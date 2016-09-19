<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIAKAD-APIKES |@yield('title') </title>
	
	<!--jquery ui-->
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap -->
    <link href="{{ URL::asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ URL::asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
	
	@yield('css')
	
    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('build/css/custom.min.css')}}" rel="stylesheet">
	
  </head>

  <body class="nav-md">
 <?php $iddosen =Auth::guard('userdosens')->user()->iddosen;  ?>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><span>SIAKAD APIKES</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                @if (Auth::guard('userdosens')->user()->imageuser===null)
                    <img class="img-circle profile_img" 
                    src="{{ URL::asset('images/user.png')}}" alt="profil-picture" />
                    @else
                    <img class="img-circle profile_img" 
                    src="data:image/jpg;base64,{{ Auth::guard('userdosens')->user()->imageuser}}" 
                    alt="profile-picture" />
                    
                    @endif
              </div>
              <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2>{{ Auth::guard('userdosens')->user()->nama }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
			 @section('sidebar')
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Dosen</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ url('/home/menu_dosen',['iddosen'=>Auth::guard('userdosens')->user()->iddosen]) }}"><i class="fa fa-home"></i> Home </a>
                  
                  </li>
				 

                   <li><a><i class="fa fa-users"></i> Penilaian Mahasiswa <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/home/addpenilaian')}}">Tambah</a></li>
                     <li><a href="{{url('/home/showpenilaian')}}">Tampilkan</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
             

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      @if (Auth::guard('userdosens')->user()->imageuser===null)
                    <img src="{{ URL::asset('images/user.png')}}" alt="profil-picture" />
                    @else
                    <img src="data:image/jpg;base64,{{ Auth::guard('userdosens')->user()->imageuser}}" 
                    alt="profile-picture" />
                    
                    @endif
                    {{ Auth::guard('userdosens')->user()->nama }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ route('dosen-changepassword',['iddosen'=>$iddosen]) }}"><i class="fa fa-cog pull-right"></i> Ganti Password</a></li>
                    
                    <li><a href="javascript:;"><i class="fa fa-battery-1 pull-right"></i> Bantuan</a></li>
                    <li><a href="{{ url('logout-dosen') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
		 @show
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row top_tiles">
			
            </div>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                @yield('content')
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            SIAKAD APIKES IMELDA - designed by <a href="#">ABT soft</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ URL::asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{ URL::asset('vendors/nprogress/nprogress.js')}}"></script>
	
	@yield('scripts')
	
    <!-- Custom Theme Scripts -->
    <script src="{{ URL::asset('build/js/custom.min.js')}}"></script>
	
  </body>
</html>
</html>