@extends('layouts.master_mahasiswa')

@section('title','KHS')
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
      <h2>Kartu Hasil Studi</h2>
                    
      <div class="clearfix">
				
			</div>
  </div>
  <div class="x_content">
    <div class="col-lg-6 col-sm-6 col-xs-5">
      <!-- form -->

    </div>

    <!--table-->
    <table id="datatable-khs" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
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
              <div class="col-md-4"><p>Nomor Induk Mahasiswa</p></div>
               <div id="vnim"></div>
              </div>

              <div class="col-md-7">
              <div class="col-md-4"><p>Nama Mahasiswa</p></div>
                <div id="vnama"></div>
              </div>  

              <div class="col-md-7">
              <div class="col-md-4"><p>Tempat / Tanggal Lahir</p></div>
                <div id="vttl"></div>
              </div>  

              <div class="col-md-7">
              <div class="col-md-4"><p>Angkatan Ke - Stambuk</p></div>
                <div id="vangkatan"></div>
              </div> 

              <div class="col-md-7">
              <div class="col-md-4"><p>Tahun Akademik</p></div>
                <label id="vtahunakademik"></label>
              </div>

              <div class="col-md-7">
              <div class="col-md-4"><p>Tingkat</p></div>
                <div id="vtingkat"></div>
              </div> 

              <div class="col-md-7">
              <div class="col-md-4"><p>Semester</p></div>
                <div id="vtsemester"></div>
              </div> 

            </div>

            </div>
          </th>
        </tr>
        <tr>
          <th>No.</th>
          <th>Kode M.K</th>
          <th>Nama Mata Kuliah</th>
          <th>Beban Studi SKS</th>
          <th>Mutu</th>
          <th>Lambang</th>
          <th>Bobot Nilai</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="3">Total SKS Diambil : </th>          
          <th></th>
          <th colspan="2">Jumlah Bobot Nilai</th>
          <th></th>
        </tr>
        <tr>
          <th colspan="6" align="right">Indeks Prestasi (IP) Semester  <label id="vindexsem"></label>: </th>
          <th><b><label id="vip"></label></b></th>
        </tr>
        <tr>
          <th colspan="6" align="right">Rangking Semester <label id="vrangsem"></label>: </th>
          <th>-</th>
        </tr>
      </tfoot>
    </table>

<!--endtable-->
  </div>
  <a href="#" target="_blank" class="btn btn-success pull-left" id="cetakkrs"><i class="fa fa-print"></i> Cetak KHS</a>
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
          window.open("{{url('home/printkhs')}}/"+$('#semester').val(), "Cetak KHS", "location=1,status=1,scrollbars=1,width=1000,height=600");
      });

      $("#semester").change(function() {
        
          $.get('{{"datakhs"}}/'+$('#semester').val(), function(data, status){

            $('#vtahunakademik').text(": "+(tahun.getFullYear()-1)+" / "+tahun.getFullYear());
            $('#vnim').text(": "+data.nim);
            $('#vnama').text(": "+data.nama);
            $('#vttl').text(": "+data.tempatlahir+" / "+data.tanggallahir);
            $('#vangkatan').text(": "+data.angkatan+" - "+data.tahun);
            $('#vtingkat').text(": "+$('#semester').val());
            $('#vtsemester').text(": "+$('#semester').val());
            $('#vindexsem').text($('#semester').val());
            $('#vrangsem').text($('#semester').val());

          },'json');

          url = '{{"datakhs"}}/'+$('#semester').val();
            
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

      gentable = $('#datatable-khs').DataTable({
              processing  : true,
              searching   : false,
              bInfo       : false,
              bPaginate   : false,
              ajax        : '',

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

                totalbobot = 0;

                totalbobot = api
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                $( api.column( 6 ).footer() ).html(
                     totalbobot 
                );

                totalip = 0;
                totalip = totalbobot / total;
                if(!isNaN(totalip)){
                  $('#vip').text(""+totalip);
                }
                
                

              },
              aoColumns: [
                  {data: null,         name: 'no', bSortable : false,},
                  {data: 'kodemk',     name: 'kodemk'},
                  {data: 'matakuliah', name: 'matakuliah'},
                  {data: 'bobot',      name: 'bobot'},
                  {data: 'nilaimutu',  name: 'nilaimutu'},
                  {data: 'lambang',    name: 'lambang'},
                  {data: 'bobotnilai', name: 'bobotnilai'}
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