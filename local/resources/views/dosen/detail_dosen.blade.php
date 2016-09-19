@extends('layouts.master')

@section('title','Dosen')
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
        <h2>Detail Dosen</h2>
         <div class="filter">
           
          </div>
     <div class="clearfix">
     	<a href="{{url('/home/showdosen')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tampilkan</a>
     </div>
    </div>
    <div class="x_content">
		<div class="col-lg-7 col-sm-7 col-xs-5">
			<div  class="form form-horizontal" > 
			<div class="row">
					<div class="form-group">
						<label class="col-md-5 control-label">NIDN :</label>
						<div class="col-md-5">
							<label class="control-label"> {{ $cdatadetail->nidn }} </label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Nama :</label>
						<div class="col-md-5">
							<label class="control-label">{{ $cdatadetail->nama }}</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-5 control-label">Tanggal Lahir :</label>
						<div class="col-md-5">
							 
							<label class="control-label">{{ date('d F, Y', strtotime($cdatadetail->tgllahir)) }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Jabatan :</label>
						<div class="col-md-5">
							<label class="control-label">{{ $cdatadetail->jabatanakademik }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Sertifikat :</label>
						<div class="col-md-5">
							<label class="control-label">{{ $cdatadetail->sertifikat }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Pendidikan :</label>
						<div class="col-md-7">
							<label class="control-label">{{ $cdatadetail->pendidikan }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Bidang :</label>
						<div class="col-md-7">
							<label class="control-label">{{ $cdatadetail->bidang }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Asal Perguruan Tinggi :</label>
						<div class="col-md-7">
							<label class="control-label">{{ $cdatadetail->asalpt }}</label>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>		
 </div>
@endsection
