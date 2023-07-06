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

  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">EDIT Q&A</h2>
              <a href="/admin/dashboard" class="btn btn-primary">BACK</a><br><br>

             
              <form action="{{ url('updateques/'.$role->id)}}" method="POST">
                @if(session('status'))
                <div class="div alert alert-success">{{session('status')}}</div>
                @endif
                @if(session('fail'))
                <div class="div alert alert-success">{{session('fail')}}</div>
                @endif
                @csrf
              
                <div class="form-outline mb-4">
                  <input type="text" name="question" id="question" class="form-control form-control-lg" value="{{$role->question}}" />
                  <label class="form-label" for="question">Enter Question Here</label>
                  <span class="text-danger">@error('question'){{ $message }}@enderror</span>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="option1" id="option1" class="form-control form-control-lg" value="{{$role->option1}}" />
                  <label class="form-label" for="option1">Enter Option 1</label>
                  <span class="text-danger"> @error('option1'){{ $message }}@enderror </span>
                </div>
                <div class="form-outline mb-4">
                  <input type="text" name="option2" id="option2" class="form-control form-control-lg" value="{{$role->option2}}" />
                  <label class="form-label" for="option2">Enter Option 2</label>
                  <span class="text-danger"> @error('option2'){{ $message }}@enderror </span>
                </div>
                <div class="form-outline mb-4">
                  <input type="text" name="option3" id="option3" class="form-control form-control-lg" value="{{$role->option3}}"  />
                  <label class="form-label" for="option3">Enter Option 3</label>
                  <span class="text-danger"> @error('option3'){{ $message }}@enderror </span>
                </div>
                <div class="form-outline mb-4">
                  <input type="text" name="option4" id="option4" class="form-control form-control-lg" value="{{$role->option4}}"  >
                  <label class="form-label" for="option1">Enter Option 4</label>
                  <span class="text-danger"> @error('option4'){{ $message }}@enderror </span>
                </div>

               

                
                

              
                <div class="align-items-center mb-4 col-sm-6">
                  <div class="form-outline flex-fill mb-0 ">
                      <label class="form-label" for="answer">Correct Option</label>
                      <select id="Answer" name="answer" id="answer" class="form-control">
                        
                          <option value="Option1">Option 1st</option>
                          <option value="Option2">Option 2nd</option>
                          <option value="Option3">Option 3rd</option>
                          <option value="Option4">Option 4th</option>
                        </select>
                  </div>
              </div>
              <div class="align-items-center mb-4 col-sm-6">
                <div class="form-outline flex-fill mb-0 ">
                    <label class="form-label" for="Answer">Correct Option</label>
                    <select id="category" name="category"  class="form-control">
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                      </select>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" 
                      class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Update</button>
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






                         
               