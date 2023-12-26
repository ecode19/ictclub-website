<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Members | Mwecaiu-ICT club</title>

    <!-- for title img -->
    @include('links')
</head>

<body>
    @include('admin.adminNav')
    <main>
        @include('admin.message')
        <div class="container">
            <a href="{{ route('add_department') }}"><button class="btn btn-primary mx-5 mt-3 text-sm-end">Add New
                    Department</button></a>
            <h1 class="text-primary text-center">ICT CLUB DEPARTMENTS </h1>
            <table id="memberTable"
                class=" shadow-lg table table-secondary table-hover table-bordered table-striped table-center">
                <thead>
                    <tr class="fw-bold">
                        <td>Dept Code</td>
                        <td>Dept Name</td>
                        <td>Dept Members</td>
                        <td>Dept HOD</td>
                        <td>Usertype</td>
                        <td>Registered At</td>
                        <td>ACTION</td>
                    </tr>
                </thead>
                <tbody>
                    @if (count($members) > 0)
                        @foreach ($members as $members)
                            <tr>
                                <td>{{ $members->fullname }}</td>
                                <td>{{ $members->registration_number }}</td>
                                <td>{{ $members->course }}</td>
                                <td>{{ $members->category }}</td>
                                <td>{{ $members->usertype }}</td>
                                <td>{{ $members->created_at }}</td>
                                <td><a class="btn btn-warning" href="{{ url('editUser', $members->id) }}">Edit</a>
                                    <a class="btn btn-danger" href="{{ url('deleteUser', $members->id) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <p class="text-danger fw-bold">CURRENTLY NO DEPARTMENT REGISTERED</p>
                    @endif
                </tbody>
            </table>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('#memberTable').DataTable();
        });
    </script>
</body>

</html>
