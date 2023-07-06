

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USER LOGIN QUIZ WEB</title>
</head>
<body>
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
              <h2 class="text-uppercase text-center mb-5">RESET PASSWORD</h2>

              <form action="{{ route('resetpw') }}" method="POST">
                @if(session('success'))
                <div class="div alert alert-success">{{session('success')}}</div>
                @endif
                @if(session('fail'))
                <div class="div alert alert-danger">{{session('fail')}}</div>
                @endif
                @csrf
                <input type="hidden" name="token" value = "{{ $token }}">
                <div class="form-outline mb-4">
                  <input type="email" name="email" id="email" class="form-control form-control-lg" value="{{ $email ?? old('email') }}" />
                  <label class="form-label" for="email">Enter Email</label>
                  <span class="text-danger"> @error('email'){{ $message }}@enderror </span>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" name="password" id="password" class="form-control form-control-lg" value="{{old('password')}}"/>
                  <label class="form-label" for="password">Enter Password</label>
                  <span class="text-danger"> @error('password'){{ $message }} @enderror </span>
                </div>
                <div class="form-outline mb-4">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" value="{{old('password')}}"/>
                    <label class="form-label" for="password">Enter Password</label>
                    <span class="text-danger"> @error('password_confirmation'){{ $message }} @enderror </span>
                  </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" 
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Reset Password</button>
                </div>

                {{-- <p class="text-center text-muted mt-5 mb-0">Forget Your Password? <a href=""
                    class="fw-bold text-body"><u>Reset here</u></a></p> --}}
                    <p class="text-center text-muted mt-5 mb-0"> <a href="{{ route('admin/login')}}"
                        class="fw-bold text-body"><u>Login from here</u></a></p>

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

{{-- 
    <div id="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4 class="text-center">RESET PASSWORD</h4>
                    </div>
                <div class="card-body">
                      <form action="{{ route('resetpw') }}" method="POST"> 
                       @if(Session::has('success'))
                        <div class="div alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::has('fail'))
                        <div class="div alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                        <input type="hidden" name="token" value = "{{ $token }}">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="enter email" value="{{ $email ?? old('email') }}">
                            <span class="text-danger">@error('email'){{$message}}@enderror</span>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="enter password" value="{{ old('password') }}">
                            <span class="text-danger">@error('password') {{$message}}@enderror</span>
                        </div><br>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="enter password" value="{{ old('password') }}">
                            <span class="text-danger">@error('password_confirmation') {{$message}}@enderror</span>
                        </div><br>
                       
                        <div class="form-group">
                        <button type="submit" class="btn btn-dark btn-block mt-4" id="loginbtn">RESET PASSWORD</button>
                        </div><br>
                        <a href="{{ route('admin/login')}}">LogIn</a>
                       
                  </form> 
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
 --}}
