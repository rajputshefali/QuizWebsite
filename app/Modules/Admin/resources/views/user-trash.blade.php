<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user trash </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="container mt-5">
                <h4>USER MANAGEMENT</h4><br><br>
                <div class="mb-4 header">
                    @if(session('userRestore'))
                    <div class="div alert alert-success">{{session('userRestore')}}</div>
                    @endif
                    @if(session('userDeleted'))
                    <div class="div alert alert-success">{{session('userDeleted')}}</div>
                    @endif
                    <div>
                    <a href="{{url('usermanagement')}}">
                        <button class="btn btn-primary">Users View</button>
                    </a>
                    </div><br><br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>Id</th>
                            <th>name</th> 
                            <th>email</th>
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
                    <a href="{{url('restoreuser/'.$item->id)}}" class="btn btn-primary">Restore</a>
                    <a href="{{url('forcedeleteuser/'.$item->id)}}" class="btn btn-danger">Delete</a>
                    {{-- //{{url('/delete/'.$item->id)}} --}}
                   
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