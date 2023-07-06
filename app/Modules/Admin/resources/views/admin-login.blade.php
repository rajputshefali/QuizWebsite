<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
</head>
<body>
    <section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">ADMIN LOGIN</h2>

              <form action="{{ route('admin-auth') }}" method="POST">
                @if(session('success'))
                <div class="div alert alert-success">{{session('success')}}</div>
                @endif
                @if(session('fail'))
                <div class="div alert alert-danger">{{session('fail')}}</div>
                @endif
                @csrf
                

                <div class="form-outline mb-4">
                  <input type="email" name="email" id="email" class="form-control form-control-lg" value="{{old('email')}}" />
                  <label class="form-label" for="email">Enter Email</label>
                  <span class="text-danger"> @error('email'){{ $message }}@enderror </span>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" name="password" id="password" class="form-control form-control-lg" value="{{old('password')}}"/>
                  <label class="form-label" for="password">Enter Password</label>
                  <span class="text-danger"> @error('password'){{ $message }} @enderror </span>
                </div>

                
                <div class="d-flex justify-content-center">
                  <button type="submit" 
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">LOGIN</button>
                </div>

                {{-- <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!"
                    class="fw-bold text-body"><u>Login here</u></a></p> --}}
                    <p class="text-center text-muted mt-5 mb-0">Forget Your Password? <a href="{{route('pwforget')}}"
                      class="fw-bold text-body"><u>Reset here</u></a></p><br>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>