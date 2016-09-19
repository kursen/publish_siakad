@extends('layouts.master')
@section('title','User Dosen')
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
         <h2>Dosen Usermanagement</h2>
            <a href="{{url('/home/show_users_dosen')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tampilkan</a>
           <div class="clearfix"></div>
        </div>
		<div class="x_content">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-xs-5">
							<form class="form-horizontal" role="form" method="POST" action="{{ url('/home/update_users_dosen') }}" id="register-form">
								{{ csrf_field() }}
							

								<div class="form-group">
									<label for="nama" class="col-md-4 control-label">Nama</label>

									<div class="col-md-6">
										<input readonly='true' id="nama" type="text" value="{{ $modeledit->nama }}" class="form-control" name="nama">
										<input type='hidden' name='id' value='{{ $modeledit->id }}'> 
									</div>
								</div>

								<div class="form-group">
									<label for="email" class="col-md-4 control-label">E-Mail</label>

									<div class="col-md-6">
										<input id="email" type="email" value="{{ $modeledit->email }}" class="form-control" name="email">
										<input type="hidden" name="iddosen" value="{{ $modeledit->iddosen }}" />
										
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
											<i class="fa fa-btn fa-checklist"></i> Simpan
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

<script type='text/javascript'>
	$(document).ready(function(){
		
		
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
								alertify.confirm('Berhasil',"Data Berhasil diupdate", function () {
									window.location.href='/home/show_users_dosen';
									},function () {
									window.location.href='/home/show_users_dosen';
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
							$('#btn-submit').removeAttr('disabled');
							$('#register-form input').removeAttr("disabled");
						}
					});
				});
		});
</script>
@endsection