  // Events handling
  const eventName = document.getElementById('eventName')
  const eventDesc = document.getElementById('eventDesc')
  const postEventBtn = document.getElementById('postEvent')

  postEventBtn.addEventListener('click', async () => {
    console.log('form clicked...')
    const title = eventName.value
    const description = eventDesc.value
    const postType = 'announcement'

        try {
          const response = await axios.post(
            '/api/v1/notifications/sendNotification',
            {
              title,
              description,
              postType,
            }
          )
        } catch (error) {
          console.error(error)
        }

  })
