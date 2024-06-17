@extends('layouts.graphics-designing')
@section('content')
    <div class="container">
        <form class="mx-5 mt-5" action="{{ route('graphics.update.member.info', $memberInfo->id) }}" method="post" autocomplete="off">
            @csrf
            @method('put')
            <h5 class="text-secondary fs-3">Update Member Informations</h5>
            <hr>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6 mb-3">
                    <label class="fw-bold" for="regNo">REGISTRATION NUMBER</label>
                    <input type="text" class="form-control" name="regNo"
                        value="{{ $memberInfo->registration_number }}">
                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-3">
                    <label class="fw-bold" for="Firstname">FULLNAME</label>
                    <input type="text" class="form-control" name="firstname" value="{{ $memberInfo->fullname }}">
                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-3">
                    <label for="name" class="fw-bold">COURSE</label>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="course">
                        <option value="{{ $memberInfo->course }}">{{ $memberInfo->course }}</option>
                        <option value="BAGEN">BAGEN</option>
                        <option value="BScCS">BScCS</option>
                        <option value="Biology ICT">Biology ICT</option>
                        <option value="Chemistry ICT">Chemistry ICT</option>
                        <option value="Statistics ICT">Statistics ICT</option>
                    </select>
                    {{-- <span class="text-danger">
                            @error('course')
                                {{ $message }}
                            @enderror
                        </span> --}}

                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-3">
                    <label for="name" class="fw-bold form-label">CATEGORY</label>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="category">
                        <option value="{{ $memberInfo->category }}">{{ $memberInfo->category }}</option>
                        <option value="Graphics Designing">Graphics Designing</option>
                        <option value="programming">programming</option>
                        <option value="cyber security">cyber security</option>
                        <option value="comp Maintenance">comp maintenance</option>
                        <option value="web Development">web development</option>
                    </select>
                    {{-- <span class="text-danger">
                            @error('category')
                                {{ $message }}
                            @enderror
                        </span> --}}
                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-3">
                    <label for="name" class="fw-bold form-label">PAYMENT STATUS</label>
                    <select class="form-select form-select-lg" aria-label=".form-select-lg example" name="payment_status">
                        <option value="{{ $memberInfo->payment_status }}">{{ $memberInfo->payment_status }}</option>
                        <option value="active">active</option>
                        <option value="inactive">inactive</option>
                    </select>
                    <span class="text-danger">
                        @error('category')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
            <button type="submit" name="update" class="btn btn-warning text-dark"> <i class="fa fa-save"
                    aria-hidden="true"></i> Save</button>
        </form>
    </div>
@endsection
