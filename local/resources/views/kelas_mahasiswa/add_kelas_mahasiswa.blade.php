@extends('layouts.master')

@section('title','Kelas Mahasiswa')
@section('css')
 <link href="{{ URL::asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
 <link href="{{ URL::asset('vendors/bootstrapvalidator/dist/css/bootstrapValidator.min.css')}}" rel="stylesheet">
 
 <link href="{{ URL::asset('vendors/alertify/css/alertify.min.css')}}" rel="stylesheet">
 
 <link href="{{ URL::asset('vendors/alertify/css/default.min.css')}}" rel="stylesheet">
 	<link href="{{ URL::asset('vendors/bootstrapdatetimepicker/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
@endsection
@section('sidebar')
@parent
@endsection
@section('content')
			<div class="x_panel">
                  <div class="x_title">
                    <h2>Tambah Data Kelas Mahasiswa</h2>
                    <a href="{{url('/home/showkelasmahasiswa')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tampilkan</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				 
					<div class="col-lg-6 col-sm-6 col-xs-12">
						{!! Form::open(array('url' => '/home/storekelasmahasiswa','class'=>'form-horizontal','id'=>'form-kelasmahasiswa','autocomplete'=>'off')) !!}
						
						{!! Form::hidden('temp_nim',0,array('class' => 'form-control','id'=>'temp_nim')) !!}
							
							 <div class="form-group">
								{!! Form::label('angkatan','Angkatan',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-5">
									 <div class="input-group dtpicker">
										<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
											{!! Form::text('angkatan',null,array('class' => 'form-control','maxlength'=>'4')) !!}
											
									</div>
									</div>
								</div>

							<div class="form-group" id="kdkl">
								{!! Form::label('kode_kelas','Kelas',array('class' => 'col-sm-4 control-label')) !!}
								<div class="col-sm-5">
									{!! Form::select('kode_kelas',$datakelas,'Pilih',array('class' => 'form-control')) !!}
								</div>
							</div>
							
							 <div class="form-group">
								{!! Form::label('tahun_ajaran','Tahun Ajaran',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-5">
									 <div class="input-group dtpicker">
										<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
											{!! Form::text('tahun_ajaran',null,array('class' => 'form-control','maxlength'=>'4')) !!}
											
									</div>
									</div>
								</div>

							<div class="form-group">
								{!! Form::label('semester','Semester',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::select('semester',$arrsemester,'Pilih',array('class' => 'form-control')) !!}
								</div>
							</div>
							
								<div class="form-group">
										<div class="col-lg-offset-4 col-sm-3">
										  <button id="btn-submit" type="submit" class="btn btn-success"><i class="fa fa-send"></i> Tambah</button>
										</div>
									  </div>
									  {!! Form::close() !!}
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-12 flexible">
								<!--table-->
								<table id="datatable-getmahasiswa" class="table table-striped table-bordered">
			                            <thead>
			                              <tr>
			                              <th></th>
			                                <th style="text-align:center;">Nim</th>
			                                <th>Nama</th>
			                              </tr>
			                            </thead>
								</table>
					<!--endtable-->
							</div>
					</div>
                  </div>
@endsection
@section('scripts')

<!-- Datatables -->
    <script src="{{ URL::asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    
    <script src="{{ URL::asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <!--datatable-->

<script src="{{ URL::asset('vendors/bootstrapvalidator/dist/js/bootstrapValidator.min.js')}}">
</script>
<script src="{{ URL::asset('vendors/alertify/js/alertify.min.js')}}">
</script>
<script src="{{ URL::asset('vendors/jquery-ui/jquery-ui.js')}}"></script>

<script src="{{ URL::asset('vendors/bootstrapdatetimepicker/moment.min.js')}}">
	</script>
	<script src="{{ URL::asset('vendors/bootstrapdatetimepicker/moment-with-locales.min.js')}}">
	</script>
	<script src="{{ URL::asset('vendors/bootstrapdatetimepicker/bootstrap-datetimepicker.min.js')}}">
	</script>
<script type='text/javascript'>
var genTable = null;
	$(document).ready(function(){

		
		
		//datatables
		genTable = $('#datatable-getmahasiswa').DataTable({
          processing: true,
          ajax: '{{url("/home/getdatamahasiswa",["tahunajaran"=>0])}}',
          paging:true,
          ordering:true,
          info:true,
          searching:true,
          columns: [
	          {

	              "className": "text-center",
	              "data": null,
	              "bSortable": false,
	              "orderable":false,
	              'mRender': function ( data, type, row ) {
                        if ( type === 'display' ) {
                          return '<input type="checkbox" name="kodemk" class="chkbox" value="'+data.nim+'"">';
                        }
                        return data;
                    }
	              
	            },
              {data: 'nim', name: 'nim',"className":"text-right"},
              {data: 'nama', name: 'nama',"className":"text-center"}
          ]
      });


	$('.dtpicker').datetimepicker({
				format:'YYYY'
			}).on('dp.change dp.show', function(e) {
				$('#form-kelasmahasiswa').bootstrapValidator('revalidateField','tahun_ajaran');
				//console.log($('#angkatan').val());
				var angkatanval = $('#angkatan').val();
				var substr_angkatan = angkatanval.substr(2,3);
				var _url='/home/getdatamahasiswa/'+substr_angkatan;
				genTable.ajax.url(_url).load();
			});


	var sbody = $('#datatable-getmahasiswa tbody');
      sbody.on('click','.chkbox',function(){
      	if ($('#tahun_ajaran').val()!='') {
      		var data = genTable.row($(this).parents('tr')).data();
      		if($(this).is(':checked')){
      				var this_checkbox = this;
		      		var kode_kelas = $('#kode_kelas').val();
		      		var tahun_ajaran = $('#tahun_ajaran').val();
		      		var semester = $('#semester').val();
	      			var strInput ='<input type="hidden" name="nim[]" value="'+data.nim+'" id="'+data.nim+'" />';
	      			$.ajax({
						type: 'POST',
						url: "{{ url('/home/check_kelasmahasiswa') }}",
						data: {'semester':semester,'nim':data.nim,'kodekelas':kode_kelas,
						'tahun_ajaran':tahun_ajaran,'_token' : $('input[name="_token"]').val()},
						dataType: 'json',
						success: function (returndata) {
								if(parseInt(returndata.return)==1){
									alertify.error('Data sudah ada!!');
									this_checkbox.checked=false;
								}else{
									$('#temp_nim').val(1);
									$(strInput).appendTo('#form-kelasmahasiswa');
									alertify.success(data.nim+' : '+data.nama+' ditambahkan');
								}
								return false;
							},
						error: function (xhr,textStatus,errormessage) {
								alertify.alert("Kesalahan! ","Error !!"+xhr.status+" "+textStatus+" "+"Tidak dapat mengirim data!");
							}
						});
	      	}else{
	      		var idfind ="#"+data.nim+"";
	      		$('#form-kelasmahasiswa').find(idfind).remove();
	      		alertify.error(data.nim+' : '+data.nama+' dibuang');
	      	}
      }else{
      		this.checked=false;
      		alertify.alert('Info!!','Data Belum Lengkap!');
      	}
      	/**/
        
      });
		
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
								alertify.success('Data Berhasil Disimpan');
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
