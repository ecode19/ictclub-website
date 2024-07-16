const resourceTitleDOM = document.getElementById('resourceTitle')
const departmentDOM = document.getElementById('department')
const submitBtn = document.getElementById('submitBtn')

submitBtn.addEventListener('click', () => {
    sendNotification()
  })

const sendNotification = async () => {
const department = departmentDOM.value
const title = resourceTitleDOM.value
const postType = 'resource'

    try {
      const response = await axios.post(
        '/api/v1/notifications/sendNotification',
        {
          department,
          title,
          postType,
        }
      )
    } catch (error) {
      console.error(error)
    }
  }



