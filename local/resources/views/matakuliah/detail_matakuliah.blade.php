@extends('layouts.master')

@section('title','MataKuliah')

@section('sidebar')
@parent
@endsection
@section('content')
<div class="x_panel">
    <div class="x_title">
        <h2>Detail Matakuliah</h2>
         <div class="filter">
           
          </div>
     <div class="clearfix">
     	<a href="{{url('/home/showmatakuliah')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tampilkan</a>
     </div>
    </div>
    <div class="x_content">
		<div class="col-lg-8 col-sm-8 col-xs-5">
						{!! Form::open(array('class'=>'form-horizontal','id'=>'form-matakuliah','autocomplete'=>'off')) !!}
							<div class="form-group">
								{!! Form::label('kodemk','Kode MataKuliah',array('class' => 'col-sm-4 control-label')) !!}
								<div class="col-sm-5">
									<label class="control-label">{{ $matakuliah->kodemk }}</label>
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('matakuliah','MataKuliah',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									<label class="control-label">{{ $matakuliah->matakuliah }}</label>
									
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('bobot','Bobot',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									<label class="control-label">{{ $matakuliah->bobot }}</label>
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('teori','Teori',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									<label class="control-label">{{ $matakuliah->teori }}</label>
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('praktek','',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									<label class="control-label">{{ $matakuliah->praktek }}</label>
								</div>
							</div>

							<div class="form-group">
								{!! Form::label('klinik','Klinik',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									<label class="control-label">{{ $matakuliah->klinik }}</label>
								</div>
							</div>


							
							<div class="form-group">
								{!! Form::label('kadep','Kadep',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									<label class="control-label">{{ $matakuliah->kadep }}</label>
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('semester','Semester',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-5">
									<label class="control-label">{{ $matakuliah->semester }}</label>
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('bobotnilai','Bobot Nilai',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									<label class="control-label">{{ $matakuliah->bobotnilai }}</label>
								</div>
							</div>

							@if($detailmatakuliah->isEmpty())
								<div class="form-group">
									{!! Form::label('kosong','Tidak Ada Dosen',array('class' => 'col-sm-6 control-label')) !!}	
								</div>
							@else
								<div class="form-group">
									{!! Form::label('dosen','Dosen',array('class' => 'col-sm-4 control-label')) !!}	
									<div class="col-sm-8">
										@foreach($detailmatakuliah as $value)
										<div class="input-group">
											<label class="control-label">{{ $value->relasi_dosen->nama }}</label>
											
										
										</div>
										@endforeach
										
									</div>
								</div>
							@endif
							
									  {!! Form::close() !!}
							</div>
	</div>		
 </div>
@endsection
