@extends('layouts.cyber-security')
@section('content')

    <body>
        <div class="container">
            <div class="col-12 col-lg-6 mt-3 ms-auto">
                <form action="{{ route('names.search') }}" method="GET">
                    @csrf
                    <label for="search" class="mb-3 fw-bold">Search</label>
                    <input type="search" class="form-control @error('registration_number') is-invalid @enderror"
                        name="registration_number" id="search" placeholder="Type here to start search">

                    @error('registration_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <button type="submit" class="departmentBtn mt-2">Search</button>
                </form>
            </div>

            <div class="row mt-3">
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="departments-card">
                        <div class="ico text-center">
                            <i class="fa fa-users fs-1" aria-hidden="true" style="color: #b2fc07;"></i>
                            <h2>Active member</h2>
                            <h3 class="fw-bold">{{ $activeMembers }}</h3>
                            <hr>
                            <a href=""><button class="fw-bold departmentBtn">View</button></a>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4">
                    <div class="departments-card">
                        <div class="text-center">
                            <i class="fa fa-close fs-1" aria-hidden="true" style="color: #b2fc07"></i>
                            <h2>Inactive member</h2>
                            <h3 class="fw-bold">{{ $totalinactiveMembers }}</h3>
                            <hr>
                            <a href="#inactive" data-bs-toggle="modal"><button
                                    class="fw-bold departmentBtn">View</button></a>
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

                <table class="table table-success table-bordered table-hover table-striped table-responsive ">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Registration Number</th>
                            <th>Course</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @if ($cyberSecurityMembers->count() > 0)
                            @foreach ($cyberSecurityMembers as $cyberSecurityMember)
                                @if ($cyberSecurityMember->id != $authenticatedUser->id)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $cyberSecurityMember->registration_number }}</td>
                                        <td>{{ $cyberSecurityMember->course }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                        @endif
                    </tbody>
                </table>

                @if ($cyberSecurityMembers->isEmpty())
                    <p class="alert alert-warning" role="alert">Currently, No member has been registered under
                        <strong>Cyber security</strong>
                        department.
                    </p>
                @endif
            </div>
        </div>

        <!--Inactive members Modal HTML -->
        <div id="inactive" class="modal fade">
            <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" style="background: #0b1810">
                <div class="modal-content" style="background: #0b1810">
                    <div class="modal-header">
                        <h5 class="modal-title">All inactive members under cyber security department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @foreach ($inactiveMembers as $inactiveMember)
                            <h6 class="">{{ $inactiveMember->registration_number }}</h6>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> --}}
                    </div>
                </div>
            </div>
        </div>
    @endsection
