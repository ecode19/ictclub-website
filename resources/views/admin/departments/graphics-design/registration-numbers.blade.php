@extends('layouts.graphics-designing')
@section('content')
    <div class="container mt-5 ">
        <div class="alert alert-secondary" role="alert">
            <h6>You have total of <strong class="fs-5">{{ $totalProgrammingMembers }}</strong> registered members under
             <strong>Graphics department .</strong></h6>
        </div>
        <form action="{{ route('store') }}" method="POST" class="container my-5">
            @csrf
            <h2 class="mb-4">Registration Numbers</h2>
            <div id="registration-numbers">

                <div class="row mb-3 registration-number-field">
                    <div class="col-md-10">
                        <input type="text" name="registration_numbers[]" value="{{ old('registration_numbers.0') }}" placeholder="Registration Number" required
                            class="form-control @error('registration_numbers.0') is-invalid @enderror">

                        @error('registration_numbers.0')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-registration-number">Remove</button>
                </div>
            </div>

        </div>
        {{-- <div class="row mb-3">
            <div class="col-12">
                <button type="button" class="btn btn-primary add-registration-number">Add another</button>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addButton = document.querySelector('.add-registration-number');
        const registrationNumbersContainer = document.getElementById('registration-numbers');

        addButton.addEventListener('click', function() {
            const newField = document.createElement('div');
            newField.classList.add('row', 'mb-3', 'registration-number-field');
            newField.innerHTML = `
            <div class="col-md-10">
                <input type="text" name="registration_numbers[]" placeholder="Registration Number" required class="form-control">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-registration-number">Remove</button>
            </div>
        `;
            registrationNumbersContainer.appendChild(newField);

            const removeButtons = document.querySelectorAll('.remove-registration-number');
            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.parentElement.parentElement.remove();
                });
            });
        });
    });
</script>
@endsection
