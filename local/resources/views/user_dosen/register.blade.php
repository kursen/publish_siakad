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
				<div class="col-lg-6 col-sm-6 col-xs-12">
							<form class="form-horizontal" role="form" method="POST" action="{{ url('/home/store_register_user_dosen') }}" id="register-form">
								{{ csrf_field() }}
								
								

								<div class="form-group" id="errid">
									<label for="nama" class="col-md-4 control-label">Nama</label>

									<div class="col-md-6">
										<input id="nama" type="text" class="form-control" name="nama">
										<small id="status_id"></small>
										<input type="hidden" name="iddosen" id="dosenid" />
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

	var fn_check_iddosen_exist = function(val){
		if(val==1){
			$('#errid').removeClass('has-success').addClass('has-error');
			$('[data-bv-icon-for="nama"]').removeClass('glyphicon glyphicon-ok').addClass('glyphicon glyphicon-remove')
			$('#status_id').text('nama sudah ada!').css('color','#a94442');
			$('#btn-submit').prop('disabled',true);
		}else{
			$('#status_id').text('');
			$('#btn-submit').prop('disabled',false);
		}
	}
	$(document).ready(function(){
		
		 if ($("#nama").length>0) {

				$('#nama').autocomplete({
					source: function (request, response) {
						$.ajax({
							url: "{{url('/home/dosen_user_autocomplete')}}",
							type: 'POST',
							data: {
								term: $('#nama').val(),
								_token : $('input[name="_token"]').val()
							},
							dataType: 'json',
							success: function (data) {
								response($.map(data, function (obj) {
									return {
										label: obj.nama,
										value: obj.nama,
										iddosen: obj.iddosen,
										nidn :obj.nidn
									}
								}));
							}
						});
					},
					change: function (event, ui) {
						if (ui.item != null) {
							$('#nama').val(ui.item.value);
							$('#dosenid').val(ui.item.iddosen);
							$.ajax({
								url:'{{ url("/home/check_iddosen") }}',
								type: 'POST',
								data: {
									iddosen: ui.item.iddosen,
									_token : $('input[name="_token"]').val()
								},
								dataType: 'json',
								success: function (returnval) {
									fn_check_iddosen_exist(parseInt(returnval));
								}

							});
						}
					}
				}).data('ui-autocomplete')._renderItem = function (ul, item) {
					//location
					return ($('<li>').append('<a><strong>' + item.label + '</strong>, <i><strong>' + item.nidn + '</strong> </i></a>').appendTo(ul));
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
					
					nidn: {
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
