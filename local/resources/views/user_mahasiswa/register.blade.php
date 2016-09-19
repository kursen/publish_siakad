@extends('layouts.master')
@section('title','User Mahasiswa')
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
         <h2>Mahasiswa Usermanagement</h2>
            <a href="{{url('/home/show_users_mahasiswa')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tampilkan</a>
           <div class="clearfix"></div>
        </div>
		<div class="x_content">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-xs-12">
							<form class="form-horizontal" role="form" method="POST" action="{{ url('/home/store_register_mahasiswa') }}" id="register-form">
								{{ csrf_field() }}
								
								<div class="form-group">
									<label for="nim" class="col-md-4 control-label">NIM</label>

									<div class="col-md-6">
										<input id="nim" type="text" class="form-control" name="nim">

										
									</div>
								</div>

								<div class="form-group">
									<label for="nama" class="col-md-4 control-label">Nama</label>

									<div class="col-md-6">
										<input id="nama" type="text" class="form-control" name="nama">

										
									</div>
								</div>

								<div class="form-group">
									<label for="email" class="col-md-4 control-label">E-Mail</label>

									<div class="col-md-6">
										<input id="email" type="email" class="form-control" name="email">

										
									</div>
								</div>

								<div class="form-group">
									<label for="password" class="col-md-4 control-label">Password</label>

									<div class="col-md-6">
										<input id="password" type="password" class="form-control" name="password">
									</div>
								</div>

								<div class="form-group">
									<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

									<div class="col-md-6">
										<input id="password-confirm" type="password" class="form-control" name="password_confirmation">

										
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button id="btn-submit" class="btn btn-success" type="submit">
											<i class="fa fa-btn fa-user"></i> Register
										</button>
									</div>
								</div>
								
							</form>
				</div>
			</div>
		</div>
		</div>
</div>
@endsection
@section('scripts')
<script src="{{ URL::asset('vendors/bootstrapvalidator/dist/js/bootstrapValidator.min.js')}}">
</script>
<script src="{{ URL::asset('vendors/alertify/js/alertify.min.js')}}">
</script>
<script src="{{ URL::asset('vendors/jquery-ui/jquery-ui.js')}}"></script>

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
		
		$('#register-form').bootstrapValidator({
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
								message: 'Silahkan isi NIM'
							},
							 integer: {
								message: 'NIM tidak boleh huruf',
									// The default separators
									thousandsSeparator: '',
									decimalSeparator: '.'
							}
							
						}
					},
					nama: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi Nama'
							}
						}
					},
					email: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi Email'
							},
							emailAddress: {
								message: 'Email salah!'
							}
						}
					},
					
					password: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi Password'
							},
							identical: {
								field: 'password_confirmation',
								message: 'password tidak cocok!'
							}
						}

					},
					password_confirmation:{
						validators:{
							notEmpty: {
								message: 'Silahkan Konfirmasi Password'
							},
							identical: {
								field: 'password',
								message: 'password tidak cocok!'
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
				$('#register-form input').attr("disabled", "disabled");
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
							$('#register-form').bootstrapValidator('resetForm',true);
							$('#btn-submit').removeAttr('disabled');
							$('#register-form input').removeAttr("disabled");
						}
					});
				});
		});
</script>
@endsection
