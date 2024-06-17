@extends('layouts.graphics-designing')
@section('content')
    <div class="container mt-5">
        <h4 class="text-center text-uppercase fw-bold">Graphics Members</h4>
        <hr>
        <div class="text-end mb-3">
            <a href="{{ route('graphics.register.member') }}">
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
                        $active = 0;
                    @endphp
                    @if ($graphicsMembers->count() > 0)
                        @foreach ($graphicsMembers as $graphicsMember)
                            @if ($graphicsMember->payment_status == 'active')
                                {{ $active++ }}
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $graphicsMember->registration_number }}</td>
                                    <td>{{ $graphicsMember->course }}</td>
                                    <td>{{ $graphicsMember->category }}</td>

                                    <td>
                                        <a href="{{ route('graphics.update.member.view', [$graphicsMember->id]) }}">
                                            <button class="btn btn-warning btn-sm mx-2"><i class="fa fa-eye"
                                                    aria-hidden="true"></i></button>
                                        </a>

                                        <form method="POST"
                                            action="{{ route('graphics.member.delete', [$graphicsMember->id]) }}"
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
                    @if ($graphicsMembers->count() > 0)
                        @foreach ($graphicsMembers as $graphicsMember)
                            @if ($graphicsMember->payment_status == 'inactive')
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $graphicsMember->registration_number }}</td>
                                    <td>{{ $graphicsMember->course }}</td>
                                    <td>{{ $graphicsMember->category }}</td>

                                    <td>
                                        <a href="{{ route('graphics.update.member.view', [$graphicsMember->id]) }}">
                                            <button class="btn btn-warning btn-sm mx-2"> <i class="fa fa-eye"
                                                    aria-hidden="true"></i></button>
                                        </a>

                                        <form method="POST"
                                            action="{{ route('graphics.member.delete', [$graphicsMember->id]) }}"
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
                        <tr>
                            <td colspan="5" class="text-center">
                                <div>
                                    All members currently have an active status. Please check the active members list for
                                    more information.
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>


        </div>
    </div>
@endsection
