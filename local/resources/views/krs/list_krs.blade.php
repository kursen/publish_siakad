@extends('layouts.master_mahasiswa')

@section('title','KRS')
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
      <h2>Kartu Rencana Studi</h2>
                    
      <div class="clearfix">
				<a href="{{url('home/addkrs')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Pengisian KRS</a>
			</div>
  </div>
  <div class="x_content">
    <div class="col-lg-6 col-sm-6 col-xs-5">
      <!-- form -->

    </div>

    <!--table-->
    <table id="datatable-krs" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
      <thead>
      <tr>
          <th colspan="7">
           <div class="form-horizontal">
            {!! Form::open(array('url' => '/addmahasiswa', 'id'=>'form-daftarkrs')) !!}
              <div class="form-group">
                {!! Form::label('semester','Semester',array('class' => 'col-sm-4 control-label')) !!}
                    <div class="col-sm-4">
                      {!! Form::select('semester',$arrsemester,'Pilih',array('class' => 'form-control', 'style' => 'width:130px;')) !!}
                    </div>
              </div>
            {!! Form::close() !!}
            </div>

            <div class="x_content">

            <div style="display:none;" id="datamhs">
            <hr>

              <div class="col-md-7">
              <div class="col-md-4"><p>Tahun Akademik</p></div>
                <label id="vtahunakademik"></label>
              </div>

              <div class="col-md-7">
              <div class="col-md-4"><p>Nim</p></div>
               <div id="vnim"></div>
              </div>

              <div class="col-md-7">
              <div class="col-md-4"><p>Nama Mahasiswa</p></div>
                <div id="vnama"></div>
              </div>     

              <div class="col-md-7">
              <div class="col-md-4"><p>Angkatan / Tahun</p></div>
                <div id="vangkatan"></div>
              </div> 

              <div class="col-md-7">
              <div class="col-md-4"><p>Tingkat / Semester</p></div>
                <div id="vts"></div>
              </div>  

            </div>

            </div>
          </th>
        </tr>
        <tr>
          <th>No.</th>
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
          <th></th>
          <th colspan="3"></th>
        </tr>
      </tfoot>
    </table>

<!--endtable-->
  </div>
  <a href="#" target="_blank" class="btn btn-success pull-left" id="cetakkrs"><i class="fa fa-print"></i> Cetak KRS</a>
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
   

    <script src="{{ URL::asset('vendors/alertify/js/alertify.min.js')}}"></script>

    <script type='text/javascript'>
    

		$(document).ready(function(){

      var gentable=null;
      var url = '';
      var tahun = new Date();

      $('#cetakkrs').addClass('disabled');

      $('#cetakkrs').click(function(){
          window.open("{{url('home/printkrs')}}/"+$('#semester').val(), "Cetak KRS", "location=1,status=1,scrollbars=1,width=1000,height=600");
      });

      $("#semester").change(function() {
        
          $.get('{{"listkrs"}}/'+$('#semester').val(), function(data, status){

            $('#vtahunakademik').text(": "+(tahun.getFullYear()-1)+" / "+tahun.getFullYear());
            $('#vnim').text(": "+data.nim);
            $('#vnama').text(": "+data.nama);
            $('#vangkatan').text(": "+data.angkatan+" / "+data.tahun);
            $('#vts').text(": "+$('#semester').val()+" / "+$('#semester').val());

          },'json');

          url = '{{"listkrs"}}/'+$('#semester').val();
            
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
              ajax        : '{{"listkrs"}}/0',

              fnDrawCallback: function ( oSettings ) {

                if ( oSettings.bSorted || oSettings.bFiltered )
                {
                    for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                    {
                        $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                    }
                }
              },
              footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;

                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                total = api
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                $( api.column( 3 ).footer() ).html(
                     total 
                );
              },
              aoColumns: [
                  {data: null,         name: 'no', bSortable : false,},
                  {data: 'kodemk',     name: 'kodemk'},
                  {data: 'matakuliah', name: 'matakuliah'},
                  {data: 'bobot',      name: 'bobot'},
                  {data: 'sem',        name: 'sem'},
                  {data: 'tahun',      name: 'tahun'},
                  {data: 'keterangan', name: 'keterangan'}
              ],
              aoColumnDefs: [
                { 
                  aTargets  : [ -1 ]
                }],
              
              aaSorting: [[ 1, 'asc' ]]

          });
			
		});

    


   </script>
@endsection