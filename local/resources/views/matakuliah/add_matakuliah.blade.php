@extends('layouts.master')

@section('title','MataKuliah')
@section('css')
 <link href="{{ URL::asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
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
                    <h2>Tambah Data MataKuliah</h2>
                    <a href="{{url('/home/showmatakuliah')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tampilkan</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				 
					<div class="col-lg-6 col-sm-6 col-xs-12">
						{!! Form::open(array('url' => '/home/storematakuliah','class'=>'form-horizontal','id'=>'form-matakuliah','autocomplete'=>'off')) !!}
							<div class="form-group" id="mkkd">
								{!! Form::label('kodemk','Kode MataKuliah',array('class' => 'col-sm-4 control-label')) !!}
								<div class="col-sm-5">
									{!! Form::text('kodemk',null,array('class' => 'form-control','maxlength'=>'10')) !!}
									<small id="status_kdmk"></small>
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('matakuliah','MataKuliah',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::text('matakuliah',null,array('class' => 'form-control')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('bobot','Bobot',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									{!! Form::text('bobot',2,array('class' => 'form-control','maxlength'=>'1')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('teori','Teori',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									{!! Form::text('teori',1,array('class' => 'form-control','maxlength'=>'3')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('praktek','Praktek',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									{!! Form::text('praktek',1,array('class' => 'form-control','maxlength'=>'3')) !!}
								</div>
							</div>

							<div class="form-group">
								{!! Form::label('klinik','Klinik',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									{!! Form::text('klinik',0,array('class' => 'form-control','maxlength'=>'3')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('kadep','Kadep',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-7">
									{!! Form::text('kadep',null,array('class' => 'form-control')) !!}
								</div>
							</div>

							
							
							<div class="form-group">
								{!! Form::label('semester','Semester',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-5">
									{!! Form::select('semester',$arrsemester,'Pilih',array('class' => 'form-control')) !!}
								</div>
							</div>
							
							<div class="form-group">
								{!! Form::label('bobotnilai','Bobot Nilai',array('class' => 'col-sm-4 control-label')) !!}	
								<div class="col-sm-3">
									{!! Form::text('bobotnilai',0,array('class' => 'form-control','maxlength'=>'2')) !!}
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
							<table id="datatable-dosen" class="table table-striped table-bordered">
	                            <thead>
	                              <tr>
	                              <th></th>
	                                <th style="text-align:center;">NIDN</th>
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
<script type='text/javascript'>
	var checkkode=0;
	var genTable = null;
	var fn_check_kodemk_exist = function(val){
		if(val==1){
			$('#mkkd').removeClass('has-success').addClass('has-error');
			$('[data-bv-icon-for="kodemk"]').removeClass('glyphicon glyphicon-ok').addClass('glyphicon glyphicon-remove')
			$('#status_kdmk').text('kode sudah ada!').css('color','#a94442');
			$('#btn-submit').prop('disabled',true);
		}else{
			$('#status_kdmk').text('');
			$('#btn-submit').prop('disabled',false);
		}
	}
	$(document).ready(function(){

		//datatables
		genTable = $('#datatable-dosen').DataTable({
          processing: true,
          ajax: '{{url("/home/getdosenpengampu")}}',
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
                          return '<input type="checkbox" name="nidn" class="chkbox" value="'+data.iddosen+'"">';
                        }
                        return data;
                    }
	              
	            },
              {data: 'nidn', name: 'nidn',"className":"text-right"},
              {data: 'nama', name: 'nama',"className":"text-center"}
          ]
      });

	var sbody = $('#datatable-dosen tbody');
      sbody.on('click','.chkbox',function(){
      	if ($('#kodemk').val()!='' && $('#matakuliah').val()!='' && $('#kadep').val()!='') {
      		var data = genTable.row($(this).parents('tr')).data();
      		if($(this).is(':checked')){
      				var this_checkbox = this;
      				var iddosen = data.iddosen;
		      		var kodemk = $('#kodemk').val();
	      			var strInput ='<input type="hidden" name="iddosen[]" value="'+data.iddosen+'" id="'+data.nidn+'" />';
	      			$.ajax({
						type: 'POST',
						url: "{{ url('/home/check_kodekmk') }}",
						data: {'nidn':iddosen,'kodemk':kodemk,'_token' : $('input[name="_token"]').val()},
						dataType: 'json',
						success: function (returndata) {
								if(parseInt(returndata.return)==1){
									alertify.error('Data sudah ada!!');
									this_checkbox.checked=false;
								}else{
									$(strInput).appendTo('#form-matakuliah');
									alertify.success(data.nidn+' : '+data.nama+' ditambahkan');
								}
								return false;
							},
						error: function (xhr,textStatus,errormessage) {
								alertify.alert("Kesalahan! ","Error !!"+xhr.status+" "+textStatus+" "+"Tidak dapat mengirim data!");
							}
						});
	      	}else{
	      		var idfind ="#"+data.nidn+"";
	      		$('#form-matakuliah').find(idfind).remove();
	      		alertify.error(data.nidn+' : '+data.nama+' dibuang');
	      	}
      }else{
      		this.checked=false;
      		alertify.alert('Info!!','Data Belum Lengkap!');
      	}
      	/**/
        
      });


		$('#kodemk').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "/home/kodemk_autocomplete",
                    type: 'POST',
                    data: {
                        term: $('#kodemk').val(),
						_token : $('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        response($.map(data, function (obj) {
							checkkode=parseInt(obj);
							fn_check_kodemk_exist(parseInt(obj));
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
				fn_check_kodemk_exist(parseInt(checkkode));
            }
        });
		
		
		$('#form-matakuliah').bootstrapValidator({
				live: 'enabled',
				message: 'This value is not Valid',
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				excluded:'disabled',
				fields: {
					
					kodemk: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi kode'
							}
							
						}
					},
					matakuliah: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi matakuliah'
							}
						}
					},
					bobot: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi bobot'
							},
							 numeric: {
								message: 'bobot salah',
								
								thousandsSeparator: ',',
								decimalSeparator: '.'
							}	
						}
					},
					
					teori: {
						validators: {
							notEmpty: {
								message: 'Silahkan isi teori'
							},
							numeric: {
								message: 'teori salah',
								
								thousandsSeparator: ',',
								decimalSeparator: '.'
							}	
						}

					},
					praktek:{
						validators:{
							notEmpty: {
								message: 'Silahkan isi praktek'
							},
							numeric: {
								message: 'praktek salah',
								
								thousandsSeparator: ',',
								decimalSeparator: '.'
							}	
						}
					},
					kadep:{
						validators:{
							notEmpty:{
								message: 'Silahkan isi kadep'
							}	
						}
					},
					semester:{
						validators:{
							notEmpty: {
								message: 'Silahkan isi semester'
							}
						}
					},
					bobotnilai:{
						validators:{
							notEmpty: {
								message: 'Silahkan isi bobot nilai'
							},
							numeric: {
								message: 'bobot nilai salah',
								
								thousandsSeparator: ',',
								decimalSeparator: '.'
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
				$('#form-matakuliah input').attr("disabled", "disabled");
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
							$('#form-matakuliah').bootstrapValidator('resetForm',true);
							$('#btn-submit').removeAttr('disabled');
							$('#form-matakuliah input').removeAttr("disabled");
							$('#bobot').val(2);
							$('#teori,#praktek').val(1);
							$('#bobotnilai').val(0);
							$('.chkbox').prop('checked',false);
						}
					});
				});
		});
</script>
@endsection
