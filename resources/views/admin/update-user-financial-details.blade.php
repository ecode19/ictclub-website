@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <form class="mx-5 mt-5" action="{{ route('update.expiration.date', $payments->id) }}" method="post" autocomplete="off">
            @csrf
            @method('put')
            <h5 class="text-primary fs-3">Financial Informations</h5>
            <hr>
            <div class="row">
                <input type="hidden" name="user_id" value="{{ $payments->user_id }}">
                <div class="col-12 col-md-12 col-lg-6 mb-3">
                    <label class="fw-bold" for="date_paid">Date Paid</label>
                    <input type="date" class="form-control mb-3" name="date_paid" id="date_paid" value="{{ $payments->date_paid }}">
                    <small class="mt-3 mb-3"><strong>Date Paid:</strong> {{ $payments->date_paid }} </small>
                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-3">
                    <label class="fw-bold" for="expiration_date">Expiration Date</label>
                    <input type="date" class="form-control mb-3" name="expiration_date" id="expiration_date" value="{{ $payments->expiration_date }}">
                    <small class="mt-3 mb-3"><strong class="text-danger">Expired On:</strong> {{ $payments->expiration_date }} </small>
                </div>
            </div>

            <button type="submit" class="btn btn-success"> <i class="fa fa-save" aria-hidden="true"></i> Save</button>
        </form>
    </div>
@endsection
