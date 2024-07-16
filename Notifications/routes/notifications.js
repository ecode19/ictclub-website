const express = require('express')
const router = express.Router()
const {
  addSubscription,
  removeSubscription,
  sendNotification,
} = require('../controllers/notifications')

router.route('/subscribe/:id').post(addSubscription)
router.route('/unsubscribe/:id').delete(removeSubscription)
router.route('/sendNotification').post(sendNotification)

module.exports = router
