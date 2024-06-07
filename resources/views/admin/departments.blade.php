@extends('layouts.admin')
@section('content')
        @include('admin.message')
        <div class="container">
            <a href="{{ route('add_department') }}"><button class="btn btn-primary mx-5 mt-3 text-sm-end"> <i class="fa fa-plus fw-bold"></i> New
                    Department</button></a>
            <h1 class="text-primary text-center">ICT CLUB DEPARTMENTS </h1>
            <table id="memberTable"
                class=" shadow-lg table table-secondary table-hover table-bordered table-striped table-center">
                <thead>
                    <tr class="fw-bold">
                        <td>S/N</td>
                        <td>Department Name</td>
                        <td>Department Description</td>
                        <td>Date Created</td>
                        <td>ACTION</td>
                    </tr>
                </thead>
                <tbody>
                @php
                    $counter = 1;
                @endphp
                    @if (count($departments) > 0)
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td class="text-dark">{{ $department->dept_name }}</td>
                                <td>{{ $department->dept_description }}</td>
                                <td>{{ $department->created_at }}</td>
                                <td><a class="btn btn-warning" href="{{ url('editUser', $department->id) }}">Edit</a>
                                    <a class="btn btn-danger" href="{{ url('deleteUser', $department->id) }}">Delete</a>
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
