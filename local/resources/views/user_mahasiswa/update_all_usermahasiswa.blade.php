@extends('layouts.master')

@section('title','User Mahasiswa')
@section('css')
  <!-- Datatables -->
    <link href="{{ URL::asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
     <link href="{{ URL::asset('vendors/alertify/css/alertify.min.css')}}" rel="stylesheet">
 
	<link href="{{ URL::asset('vendors/alertify/css/default.min.css')}}" rel="stylesheet">
@endsection
@section('sidebar')
@parent
@endsection
@section('content')
			<div class="x_panel">
                  <div class="x_title">
                    <h2>Data User Mahasiswa</h2>
                    
                    <div class="clearfix">
						<a href="{{url('/home/register_mahasiswa')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah</a>
					</div>
                  </div>
                  <div class="x_content">
				  <input type="hidden" name="_token" value="{{ csrf_token() }}" id='token'>
					<!--table-->
					<table id="datatable-mk" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                              <th>{!! Form::checkbox('checkall',null,null, array('id'=>'checkall')) !!}</th>
                                <th>NIM</th>
                                <th>Nama</th>
                              </tr>
                            </thead>
					</table>
					<!--endtable-->
                  </div>
               </div>
               <!--modal-->
               <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
				  <div class="modal-dialog modal-sm" role="document">
				    <div class="modal-content">
				    	 <div class="modal-body">
				      			Mohon Tunggu 
				      			<img src="{{ URL::asset('images/loading.gif') }}" style="width: 100px;" alt="loading-img" />
				      	 </div>
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
	<script src="{{ URL::asset('vendors/alertify/js/alertify.min.js')}}">
</script>

   <script type='text/javascript'>
   var password_user =12345;
		var gentable=null;
		$(document).ready(function(){
			gentable=$('#datatable-mk').DataTable({
				  processing: true,
				 //serverSide: true,
					ajax: "{!! route('datatables_usermahasiswa.data') !!}",
					columns: [
					{
		              "data": null,
		              orderable:false,
		              'mRender': function ( data, type, row ) {
	                        if ( type === 'display' ) {
	                          return '<input type="checkbox" name="id" class="chkbox" value="'+data.id+'"">';
	                        }
	                        return data;
	                    },
	                  "className": "text-center"
		              
		            },
		            { data: 'nim', name: 'nim',"className": "text-center","bSortable": false,"orderable":false },
		              { data: 'nama', name: 'nama'  }
				]
			});

		var sbody = $('#datatable-mk tbody');
      	sbody.on('click','.chkbox',function(){
      		var data = gentable.row($(this).parents('tr')).data();
      		if($(this).is(':checked')){
      				var this_checkbox = this;
      				var iduser=data.id;
	      			$.ajax({
						type: 'POST',
						url: "{{ url('/home/update_all_user_mahasiswa') }}",
						data: {'id':iduser,
								'password':password_user,
								'_token' : $('input[name="_token"]').val()
							},
						dataType: 'json',
						error: function (xhr,textStatus,errormessage) {
								alertify.alert("Kesalahan! ","Error !!"+xhr.status+" "+textStatus+" "+"Tidak dapat mengirim data!");
							}
						});
	      	}
      	});

      	var shead = $('#datatable-mk thead');
        shead.on('click', '#checkall', function(){
          var cells = gentable.cells().nodes();

           var allcheckbox=$( cells ).find(':checkbox').prop('checked', $(this).is(':checked'));
           $(allcheckbox).each(function(i,val){
           		//console.log(val.value);
           			$.ajax({
							type: 'POST',
							url: "{{ url('/home/update_all_user_mahasiswa') }}",
							data: {'id':val.value,
									'password':password_user,
									'_token' : $('input[name="_token"]').val()
								},
							dataType: 'json',
							beforeSend:function(){
								$('.bs-example-modal-sm').modal({
									backdrop: 'static',
	   								keyboard: false
	   							});
							},
							error: function (xhr,textStatus,errormessage) {
									alertify.alert("Kesalahan! ","Error !!"+xhr.status+" "+textStatus+" "+"Tidak dapat mengirim data!");
							}

						});
           });
           
           $(document).ajaxStop(function() {
           		$('.bs-example-modal-sm').modal("hide");
           		document.getElementById('checkall').checked=false;
           		$('.chkbox').prop('checked', false);
			});
            
        });
	});
		
   </script>
@endsection