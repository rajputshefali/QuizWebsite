<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reult Management </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="/assets/css/show.css">

</head>
<body>
<div class="container">
        <div class="row">
            <div class="container mt-5">
                <h4>RESULT MANAGEMENT</h4><br><br>
                <div class="mb-4 header">
                    <a href="/admin/dashboard" class="btn btn-primary">BACK</a><br><br>
                    @if(session('fail'))
                    <div class="div alert alert-success">{{session('fail')}}</div>
                    @endif
                 
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <!-- <th>Id</th> -->
                            <th>User_id</th> 
                            <th>User_Name</th>
                            <th>Marks</th>
                            <th>Result</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <!-- <td>{{ $item-> id}}</td> -->
                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->user_name }}</td>
                            <td>{{ $item->marks }}</td>
                            <td>
                        @if($item->marks <= "4")
                    
                    <label class="text-danger"><b>FAIL</b></label>
                    @elseif($item->marks >"4")
                    <label class="text-success"><b>PASS</b></label>
                    
                    @endif
                            
                        </td>
                            <td>
                               
                                <a href="{{url('deleteResult/'.$item->id)}}" class="btn btn-danger">DELETE</a>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </div>
                    <table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>