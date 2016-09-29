@extends('layouts.master')

@section('title','Dosen')
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
<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
                  <div class="x_title">
                    <h2>Data Dosen</h2>
                    
                    <div class="clearfix">
						<a href="{{url('/home/adddosen')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah</a>
					</div>
                  </div>
                  <div class="x_content">
				  <input type="hidden" name="_token" value="{{ csrf_token() }}" id='token'>
					<!--table-->
					<table id="datatable-dosen" class="table table-striped table-bordered dt-responsive nowrap" data-page-length='25'>
                            <thead>
                              <tr>
                                <th>Nidn</th>
                                <th>Nama</th>
								<th>Jabatan Akademik</th>
								<th>Pendidikan</th>
								<th></th>
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
   	<script src="{{ URL::asset('vendors/alertify/js/alertify.min.js')}}">
</script>
   <script type='text/javascript'>
		var gentable=null;
		$(document).ready(function(){
			gentable=$('#datatable-dosen').DataTable({
				  processing: true,
				ajax: '{{url("/home/showdatadosen")}}',
					columns: [
						{ data: 'nidn', 			name: 'nidn','className':'text-center'},
						{ data: 'nama', 			name: 'nama'},
						{ data: 'jabatanakademik', 	name: 'jabatanakademik'},
						{ data: 'pendidikan', 		name: 'pendidikan','className':'text-center'},
						{
							"className": "action text-center",
							"data": null,
							"bSortable": false,
							"defaultContent": "" +
							"<div class='btn-group' role='group'>" +
							"<button class='list btn btn-success btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Detail'><i class='fa fa-list'></i></button>"+
							"  <button class='edit  btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fa fa-edit'></i></button>" +
							"  <button class='delete btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Hapus'><i class='fa fa-trash-o'></i></button>" +
							"<button type=\"button\" class=\"btn btn-success btn-xs detail\" rel='tooltip' data-toggle='tooltip' data-placement='right' title='Detail'><i class='fa fa-list'></i>" +
							"<span class=\"sr-only\">Action</span></button>" +
							"</div>"
						}
					
				]
			});
			
		var sbody = $('#datatable-dosen tbody');
		sbody.on('click','.edit',function(){
			var data = gentable.row($(this).parents('tr')).data();
			if(data===undefined){
          data = gentable.row($(this).closest('tr').prev()).data();
        }
			window.location.href='/home/editdosen/'+data.iddosen;
		}).
		on('click','.list',function(){
			var data = gentable.row($(this).parents('tr')).data();
			if(data===undefined){
          data = gentable.row($(this).closest('tr').prev()).data();
        }
			window.location.href='/home/detaildosen/'+data.iddosen;
		}).
		on('click','.delete',function(){
			var data = gentable.row($(this).parents('tr')).data();
			if(data===undefined){
          data = gentable.row($(this).closest('tr').prev()).data();
        }
			alertify.confirm("Konfirmasi","Anda Yakin Ingin menghapus data?", function (e) {
				if (e) {
					$.get("/home/deletedosen/"+data.iddosen,function(data,status){
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
			//tooltip
			/*$('body').tooltip({
				selector: '[rel=tooltip]'
			});*/
   </script>
@endsection
