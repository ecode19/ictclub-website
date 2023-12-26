  <!--navbar-->
  <nav class="navbar navbar-expand-lg navbar-light sticky-top shadow"
      style="background-color: #19c357; color: rgb(255, 255, 255);">
      <div class="container">
          <a href="{{ route('index') }}" class="navbar-brand text-warning">
              <h3 class="fw-bold">Mwecau-ICT Club </h3> <span class="fs-6 mb-4 text-white fst-italic">"Inspire, Innovate,
                  Integrate"</span>
          </a>
          <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navmenu">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navmenu">
              <ul class="navbar-nav mx-auto">
                  <li class="nav-item"><a href="{{ route('index') }}" class="nav-link">HOME</a></li>
                  <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">ABOUT US</a></li>
                  <li class="nav-item"><a href="{{ route('categories') }}" class="nav-link">OUR PROJECTS </a></li>
                  <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">CONTACT US</a></li>
              </ul>
              <button class="btn btn-brand"><a class="hover-text text-light nav-item nav-link"
                      href="{{ route('login') }}">Login</a></button>
              <button class="btn btn-brand">
                  <a class="hover-text text-light nav-item nav-link"
                      href="{{ route('registration') }}">Register</a></button>
          </div>
      </div>
  </nav>
  <!--End Navbar-->
