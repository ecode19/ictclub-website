 <div class="card">
     @if (Session()->has('message'))
         <script>
             Swal.fire('Message', '{{ Session::get('message') }}', 'success', {
                 button: "Ok",
             });
         </script>
     @endif
 </div>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <!-- Include SweetAlert CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">


 <div>
     @if (session()->has('success'))
         <div class="alert alert-success">
             {{ session('success') }}
         </div>
     @endif
 </div>
 <div>
     @if (session()->has('success'))
         <div class="alert alert-success">
             {{ session('success') }}
         </div>
     @endif
 </div>
