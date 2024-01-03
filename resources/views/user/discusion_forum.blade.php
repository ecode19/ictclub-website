<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusion Forum</title>

    @include('links')
</head>

<body>
    @include('user.usernav')
    <div class="container">
        <div class="mt-3">
            <h3 class="text text-primary"><strong class="text-warning">Hi,</strong>, {{ $userInfo->fullname }}</h3>
            <p>Welcome to the ICT club Discusion forum.</p> We are kindly request to to
            <a class="text-decoration-none"
                href="https://ict-chat-forum.onrender.com/index.html/{{ urlencode($userInfo->fullname) }}">click
                here </a> to connected to the Live Discusion Forum
        </div>
    </div>

</body>

</html>
