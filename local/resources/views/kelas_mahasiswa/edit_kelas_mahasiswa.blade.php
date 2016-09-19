@extends('layouts.master')

@section('title','Kelas Mahasiswa')
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
                    <h2>Edit Data Kelas Mahasiswa</h2>
                    <a href="{{url('/home/showkelasmahasiswa')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tampilkan</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				 
					<div class="col-lg-6 col-sm-6 col-xs-5">
						{!! Form::open(array('url' => '/home/updatekelasmahasiswa','class'=>'form-horizontal','id'=>'form-kelasmahasiswa','autocomplete'=>'off')) !!}
							
						<div class="form-group" id="kdkl">
								{!! Form::label('kode_kelas','Kelas',array('class' => 'col-sm-4 control-label')) !!}
								<div class="col-sm-5">
									{!! Form::hidden('id',$model_edit->id) !!}
									{!! Form::select('kode_kelas',$datakelas,$model_edit->kode_kelas,array('class' => 'form-control')) !!}
								</div>
							</div>
							
							 <div class="form-group">
								{!! Form::label('tahun_ajaran','Tahun Ajaran',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-5">
									 <div class="input-group dtpicker">
										<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
											{!! Form::text('tahun_ajaran',$model_edit->tahun_ajaran,array('class' => 'form-control','maxlength'=>'4')) !!}
									</div>
									</div>
								</div>

							<div class="form-group">
								{!! Form::label('nim','Nim',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::text('nim',$model_edit->nim,array('class' => 'form-control')) !!}
								</div>
							</div>

							<div class="form-group">
								{!! Form::label('nama','Nama',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::text('nama',$model_edit->relasi_mahasiswa->nama,array('class' => 'form-control','readonly'=>'true')) !!}
								</div>
							</div>

							<div class="form-group">
								{!! Form::label('semester','Semester',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::select('semester',$arrsemester,$model_edit->semester,array('class' => 'form-control')) !!}
								</div>
							</div>
							
								<div class="form-group">
										<div class="col-lg-offset-4 col-sm-3">
										  <button id="btn-submit" type="submit" class="btn btn-success">
										  	<i class="fa fa-send"></i> Simpan</button>
										</div>
									  </div>
								{!! Form::close() !!}
							</div>
					</div>
					
					
                  </div>
               </div>
@endsection
@section('scripts')
<script src="{{ URL::asset('vendors/jquery-ui/jquery-ui.js')}}"></script>
<script src="{{ URL::asset('vendors/bootstrapvalidator/dist/js/bootstrapValidator.min.js')}}">
</script>
<script src="{{ URL::asset('vendors/alertify/js/alertify.min.js')}}">
</script>
<script type='text/javascript'>
	$(document).ready(function(){
		
		if ($("#nim").length>0) {

				$('#nim').autocomplete({
					source: function (request, response) {
						$.ajax({
							url: "{{url('/home/mahasiswa_user_autocomplete')}}",
							type: 'POST',
							data: {
								term: $('#nim').val(),
								_token : $('input[name="_token"]').val()
							},
							dataType: 'json',
							success: function (data) {
								response($.map(data, function (obj) {
									console.log(obj);
									return {
										label: obj.nim,
										value: obj.nim,
										nama: obj.nama
									}
								}));
							}
						});
					},
					change: function (event, ui) {
						if (ui.item != null) {
							$('#nim').val(ui.item.value);
							$('#nama').val(ui.item.nama);
						}
					}
				}).data('ui-autocomplete')._renderItem = function (ul, item) {
					//location
					return ($('<li>').append('<a><strong>' + item.label + '</strong>, <i><strong>' + item.nama + '</strong> </i></a>').appendTo(ul));
				};

    }; //end autcomplete

		
		$('#form-kelasmahasiswa').bootstrapValidator({
				live: 'enabled',
				message: 'This value is not Valid',
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				excluded:'disabled',
				fields: {
					
					kode_kelas: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi kelas'
							}
							
						}
					},
					tahun_ajaran: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi tahun'
							},
								numeric: {
	                            message: 'tahun salah!',
	                            // The default separators
	                            thousandsSeparator: '',
	                            decimalSeparator: ''
                        	}
						}
					},
					semester: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi semester'
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
				$('#form-kelasmahasiswa input').attr("disabled", "disabled");
				$.ajax({
					type: 'POST',
					url: $form.attr('action'),
					data: data,
					dataType: 'json',
					success: function (data) {
						
							var returndata=parseInt(data.return);
							if(returndata==1){
								alertify.confirm('Berhasil',"Data Berhasil diupdate", function () {
									window.location.href='/home/showkelasmahasiswa';
									},function () {
									window.location.href='/home/showkelasmahasiswa';
									});	
								
							}else{
								alertify.alert("Error ","Data Input Tidak Valid");
							}
							return false;
						},
						error: function (xhr,textStatus,errormessage) {
							alertify.alert("Kesalahan! ","Error !!"+xhr.status+" "+textStatus+" "+"Tidak dapat mengirim data!,Periksa Kembali Data Anda!!");
						},
						complete: function () {
							$('#form-kelasmahasiswa').bootstrapValidator('resetForm',false);
							$('#btn-submit').removeAttr('disabled');
							$('#form-kelasmahasiswa input').removeAttr("disabled");
							$('.chkbox').prop('checked',false);
						}
					});
				});
		});
</script>
@endsection