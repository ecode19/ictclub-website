@extends('layouts.programming')
@section('content')

    <body>
        <div class="container">
            <div class="col-12 col-lg-6 mt-3 ms-auto">
                <form action="{{ route('names.search') }}" method="GET">
                    @csrf
                    <label for="search" class="mb-3 fw-bold">Search</label>
                    <input type="search" class="form-control" name="registration_number" id="search"
                        placeholder="Type member registration number to start search.">
                    <button type="submit" class="departmentBtn mt-2">Search</button>
                </form>
            </div>

            <div class="row mt-3">
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="departments-card">
                        <div class="ico text-center">
                            <i class="fa fa-users fs-1" aria-hidden="true" style="color: #c8fc50"></i>
                            <h2>Active member</h2>
                            <h4>{{ $activeMembers }}</h4>
                            <hr>
                            <a href=""><button class="fw-bold departmentBtn">View</button></a>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4">
                    <div class="departments-card">
                        <div class="text-center">
                            <i class="fa fa-close fs-1" aria-hidden="true" style="color: #c8fc50"></i>
                            <h2>Inactive member</h2>
                            <h4>{{ $inactiveMembers }}</h4>
                            <hr>
                            <a href=""><button class="fw-bold departmentBtn">View</button></a>
                        </div>

                    </div>
                </div>


                <div class="col-12 col-md-4 col-lg-4">
                    <div class="departments-card">
                        <div class="ico text-center">
                            <i class="fa fa-dollar fs-1" aria-hidden="true" style="color: #b2fc07"></i>
                            <h2>Resources</h2>
                            @if ($totalRescources === 0)
                                <strong class="text-warning">Currently no resource.</strong>
                            @else
                                <h3 class="fw-bold">{{ $totalRescources }}</h3>
                            @endif

                            <hr>
                            <a href="{{ route('cyber-security.members') }}"><button
                                    class="fw-bold departmentBtn">View</button></a>
                        </div>
                    </div>
                </div>

            </div>

            <table class="table table-success table-bordered table-hover table-striped table-responsive ">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Registration Number</th>
                        <th>Course</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 1;
                    @endphp
                    @if ($programmingMembers->count() > 0)
                        @foreach ($programmingMembers as $programmingMember)
                            @if ($programmingMember->id != $authicatedUser->id)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $programmingMember->registration_number }}</td>
                                    <td>{{ $programmingMember->course }}</td>
                                    <td>{{ $programmingMember->category }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>

            @if ($programmingMembers->isEmpty())
                <p class="alert alert-warning" role="alert">Currently, No member has been registered under
                    <strong>programming</strong>
                    department.
                </p>
            @endif


            <h1>{{ $totalProgrammingMembers }}</h1>
            <i class="fa fa-address-book fs-2" aria-hidden="true" style="color: #8E05c2"></i>
        </div>
    @endsection
