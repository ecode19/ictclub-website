<!DOCTYPE html>
<html>

<head>
    @include('links')

</head>

<body>
    @include('admin.adminNav')
    <main>
        <div class="container mt-5">
            <h2 class="text-dark">Event Management</h2>
            <!-- Event creation form -->
            <form action="process_event.php" method="post">
                <div class="form-group">
                    <label for="event_name">Event Name:</label>
                    <input type="text" class="form-control" id="event_name" name="event_name" required>
                </div>
                <div class="form-group">
                    <label for="event_date">Event Date:</label>
                    <input type="date" class="form-control" id="event_date" name="event_date" required>
                </div>
                <button type="submit" class="btn color mt-3">Create Event</button>
            </form>
            <hr>
            <!-- List of existing events -->
            <h3>Existing Events:</h3>
            <ul class="list-group">
                <li class="list-group-item">Event 1 - August 25, 2023</li>
                <li class="list-group-item">Event 2 - September 10, 2023</li>
                <!-- Add dynamically generated list items for each event -->
            </ul>
        </div>
    </main>

</body>

</html>
