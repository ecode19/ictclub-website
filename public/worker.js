let postType
self.addEventListener('push', (e) => {
  const data = e.data.json()
  postType = data.postType
  self.registration.showNotification(data.title, {
    body: `Title: ${data.message}`,
    icon: 'img/logo.jpg', 
    vibrate: [200, 100, 200],
  })
})

// listen for a click event in the notification
self.addEventListener('notificationclick', (event) => {
    event.notification.close()

    const urlToOpen = postType === 'resource' ? '/user/resources' : '/user/announcement'

    event.waitUntil(clients.matchAll({type: 'window'}).then((clientList) => {
        for(const client of clientList) {
            if(client.url.endsWith(urlToOpen) && 'focus' in client) {
                return client.focus()
            }
        }

        if(clients.openWindow) {
            return clients.openWindow(urlToOpen)
        }
    }))
})
