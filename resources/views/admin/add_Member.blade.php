<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | ICT Club</title>
    <!--links-->
    @include('links')
</head>

<body>
    @include('admin.adminNav')
    <main>
        @include('admin.message')
        <div class="container">
            <form class="mx-5 mt-5" action="{{route('newMember')}}" method="post" autocomplete="off">
                @csrf

                @include('admin.message')
                <h1 class="text-primary fs-3">Register new Member</h1>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="registration_number">REGISTRATION NUMBER</label>
                        <input type="text" class="form-control @error('registration_number') is-invalid @enderror" value="{{old('registration_number')}}" name="registration_number"
                               placeholder="Enter Member Registration Number">

                        @error('registration_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="Full name">Full Name</label>
                        <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{old('fullname')}}"
                               placeholder="Enter Full Name">

                        @error('fullname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="email">E-Mail</label>
                        <input type="email" class="form-control @error('fullname') is-invalid @enderror" name="email" value="{{old('email')}}"
                               placeholder="Enter Valid E-Mail Address">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="GENDER">Course</label>
                        <select class="form-select" name="course">
                            <option value="BAGEN">BAGEN</option>
                            <option value="BScCS">BScCS</option>
                            <option value="Biology ICT">Biology ICT</option>
                            <option value="Chemistry ICT">Chemistry ICT</option>
                            <option value="Statistics ICT">Statistics ICT</option>
                        </select>

                        @error('course')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="col-12 col-md-12 col-lg-6">
                        <label class="fw-bold" for="category">Category</label>
                        <select class="form-select" name="category">
                            <option value="Graphics Designing">Graphics Designing</option>
                            <option value="Programming">Programming</option>
                            <option value="Cyber Security">Cyber Security</option>
                            <option value="Comp Maintenance">Comp Maintenance</option>
                            <option value="Web Development">Web Development</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="confirmPassword">CONFIRM PASSWORD</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="Re-type your password">

                        <span class="text-danger p-1"> </span>

                    </div>
                    <button type="submit" class="btn btn-lg mt-5 fw-bold" style="background-color:#19c357">REGISTER</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
