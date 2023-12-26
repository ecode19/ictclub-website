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
            <form class="mx-5 mt-5" action="" method="POST" autocomplete="off">
                @include('admin.message')
                <h5 class="text-primary fs-3">Register new Member</h5>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="regNo">REGISTRATION NUMBER</label>
                        <input type="text" class="form-control" name="regNo" placeholder="Enter First Name">

                        <span class="text-danger p-1"> </span>

                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="Firstname">First Name</label>
                        <input type="text" class="form-control" name="firstname" placeholder="Enter First Name">

                        <span class="text-danger p-1"> </span>

                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="Last Name">Last Name</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name">

                        <span class="text-danger p-1"></span>

                    </div>
                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="GENDER">Course</label>
                        <select class="form-select" name="course">
                            <option selected>Select</option>
                            <option value="BAGEN">BAGEN</option>
                            <option value="BScCS">BScCS</option>
                            <option value="Biology ICT">Biology ICT</option>
                            <option value="Chemistry ICT">Chemistry ICT</option>
                            <option value="Statistics ICT">Statistics ICT</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6">
                        <label class="fw-bold" for="class">Category</label>
                        <select class="form-select" name="category">
                            <option selected>Select</option>
                            <option value="Graphics Designing">Graphics Designing</option>
                            <option value="Programming">Programming</option>
                            <option value="Cyber Security">Cyber Security</option>
                            <option value="Comp Maintenance">Comp Maintenance</option>
                            <option value="Web Development">Web Development</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password">

                        <span class="text-danger p-1"> </span>

                    </div>
                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="confirmPassword">CONFIRM PASSWORD</label>
                        <input type="password" class="form-control" name="confirmPassword"
                            placeholder="Re-type your password">

                        <span class="text-danger p-1"> </span>

                    </div>

                    <div class="col-12 col-md-12 col-lg-6">
                        <label class="fw-bold" for="class">Assign Role</label>
                        <select class="form-select" name="usertype">
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-lg mt-5 fw-bold"
                        style="background-color:#19c357">REGISTER</button>
            </form>
        </div>
        </div>
</body>

</html>
