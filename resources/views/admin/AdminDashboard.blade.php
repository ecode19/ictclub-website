<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Dashboard</title>

    {{-- links --}}
    @include('links')
</head>

<body>

    {{-- @if ($payment_status == 1)
        @include('users.usernav') --}}
    @include('admin.adminNav')
    <main>
        <div class="container">
        <div class="mt-5">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="mb-3">
            @if (session()->has('fail'))
                <span class="alert alert-danger p-3 mt-5">
                            {{ session('fail') }}
                        </span>
            @endif
        </div>


{{--        @extends('layouts.app')--}}



        <div class="container">
            <div class="dropdown text-end mt-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    {{ Auth::user()->fullname }}, ({{ Auth::user()->usertype }})
                </button>
                <ul class="dropdown-menu bg-secondary">
                    <li><a class="dropdown-item" href="teachers.php">Profile</a></li>
                    <li><a class="dropdown-item" href="#"></a></li>
                    {{ Auth::user()->fullname }}
                </ul>
            </div>
        </div>
            <div class="row">
                <div class="mt-3">
                </div>
                <div class="col-12 col-md-6 col-lg-3 mt-2">
                    <div class="card shadow hv">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fa fa-user-graduate text-primary fa-2x" aria-hidden="true"></i>
                                <div class="fs-4 fw-bold">{{ $allMembers }}</div>
                                <p class="text-dark">Registered Member</p>
                                <hr>
                                <small><a href="{{ route('member_list') }}"
                                        class="text-decoration-none fs-5 text-dark">View</a></small>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 mt-2">
                    <div class="card text-light shadow hv">
                        <div class="card-body">
                            <div class="text-dark text-center">
                                <i class="fa fa-users text-primary fa-2x" aria-hidden="true"></i>
                                <div class="fs-4 fw-bold">{{ $activeMembers }}</div>
                                <p class="text-dark">Active Members</p>
                                <hr>
                                <small><a href="member_list.php"
                                        class="text-decoration-none fs-5 text-dark">View</a></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 mt-2">
                    <div class="card text-light shadow hv">
                        <div class="card-body">
                            <div class="text-dark text-center">
                                <i class="fas fa-university text-primary fa-2x" aria-hidden="true"></i>
                                <div class="fs-4 fw-bold">{{ $allMembers }}</div>
                                <p class="text-dark">Departments</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 mt-2">
                    <div class="card text-light shadow hv">
                        <div class="card-body">
                            <div class="text-dark text-center">
                                <i class="fas fa-signal text-primary fa-2x" aria-hidden="true"></i>
                                <div class="fs-3 fw-bold">{{ $inactiveMembers }}</div>
                                <p class="text-dark">Inactive Members</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post" class="mt-5">
                <a href="member_list.php" class="text-decoration-none fw-bold text-dark">Member list</a>
                <table id="memberTable"
                    class="table table-primary table-hover table-striped table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>RegNo</th>
                            <th>FULL NAME</th>
                            <th>Course</th>
                            <th>Mark as Paid</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fetch member list from the database -->
                        @if (count($members) > 0)
                            @foreach ($members as $members)
                                <tr>
                                    <td>{{ $members->registration_number }}</td>
                                    <td>{{ $members->fullname }}</td>
                                    <td>{{ $members->course }}</td>
                                    <td>{{ $members->payment_status }}</td>
                                    {{-- <td>{{ $members->created_at }}</td> --}}
                                    <td><a class="btn btn-warning"
                                            href="{{ route('update', ['id' => $members->id]) }}">Edit</a>

                                        <a class="btn btn-danger"
                                            href="{{ url('deleteUser', $members->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p class="text-danger fw-bold">CURRENTLY NO RECORDS FOUND</p>
                        @endif

                    </tbody>
                </table>
                <button type="submit" name="payment_update" class="btn color mb-3">Update Payment Status</button>
            </form>
        </div>
        {{-- @else --}}
        {{-- @include('users.accessDenied') --}}
    </main>
    {{-- @endif --}}
    <!--bootstrap javascrip-->
    <script>
        $(document).ready(function() {
            $('#memberTable').DataTable();
        });
    </script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>

</html>


