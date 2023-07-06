<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QUESTION MANAGEMENT</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
    <div class="container" id="upload-user">
        <div class="row">
            <div class="container mt-5">
            <a href="/admin/dashboard" class="btn btn-outline-primary">Go back</a><br><br>
            <h3 class="mb-4 header"> QUESTIONS LIST</h3>
            <table class="table table-bordered ">
              <thead>
                <tr>
                <th>Id</th>
                <th>question</th> 
                <th>option1</th>
                <th>option2</th>
                <th>option3</th>
                <th>option4</th>
                <th>answer</th>
                <th>category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item-> id}}</td>
                <td>{{ $item-> question }}</td>
                <td>{{ $item-> option1 }}</td>
                <td>{{ $item-> option2 }}</td>
                <td>{{ $item-> option3 }}</td>
                <td>{{ $item-> option4 }}</td>
                <td>{{ $item-> answer }}</td>
                <td>{{ $item-> category}}</td>
                
                <td>
                    <a href="{{url('editques/'.$item->id)}}" class="btn btn-primary">Edit</a>
                    <a href="{{url('deleteques/'.$item->id)}}" class="btn btn-danger">Delete</a>
                </td>
            @endforeach
        </tr>
        </tbody>
        </div>
    </div>
    </div>
</body>
</html>