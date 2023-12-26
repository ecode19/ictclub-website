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
                <h5 class="text-primary fs-3">Registering New Department</h5>
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="Firstname">Department Name</label>
                        <input type="text" class="form-control" name="department_name"
                            placeholder="Enter First Name">
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

                    <button type="submit" name="submit" class="btn btn-success fw-bold"
                        style="background-color:#19c357">ADD</button>
            </form>
        </div>
        </div>
</body>

</html>
