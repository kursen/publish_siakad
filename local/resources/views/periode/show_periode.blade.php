@extends('layouts.master')

@section('title','Periode')
@section('css')
    <!-- Datatables -->
    <link href="{{ URL::asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
     

     <link href="{{ URL::asset('vendors/alertify/css/alertify.min.css')}}" rel="stylesheet">
 
	<link href="{{ URL::asset('vendors/alertify/css/default.min.css')}}" rel="stylesheet">
@endsection
@section('sidebar')
@parent
@endsection
@section('content')
			<div class="x_panel">
                  <div class="x_title">
                    <h2>Data Periode</h2>
                    
                    <div class="clearfix">
						<a href="{{url('/home/addperiode')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah</a>
					</div>
                  </div>
                  <div class="x_content">
				  <input type="hidden" name="_token" value="{{ csrf_token() }}" id='token'>
					<!--table-->
					<table id="datatable-periode" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                              <tr>
                                <th>Sistem</th>
                                <th>Tanggal awal</th>
								<th>Tanggal akhir</th>
															<th></th>
                              </tr>
                            </thead>
					</table>
					<!--endtable-->
                  </div>
               </div>
@endsection
@section('scripts')
<!-- Datatables -->
    <script src="{{ URL::asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    
    <script src="{{ URL::asset('vendors/jszip/dist/jszip.min.js')}}"></script>


	<script src="{{ URL::asset('vendors/alertify/js/alertify.min.js')}}">
</script>
   <script type='text/javascript'>
			var gentable=null;
		$(document).ready(function(){
			gentable=$('#datatable-periode').DataTable({
				  processing: true,
				 
				 //serverSide: true,
					ajax: "{!! route('datatablesperiode.data') !!}",
					columns: [
						{ data: 'sistem', name: 'sistem' },
						{ data: 'tglawal', name: 'tglawal'},
						{ data: 'tglakhir', name: 'tglakhir'},
							{"className": "action text-center",
							"data": null,
							"bSortable": false,
							"defaultContent": "" +
							"<div class='btn-group' role='group'>" +
							"  <button class='edit  btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Edit'><i class='fa fa-edit'></i></button>" +
							"  <button class='delete btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Hapus'><i class='fa fa-trash-o'></i></button>" +
							"<button type=\"button\" class=\"btn btn-success btn-xs detail\" rel='tooltip' data-toggle='tooltip' data-placement='right' title='Detail'><i class='fa fa-list'></i>" +
							"<span class=\"sr-only\">Action</span></button>" +
							"</div>"
						}
					
				]
			});
			
		var sbody = $('#datatable-periode tbody');
		sbody.on('click','.edit',function(){
			var data = gentable.row($(this).parents('tr')).data();
			if(data===undefined){
          data = gentable.row($(this).closest('tr').prev()).data();
        }
			window.location.href='/home/edit_periode/'+data.idperiode;
		}).
		on('click','.delete',function(){
			var data = gentable.row($(this).parents('tr')).data();
			if(data===undefined){
          data = gentable.row($(this).closest('tr').prev()).data();
        }
			alertify.confirm("Konfirmasi","Anda Yakin Ingin menghapus data?", function (e) {
				if (e) {
					$.post("/home/deleteperiode",{'idperiode':data.idperiode,_token:$('#token').val()},function(data,status){
							if(parseInt(data.return)==1){
								alertify.success('Data berhasil dihapus');
								gentable.ajax.reload();
							}else{
								alertify.error('Gagal menghapus');
							}
							
						},'json');
				}
			},function(){});		
		});
			//tooltip
			$('body').tooltip({
				selector: '[rel=tooltip]'
			});
		});
   </script>
@endsection