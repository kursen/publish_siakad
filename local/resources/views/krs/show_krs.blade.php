<!DOCTYPE html>
<html>
<head>
	<title>Cetak KRS</title>
	<style type="text/css">
		.tg  {	border-collapse:collapse;
				border-spacing:0;
				border-color:#ccc;
				width: 100%; 
			 }
        .tg td{	font-family:Arial;
        		font-size:12px;
        		padding:10px 5px;
        		border-style:solid;
        		border-width:1px;
        		overflow:hidden;
        		word-break:normal;
        		border-color:#ccc;
        		color:#333;
        		background-color:#fff;
        	  }
        .tg th{	font-family:Arial;
        		font-size:14px;
        		font-weight:normal;
        		padding:10px 5px;
        		border-style:solid;
        		border-width:1px;
        		overflow:hidden;
        		word-break:normal;
        		border-color:#ccc;
        		color:#333;
        		background-color:#09C;
        		font-weight: bold;
        	  }
        .tg .tg-3wr7{ font-weight:bold;
        			  font-size:12px;
        			  font-family:"Arial", 
        			  Helvetica, sans-serif !important;
        			  text-align:center;
        			}
        .tg .tg-ti5e{ font-size:10px;
        			  font-family:"Arial",
        			  Helvetica, sans-serif !important;
        			  text-align:center;
        			}
        .tg .tg-rv4w{ font-size:10px;
        			  font-family:"Arial", Helvetica, sans-serif !important;
        			}
	</style>

</head>
<body>
<table width="100%" border="0" align="center" class="tg">
  <tr>
    <td height="27" colspan="7" valign="top"><table width="100%" border="0">
      <tr>
        <td width="15%" valign="top" align="center"><img src="images/logoapikes.png" width="70" height="80"></td>
        <td width="85%" valign="top" align="center">
        <p>
          <b style="color:#00C;">AKADEMI   PEREKAM MEDIK DAN INFOKES (APIKES) IMELDA</b><br />
          Jl. Bilal No. 52 Kelurahan Pulo Brayan Darat I Kecamatan Medan Timur, Kode Pos 20239<br>
          Tel. (061) 6630210-6610072-6631380<br>
          Fax. (061) 6618457
        </p></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="7" align="center" style="background-color:#09C;"><b>KARTU RENCANA STUDY</b></td>
  </tr>
  <tr>
    <td colspan="7">
    <table width="100%" border="0">
    <?php $tanggal; ?>
    <?php $namamhs; ?>
    <?php $dosenwali; ?>
    @foreach($datamhs as $key => $cdatamhs)
      <tr>
        <td width="30%">Tahun Akademik</td>
        <td width="70%">: {{ date('Y')-1 }} / {{ date('Y') }}</td>
      </tr>
      <tr>
        <td>Nim</td>
        <td>: {{ $cdatamhs->nim }}</td>
      </tr>
      <tr>
        <td>Nama Mahasiswa</td>
        <td>: {{ $cdatamhs->nama }}</td>
      </tr>
      <tr>
        <td>Angkatan / Tahun</td>
        <td>: {{ $cdatamhs->angkatan }} / {{ $cdatamhs->tahun }}</td>
      </tr>
      <tr>
        <td>Tingkat / Semester </td>
        <td>: {{ $vts}} / {{ $vts}}</td>
      </tr>
      <?php $namamhs   = $cdatamhs->nama; ?>
      <?php $tanggal   = $cdatamhs->tanggal; ?>
      <?php $dosenwali = $cdatamhs->dosenwali; ?>
      @endforeach
    </table>
    <br>
    </td>
  </tr>
  <tr>
    <th width="6%">No.</th>
    <th width="16%">Kode M.K</th>
    <th width="30%">Nama Mata Kuliah</th>
    <th width="9%">SKS</th>
    <th width="9%">Semester</th>
    <th width="7%">Tahun</th>
    <th width="23%">Keterangan</th>
  </tr>
  <!-- mata kuliah -->

  <?php $totalsks = 0; ?>
  @foreach($datakrs as $key => $cdatakrs)
  <tr>
    <td align="center">{{ $key+1 }}</td>
    <td>{{ $cdatakrs->kodemk }}</td>
    <td>{{ $cdatakrs->matakuliah }}</td>
    <td>{{ $cdatakrs->bobot }}</td>
    <td>{{ $cdatakrs->sem }}</td>
    <td>{{ $cdatakrs->tahun }}</td>
    <td>{{ $cdatakrs->keterangan }}</td>
    <?php $totalsks += $cdatakrs->bobot; ?>
  </tr>
  @endforeach
  <!-- end -->
  <tr>
    <td colspan="3"><b>Total SKS Diambil</b></td>
    <td><b><?php echo $totalsks; ?></b></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">
    <br>
    <table width="100%" border="0">
      <tr>
        <td width="34%" valign="top">
        	Disetujui Oleh :<br />
            WADIR I Bidang Akademik<br /><br /><br /><br />
            
            
            
            Esraida Simanjuntak, SKM</td>
        <td width="34%" valign="top">
        	Diketahui Oleh :<br />
            Dosen Wali<br /><br /><br /><br />
            
            
            <?php echo $dosenwali; ?>
        </td>
        <td width="32%" valign="top">
        	Medan, <?php echo $tanggal; ?><br />
            Tanda Tangan Mahasiswa<br /><br /><br /><br />
            
            
            <?php echo $namamhs; ?> 
        </td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="7"><p>(Nb : KRS ini harap disimpan, akan dikumpulkan sewaktu  ujian semester)</p></td>
  </tr>
</table>

</body>
</html>