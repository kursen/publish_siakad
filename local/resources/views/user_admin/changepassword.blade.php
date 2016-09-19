@extends('layouts.master')
@section('title','Ganti Password')

@section('css')
	<link href="{{ URL::asset('vendors/bootstrapvalidator/dist/css/bootstrapValidator.min.css')}}" rel="stylesheet">
@endsection

@section('sidebar')
@parent
@endsection
@section('content')
<div class="x_panel">
    <div class="x_title">
        <h2>Ganti Password</h2>
         <div class="filter">
           <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
		   Create at :
            
                 <span> {{ date('d F, Y', strtotime(Auth::user()->created_at)) }}</span> 
            </div>
          </div>
     <div class="clearfix"></div>
    </div>
    <div class="x_content">
		<div class="col-lg-6 col-sm-6 col-xs-5">
			@if (Session::has('AuthErr'))
                    <div class="alert alert-danger" style="text-align: center;">{{ Session::get('AuthErr') }}</div>
                @endif
			{!! Form::open(array('url' => '/home/changepassword_admin', 'class'=>'form-horizontal', 'id'=>'form-password')) !!}
				<div class="row">
					<div class="form-group">
						<label class="col-md-5 control-label">Password Lama</label>
						<div class="col-md-5">
						<input type="hidden" name="id" value="{{Auth::user()->id}}" />
							{!! Form::password('LastPassword',array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Password Baru</label>
						<div class="col-md-5">
							{!! Form::password('NewPassword',array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Konfirmasi Password</label>
						<div class="col-md-5">
							{!! Form::password('ConfirmNewPassowrd',array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-5 col-sm-3">
							<button id="btn-submit" type="submit" class="btn btn-success"><i class="fa fa-send"></i> Ganti</button>
						</div>
					</div>
					
				</div>
			{!! Form::close() !!}
		</div>
		<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
		   Last login :
				 <span> {{ date('d F, Y', strtotime(Auth::user()->updated_at)) }}</span> 
            </div>
	</div>		
 </div>
@endsection
@section('scripts')
	<script src="{{ URL::asset('vendors/bootstrapvalidator/dist/js/bootstrapValidator.min.js')}}"></script>

	
    <script type='text/javascript'>
			$(document).ready(function(){

			$('#form-password').bootstrapValidator({
				live: 'enabled',
				message: 'This value is not Valid',
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				excluded:'disabled',
				fields: {
					
					LastPassword: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi password lama'
							},
							identical: {
								field: 'password_confirmation',
								message: 'password tidak cocok!'
							}
						}

					},
					NewPassword:{
						validators:{
							notEmpty: {
								message: 'Silahkan isi password baru'
							},
							identical: {
								field: 'ConfirmNewPassowrd',
								message: 'password tidak cocok!'
							}
						}
					},
					ConfirmNewPassowrd:{
						validators:{
							notEmpty: {
								message: 'Silahkan isi konfirmasi password baru'
							},
							identical: {
								field: 'NewPassword',
								message: 'password tidak cocok!'
							}
						}
					}
				}
			});
		});
		
   </script>
@endsection