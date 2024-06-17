@extends('layouts.admin')
@section('content')
    @include('admin.message')
    <div class="container">
        <h1 class="text-primary text-center">ICT CLUB DEPARTMENTS </h1>
        <a href="{{ route('add_department') }}"><button class="btn btn-primary mx-5 mb-3 text-sm-end"> <i
                    class="fa fa-plus fw-bold"></i> New
                Department</button></a>
        <table id="memberTable"
            class=" shadow-lg table table-secondary table-hover table-bordered table-striped table-center">
            <thead>
                <tr class="fw-bold">
                    <td>S/N</td>
                    <td>Department Name</td>
                    {{-- <td>Department Description</td> --}}
                    <td>Date Created</td>
                    <td>Admin</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 1;
                @endphp
                @if (count($departments) > 0)
                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td class="text-dark">{{ $department->dept_name }}</td>
                            <td>{{ $department->created_at }}</td>
                            <td>
                                @if ($department->admins->isEmpty())
                                    <p class="text-danger">No admin assigned</p>
                                @else
                                    @foreach ($department->admins as $admin)
                                        {{ $admin->user->fullname }}@if (!$loop->last), @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a href="">
                                    <button class="btn btn-warning btn-sm mx-2"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                </a>
                                <form method="POST" action="{{ route('admin.department.destroy', [$department->id]) }}" enctype="multipart/form-data" class="delete-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-button"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <p class="text-danger fw-bold">CURRENTLY NO DEPARTMENT REGISTERED</p>
                @endif
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#memberTable').DataTable();
        });
    </script>
@endsection
