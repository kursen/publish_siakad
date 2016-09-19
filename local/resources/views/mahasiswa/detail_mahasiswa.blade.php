@extends('layouts.master')

@section('title','Mahasiswa')
@section('css')
<!-- <link href="{{ URL::asset('build/css/jquery.fileupload.css')}}" rel="stylesheet">
<link href="{{ URL::asset('vendors/cropper-master/dist/cropper.min.css')}}" rel="stylesheet"> -->
<style>
    .container-here {
      max-width: 960px;
      margin: 20px auto;
    }

    .img-container {
      width: 100%;
      max-height: 450px;
    }
	
	
    .img-container img {
      max-width: 100%;
    }

    .img-preview {
      overflow: hidden;
    }

    .col {
      float: left;
    }

    .col-6 {
      width: 50%;
    }

    .col-3 {
      width: 25%;
    }

    .col-2 {
      width: 16.7%;
    }

    .col-1 {
      width: 8.3%;
    }
	.fileinput-button {
    position: relative;
    overflow: hidden;
    display: inline-block;
	}

  </style>
@endsection
@section('sidebar')
@parent
@endsection
@section('content')
<div class="x_panel">
    <div class="x_title">
        <h2>Detail Mahasiswa</h2>
         <div class="filter">
           
          </div>
     <div class="clearfix">
     	<a href="{{url('/home/showmahasiswa')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tampilkan</a>
     </div>
    </div>
    <div class="x_content">
    	@foreach($datadetail as $key=>$cdatadetail)
		<div class="col-lg-7 col-sm-7 col-xs-5">
			<div  class="form form-horizontal" > 
			<div class="row">
					<div class="form-group">
						<label class="col-md-5 control-label">NIDN :</label>
						<div class="col-md-5">
							<label class="control-label"> {{ $cdatadetail->nim }} </label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Nama :</label>
						<div class="col-md-5">
							<label class="control-label">{{ $cdatadetail->nama }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Tempat Lahir :</label>
						<div class="col-md-5">
							<label class="control-label">{{ $cdatadetail->tempatlahir }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Tanggal Lahir :</label>
						<div class="col-md-5">
							<label class="control-label">{{ date('d F, Y', strtotime($cdatadetail->tanggallahir)) }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Agama :</label>
						<div class="col-md-5">
							<label class="control-label">{{ $cdatadetail->agama }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Asal Sekolah :</label>
						<div class="col-md-7">
							<label class="control-label">{{ $cdatadetail->asalsekolah }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Nama Orang Tua :</label>
						<div class="col-md-7">
							<label class="control-label">{{ $cdatadetail->namaortu }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Status :</label>
						<div class="col-md-7">
							<label class="control-label">{{ $cdatadetail->status }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Angkatan :</label>
						<div class="col-md-7">
							<label class="control-label">{{ $cdatadetail->angkatan }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Stambuk :</label>
						<div class="col-md-7">
							<label class="control-label">{{ $cdatadetail->tahun }}</label>
						</div>
					</div>
				</div>
			</div>	
		</div>
		@endforeach
	</div>		
 </div>
@endsection
