<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>APIKES IMELDA</title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
	 <link href="{{ URL::asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
	  <link href="{{ URL::asset('vendors/temacarousell/carousell.css')}}" rel="stylesheet">
	 <link href="{{ URL::asset('vendors/temacarousell/prettyPhoto.css')}}" rel="stylesheet">    
	<link href="{{ URL::asset('vendors/style/style.css')}}" rel="stylesheet">  
	

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<header>		
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navigation">
				<div class="container">					
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<<div class="navbar-brand">
							<a href="#"><h1><span>Sistem Akademik APIKES IMELDA</span></h1></a>
						</div>
					</div>
					
					<div class="navbar-collapse collapse">							
						<div class="menu">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation"><a href="{{ url('login-mahasiswa')}}"> Mahasiswa</a></li>
								<li class="dropdown">
									<a href="{{ url('login-dosen')}}"> Dosen</a>
								</li>
						</div>
					</div>						
				</div>
			</div>	
		</nav>		
	</header>
	
	 @yield('content')
		
	</div>
	
	<footer>
		<div class="footer">
			<div class="container">
				<div class="social-icon">
					<div class="col-md-4">
						<div class="footer-text"><span class="fa fa-facebook"></span> facebook : APIKES IMELDA</div>
						
						<div class="footer-text"><span class="fa fa-envelope"></span> E-mail : apikesimelda52@yahoo.com</div>
					</div>
				</div>
				
				<div class="col-md-4 col-md-offset-4">
					<div class="footer-text">APIKES IMELDA</div>
					<div class="footer-text">Alamat : Jl. Bilal No. 52 Kelurahan pulo Brayan Darat </div>
					<div class="footer-text">Kecamatan Medan Timur, Medan - Sumatera Utara</div>
					<div class="footer-text">Telp. :(061) 6610072-6631380-6630196</div>
					<div class="footer-text">Fax : (061) 6618457 Kode Pos: 20239</div>
				</div>
	
	</footer>

	
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

	<script src="{{ URL::asset('js/cvganadi/jquery-2.1.1.min.js')}}"></script>	
    <!-- Include all compiled plugins (below), or include individual files as needed -->
 <script src="{{ URL::asset('js/cvganadi/wow.min.js')}}"></script>	
 <script src="{{ URL::asset('js/cvganadi/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('js/cvganadi/functions.js')}}"></script>
 <script src="{{ URL::asset('js/cvganadi/jquery.isotope.min.js')}}"></script>
<script src="{{ URL::asset('js/cvganadi/jquery.prettyPhoto.js')}}"></script>
 
  </body>
</html>
