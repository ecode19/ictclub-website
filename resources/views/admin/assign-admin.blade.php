@extends('layouts.admin')
@section('content')
    <style>
        .form-control {
            color: #495057;
            /* Default color for select options */
        }

        .form-control:focus {
            color: #495057;
            /* Color for select options on focus */
        }

        option {
            color: #000;
            /* Ensure options are visible */
        }
    </style>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Assign Admin</h3>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('assignAdmin') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="user">Select User:</label>
                                <select name="user_id" id="user"
                                    class="form-select @error('user_id') is-invalid @enderror">

                                    @foreach ($users as $user)
                                        @if ($user->id != $authenticatedUser->id)
                                            <option value="{{ $user->id }}">{{ $user->registration_number }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="department">Select Department:</label>
                                <select name="department_id" id="department"
                                    class="form-select @error('department_id') is-invalid @enderror">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->dept_name }}</option>
                                    @endforeach
                                </select>

                                @error('department_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-3">Assign Admin</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Manage Admins</h3>
            </div>
        </div>
    </div>
@endsection
