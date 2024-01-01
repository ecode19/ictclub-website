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
            <form class="mx-5 mt-5" action="{{route('newDepartment')}}" method="post" autocomplete="off">
                #@csrf
                @include('admin.message')
                <h5 class="text-primary fs-3">Registering New Department</h5>
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="Firstname">Department Name</label>
                        <input type="text" class="form-control @error('dept_name') is-invalid @enderror" name="dept_name"
                            placeholder="Enter First Name">

                        <div class="text-danger">
                            @error('dept_description')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold mb-3" for="dept_description">Short Department Description</label>
                        <textarea class="form-control @error('dept_description') is-invalid @enderror" name="dept_description" rows="5">{{ old('dept_description') }}</textarea>
                        <div class="text-danger">
                            @error('dept_description')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success fw-bold"
                        style="background-color:#19c357">ADD</button>
            </form>
        </div>
        </div>
    </main>
</body>

</html>
