@extends('layouts.programming')
@section('content')
    <div class="container mt-5">
        <h4 class="text-center text-uppercase fw-bold">Programming Members</h4>
        <div class="text-end mb-3">
            <a href="{{ route('programming.register.member') }}">
                <button class="btn btn-primary btn-sm fw-bold"> <i class="fa fa-plus fw-bold" aria-hidden="true"></i>
                    Add</button>
            </a> N
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
                        $active = 0;
                    @endphp
                    @if ($programmingMembers->count() > 0)
                        @foreach ($programmingMembers as $programmingMember)
                            @if ($programmingMember->payment_status == 'active')
                                {{ $active++ }}
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $programmingMember->registration_number }}</td>
                                    <td>{{ $programmingMember->course }}</td>
                                    <td>{{ $programmingMember->category }}</td>

                                    <td>
                                        <a href="{{ route('programming.member.update', [$programmingMember->id]) }}">
                                            <button class="btn btn-warning btn-sm mx-2"><i class="fa fa-eye"
                                                    aria-hidden="true"></i></button>
                                        </a>

                                        <form method="POST"
                                            action="{{ route('programming.member.delete', [$programmingMember->id]) }}"
                                            enctype="multipart/form-data" class="delete-form d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-button"><i
                                                    class="fa fa-trash-alt" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @else
                                @continue
                                {{-- <div class="alert alert-warning" role="alert"> No active members found. Please check the
                                    inactive members list for more information.</div> --}}
                            @endif
                        @endforeach
                    {{-- @else --}}
                    @endif
                    @if ($active == 0)
                        <div class="alert alert-warning" role="alert"> No active members found. Please check the
                            inactive members list for more information.</div>
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
                    @if ($programmingMembers->count() > 0)
                        @foreach ($programmingMembers as $programmingMember)
                            @if ($programmingMember->payment_status == 'inactive')
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $programmingMember->registration_number }}</td>
                                    <td>{{ $programmingMember->course }}</td>
                                    <td>{{ $programmingMember->category }}</td>

                                    <td>
                                        <a href="{{ route('programming.member.update', [$programmingMember->id]) }}">
                                            <button class="btn btn-warning btn-sm mx-2"> <i class="fa fa-eye"
                                                    aria-hidden="true"></i></button>
                                        </a>

                                        <form method="POST"
                                            action="{{ route('programming.member.delete', [$programmingMember->id]) }}"
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
                        <div class="alert alert-warning" role="alert"> All members currently have an active
                            status. Please check the active members list for more information.</div>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
@endsection
