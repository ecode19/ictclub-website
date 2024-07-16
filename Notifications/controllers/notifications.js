const webpush = require("web-push");
const mysql = require("mysql");

// Web push
const publicVapidKey = process.env.PUBLIC_VAPID_KEY;

const privateVapidKey = process.env.PRIVATE_VAPID_KEY;

webpush.setVapidDetails(
    "mailto:test@test.com",
    publicVapidKey,
    privateVapidKey
);

// Establish DB Connection
// Create DB connection
const db = mysql.createConnection({
    host: process.env.DB_HOST, // host name
    user: process.env.DB_USERNAME, // DB user
    password: process.env.DB_PASSWORD, // DB password
    database: process.env.DB_DATABASE, // DB name
});

// connect
db.connect((err) => {
    if (err) {
        throw err;
    }
    console.log("MySql connected...");
});

const addSubscription = (req, res) => {
    const subscription = req.body;
    const endpoint = subscription.endpoint;
    const keys = JSON.stringify(subscription.keys); // convert keys to JSON string
    const expirationTime = subscription.expirationTime
        ? subscription.expirationTime
        : null;
    const userId = req.params.id;

    // Retrieve the subscriptoins to see if the user had already subscribed before
    let fetchQuery = `SELECT * from subscriptions WHERE user_ID = ${userId}`;

    let query2 = db.query(fetchQuery, (err, result) => {
        if (!isEmpty(result)) {
            let updateQuery =
                "UPDATE subscriptions SET endpoint = ?, sub_keys = ?, expirationTime = ? WHERE user_ID = ?";
            let query3 = db.query(
                updateQuery,
                [endpoint, keys, expirationTime, userId],
                (err, result) => {
                    if (err) throw err;
                }
            );
        } else {
            let insertQuery = `INSERT INTO subscriptions VALUES (?, ?, ?, ?)`;
            let query = db.query(
                insertQuery,
                [userId, endpoint, keys, expirationTime],
                (err, result) => {
                    if (err) throw err;
                }
            );
        }
        res.status(201).json({ msg: "Successfull subscibed" });
    });
};

const removeSubscription = (req, res) => {
    const userId = req.params.id;

    let deleteQuery = "DELETE FROM subscriptions WHERE user_ID = ?";
    let query = db.query(deleteQuery, userId, (err, result) => {
        if (err) throw err;
        console.log(result);
    });
    res.status(200).json({ msg: "Successfull unsubscribed" });
};

const sendNotification = async (req, res) => {
    const { department, title, postType, description } = req.body;
    let payload;
    if (postType === "resource") {
        payload = JSON.stringify({
            title: `New Resource: ${department}`,
            message: title,
            postType,
        });
    } else if (postType === "announcement") {
        payload = JSON.stringify({
            title: `New Announcement: ${title}`,
            message: description,
            postType,
        });
    }

    let subscription;

    // Get all the subscribed users
    let selectQuery = `SELECT * FROM subscriptions`;
    let query1 = db.query(selectQuery, (err, result) => {
        if (err) throw err;

        try {
            for (const row of result) {
                const userId = row.user_ID;
                subscription = {
                    endpoint: row.endpoint,
                    keys: JSON.parse(row.sub_keys),
                    expirationTime: row.expirationTime,
                };

                if (postType === "resource") {
                    // check if department matches the required one
                    let selectQuery2 =
                        "SELECT category FROM users WHERE id = ?";
                    let query3 = db.query(
                        selectQuery2,
                        userId,
                        (err, result) => {
                            if (err) throw err;
                            if (result[0].category === department) {
                                webpush
                                    .sendNotification(subscription, payload)
                                    .catch((err) => console.log(err));
                            }
                        }
                    );
                } else if (postType === "announcement") {
                    // send notification to everyone
                    webpush
                        .sendNotification(subscription, payload)
                        .catch((err) => console.log(err));
                }
            }
        } catch (error) {
            if (error.statusCode === 410) {
                console.log("Subscription has expired or unsubscribed");
            } else {
                console.log("error sending notification:", error);
            }
        }
    });
};

// look if an object is empty
function isEmpty(obj) {
    return Object.keys(obj).length === 0;
}

module.exports = { addSubscription, removeSubscription, sendNotification };
