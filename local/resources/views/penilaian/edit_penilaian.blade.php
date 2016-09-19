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
                    <a href="{{url('/home/shownilai')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tampilkan</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<div class="col-lg-6 col-sm-6 col-xs-5">

						@if(Session::has('success'))
						    <div class="alert alert-success">
						        {{ Session::get('success') }}
						    </div>
						@endif

						@foreach( $datanilai as $key => $cdatanilai )
		
						{!! Form::open(array('url' => '/home/editnilai/'.$cdatanilai->idkhs, 'class'=>'form-horizontal', 'id'=>'form-editnilai')) !!}
							
							{!! Form::hidden('idkhs', $cdatanilai->idkhs, array('class' => 'form-control')) !!}

							<div class="form-group">
								{!! Form::label('nim','Nim',array('class' => 'col-sm-4 control-label')) !!}
								<div class="col-sm-5">
									{!! Form::text('nim', $cdatanilai->nim, array('class' => 'form-control','maxlength'=>'10','readonly'=>'true')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('nama','Nama Mahasiswa',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::text('nama', $cdatanilai->nama, array('class' => 'form-control', 'readonly'=>'true')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('absensi','Absensi',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									{!! Form::text('absensi', $cdatanilai->absensi, array('class' => 'form-control', 'maxlength'=>'3', 'size'=>'2')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('seminar','Seminar',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									{!! Form::text('seminar', $cdatanilai->seminar, array('class' => 'form-control', 'maxlength'=>'3')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('tugas','Tugas',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									{!! Form::text('tugas', $cdatanilai->tugas, array('class' => 'form-control', 'maxlength'=>'3' , 'size'=>'2')) !!}
								</div>
							</div>

							<div class="form-group">
								{!! Form::label('midsm','MID SM',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									{!! Form::text('midsm', $cdatanilai->midsm, array('class' => 'form-control', 'maxlength'=>'3' , 'size'=>'2')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('uas','UAS',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									{!! Form::text('uas', $cdatanilai->nsem, array('class' => 'form-control', 'maxlength'=>'3', 'size'=>'2')) !!}
								</div>
							</div>

							<div class="form-group">
								{!! Form::label('keterangan','Keterangan',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::text('keterangan', $cdatanilai->keterangan, array('class' => 'form-control')) !!}
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-offset-4 col-sm-3">
									<button id="btn-submit" type="submit" class="btn btn-success"><i class="fa fa-send"></i> Ubah</button>
								</div>
							</div>


							{!! Form::close() !!}

							@endforeach

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
			$('#form-editnilai').bootstrapValidator({
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
					absensi: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi nilai absensi'
							}
						}
					},
					seminar: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi nilai seminar'
							}
						}
					},
					tugas: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi nilai tugas'
							}
						}
					},
					midsm: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi nilai mid semester'
							}
						}
					},
					uas: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi nilai uas'
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
				$('#form-editnilai input').attr("disabled", "disabled");
				$.ajax({
					type: 'POST',
					url: $form.attr('action'),
					data: data,
					dataType: 'json',
					success: function (data) {
						
							var returndata=parseInt(data.return);
							if(returndata==1){
									alertify.confirm('Berhasil',"Data Berhasil diubah", function () {
									window.location.href='/home/shownilai';
									},function () {
									window.location.href='/home/shownilai';
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
							$('#form-editnilai').bootstrapValidator('resetForm',true);
							$('#btn-submit').removeAttr('disabled');
							$('#form-editnilai input').removeAttr("disabled");
						}
					});
				});
		});
		
   </script>
@endsection
