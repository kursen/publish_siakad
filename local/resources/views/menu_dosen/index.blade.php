@extends('layouts.master_dosen')
@section('title','Dosen')
@section('css')
<link href="{{ URL::asset('build/css/jquery.fileupload.css')}}" rel="stylesheet">
<style>
    
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
<div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>DashBoard</h2>
                      
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block;">
                      <div class="dashboard-widget-content">
                        <div class="col-md-4 hidden-small">
						@if (Auth::guard('userdosens')->user()->imageuser===null)
					<img class="img-rounded" style="max-width: 100%;" id="image" src="{{ URL::asset('images/user.png')}}" alt="profil-picture" >
					@else
					<img class="img-rounded" id="image" style="max-width: 100%;" src="data:image/jpg;base64,{{ Auth::guard('userdosens')->user()->imageuser}}" alt="profile-picture">
					
					@endif
						{!! Form::open(array('url' => '/home/dosen/TempUpload','id'=>'form-image','autocomplete'=>'off','enctype'=>'multipart/form-data')) !!}
						<span class="btn btn-success fileinput-button">
							<i class="fa fa-camera"></i>
								<span>Ganti</span>
								<input type="hidden" name="id" id="id" 
								value="{{ Auth::guard('userdosens')->user()->id }}" />
								{!! Form::file('imageuser',array('id'=>'image_user')) !!}
						</span>
						<button class="btn btn-primary" id="btn-submit" type="submit" style="display:none;">
							<i class="fa fa-send"></i> Simpan</button>
						 {!! Form::close() !!}
							
						  
                        </div>
                        <!--isi-->
						<div class="col-md-8 col-sm-12 col-xs-12">
							<table class="table">
								<colgroup>
									<col/>
									<col style="width: 435px;"/>
								</colgroup>
								<thead>
								<tr>
									<th>NIDN</th>
									<th>{{ $model->nidn }}</th>
								</tr>
								<tr>
									<th>Nama</th>
									<th>{{ Auth::guard('userdosens')->user()->nama }}</th>
								</tr>
								<tr>
									<th>Tanggal Lahir</th>
									<th>{{ date('d F, Y', strtotime($model->tgllahir)) }}</th>
								</tr>
								
								<tr>
									<th>Jabatan</th>
									<th>{{ $model->jabatanakademik }}</th>
								</tr>
								
								<tr>
									<th>Pendidikan</th>
									<th>{{ $model->pendidikan }}</th>
								</tr>

								<tr>
									<th>Sertifikat</th>
									<th>{{ $model->sertifikat }}</th>
								</tr>

								<tr>
									<th>Asal Perguruan Tinggi</th>
									<th>{{ $model->asalpt }}</th>
								</tr>

								<tr>
									<th>Bidang</th>
									<th>{{ $model->bidang }}</th>
								</tr>
								
								<tr>
									<th>Last Login</th>
									<th>{{ date('d F, Y', strtotime(Auth::guard('userdosens')->user()->updated_at)) }}</th>
								</tr>
								<tr>
									<th>Created at</th>
									<th>{{ date('d F, Y', strtotime(Auth::guard('userdosens')->user()->created_at)) }}</th>
								</tr>
								</thead>
							</table>
							 </div>
                      </div>
                    </div>
                  </div>
                </div>
         
@endsection
@section('scripts')
    <script type="text/javascript">
    function readURL(input) {
        var a=$(input)[0].files;
        
        if (a) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL($(input)[0].files[0]);
        }
    }
    
    $(document).ready(function(){
        
        $('#image_user').change(function(){
            readURL($(this));
            var image=document.getElementById('newimg');
            $('#btn-submit').show();
            /*var cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                ready: function () {
                croppable = true;
                }
            });*/
        });
    });
    </script>
@endsection