<!DOCTYPE html>
<html>
<head>
	<title>Cetak KHS</title>
	<style type="text/css">
		.tg  {	border-collapse:collapse;
				border-spacing:0;
				border-color:#ccc;
				width: 100%; 
			 }
        .tg td{	font-family:Arial;
        		font-size:12px;
        		padding:4px 5px;
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
    <td colspan="7" align="center" style="background-color:#09C;"><b>KARTU HASIL STUDY</b></td>
  </tr>
  <tr>
    <td colspan="7">
    <table width="100%" border="0">
    <?php $namamhs; ?>
    <?php $tanggal; ?>
    @foreach($datamhs as $key => $cdatamhs)
      
      <tr>
        <td>Nomor Induk Mahasiswa</td>
        <td>: {{ $cdatamhs->nim }}</td>
      </tr>
      <tr>
        <td>Nama Mahasiswa</td>
        <td>: {{ $cdatamhs->nama }}</td>
      </tr>
       <tr>
        <td>Tempat / Tanggal Lahir</td>
        <td>: {{ $cdatamhs->tempatlahir }} / {{ $cdatamhs->tanggallahir }}</td>
      </tr>
       <tr>
        <td>Angkatan Ke - Stambuk</td>
        <td>: {{ $cdatamhs->angkatan }} / {{ $cdatamhs->tahun }}</td>
      </tr>
      <tr>
        <td width="30%">Tahun Akademik</td>
        <td width="70%">: {{ date('Y')-1 }} / {{ date('Y') }}</td>
      </tr>
      <tr>
        <td>Tingkat</td>
        <td>: {{ $vts}}</td>
      </tr>
      <tr>
        <td>Semester </td>
        <td>: {{ $vts}}</td>
      </tr> 
      <?php $namamhs = $cdatamhs->nama; ?>
      <?php $tanggal = $cdatamhs->tanggal; ?>
      @endforeach
    </table>
    <br>
    </td>
  </tr>
  <tr>
    <th width="5%">No.</th>
    <th width="10%">Kode M.K</th>
    <th width="20%">Nama Mata Kuliah</th>
    <th width="9%">Beban Studi SKS</th>
    <th width="9%">Mutu</th>
    <th width="10%">Lambang</th>
    <th width="10%">Bobot Nilai</th>
  </tr>
  <!-- mata kuliah -->
  <?php $totalsks = 0; ?>
  <?php $totalbobotnilai = 0; ?>
  @foreach($datakhs as $key => $cdatakhs)
  <tr>
    <td align="center">{{ $key+1 }}</td>
    <td>{{ $cdatakhs->kodemk }}</td>
    <td>{{ $cdatakhs->matakuliah }}</td>
    <td align="center">{{ $cdatakhs->bobot }}</td>
    <td align="center">{{ $cdatakhs->nilaimutu }}</td>
    <td align="center">{{ $cdatakhs->lambang }}</td>
    <td align="center">{{ $cdatakhs->bobotnilai }}</td>
    <?php $totalsks += $cdatakhs->bobot; ?>
    <?php $totalbobotnilai += $cdatakhs->bobotnilai; ?>
  </tr>
  @endforeach
  <!-- end -->
  <tr>
    <td colspan="3"><b>Total SKS Diambil</b></td>
    <td align="center"><b><?php echo $totalsks; ?></b></td>
    <td colspan="2"><b>Jumlah Bobot Nilai</b></td>
    <td align="center"><?php echo $totalbobotnilai; ?></td>
  </tr>
  <tr>
    <td colspan="6" align="right"><b>Indeks Prestasi (IP) Semester {{ $vts }} :</b></td>
    <td align="center"><b><?php echo ($totalbobotnilai / $totalsks); ?></b></td>
  </tr>
  <tr>
    <td colspan="6" align="right"><b>Rangking Semester {{ $vts }} :</b></td>
    <td align="center"><b>-</b></td>
  </tr>

  <tr>
    <td colspan="7">
    <br>
    <table width="100%" border="0">
      <tr>
        <td width="34%" valign="top">
        - Kelakuan  : <br>
        - Kerapian  : <br>
        - Kerajinan : <br>
        </td>
        <td width="32%" valign="top">
         Catatan Pembimbing Akademik :
         <br>
         <br>
         <br>
        </td>
      </tr>
    </table>
    <br>

    <table width="100%" border="0">
      <tr>
        <td width="20%" valign="top">
        	Diketahui oleh : <br />
            Pembimbing Akademik<br /><br /><br /><br />
            
            
            
            Esraida Simanjuntak, SKM</td>
        <td width="34%" valign="top" align="center">
        	Disetujui Oleh :<br>
          Direktur Akademi Perekam Informasi Kesehatan Imelda<br /><br /><br /><br />
            
            
            dr. Suheri Parulian Gultom, M.Kes
        </td>
        <td width="20%" valign="top">
        	Medan, <?php echo $tanggal; ?><br />
          Tanda Tangan Mahasiswa<br /><br /><br /><br />
            
            
          <?php echo $namamhs; ?> 
        </td>
      </tr>
    </table>
    </td>
  </tr>
</table>

</body>
</html>