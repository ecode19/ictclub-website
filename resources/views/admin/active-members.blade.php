@extends('layouts.admin')
@section('content')
    @include('admin.message')
    <div class="container">
        <h1 class="text-primary text-center">Active Members </h1>
        <table id="myTable" class=" shadow-lg table table-secondary table-hover table-bordered table-striped table-center">
            <thead>
                <tr class="fw-bold">
                    <td>Fullname</td>
                    <td>Registration Number</td>
                    <td>Course</td>
                    <td>Category</td>
                </tr>
            </thead>
            <tbody>
                @if (count($activeMembers) > 0)
                    @foreach ($activeMembers as $members)
                        <tr>
                            <td>{{ $members->fullname }}</td>
                            <td>{{ $members->registration_number }}</td>
                            <td>{{ $members->course }}</td>
                            <td>{{ $members->category }}</td>
                        </tr>
                    @endforeach
                @else
                    <p class="text-danger fw-bold">CURRENTLY NO RECORDS FOUND</p>
                @endif
            </tbody>
        </table>
        <div class="mt-3">
            <a class="btn btn-secondary mb-5" href="{{ route('active-members') }}">Print</a>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#memberTable').DataTable();
        });
    </script>
@endsection
