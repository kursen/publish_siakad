@extends('layouts.master')

@section('title','Kelas')
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
                    <h2>Edit Data Kelas</h2>
                    <a href="{{url('/home/showkelas')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tampilkan</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				 
					<div class="col-lg-6 col-sm-6 col-xs-5">
						{!! Form::open(array('url' => '/home/editkelas','class'=>'form-horizontal','id'=>'form-kelas','autocomplete'=>'off')) !!}
							{!! Form::hidden('idkelas',$kelas->idkelas) !!}
							<div class="form-group" id="mkkd">
								{!! Form::label('kode_kelas','Kode Kelas',array('class' => 'col-sm-4 control-label')) !!}
								<div class="col-sm-5">
									{!! Form::text('kode_kelas',$kelas->kodekelas,array('class' => 'form-control','maxlength'=>'6','readonly'=>'true')) !!}
									<small id="status_kdkelas"></small>
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('nama_kelas','Nama Kelas',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::text('nama_kelas',$kelas->namakelas,array('class' => 'form-control')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('dosen_wali','Dosen Wali',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::select('dosen_wali', $arrdosen, $kelas->iddosen,array('class' => 'form-control')) !!}
								</div>
							</div>

								<div class="form-group">
										<div class="col-lg-offset-4 col-sm-3">
										  <button id="btn-submit" type="submit" class="btn btn-success">
										  	<i class="fa fa-send"></i> Ubah</button>
										</div>
									  </div>
									  {!! Form::close() !!}
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
		
		
		$('#form-kelas').bootstrapValidator({
				live: 'enabled',
				message: 'This value is not Valid',
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				excluded:'disabled',
				fields: {
					nama_kelas: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi kelas'
							}
						}
					},
					dosen_wali: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi dosen wali'
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
				$('#form-kelas input').attr("disabled", "disabled");
				$.ajax({
					type: 'POST',
					url: $form.attr('action'),
					data: data,
					dataType: 'json',
					success: function (data) {
						
							var returndata=parseInt(data.return);
							
							if(returndata==1){
								alertify.confirm('Berhasil',"Data Berhasil diupdate", function () {
									window.location.href='/home/showkelas';
									},function () {
									window.location.href='/home/showkelas';
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
							$('#form-kelas input').removeAttr("disabled");
						}
					});
				});
		});
</script>
@endsection