<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user management </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="/assets/css/show.css">

</head>
<body>
<div class="container">
        <div class="row">
            <div class="container mt-5">
                <h4>USER MANAGEMENT</h4><br><br>
                <div class="mb-4 header">
                    <a href="/admin/dashboard" class="btn btn-primary">BACK</a>
                    @if(session('userDeleted'))
                    <div class="div alert alert-success">{{session('userDeleted')}}</div>
                    @endif
                    <a href="{{url('trash')}}">
                        <button class="btn btn-danger d-inline-block m2 float-right">Go to Trash</button>
                    </a><br><br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>Id</th>
                            <th>name</th> 
                            <th>email</th>
                            <th>isBan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $item-> id}}</td>
                            <td>{{ $item-> name }}</td>
                            <td>{{ $item-> email}}</td>
                            <td>
                                @if($item->isBan == "0")
                    
                                <label class="btn btn-primary">Not Banned</label>
                                @elseif($item->isBan == "1")
                                <label class="btn btn-danger">Banned</label>
                                
                                @endif
                            </td>
                            <td>
                    <a href="{{url('edit/'.$item->id)}}" class="btn btn-primary">EDIT</a>
                   
                    <a href="{{url('deleteuser/'.$item->id)}}" class="btn btn-danger">Trash</a>
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