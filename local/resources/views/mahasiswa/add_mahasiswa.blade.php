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
                    <h2>Tambah Data Mahasiswa</h2>
                    <a href="{{url('/home/showmahasiswa')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tampilkan</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<div class="col-lg-6 col-sm-6 col-xs-12">

						{!! Form::open(array('url' => '/home/addmahasiswa','class'=>'form-horizontal', 'id'=>'form-mahasiswa')) !!}
							<div class="form-group" id="nimgroup">
								{!! Form::label('nim','Nim',array('class' => 'col-sm-4 col-sm-4 col-xs-12 control-label')) !!}
								<div class="col-md-5 col-sm-6 col-xs-12">
									{!! Form::text('nim',null,array('class' => 'form-control','maxlength'=>'10')) !!}
									<small id="status_nim"></small>
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('nama','Nama Mahasiswa',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-md-5 col-sm-6 col-xs-12">
									{!! Form::text('nama',null,array('class' => 'form-control')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('tempatlahir','Tempat Lahir',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-md-5 col-sm-6 col-xs-12">
									{!! Form::text('tempatlahir',null,array('class' => 'form-control')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('tanggallahir','Tanggal Lahir',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-md-5 col-sm-6 col-xs-12">
									 <div class="input-group" id="dtpicker">
										<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
											{!! Form::text('tanggallahir',null,array('class' => 'form-control')) !!}
										</div>
									</div>
								</div>

								<div class="form-group">
									{!! Form::label('agama','Agama',array('class' => 'col-sm-4 control-label')) !!}
									<div class="col-md-5 col-sm-6 col-xs-12">
										{!! Form::select('agama', $arragama, 'Pilih', array('class' => 'form-control')) !!}
									</div>
								</div>
		
								<div class="form-group">
									{!! Form::label('asalsekolah','Asal Sekolah',array('class' => 'col-sm-4 control-label')) !!}
								<div class="col-md-5 col-sm-6 col-xs-12">
										{!! Form::text('asalsekolah',null,array('class' => 'form-control')) !!}
									</div>
								</div>

								<div class="form-group">
									{!! Form::label('namaortu','Nama Orang Tua',array('class' => 'col-sm-4 control-label')) !!}
									<div class="col-md-5 col-sm-6 col-xs-12">
										{!! Form::text('namaortu',null,array('class' => 'form-control')) !!}
									</div>
								</div>
								
								<div class="form-group">
									{!! Form::label('status','Status',array('class' => 'col-sm-4 control-label')) !!}
									<div class="col-md-5 col-sm-6 col-xs-12">
										{!! Form::select('status', $arrstatus, 'Pilih', array('class' => 'form-control')) !!}
									</div>
								</div>

								<div class="form-group">
										<div class="col-lg-offset-4 col-sm-3">
										  <button id="btn-submit" type="submit" class="btn btn-success"><i class="fa fa-send"></i> Tambah</button>
										</div>
								</div>

							    {!! Form::close() !!}
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-5">
								<img class="img-thumbnail" style="width: 150px;height: 200px; display:none;" src="#" alt="myimg"  id="blah" />
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
	<script src="{{ URL::asset('vendors/jquery-ui/jquery-ui.js')}}"></script>

	
    <script type='text/javascript'>
		/*function readURL(input) {
		var a=$(input)[0].files;
        if (a) {
			$('#blah').show();
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL($(input)[0].files[0]);
        }
		else{
			$('#blah').hide();
		}
    }*/
	
		var checkkode=0;
		var fn_check_nim_exist = function(val){
		if(val==1){
			$('#nimgroup').removeClass('has-success').addClass('has-error');
			$('[data-bv-icon-for="nim"]').removeClass('glyphicon glyphicon-ok').addClass('glyphicon glyphicon-remove')
			$('#status_nim').text('nim sudah ada!').css('color','#a94442');
			$('#btn-submit').prop('disabled',true);
		}else{
			$('#status_nim').text('');
			$('#btn-submit').prop('disabled',false);
		}
	}
	
	
		$(document).ready(function(){
			
			/*var startDate = new Date('1985-01-01'),
				endDate = new Date('1996-01-01');*/
			$('#tanggallahir').datetimepicker({
				format:'YYYY-MM-DD',
				locale:'id',
				/*minDate:startDate,
				maxDate:endDate,
				defaultDate: '01/26/2014'*/
			});
			
			$('#nim').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "/home/nim_autocomplete",
                    type: 'POST',
                    data: {
                        term: $('#nim').val(),
						_token : $('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        response($.map(data, function (obj) {
							checkkode=parseInt(obj);
							fn_check_nim_exist(parseInt(obj));
                        }));
                    }
                });
            },
			 messages: {
				noResults:'' ,
				results: function() {{
					}
				}
			},
            change: function (event, ui) {
				parseInt(checkkode);
				fn_check_nim_exist(parseInt(checkkode));
            }
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
							},
							integer: {
								message: 'Nim harus angka'
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
							$('#form-mahasiswa').bootstrapValidator('resetForm',true);
							$('#btn-submit').removeAttr('disabled');
							$('#form-mahasiswa input').removeAttr("disabled");
						}
					});
				});
				
			/*$('#image').change(function(){
				readURL($(this));
			});*/
			
		});
		
   </script>
@endsection
