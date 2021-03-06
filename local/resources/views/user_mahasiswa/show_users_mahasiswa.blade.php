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
					<table id="datatable-mk" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                              <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                
								<th>Tanggal Pembuatan</th>
								<th>Tanggal Pembaharuan</th>
								
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
   
    <script src="{{ URL::asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
   


    <script src="{{ URL::asset('vendors/alertify/js/alertify.min.js')}}"></script>
</script>
   <script type='text/javascript'>
		var gentable=null;
		$(document).ready(function(){
			gentable=$('#datatable-mk').DataTable({
				  processing: true,
				 //serverSide: true,
					ajax: "{!! route('datatables_usermahasiswa.data') !!}",
					columns: [
						{ data: 'nim', name: 'nim',"className": "text-center" },
						{ data: 'nama', name: 'nama' },
						{ data: 'created_at', name: 'created_at' ,"className": "text-center" },
						{ data: 'updated_at', name: 'updated_at' ,"className": "text-center" },
						{
							"className": "action text-center",
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
			
		var sbody = $('#datatable-mk tbody');
		sbody.on('click','.edit',function(){
			var data = gentable.row($(this).parents('tr')).data();
			if(data===undefined){
          data = gentable.row($(this).closest('tr').prev()).data();
        }
			window.location.href='/home/edit_usermahasiswa/'+data.id;
		}).
		on('click','.delete',function(){
			var data = gentable.row($(this).parents('tr')).data();
			if(data===undefined){
          data = gentable.row($(this).closest('tr').prev()).data();
        }
			alertify.confirm("Konfirmasi","Anda Yakin Ingin menghapus data?", function (e) {
				if (e) {
					$.post("/home/delete_usermahasiswa",{'id':data.id,_token:$('#token').val()},function(data,status){
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