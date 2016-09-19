@extends('layouts.master')

@section('title','Dosen')
@section('css')

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
                    <h2>Tambah Data Dosen</h2>
                    <a href="{{url('/home/showdosen')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tampilkan</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				 
					<div class="col-lg-6 col-sm-6 col-xs-12">
						{!! Form::open(array('url' => '/home/adddosen','class'=>'form-horizontal','id'=>'form-dosen')) !!}
							
							<div class="form-group" id="nidn_stat">
								{!! Form::label('nidn','NIDN',array('class' => 'col-sm-4 control-label')) !!}
								<div class="col-sm-5">
									{!! Form::text('nidn',null,array('class' => 'form-control','maxlength'=>'11')) !!}
									<small id="status_nidn"></small>
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('nama','Nama',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::text('nama',null,array('class' => 'form-control')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('tanggallahir','Tanggal Lahir',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-5">
									 <div class="input-group" id="dtpicker">
										<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
											{!! Form::text('tanggallahir', null, array('class' => 'form-control','placeholder'=>'YYYY-MM-DD')) !!}
										</div>
									</div>
								</div>
							
							<div class="form-group">
								{!! Form::label('jabatanakademik','Jabatan Akademik',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-4">
									{!! Form::select('jabatanakademik', $arrjabakademik,'Pilih',array('class' => 'form-control')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('sertifikat','Sertifikat',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::text('sertifikat',null, array('class' => 'form-control')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('pendidikan','Pendidikan',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-4">
									{!! Form::select('pendidikan', $arrpendidikan, 'Pilih', array('class' => 'form-control')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('asalpt','Asal PT',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::text('asalpt',null, array('class' => 'form-control')) !!}
								</div>
							</div>

							<div class="form-group">
								{!! Form::label('bidang','Bidang',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::text('bidang',null, array('class' => 'form-control')) !!}
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-offset-4 col-sm-3">
									<button id="btn-submit" type="submit" class="btn btn-success"><i class="fa fa-send"></i> Tambah</button>
								</div>
							</div>
					{!! Form::close() !!}

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
	var fn_check_nidn_exist = function(val){
		if(val==1){
			$('#nidn_stat').removeClass('has-success').addClass('has-error');
			$('[data-bv-icon-for="nidn"]').removeClass('glyphicon glyphicon-ok').addClass('glyphicon glyphicon-remove')
			$('#status_nidn').text('nidn sudah ada!').css('color','#a94442');
			$('#btn-submit').prop('disabled',true);
		}else{
			$('#status_nidn').text('');
			$('#btn-submit').prop('disabled',false);
		}
	}
	$(document).ready(function(){

		$('#tanggallahir').datetimepicker({
				format:'YYYY-MM-DD',
				maxDate:'1995-1-1',
				locale:'id'
				/*minDate:startDate,
				maxDate:endDate,
				defaultDate: '01/26/2014'*/
		});

		$('#nidn').keyup(function()
		{
			_datasend= $(this).val();
			$.ajax({
					type: 'POST',
					url: '{{ url("/home/check_nidn") }}',
					data:{term: _datasend,
						_token : $('input[name="_token"]').val()},
					dataType: 'json',
					success: function (datareturn) {
							var returndata=parseInt(datareturn.return);
							fn_check_nidn_exist(returndata);
							return false;
						}
			});
		});
		
		
		$('#form-dosen').bootstrapValidator({
				live: 'enabled',
				message: 'This value is not Valid',
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				excluded:'disabled',
				fields: {
					
					nidn: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi nidn'
							},
							numeric: {
								message: 'Nidn harus angka'
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
					tanggallahir:{
						validators:{
							date:{
								format:'YYYY-MM-DD',
								message:'format tanggal salah!'
							}
						}
					},
					
					/*
					jabatanakademik:{
						validators:{
							notEmpty: {
								message: 'Silahkan isi semester'
							}
						}
					},
					sertifikat:{
						validators:{
							notEmpty: {
								message: 'Silahkan isi semester'
							}
						}
					},*/
					pendidikan:{
						validators:{
							notEmpty: {
								message: 'Silahkan isi pendidikan'
							}
						}
					},
					asalpt:{
						validators:{
							notEmpty: {
								message: 'Silahkan isi asal PT'
							}
						}
					},
					bidang:{
						validators:{
							notEmpty: {
								message: 'Silahkan isi bidang'
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
				$('#form-dosen input').attr("disabled", "disabled");
				//alert(data);
				$.ajax({
					type: 'POST',
					url: $form.attr('action'),
					data: data,
					dataType: 'json',
					success: function (data) {
						
							var returndata=parseInt(data.return);
							if(returndata==1){
								alertify.success('Data Berhasil Disimpan');
							}else{
								alertify.alert("Error ","Data Input Tidak Valid");
							}
							return false;
						},
						error: function (xhr,textStatus,errormessage) {
							alertify.alert("Kesalahan! ","Error !!"+xhr.status+" "+textStatus+" "+"Tidak dapat mengirim data!");
						},
						complete: function () {
							$('#form-dosen').bootstrapValidator('resetForm',true);
							$('#btn-submit').removeAttr('disabled');
							$('#form-dosen input').removeAttr("disabled");
						}
					});
				});
		});
</script>
@endsection
