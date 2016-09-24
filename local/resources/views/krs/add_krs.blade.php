@extends('layouts.master_mahasiswa')

@section('title','KRS')
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
      <h2>Kartu Rencana Studi</h2>
                    
      <div class="clearfix">
				<a href="{{url('/home/listkrs')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Lihat KRS</a>
			</div>
  </div>
  <div class="x_content">
    <div class="col-lg-6 col-sm-6 col-xs-5">
      <!-- form -->

    </div>

    <!--table-->
    {!! Form::open(array('url' => '/home/storekrs', 'id'=>'form-daftarkrs')) !!}
    <table id="datatable-krs" class="table table-striped table-bordered" width="100%">
      <thead>
      <tr>
          <th colspan="7">
           <div class="form-horizontal">
            
              <div class="form-group">
                {!! Form::label('semester','Semester',array('class' => 'col-sm-4 control-label')) !!}
                    <div class="col-sm-4">
                      {!! Form::select('semester',$arrsemester,'Pilih',array('class' => 'form-control', 'style' => 'width:130px;')) !!}
                    </div>
              </div>
    
            </div>
          </th>
        </tr>
        <tr>
          <th>{!! Form::checkbox('checkall',null,null, array('id'=>'checkall')) !!}</th>
          <th>Kode M.K</th>
          <th>Nama Mata Kuliah</th>
          <th>SKS</th>
          <th>Semester</th>
          <th>Tahun</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="3">Total SKS Diambil : </th>          
          <th id="totalsks"></th>
          <th colspan="3"></th>
        </tr>
        <tr>
          <th colspan="7"><button id="btn-submit" type="button" class="btn btn-success"><i class="fa fa-send"></i> Tambah</button> </th>          
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
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

    <script type='text/javascript'>
     var gentable=null;

		$(document).ready(function(){
     
      var url = '';
      var tahun = new Date();

      $('#cetakkrs').addClass('disabled');

      $("#semester").change(function() {

          url = '{{"datamk"}}/'+$('#semester').val();
            
          if($('#semester').val()!=0){
            $('#datamhs').show();
            $('#cetakkrs').removeClass('disabled');
          }
          else{
            $('#datamhs').hide();
            $('#cetakkrs').addClass('disabled');
          }

          gentable.ajax.url(url).load(); 

      });

      gentable = $('#datatable-krs').DataTable({
              processing  : true,
              searching   : false,
              bInfo       : false,
              bPaginate   : false,
              ajax        : '{{"datamk"}}/0',
              aoColumns: [
                  {
                    data:   null,
                    orderable : false,
                    render: function ( data, type, row ) {
                        if ( type === 'display' ) {
                          return '<input type="checkbox" name="kodemk" id="kodemk" class="editor-active" value="'+data.kodemk+'"">';
                        }
                        return data;
                    },
                    className: "dt-body-center",

                  },
                  {data: 'kodemk',     name: 'kodemk'},
                  {data: 'matakuliah', name: 'matakuliah'},
                  {data: 'bobot',      name: 'bobot'},
                  {data: 'sem',        name: 'sem'},
                  {data: null,         defaultContent: tahun.getFullYear()},
                  {data: null,         name: 'keterangan',
                    orderable : false,
                    render: function ( data, type, row ) {
                        if ( type === 'display' ) {
                            return '<input type="text" name="keterangan" id="keterangan'+data.kodemk+'" class="form-control">';
                        }
                        return data;
                    },
                    className: "dt-body-center",
                  }
              ],
              aoColumnDefs: [
                 
                  { "bSearchable": false, "aTargets": [ 6 ] }

                ],
              
              aaSorting: [[ 1, 'asc' ]]

          });

      var sbody = $('#datatable-krs tbody');
      
      sbody.on('click','.editor-active',function(){
        
        $('#checkall').prop('checked', false);
        
        var rowData = new Array(null);
        $('.editor-active:checked').each(function(index, elem) {    
          rowData [index] = gentable.row($(this).parents('tr')).data().bobot;
          
        });

        $('#totalsks').text(rowData.reduce(getSum));
        
      });

      var shead = $('#datatable-krs thead');
       shead.on('click', '#checkall', function(){
        var cells = gentable.cells( ).nodes();
         $( cells ).find(':checkbox').prop('checked', $(this).is(':checked'));
        var rowData = new Array(null);
        $('.editor-active:checked').each(function(index, elem) {    
          rowData [index] = gentable.row($(this).parents('tr')).data().bobot;
          
        });

        $('#totalsks').text(rowData.reduce(getSum));
        
      });

      function getSum(total, num) {
        return parseInt(total) + parseInt(num);
      }

      $('#btn-submit').click(function(){
          /*var row = gentable.$('.editor-active:checked', {'page': 'all'});
          row.each(function(index, elem){
              alert($(elem).val());
          });*/

          /*var data = gentable.$('input[type=checkbox]:checked, input[type=text]').serialize();
          alert(
            "The following data would have been submitted to the server: \n\n"+
            data
          );
          return false;*/

                var isikodemk;
                var kdmk;
                kdmk = $('.editor-active:checked').map(function(index, elem) {    
                  isikodemk = $(elem).val();
                  return isikodemk;
                }).get();



                var isiket;
                var ket;

                ket = $('.editor-active:checked').map(function(index, elem) {    
                  isiket = $('#keterangan'+$(elem).val()).val();
                  return isiket;
                }).get();

            var data = "kdmk="+kdmk+"&ket="+ket;
            //var data = $('#form-daftarkrs').serialize();
            $('#form-daftarkrs input').attr("disabled", "disabled");
              $.ajax({
                type: 'GET',
                url: '{{"./storekrs"}}',
                data: data,
                dataType: 'json',
                success: function (data) {
                  
                    var returndata=data.return;
                    if(returndata==1){
                      alertify.success('Data Berhasil Disimpan');
                    }else{
                      alertify.alert("Error ","Data Input Tidak Valid ");
                    }
                    return false;
                  },
                  error: function (xhr,textStatus,errormessage) {
                    alertify.alert("Kesalahan! ","Error !!"+xhr.status+" "+textStatus+" "+"Tidak dapat mengirim data!");
                  },
                  complete: function () {
                    gentable.ajax.url('{{"datamk"}}/'+$('#semester').val()).load(); 
                     $('#totalsks').text('');
                     $('#checkall').prop('disabled',false);
                     document.getElementById('checkall').checked=false;
                     document.getElementById('semester').value=0;
                  }
                });

            });
			
		});

   </script>
@endsection