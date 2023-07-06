<!DOCTYPE html>
<html>

<head>
	<title> Import Questions</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>

<body>
	<h6> 
		
	</h6>
	<div class="container">
		<div class="card bg-light mt-3">
			<div class="card-header">
				<h1>Import Questions</h1>
			</div>
			<div class="card-body">
                <a href="/queadd" class="btn btn-primary">BACK</a><br><br>
				<form action="{{ route('uploadQue') }}" method="POST" enctype="multipart/form-data">
                    @if(session('success'))
                    <div class="div alert alert-success">{{session('success')}}</div>
                    @endif
					@csrf
					<input type="file" name="file" class="form-control">
					<br>
					<button class="btn btn-success">
						Import 
					
				</form>
			</div>
		</div>
	</div>

</body>

</html>
