@extends('layouts.graphics-designing')
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
                            <h4>{{ $totalActiveMembers }}</h4>
                            <hr>
                            <a href="#active" data-bs-toggle="modal"><button
                                class="fw-bold departmentBtn">View</button></a>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4">
                    <div class="departments-card">
                        <div class="text-center">
                            <i class="fa fa-close fs-1" aria-hidden="true" style="color: #c8fc50"></i>
                            <h2>Inactive member</h2>
                            <h3>{{ $totalInactiveMembers }}</h3>
                            <hr>
                            <a href="#inactive" data-bs-toggle="modal"><button
                                    class="fw-bold departmentBtn">View</button></a>
                        </div>

                    </div>
                </div>


                <div class="col-12 col-md-4 col-lg-4">
                    <div class="departments-card">
                        <div class="ico text-center">
                            <i class="fa fa-folder-open fs-1" aria-hidden="true" style="color: #b2fc07"></i>
                            <h2>Resources</h2>
                            @if ($totalRescources === 0)
                                <strong class="text-warning">Currently no resource.</strong>
                            @else
                                <h3 class="fw-bold">{{ $totalRescources }}</h3>
                            @endif

                            <hr>
                            <a href=""><button
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
                    @if ($graphicsMembers->count() > 0)
                        @foreach ($graphicsMembers as $graphicsMember)
                            @if ($graphicsMember->id != $authicatedUser->id)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $graphicsMember->registration_number }}</td>
                                    <td>{{ $graphicsMember->course }}</td>
                                    <td>{{ $graphicsMember->category }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>

            @if ($graphicsMembers->isEmpty())
                <p class="alert alert-warning" role="alert">Currently, No member has been registered under
                    <strong>programming</strong>
                    department.
                </p>
            @endif


            <h1>{{ $totalGraphicsMembers }}</h1>
            <i class="fa fa-address-book fs-2" aria-hidden="true" style="color: #8E05c2"></i>
        </div>

        <!--active members Modal HTML -->
        <div id="active" class="modal fade">
            <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" style="background: #0b1810">
                <div class="modal-content" style="background: #0b1810">
                    <div class="modal-header">
                        <h5 class="modal-title text-warning">All active members under Graphics department</h5>
                        <button type="button" class="btn-close bg-warning" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @foreach ($activeMembers as $activeMember)
                            <h6 class="">{{ $activeMember->registration_number }}</h6>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> --}}
                    </div>
                </div>
            </div>
        </div>

        <!--Inactive members Modal HTML -->
        <div id="inactive" class="modal fade">
            <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" style="background: #0b1810">
                <div class="modal-content" style="background: #0b1810">
                    <div class="modal-header">
                        <h5 class="modal-title text-warning">All inactive members under Graphics department</h5>
                        <button type="button" class="btn-close bg-warning" data-bs-dismiss="modal"></button>
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