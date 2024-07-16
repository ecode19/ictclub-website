const publicVapidKey =
  'BIWkeiGBiaCYNVmIh8UUCkOdbGM5V1S_msbvJnba6knR5kyTiBglZoRMhQpw1kzuPFt5_wzAwDqW4eIUx52QihI'
let register
const userIdDOM = document.getElementById('userIdBtn')
const userId = userIdDOM.dataset.id

// Check for and register service worker
document.addEventListener('DOMContentLoaded', async () => {
    try {
      // Check if service worker is supported
      if ('serviceWorker' in navigator) {
        // Register service worker
        register = await navigator.serviceWorker.register('/worker.js', {
          scope: '/',
        })
      }
      console.log('service worker registered...')
    } catch (error) {
      console.log('service worker registration failed')
      console.log(error)
    }

    const isSubscribed = await checkSubscription()
    updateButtonState(isSubscribed)
  })

userIdDOM.addEventListener('click', async () => {
    userIdDOM.disabled = true
    const isSubscribed = await checkSubscription()

    if(isSubscribed) {
        await unsubscribeUser()
    } else {
        subscribeUser()
    }
})

// Check for user subscription
const checkSubscription = async () => {
    // check if service worker is supported
    if('serviceWorker' in navigator) {
        // Get push subscription
        const subscription = await register.pushManager.getSubscription()
        return !!subscription // returns true if subscribed, false otherwise
    }
    return false
}

// Function to subscribe the user
const subscribeUser = async () => {
    // Subscribe the user
    const subscription = await register.pushManager.subscribe({
      userVisibleOnly: true,
      applicationServerKey: urlBased64ToUint8Array(publicVapidKey),
    })

    // Send push subscription to the server
    const response = await axios.post(
      `/api/v1/notifications/subscribe/${userId}`,
      subscription
    )

    if(response) {
        userIdDOM.disabled = false
        updateButtonState(true)
    }
  }

// Function to unsubscribe the user
const unsubscribeUser = async () => {
  // Get push subscription
  const subscription = await register.pushManager.getSubscription()

  if (subscription) {
    // Unsubscribe the user
    await subscription.unsubscribe()

    // Remove push subscription from the server
    const response = await axios.delete(
      `/api/v1/notifications/unsubscribe/${userId}`
    )

      if(response) {
        userIdDOM.disabled = false
        updateButtonState(false)
    }
  }
}

const updateButtonState = (isSubscribed) => {
    userIdDOM.textContent = isSubscribed ? 'Block Notifications' : 'Allow Notifications'
    userIdDOM.style.backgroundColor = isSubscribed ? '#dc3545' : '#6c757d'
    userIdDOM.style.color = 'white'
}

// Utility function to convert URL-based base64 to Uint8Array
function urlBased64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - (base64String.length % 4)) % 4)
  const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/')

  const rawData = window.atob(base64)
  let outputArray = new Uint8Array(rawData.length)

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i)
  }
  return outputArray
}


