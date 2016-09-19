@extends('master_index')
@section('content')
<!--Carousell-->
	<div id="myCarousel" class="carousel slide wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class=""></li>
        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
        <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item ">
          <img class="first-slide" src="{{ URL::asset('images/index1.jpg')}}" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1> APIKES IMELDA</h1>
             
            </div>
          </div>
        </div>
        <div class="item active">
          <img class="second-slide" src="{{ URL::asset('images/index5.JPG')}}" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>AKADEMI  PEREKAM MEDIK DAN INFOKES (APIKES) IMELDA</h1>
      
            </div>
          </div>
        </div>
        <div class="item">
          <img src="{{ URL::asset('images/index3.jpg')}}" alt="Third slide" height="578" class="third-slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Medical Record</h1>

            </div>
          </div>
        </div>
		
		
		
		
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
	<!--End Of Carousell-->
  <div class="about">
    <div class="container">
      <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" >
        <h2>Tujuan </h2>
        <ul class="custom-bullet">
          <li>Menghasilkan Kurikulum yang sesuai dengan kompetensi utama 
            lulusan Rekam Medik Informasi Kesehatan 
            (RMIK) sesuai dengan KKNI dan SN DIKTI serta PORMIKI
          </li>
          <li>Menghasilkan penelitian yang mampu 
            meningkatkan efektivitas dan efesiensi manajemen , pengelolaan data dan penyajian 
            informasi kesehatan
           </li>
          <li>Melakukan pengabdian masyarakat yang mampu meningkatkan penataan data-data dan pemberian 
            informasi kesehatan di berbagai institusi pelayanan kesehatan baik swasta maupun negeri
          </li>
          <li>Membentuk SDM pendidik yang memiliki kompetensi dalam mengaplikasikan kurikulum ahlimadya Rekam 
            medis informasi kesehatan sesuai dengan perkembangan IPTEK dibidang informasi kesehatan
          </li>
          <li>Menyediakan sarana prasarana untuk mendukung terjadinya proses pembelajaran
          </li>
          <li>Menjalin hubungan kerja sama dengan berbagai institusi untuk mendukung Tridharma perguruan Tinggi
          </li>
        </ul>
      </div>


      <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
        <h2>Visi Dan Misi</h2>
        <p><strong><i class="glyphicon glyphicon-asterisk"></i> VISI</strong></p>
        <ul class="custom-bullet">
          <li>
              Menjadi pusat pendidikan RMIK berbasis elektronika untuk menghasilkan lulusan D3 RMIK profesional
               serta mampu bersaing di tingkat nasional pada tahun 2020
          </li>
        </ul>
        
        <p><strong><i class="glyphicon glyphicon-asterisk"></i> MISI</strong></p>
        <ul class="custom-bullet">
          <li>Menyelenggaarakan kurikulum RMIK bidang rekam medis dan informasi kesehatan 
            berbasis Rekam Kesehatan Elektronik (RKE) yang mengikuti perkembangan ilmu pengetahuan 
            Rekam Medis Informasi Kesehatan yang berkualitas mengacu kepada KKNI dan SN Dikti</li>
          <li>Menghasilkan penelitian ilmiah yang mampu memberikan kontribusi kepada pengembangan ilmu 
            pengetahuan dan teknologi dalam bidang Rekam Medik serta mampu memberikan solusi dalam berbagai persoalan 
            pelayanan Rekam Medik di rumah sakit, puskesmas dan pelayanan kesehatan lain yang membutuhkan</li>
          <li>Melakukan pengabdian masyarakat dalam bidang pelayanan Rekam Medik Informasi Kesehatan 
          terutama mendorong terlaksananya sistem informasi kesehatan nasional di berbagai institusi pelayanan 
          kesehatan masyarakat</li>
          <li>Mengadakan kerjasama dengan berbagai lembaga kesehatan pemerintah dah swasta, pengguna lulusan Rekam 
            Medik Informasi Kesehatan Imelda, serta 
            mengadakan kerjsama dengan pihak institusi dalam negeri</li>
        </ul>
        
      </div>
    </div>
  </div>
	@endsection
