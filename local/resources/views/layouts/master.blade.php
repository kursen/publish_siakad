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
	<link href="{{ url('vendors/jquery-ui-themes-1.12.0/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
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
                 @if (Auth::user()->imageuser===null)
                   <img src="{{ URL::asset('images/user.png')}}" alt="img-profile" class="img-circle profile_img">
                    @else
                    <img class="img-circle profile_img" src="data:image/jpg;base64,{{ Auth::user()->imageuser}}" alt="profile-picture">
                    
                    @endif
                
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2> {{ Auth::user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
			 @section('sidebar')
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>@if(Auth::user()->admin)
                Administrator
                @elseif(Auth::check('usermahasiswa'))
				Mahasiswa
                Guess
                @endif</h3>
                <ul class="nav side-menu">
				<li><a href="{{url('/home')}}"><i class="fa fa-home"></i> Home </a></li>
                  <li><a><i class="fa fa-users"></i> Mahasiswa <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/home/addmahasiswa')}}">Tambah</a></li>
                      <li><a href="{{url('/home/showmahasiswa')}}">Tampilkan</a></li>
                    </ul>
                  </li>
				  <li><a><i class="fa fa-user"></i> Dosen <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/home/adddosen')}}">Tambah</a></li>
                      <li><a href="{{url('/home/showdosen')}}">Tampilkan</a></li>
                    </ul>
                  </li>
          <li><a><i class="fa fa-table"></i> Kelas Dosen <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/home/addkelasdosen')}}">Tambah</a></li>
                      <li><a href="{{url('/home/showkelasdosen')}}">Tampilkan</a></li>
                    </ul>
                  </li>
          <!--li><a><i class="fa fa-users"></i> Penilaian Mahasiswa <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/home/addpenilaian')}}">Tambah</a></li>
                      <li><a href="{{url('/home/showpenilaian')}}">Tampilkan</a></li>
                    </ul>
                  </li-->
				 <li><a><i class="fa fa-clone"></i> MataKuliah <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/home/addmatakuliah')}}">Tambah</a></li>
                      <li><a href="{{url('/home/showmatakuliah')}}">Tampilkan</a></li>
                      
                    </ul>
                  </li>
				<li><a><i class="fa fa-calendar"></i> Periode <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/home/addperiode')}}">Tambah</a></li>
                      <li><a href="{{url('/home/showperiode')}}">Tampilkan</a></li>
                      
                    </ul>
                  </li>
                 
                  <li><a><i class="fa fa-table"></i> Kelas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('/home/addkelas') }}"> Tambah</a></li>
                      <li><a href="{{ url('/home/showkelas') }}"> Tampilkan</a></li>
                    </ul>
                  </li>
          
                  <li><a><i class="fa fa-bar-chart-o"></i> Kelas Mahasiswa <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('/home/addkelasmahasiswa') }}"> Tambah</a></li>
                      <li><a href="{{ url('/home/showkelasmahasiswa') }}"> Tampilkan</a></li>
                    </ul>
                  </li>
                  
        
          
				        <!--  <li>
                  <a><i class="fa fa-sitemap"></i> Angkatan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Tambah</a>
                        </li>
                        <li><a href="#level1_2">Tampilkan</a>
                        </li>
                    </ul>
                  </li> -->

                  <li>
                  <a><i class="fa fa-sitemap"></i>Penilaian Mahasiswa <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ url('/home/shownilai') }}">Tampilkan</a>
                        </li>
                    </ul>
                  </li>

                 <h3>User Management</h3>
              <li>
                <a><i class="fa fa-bug"></i> Admin <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/home/register_admin')}}"> Tambah</a></li>
                       <li><a href="{{url('/home/show_useradmin')}}">Tampilkan</a></li>
                    </ul>
                  </li> 
				     <li>
                <a><i class="fa fa-bug"></i> Dosen <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
          						<li><a href="{{url('/home/register_dosen')}}"> Tambah</a></li>
          						 <li><a href="{{url('/home/show_users_dosen')}}">Tampilkan</a></li>
                    </ul>
                  </li>
				      <li>
              <a><i class="fa fa-bug"></i> Mahasiswa <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
          						<li><a href="{{url('/home/register_mahasiswa')}}"> Tambah</a></li>
          						<li><a href="{{url('/home/show_users_mahasiswa')}}">Tampilkan</a></li>
                    </ul>
               </li>
               <li>
              <a><i class="fa fa-bug"></i> UpdateAll Mahasiswa <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/home/update_all_mahasiswa')}}"> Update</a></li>
                     
                    </ul>
               </li>


                  <!-- <li><a><i class="fa fa-edit"></i> KRS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/home/addkrs')}}">Pengisian KRS</a></li>
                      <li><a href="{{url('/home/listkrs')}}">Lihat KRS</a></li>
                       <li><a href="{{url('list_krs')}}">Lihat KRS 1</a></li> 
                    </ul>
                  </li> -->


				  
          <!-- tutup dulu
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
         
            
                  <li><a><i class="fa fa-edit"></i> KRS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/home/add_krs')}}">Pengisian KRS</a></li>
                      <li><a href="{{url('/home/list_krs')}}">Lihat KRS</a></li>
                    </ul>
                  </li> -->
                
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
                     @if (Auth::user()->imageuser===null)
                         <img src="{{ URL::asset('images/user.png')}}" alt="img1">
                    @else
                        <img src="data:image/jpg;base64,{{ Auth::user()->imageuser}}" alt="profile-picture">
                    
                    @endif
                    {{ Auth::user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{url('/home')}}"> <i class="fa fa-user pull-right"></i>Profile</a></li>
                    <li><a href="{{ url('/home/changepassword_admin') }}"><i class="fa fa-cog pull-right"></i>Ganti Password</a></li>                 
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <!--li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                </li-->
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
