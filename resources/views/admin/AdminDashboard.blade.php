@extends('layouts.admin')

{{-- <script src="{{ asset('jquery/js/jquery-3.5.1.js') }}"></script> --}}

@section('content')

    <div class="row">
        <div class="col-12 col-md-6 col-lg-3 mt-2">
            <div class="DashboardCard shadow hv">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fa fa-user-graduate text-white fa-2x" aria-hidden="true"></i>
                        <div class="fw-bolder" style="font-family: 'Trebuchet MS'">
                            <h1>{{ $allMembers }}</h1>
                        </div>
                        {{-- <div class="fs-4 fw-bold">{{ $allMembers }}</div> --}}
                        <p class="">Registered Member</p>
                        <hr>
                        <a href=""><button class="btn btn-outline-warning">View</button></a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3 mt-2">
            <div class="DashboardCard text-light shadow hv">
                <div class="card-body">
                    <div class=" text-center">
                        <i class="fa fa-users text-white fa-2x" aria-hidden="true"></i>
                        <div>
                            <h1 class="fw-bolder" style="font-family: 'Trebuchet MS'">{{ $activeMembers }}</h1>
                        </div>
                        <p class="">Active Members</p>
                        <hr>
                        <a href=""><button class="btn btn-outline-warning">View</button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3 mt-2">
            <div class="DashboardCard card text-light shadow hv">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-university text-white fa-2x" aria-hidden="true"></i>
                        <div>
                            <h1 class="fw-bolder" style="font-family: 'Trebuchet MS'">{{ $totalDepartments }}</h1>
                        </div>
                        <p class="">Departments</p>
                        <hr>
                        <a href=""><button class="btn btn-outline-warning">View</button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3 mt-2">
            <div class="DashboardCard text-light shadow hv">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-signal text-white fa-2x" aria-hidden="true"></i>
                        <div>
                            <h1 class="fw-bolder" style="font-family: 'Trebuchet MS'">{{ $inactiveMembers }}</h1>
                        </div>
                        <p class="">Inactive Members</p>
                        <hr>
                        <a href=""><button class="btn btn-outline-warning">View</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="post" class="mt-5">
        <a href="member_list.php" class="text-decoration-none fw-bold text-dark">Member list</a>
        <table id="myTable"
            class="yajra-datatable table table-primary table-hover table-striped table-responsive table-bordered">
            <thead>
                <tr>
                    <th>RegNo</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Payment Status</th>
                    <th>Date signed</th>
                    <th>Action </th>
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
                            <td>{{ $members->created_at }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('update', ['id' => $members->id]) }}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <form method="POST" action="{{ route('destroy.member', [$members->id]) }}"
                                    enctype="multipart/form-data" class="delete-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-button delete-btn"><i
                                            class="fa fa-trash-alt" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <p class="text-danger fw-bold">CURRENTLY NO RECORDS FOUND</p>
                @endif

            </tbody>
        </table>
    </form>
    </div>
@endsection
