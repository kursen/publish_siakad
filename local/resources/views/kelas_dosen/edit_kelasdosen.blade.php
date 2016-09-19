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
      <h2>Ubah Kelas Dosen</h2>
                    
      <div class="clearfix">
        <a href="{{url('/home/showkelasdosen')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tampilkan</a>
      </div>
  </div>
  <div class="x_content">
         
  <!--table-->
  {!! Form::open(array('url' => '/home/updatekelasdosen', 'id'=>'form-kelasdosen')) !!}
    <table id="datatable-kelasdosen" class="table table-striped table-bordered">
      <thead>

        <tr>
          <th>idkelasdosen</th>
          <th>NIDN</th>
          <th>Nama</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      @foreach($datakelasdosen as $ckelasdosen)
        <tr>
          <td>{{ $ckelasdosen->idkelasdosen }}</td>
          <td>{{ $ckelasdosen->nidn }}</td>
          <td>{{ $ckelasdosen->nama }}</td>
          <td> {!! Form::select('kelas', $arrkelas, $ckelasdosen->idkelas, array('class' => 'form-control', 'style' => 'width:130px;')) !!}</td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th colspan="4"><button id="btn-submit" type="button" class="btn btn-success pull-left"><i class="fa fa-send"></i> Ubah</button> </th>          
        </tr> 
      </tfoot>
    </table>
    {!! Form::close() !!}
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
              searching   : false,
              bInfo       : false,
              bPaginate   : false,
              aoColumnDefs: [
              { "visible": false, "aTargets": 0  },
              /*{ aTargets  : [ -1 ] }*/

              ],
              
              

          });

        var sbody = $('#datatable-kelasdosen tfoot');
        sbody.on('click','#btn-submit',function(){
            
              var idkelas = $('.form-control').val();
              $.ajax({
                type: 'POST',
                url: "{{ url('/home/editkelasdosen') }}/"+idkelas,
                data: {'idkelasdosen':gentable.cell( 0, 0 ).data(), 'idkelas':idkelas, '_token' : $('input[name="_token"]').val()},
                dataType: 'json',
                success: function (returndata) {

                    if(parseInt(returndata.return)==1){
                      alertify.success('Data berhasil diubah');
                    }else{
                      alertify.alert('Data gagal diubah');
                    }
                    return false;
                },
                error: function (xhr,textStatus,errormessage) {
                    alertify.alert("Kesalahan! ","Error !!"+xhr.status+" "+textStatus+" "+"Tidak dapat mengirim data!");
                },
                complete: function () {
                    window.location.href='/home/showkelasdosen';
                }
            });
        });
          //}

         /* $('#form-kelasdosen').bootstrapValidator({
            live: 'enabled',
            message: 'This value is not Valid',
            feedbackIcons: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
            },
            excluded:'disabled',
            fields: {
              kelas: {
                validators: {
                  notEmpty: {
                    message: 'Silahkan isi kelas'
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
            var data = gentable.row($(this).parents('tr')).data();
            $.ajax({
              type: 'POST',
              url: $form.attr('action'),
              data: {'idkelasdosen':data.idkelasdosen, 'idkelas':$('kelas').val(), '_token' : $('input[name="_token"]').val()},
              dataType: 'json',
              success: function (data) {
                
                  var returndata=parseInt(data.return);
                  if(returndata==1){
                    alertify.success('Data Berhasil Diubah');
                  }else{
                    alertify.alert("Error ","Data Input Tidak Valid");
                  }
                  return false;
                },
                error: function (xhr,textStatus,errormessage) {
                  alertify.alert("Kesalahan! ","Error !!"+xhr.status+" "+textStatus+" "+"Tidak dapat mengirim data!");
                },
                complete: function () {
                  window.location.href='/home/showkelasdosen';
                }
              });*/
    });
       

    

   </script>
@endsection