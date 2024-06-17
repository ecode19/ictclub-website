@extends('layouts.programming')
@section('content')
    <div class="container">
        <div class="text-white">
            <div class="" aria-labelledby="dropdownMenuButton">
                <h6 class="">User Details</h6>
                Registration Number: {{ $user->registration_number }} <br>
                Full Name: {{ $user->fullname }} <br>
                Course: {{ $user->course }} <br>
                Category: {{ $user->category }} <br>
                Email: {{ $user->email }} <br>
                Created At: {{ $user->created_at }}
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-success ">Message</button>
            <button class="btn btn-warning ">Update</button>
            <button class="btn btn-danger ">Delete</button>
        </div>

        <h1 class="text-warning mt-4">Total found: <strong>{{ $totalResults }}</strong></h1>
    </div>
@endsection

// Processing file
if ($request->hasFile('file')) {
    $file = $request->file('file');
    $fileName = time() . "_" . $file->getClientOriginalName();

    // Storing the uploaded file in storage/app/public/uploads/pdfs
    $filePath = 'public/uploads/pdfs/' . $fileName;
    $file->storeAs('public/uploads/pdfs', $fileName);

    // Check for existing file and delete it
    $existingFilePath = 'public/uploads/pdfs/' . $user->file;
    if (Storage::exists($existingFilePath)) {
        Storage::delete($existingFilePath);
    }

    // Update user file
    $user->file = $fileName;
}
