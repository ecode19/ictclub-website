@extends('layouts.admin')
@section('content')
        @include('admin.message')
        <div class="container">
            <h1 class="text-primary text-center">Mwecau ICT Club Members </h1>
            <a href="{{ route('admin.register.member') }}"><button class="btn btn-primary btn-sm mx-5 mt-3 mb-4 text-sm-end"> <i class="fa fa-user-plus" aria-hidden="true"></i> Add New</button></a>
            <table id="myTable"
                class=" shadow-lg table table-secondary table-hover table-bordered table-striped table-center">
                <thead>
                    <tr class="fw-bold">
                        <td>Fullname</td>
                        <td>Registration Number</td>
                        <td>Course</td>
                        <td>Category</td>
                        <td>Usertype</td>
                        <td>Registered At</td>
                        <td>ACTION</td>
                    </tr>
                </thead>
                <tbody>
                    @if (count($members) > 0)
                        @foreach ($members as $members)
                            <tr>
                                <td>{{ $members->fullname }}</td>
                                <td>{{ $members->registration_number }}</td>
                                <td>{{ $members->course }}</td>
                                <td>{{ $members->category }}</td>
                                <td>{{ $members->usertype }}</td>
                                <td>{{ $members->created_at }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="{{ route('update', ['id' => $members->id]) }}">
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
            <div class="mt-3">
                 <a class="btn btn-secondary mb-5" href="{{ route('all.registered.members') }}">Print</a>
            </div>

        </div>

    <script>
        $(document).ready(function() {
            $('#memberTable').DataTable();
        });
    </script>
@endsection
