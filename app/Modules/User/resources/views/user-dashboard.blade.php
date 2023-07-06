<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/user.css')}}">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand"  href="/resultView"><b> Result</b></a>
   
    <a class="navbar-brand" href="/edit-profile"><b>Edit-Profile</b></a>

    <a class="navbar-brand" href="/graphResult"><b>Graph Result</b></a>

  
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="navbar-brand" href="/user/logout">LOGOUT</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
           <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul> -->
        <!-- </li> -->
        
      </ul>
     
    </div>
  </div>
</nav>
    <div class="container-fluid">
        <!-- <a href="/user/logout"><button type="button" class="text-right">LOGOUT</button></a> -->
        <br><br><br><br><br><br><br><br><br>
        <div class="row">
            <div class="col-md-5">

            </div>
            <div class="col-md-4">
                {{-- <p>WELCOME {{ Auth::user()->name }}</p> --}}
            <h2 style="font-family: Georgia, 'Times New Roman', Times, serif;">Ready for quiz??</h2>
            <a href="/user/answer"><button class="btn btn-primary"   style="margin-left: 10%">START QUIZ</button></a>
            </div>
            <div class="col-md-3">
             
            </div>
        </div>
      </div>
      
    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</html>


{{-- <script type="text/javascript">

    document.getElementById('timer').innerHTML = '';
      
    
    
    function startTimer() {
      var presentTime = document.getElementById('timer').innerHTML;
      var timeArray = presentTime.split(/[:]+/);
      var m = timeArray[0];
      var s = checkSecond((timeArray[1] - 1));
      if(s==59){m=m-1}
      if(m==0 && s==0){document.getElementById("form").submit();}
      document.getElementById('timer').innerHTML =
        m + ":" + s;
      setTimeout(startTimer, 1000);
    }
    
    function checkSecond(sec) {
      if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
      if (sec < 0) {sec = "59"};
      return sec;
      if(sec == 0 && m == 0){ alert('stop it')};
    }
    </script> --}}