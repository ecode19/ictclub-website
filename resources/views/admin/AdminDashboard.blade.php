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
    @include('admin.adminNav')
    <main>
        @include('admin.message')

        <div class="container">
            {{--            <div class="dropdown text-end mt-3"> --}}
            {{--                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"> --}}
            {{--                    {{ Auth::user()->fullname }}, ({{ Auth::user()->usertype }}) --}}
            {{--                </button> --}}
            {{--                <ul class="dropdown-menu bg-secondary"> --}}
            {{--                    <li><a class="dropdown-item" href="teachers.php">Profile</a></li> --}}
            {{--                    <li><a class="dropdown-item" href="#"></a></li> --}}
            {{--                    {{ Auth::user()->fullname }} --}}
            {{--                </ul> --}}
            {{--            </div> --}}
        </div>
        <div class="row">
            <div class="mt-3">
                <p class="text-primary fw-bold">{{ $adminDept->department->dept_name }}</p>
                <p class="text-primary fw-bold">{{ $adminDept->user->usertype }}</p>
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
                            <i class="fas fa-university text-primary fa-2x" aria-hidden="true"></i>
                            <div class="fs-4 fw-bold">{{ $totalDepartments }}</div>
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
            <table id="memberList"
                class="table table-primary table-hover table-striped table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>RegNo</th>
                        <th>NAME</th>
                        <th>Course</th>
                        <th>Payment Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Fetch member list from the database -->
                    @if (count($members) > 0)
                        @foreach ($members as $member)
                            <tr>
                                <td>{{ $member->registration_number }}</td>
                                <td>{{ $member->fullname }}</td>
                                <td>{{ $member->course }}</td>
                                <td>{{ $member->payment_status }}</td>
                                {{-- <td>{{ $members->created_at }}</td> --}}
                                <td><a class="btn btn-warning"
                                        href="{{ route('update', ['id' => $member->id]) }}">Edit</a>

                                    <a class="btn btn-danger" href="{{ url('deleteUser', $member->id) }}">Delete</a>
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
    </main>
    {{-- @endif --}}

    <script src="{{ asset('../bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
