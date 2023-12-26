<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Messages | Mwecaiu-ICT club</title>

    <!-- for title img -->
    <link rel="shortcut icon" type="image/icon" href="img/mwecau.png" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>

<body>
    <div class="container">
        <div class="card p-5">
            <div class="card-body">
                <div class="card-title">
                    <h1 class="text-primary text-center">Messages From ICT Club website users.</h1>
                </div>
                <table class=" shadow-lg table table-secondary table-hover table-bordered table-striped table-center">
                    <thead>
                        <tr class="fw-bold">
                            <td>MESSAGE</td>
                            <td>FROM</td>
                            <td>Date Sent</td>
                            <td>ACTION</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($contacts) > 0)
                            @foreach ($contacts as $contacts)
                                <tr>
                                    <td>{{ $contacts->message }}</td>
                                    <td>{{ $contacts->name }}</td>
                                    <td>{{ $contacts->created_at }}</td>
                                    <td><a class="btn btn-warning" href="{{ url('editUser', $contacts->id) }}">Edit</a>
                                        <a class="btn btn-danger"
                                            href="{{ url('deleteUser', $contacts->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p class="text-danger fw-bold">CURRENTLY NO RECORDS FOUND</p>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
