@extends('layouts.cyber-security')
@section('content')
    <div class="container mt-5">
        <h4 class="text-center text-uppercase fw-bold">Cyber security Members</h4>
        <div class="text-end mb-3">
            <a href="{{ route('cyber-security.register.member') }}">
                <button class="btn btn-primary btn-sm fw-bold"> <i class="fa fa-plus fw-bold" aria-hidden="true"></i>
                    Add</button>
            </a>
        </div>
        <div class="text-center mb-3 ">
            <button class="activeMembersBtn departmentBtn w-25">active Members</button>
            <button class="inactiveMembersBtn departmentBtn w-25">inactive Members</button>
        </div>

        <div class="activeMembersTable">
            <h5 class="mb-3">#active member list</h5>
            <table class="table table-success table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Registration Number</th>
                        <th>Course</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 1;
                    @endphp
                    @if ($cybersecurityMembers->count() > 0)
                        @foreach ($cybersecurityMembers as $cyberSecurityMember)
                            @if ($cyberSecurityMember->payment_status == 'active')
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $cyberSecurityMember->registration_number }}</td>
                                    <td>{{ $cyberSecurityMember->course }}</td>
                                    <td>{{ $cyberSecurityMember->category }}</td>

                                    <td>
                                        <a href="">
                                            <button class="btn btn-warning btn-sm mx-2"><i class="fa fa-eye"
                                                    aria-hidden="true"></i></button>
                                        </a>

                                        <form method="POST"
                                            action="{{ route('cyber-security.member.destroy', [$cyberSecurityMember->id]) }}"
                                            enctype="multipart/form-data" class="delete-form d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-button"><i
                                                    class="fa fa-trash-alt" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                    @endif
                </tbody>
            </table>
        </div>


        <div class="inactiveMembersTable">
            <h5 class="mb-3">#Inactive member list</h5>
            <table class="table table-success table-bordered table-hover table-striped table-responsive ">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Registration Number</th>
                        <th>Course</th>
                        <th>Category</th>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 1;
                    @endphp
                    @if ($cybersecurityMembers->count() > 0)
                        @foreach ($cybersecurityMembers as $cyberSecurityMember)
                            @if ($cyberSecurityMember->payment_status == 'inactive')
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $cyberSecurityMember->registration_number }}</td>
                                    <td>{{ $cyberSecurityMember->course }}</td>
                                    <td>{{ $cyberSecurityMember->category }}</td>

                                    <td>
                                        <a href="">
                                            <button class="btn btn-warning btn-sm mx-2"> <i class="fa fa-eye"
                                                    aria-hidden="true"></i></button>
                                        </a>

                                        <form method="POST"
                                            action="{{ route('cyber-security.member.destroy', [$cyberSecurityMember->id]) }}"
                                            enctype="multipart/form-data" class="delete-form d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-button"><i
                                                    class="fa fa-trash-alt" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                    @endif
                </tbody>
            </table>

        </div>

        @if ($cybersecurityMembers->isEmpty())
            <p class="alert alert-warning" role="alert">Currently, No member has been registered under
                <strong>Cyber security</strong>
                department.
            </p>
        @endif
    </div>
@endsection
