@extends('layouts.master')

@section('title','Mahasiswa')
@section('css')
	<link href="{{ URL::asset('vendors/bootstrapdatetimepicker/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">

	<link href="{{ URL::asset('vendors/bootstrapvalidator/dist/css/bootstrapValidator.min.css')}}" rel="stylesheet">
 
 	<link href="{{ URL::asset('vendors/alertify/css/alertify.min.css')}}" rel="stylesheet">
 
 	<link href="{{ URL::asset('vendors/alertify/css/default.min.css')}}" rel="stylesheet">
@endsection
@section('sidebar')
@parent
@endsection
@section('content')
			<div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Data Mahasiswa</h2>
                    <a href="{{url('/home/showmahasiswa')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tampilkan</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<div class="col-lg-6 col-sm-6 col-xs-5">

						@if(Session::has('success'))
						    <div class="alert alert-success">
						        {{ Session::get('success') }}
						    </div>
						@endif

						<!-- @foreach( $data as $key => $cdata ) -->
		
						{!! Form::open(array('url' => '/home/editmahasiswa/'.$cdata->nim, 'class'=>'form-horizontal', 'id'=>'form-mahasiswa')) !!}
						
							<div class="form-group">
								{!! Form::label('nim','Nim',array('class' => 'col-sm-4 control-label')) !!}
								<div class="col-sm-5">
									{!! Form::text('nim', $cdata->nim, array('class' => 'form-control','maxlength'=>'10','readonly'=>'true')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('nama','Nama Mahasiswa',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::text('nama', $cdata->nama, array('class' => 'form-control')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('tempatlahir','Tempat Lahir',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::text('tempatlahir', $cdata->tempatlahir, array('class' => 'form-control')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('tanggallahir','Tanggal Lahir',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-5">
									 <div class="input-group" id="dtpicker">
										<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
											{!! Form::text('tanggallahir', $cdata->tanggallahir, array('class' => 'form-control')) !!}
										</div>
									</div>
								</div>
								
								<div class="form-group">
									{!! Form::label('agama','Agama',array('class' => 'col-sm-4 control-label')) !!}
									<div class="col-sm-4">
										{!! Form::select('agama', $arragama, $cdata->agama, array('class' => 'form-control')) !!}
									</div>
								</div>

								<div class="form-group">
									{!! Form::label('asalsekolah','Asal Sekolah',array('class' => 'col-sm-4 control-label')) !!}<div class="col-sm-7">
										{!! Form::text('asalsekolah', $cdata->asalsekolah, array('class' => 'form-control')) !!}
									</div>
								</div>

								<div class="form-group">
									{!! Form::label('namaortu','Nama Orang Tua',array('class' => 'col-sm-4 control-label')) !!}<div class="col-sm-7">
										{!! Form::text('namaortu', $cdata->namaortu, array('class' => 'form-control')) !!}
									</div>
								</div>

								<div class="form-group">
									{!! Form::label('status','Status',array('class' => 'col-sm-4 control-label')) !!}
									<div class="col-sm-4">
										{!! Form::select('status', $arrstatus, $cdata->status, array('class' => 'form-control')) !!}
									</div>
								</div>

								<div class="form-group">
										<div class="col-lg-offset-4 col-sm-3">
										  <button id="btn-submit" type="submit" class="btn btn-success"><i class="fa fa-send"></i> Ubah</button>
										</div>
									  </div>
									  {!! Form::close() !!}

							<!-- @endforeach -->

							</div>
					</div>
					
					
                  </div>
               </div>
@endsection
@section('scripts')
	<script src="{{ URL::asset('vendors/bootstrapdatetimepicker/moment.min.js')}}"></script>
	<script src="{{ URL::asset('vendors/bootstrapdatetimepicker/moment-with-locales.min.js')}}"></script>
	<script src="{{ URL::asset('vendors/bootstrapdatetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
	
	<script src="{{ URL::asset('vendors/bootstrapvalidator/dist/js/bootstrapValidator.min.js')}}"></script>
	<script src="{{ URL::asset('vendors/alertify/js/alertify.min.js')}}"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

    <script type='text/javascript'>
		$(document).ready(function(){
			var startDate = new Date('1985-01-01');
			
			$('#tanggallahir').datetimepicker({
				format:'YYYY-MM-DD',
				locale:'id',
				minDate:startDate
			});

			$('#form-mahasiswa').bootstrapValidator({
				live: 'enabled',
				message: 'This value is not Valid',
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				excluded:'disabled',
				fields: {
					
					nim: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi nim'
							}
							
						}
					},
					nama: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi nama'
							}
						}
					},
					tempatlahir: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi tempat lahir'
							}
						}
					},
					tanggallahir: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi tanggal lahir'
							}
						}
					},
					asalsekolah: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi asal sekolah'
							}
						}
					},
					namaortu: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi nama orang tua'
							}
						}
					}
				}
			}).on('success.form.bv', function (e) {
        // Prevent form submission
				e.preventDefault();
				// Get the form instance
				var $form = $(e.target);
				// Get the BootstrapValidator instance
				var bv = $form.data('bootstrapValidator');
				// Use Ajax to submit form data
				
				//formData.append('file','file);
				var data = $form.serialize();
				$('#form-mahasiswa input').attr("disabled", "disabled");
				$.ajax({
					type: 'POST',
					url: $form.attr('action'),
					data: data,
					dataType: 'json',
					success: function (data) {
						
							var returndata=parseInt(data.return);
							if(returndata==1){
									alertify.confirm('Berhasil',"Data Berhasil diubah", function () {
									window.location.href='/home/showmahasiswa';
									},function () {
									window.location.href='/home/showmahasiswa';
									});	
							}else{
								alertify.alert("Error ","Data Input Tidak Valid");
							}
							return false;
						},
						error: function (xhr,textStatus,errormessage) {
							alertify.alert("Kesalahan! ","Error !!"+xhr.status+" "+textStatus+" "+"Tidak dapat mengirim data!");
						},
						complete: function () {
							$('#form-mahasiswa').bootstrapValidator('resetForm',true);
							$('#btn-submit').removeAttr('disabled');
							$('#form-mahasiswa input').removeAttr("disabled");
						}
					});
				});
		});
		
   </script>
@endsection