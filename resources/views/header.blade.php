<nav class="navbar navbar-expand-lg navbar-dark bg-dark navber-fixed-top">
    <a class="navbar-brand" href="#">Doctor Appoinrment</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" href="{{route('home.index')}}">Home <span class="sr-only">(current)</span></a>
        <a class="nav-link" href="{{route('doctor.index')}}">Doctor</a>
        <a class="nav-link" href="{{route('appointment.index')}}">Appointment</a>
       
      </div>
    </div>
  </nav>

