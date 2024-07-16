@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <h1>Enter Members Payment Details</h1>
        <div class="col-md">
            <form action="{{ route('add.member.payment.details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label class="mb-2" for="select_user">Select user</label>
                    <select name="user_id" id="userId" class="form-select @error('user_id') is-invalid @enderror">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                        @endforeach
                    </select>

                    @error('user_id')
                        <span class="invalid-feedback" role-="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="mb-2" for="datePaid">Date Paid</label>
                    <input type="date" name="date_paid"
                        class="class form-control @error('date_paid') is-invalid @enderror">
                    @error('date_paid')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="mb-2" for="expirationDate">Expiration Date</label>
                    <input type="date" name="expiration_date"
                        class="class form-control @error('expiration_date') is-invalid @enderror">

                    @error('expiration_date')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
            </form>
        </div>
    </div>

    <div class="container mt-5">
        <div class="col-md">
            <h1>Members paid membership fee</h1>
            <table id="myTable" class="table table-success table-bordered table-striped">
                @php
                    $counter = 1;
                @endphp
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Registratiton Number</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Payment status</th>
                        <th>Action</th>
                        <th>user_id</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $payment->user->registration_number }}</td>
                            <td>{{ $payment->user->fullname }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->payment_status }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('update.payment.info', [$payment->id]  ) }}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>

                                <a class="btn btn-danger" href="">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>  {{ $payment->user_id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
