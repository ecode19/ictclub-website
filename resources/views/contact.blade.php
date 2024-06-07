@extends('layouts.web')
<style>
    .contact-form {
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        padding: 30px;
        margin-top: 50px;
    }

    .contact-info {
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        padding: 30px;
        margin-top: 50px;
        height: 80%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* .contact-info h2 {
    margin-bottom: 30px;
}

.contact-info p {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
} */

    .contact-info p i {
        margin-right: 10px;
    }

    .bottom-border {
        border-bottom: 2px solid #4c88f7;
    }

    #chatIcon {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: darkcyan;
        color: #fff;
        text-align: center;
        cursor: pointer;
    }


    #contactp {
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }

    .footer {
        background-color: #343a40;
        color: #fff;
        padding: 50px 0;
    }

    .footer h4 {
        margin-bottom: 30px;
    }

    .footer ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 30px;
    }

    .footer ul li a {
        color: #fff;
    }
</style>
@section('content')
    <div class="container">
        <div class="row g-0" id="contact">
            <div class="col-md-6 mb-3">
                <div class="contact-form bottom-border">

                    <h2 class="bottom-border
                colorIcon">Contact Us</h2>
                    <form method="POST" action="{{ route('message') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="form-group mb-3">
                            <label class="mb-2" for="fullname">Name</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Enter your fullname"
                                value="{{ old('fullname') }}">
                            <div class="text-danger">
                                @error('fullname')
                                    {{ $message }}
                                @enderror
                            </div>

                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-2" for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email"
                                value="{{ old('email') }}">
                            <div class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="mb-2" for="email">Message Department Category</label>
                            <select name="category" id="category" class="form-select @error('category') is-invalid @enderror">
                                <option value="programming">programming</option>
                                <option value="cyber_security">cyber security</option>
                                <option value="networking">networking</option>
                                <option value="graphics_designing">graphics designing</option>
                            </select>

                            <div class="text-danger">
                                @error('category')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>


                        <div class="form-group mb-3">
                            <label class="mb-2" for="message">Message</label>
                            <textarea class="form-control" name="message" rows="5">{{ old('message') }}</textarea>
                            <div class="text-danger">
                                @error('message')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-3 mb-3 text-md-center">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-info bottom-border">
                    <h2 class="bottom-border colorIcon">M-ICT Club Address</h2>
                    <p><i class="fas fa-map-marker-alt colorIcon"></i>P.O. Box 1226, Moshi, Kilimanjaro</p>
                    <p><i class="fa fa-phone colorIcon"></i>Tel: +255-27-2974 110</p>
                    <p><i class="fa fa-envelope colorIcon"></i>example@mail.com</p>
                    <p><i class="fa fa-fax colorIcon"></i>Fax: +255-27-2974108</p>
                    <p><i class="fa fa-headset colorIcon"></i>Customer Support</p>
                </div>
            </div>
        </div>
    </div>
@endsection
