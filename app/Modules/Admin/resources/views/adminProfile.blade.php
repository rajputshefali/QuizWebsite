<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EDIT USER PROFILE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
</head>
<body>
    <section class="vh-100 bg-image"
  {{-- style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');"> --}}
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">EDIT YOUR PROFILE</h2>
             
              <a href="/admin/dashboard" class="btn btn-outline-primary">Go back</a><br><br>
              <form action="{{url('adminupdate/'.$admin->id)}}" method="POST">
               
                @if(session('update'))
                <div class="div alert alert-success">{{session('update')}} </div>
                @endif
                @csrf
                @method('PUT')
                <div class="form-outline mb-4">
                  <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{$admin->name}}" />
                  <label class="form-label" for="name">Enter Name</label>
                  <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                </div>

                <div class="form-outline mb-4">
                  <input type="email" name="email" id="email" class="form-control form-control-lg" value="{{$admin->email}}" />
                  <label class="form-label" for="email">Enter Email</label>
                  <span class="text-danger"> @error('email'){{ $message }}@enderror </span>
                </div>
             

               

                <div class="d-flex justify-content-center">
                  <button type="submit" 
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">EDIT</button>
                </div>
                

              
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