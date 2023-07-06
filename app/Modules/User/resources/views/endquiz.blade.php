<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-image: url('/assets/images/r.jpg'); background-repeat:no-repeat;background-size: cover;">
    <div class="container-fluid">
        <br><br><br><br>
        <h3 class="text-center" style="font-family: cursive;"><b>THANK YOU FOR ATTEMPTING THE QUIZ</b></h3>
      <br><br><br>
        <div class="row">
            <div class="col-md-5">
                
            </div>
            <div class="col-md-4">
                
           {{-- <label>Correct:<small>{{$data->user_id}}</small></label><br>
           <label>Incorrect:<small>{{$data->question_id}}</small></label><br> --}}
           <!-- @foreach($item as $i)
           <label><b>Question:</b>&nbsp;<small>{{$i->question}}</small></label><br>
          @endforeach -->
          
           @foreach($data as $d)
         
           


           <label><b>Your Answer:</b>&nbsp;<small>{{$d->user_ans}}</small></label><br>
           <label><b>Correct Answer:</b>&nbsp;<small>{{$d->correct_ans}}</small></label><br><br>
           @endforeach
          
           <label style="color: red"><b>Your Marks:{{$marks}}</b></label><br><br>

            <a href="/storeResult"><button class="btn btn-primary" >FINISH QUIZ</button></a><br>
           
          
            </div>
            <div class="col-md-3">

            </div>
        </div>
      </div>
      
    
</body>
</html>