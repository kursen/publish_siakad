@extends('layouts.master')

@section('title','Kelas Mahasiswa')
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
      <h2>Data Kelas Mahasiswa</h2>
                    
      <div class="clearfix">
				<a href="{{url('/home/addkelasmahasiswa')}}" class="btn btn-success pull-right">
          <i class="fa fa-plus"></i> Tambah</a>
			</div>
  </div>
  <div class="x_content">
				  
  <!--table-->
    <table id="datatable-kelasmahasiswa" class="table table-striped table-bordered dt-responsive nowrap" data-page-length='25'>
      <thead>
        <tr>
          <th>Tahun Ajaran</th>
          <th>Semester</th>
          <th>Kelas</th>
          <th>Nim</th>
          <th>Nama</th>
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
    
    <script src="{{ URL::asset('vendors/jszip/dist/jszip.min.js')}}"></script>
    

    <script src="{{ URL::asset('vendors/alertify/js/alertify.min.js')}}"></script>
    <script type='text/javascript'>
    var gentable=null;
    $(document).ready(function(){
      gentable = $('#datatable-kelasmahasiswa').DataTable({
          processing: true,
          columnDefs: [
            //{ "visible": false, "targets": {0,1,2}}
          ],
          order:[[1,'asc']],
          ajax: '{{url("/home/datakelasmahasiswa")}}',
          columns: [
              {data: 'tahun_ajaran', name: 'tahun_ajaran'},
              {data: 'semester', name: 'semester'},
              {data: 'relasi_kelas.namakelas', name: 'relasi_kelas.namakelas'},
              {data: 'nim', name: 'nim'},
              {data: 'relasi_mahasiswa.nama', name: 'relasi_mahasiswa.nama'},
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
          ],
          drawCallback: function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;

            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                );
                last = group;
              }
            });

              api.column(1, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="3">'+'Semester '+group+'</td></tr>'
                );
                last = group;
              }
            });

            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="3">'+'Tahun Ajaran '+group+'</td></tr>'
                );
                last = group;
              }
            });
           
             
        },
        columnDefs: [
            { "visible": false, "targets": [0,1,2] }
          ],
      });

      var sbody = $('#datatable-kelasmahasiswa tbody');
      sbody.on('click','.edit',function(){
        var data = gentable.row($(this).parents('tr')).data();
        if(data===undefined){
          data = gentable.row($(this).closest('tr').prev()).data();
        }
        window.location.href='/home/editkelasmahasiswa/'+data.id;
      }).
      on('click','.delete',function(){
        var data = gentable.row($(this).parents('tr')).data();
        if(data===undefined){
          data = gentable.row($(this).closest('tr').prev()).data();
        }
        alertify.confirm("Konfirmasi","Anda Yakin Ingin menghapus data?", function (e) {
          if (e) {
            $.get("/home/deletekelasmahasiswa/"+data.id, function(data, status){
              //alert(data)
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