@extends('layouts.master')

@section('title','Kelas Dosen')
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
      <h2>Kelas Dosen</h2>
                    
      <div class="clearfix">
        <a href="{{url('/home/addkelasdosen')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah</a>
      </div>
  </div>
  <div class="x_content">
          
  <!--table-->
    <table id="datatable-kelasdosen" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th width="5%">idkelasdosen</th>
          <th>NIDN</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Matakuliah</th>
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

    <script type='text/javascript'>
    
     var gentable=null;
    $(document).ready(function(){
      gentable = $('#datatable-kelasdosen').DataTable({
              processing  : true,
              ajax        : '{{"showdatakelasdosen"}}',
              aoColumns: [
                  {data: 'idkelasdosen',  name: 'idkelasdosen'},
                  {data: 'nidn',          name: 'nidn'},
                  {data: 'nama',          name: 'nama'},
                  {data: 'namakelas',    name: 'namakelas'},
                  {data: 'matakuliah',    name: 'matakuliah'},
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
              "drawCallback": function ( settings ) {
                  var api = this.api();
                  var rows = api.rows( {page:'current'} ).nodes();
                  var last=null;
       
                  api.column(3, {page:'current'} ).data().each( function ( group, i ) {
                      if ( last !== group ) {
                          $(rows).eq( i ).before(
                              '<tr class="group"><th colspan="4">'+group+'</th></tr>'
                          );
       
                          last = group;
                      }
                  } );
              },
              aoColumnDefs: [
                { "visible": false, "aTargets": 0 },
                { "visible": false, "aTargets": 3 },
                { "width": "40%",   "targets": 4 }
              ],
          });
        var sbody = $('#datatable-kelasdosen tbody');
        sbody.on('click','.edit',function(){
          var data = gentable.row($(this).parents('tr')).data();
          window.location.href='/home/editkelasdosen/'+data.idkelasdosen;
        }).
        on('click','.delete',function(){
          var data = gentable.row($(this).parents('tr')).data();
          alertify.confirm("Konfirmasi","Anda Yakin Ingin menghapus data?", function (e) {
            if (e) {
              $.get("/home/deletekelasdosen/"+data.idkelasdosen,function(data,status){
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
       
    });
    
   </script>
@endsection
