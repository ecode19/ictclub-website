<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update | ICT Club</title>
    <!--links-->
    @include('links')
</head>

<body>
    @include('admin.adminNav')
    <main>
        @include('admin.message')
        <div class="container">
            <form class="mx-5 mt-5" action="{{ route('edit', $members->id) }}" method="post" autocomplete="off">
                @csrf
                @method('put')
                <h5 class="text-primary fs-3">Update Member Informations</h5>
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-6 mb-3">
                        <label class="fw-bold" for="regNo">REGISTRATION NUMBER</label>
                        <input type="text" class="form-control" name="regNo"
                            value="{{ $members->registration_number }}">
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-3">
                        <label class="fw-bold" for="Firstname">FULLNAME</label>
                        <input type="text" class="form-control" name="firstname" value="{{ $members->fullname }}">
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-3">
                        <label for="name" class="fw-bold">COURSE</label>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                            name="course">
                            <option value="{{ $members->course }}">{{ $members->course }}</option>
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
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                            name="category">
                            <option value="{{ $members->category }}">{{ $members->category }}</option>
                            <option value="Graphics Designing">Graphics Designing</option>
                            <option value="Programming">Programming</option>
                            <option value="Cyber Security">Cyber Security</option>
                            <option value="Comp Maintenance">Comp Maintenance</option>
                            <option value="Web Development">Web Development</option>
                        </select>
                        {{-- <span class="text-danger">
                            @error('category')
                                {{ $message }}
                            @enderror
                        </span> --}}
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-3">
                        <label for="name" class="fw-bold form-label">PAYMENT STATUS</label>
                        <select class="form-select form-select-lg" aria-label=".form-select-lg example"
                            name="payment_status">
                            <option value="{{ $members->payment_status }}">{{ $members->payment_status }}</option>
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
                <button type="submit" name="update" class="btn btn-warning text-dark fw-bold">Update</button>
            </form>
        </div>
</body>

</html>
