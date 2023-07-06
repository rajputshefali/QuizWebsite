<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RESULT MANAGEMENT </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="/assets/css/show.css">

</head>
<body>
<div class="container">
        <div class="row">
            <div class="container mt-5">
                <h4>YOUR RESULT</h4><br><br>
                <div class="mb-4 header">
                    <a href="/user/dashboard" class="btn btn-primary">BACK</a><br><br>
                    <!-- @if(session('userDeleted'))
                    <div class="div alert alert-success">{{session('userDeleted')}}</div>
                    @endif
                    <a href="{{url('trash')}}">
                        <button class="btn btn-danger d-inline-block m2 float-right">Go to Trash</button>
                    </a><br><br> -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>Test</th>
                           
                           
                            <th>Your Marks</th>
                            <th>Result</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                       @php
                        $i=1;
                        @endphp 
                        @foreach ($data as $item)
                        <tr>
                        <td>
                           
                        {{$i++}}

                        </td>
                       
                        <td>{{$item->marks}}</td>
                        <td>
                        @if($item->marks <= "4")
                    
                    <label class="text-danger"><b>FAIL</b></label>
                    @elseif($item->marks >"4")
                    <label class="text-success"><b>PASS</b></label>
                    
                    @endif
                            
                        </td>

                        
                           
                     @endforeach
                     </tr>
                    </tbody>
                    </div>
                    <table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>