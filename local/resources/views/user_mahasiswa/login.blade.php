@extends('master_index')
@section('content')
<br/>
<br/>
<br/>
<br/>
<br/>
 <div class="container">
      <div class="row">  
  <div class="col-md-offset-4 col-lg-offset-4 col-md-4 col-lg-4">
       <div class="panel panel-default">
       <div class="panel-body">
          <div class="page-header">
         <h3>Login Mahasiswa <i class="glyphicon glyphicon-user"></i></h3>
      </div>
				@if (Session::has('AuthErr'))
                    <div class="alert alert-danger" style="text-align: center;">{{ Session::get('AuthErr') }}</div>
                @endif
      <form id="login-form" action="{{ url('/login-mahasiswa') }}" 
      method="post" accept-charset="utf-8" role="form">
         <div class="form-group">
            <label for="nim">NIM</label>
            <div class="input-group">
               <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
			   {{ csrf_field() }}
               <input type="text" class="form-control" name="nim" id="nim" value="{{ old('nim') }}"  />

               

            </div>
			 @if ($errors->has('nim'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nim') }}</strong>
                    </span>
             @endif
         </div>
         <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
			   <span class="input-group-addon"><span class="glyphicon glyphicon-star"></span></span>
			   <input type="password" class="form-control" name="password"  />
			</div>
		@if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
             @endif
         </div>
         <hr/>
         
         <button type="submit" class="btn btn-primary" id="btn-submit">
            <span class="glyphicon glyphicon-lock"></span> Login</button>
        
         <p>
        </p>

      </form>
       </div>
    </div>
    
     </div>
  </div>
    </div>
@endsection
