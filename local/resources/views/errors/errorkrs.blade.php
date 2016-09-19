
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="{{ URL::asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
	<style type="text/css">
		
		.center {text-align: center; margin:auto; }
	</style>
</head>
<body>
<br><br><br><br><br>
<div class="alert alert-danger">
<div class="container">
  <div class="row">
    <div class="span12">
      <div class="hero-unit center">
          <h1>Maaf !</h1>
          <br />
          <p><b>{{ $pesan }}</b></p>
          <p></p>
          <a href="{{url('/home/menu_mahasiswa/'.Auth::guard('usermahasiswas')->user()->nim)}}" class="btn btn-success"><i class="fa fa-home"></i> Home</a>
        </div>
        <br />
      
        <br />
        <p></p>
        <!-- By ConnerT HTML & CSS Enthusiast -->  
    </div>
  </div>
</div>
</div>
<!-- <div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Error!</strong> {{ $pesan }}
</div> -->
</body>
</html>