<!DOCTYPE html>
<html>
<head>
    <title>Membership Card</title>
    <style>
        .card {
            border: 1px solid #000;
            padding: 20px;
            width: 300px;
            text-align: center;
        }
        .profile-picture {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .name {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .details {
            font-size: 16px;
            color: gray;
        }
        .color {
            background-color: #333; /* Adjust as per your original CSS */
            color: white;
        }
        .fs-5 {
            font-size: 1.25rem;
        }
        .fw-bold {
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .text-light {
            color: #f8f9fa;
        }
        .text-white {
            color: #fff;
        }
        .text-decoration-underline {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="card shadow-lg">
        <div class="details text-light color">
            <h6 class="mx-3 mt-3 fs-6 fw-bold">Club Member</h6>
        </div>
        <div class="card-tittle text-center">
            <h6 class="mx-3 text-decoration-underline fs-6 fw-bold">Informations</h6>
        </div>
        <div class="card-body d-flex">
            <img src="{{ $profilePicture }}" class="img-fluid rounded-circle mt-auto profile-picture" alt="Profile Picture">
            <div class="mx-auto">
                <p><strong>RegNo:</strong> {{ $registrationNumber }}</p>
                <p><strong>Full Name: </strong> {{ $fullname }}</p>
                <p><strong>Course:</strong> {{ $course }}</p>
                <p><strong>Category: </strong> {{ $category }}</p>
            </div>
        </div>
    </div>
</body>
</html>
