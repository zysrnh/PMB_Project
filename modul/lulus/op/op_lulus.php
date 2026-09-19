<h4>Kelulusan</h4>

  <script language="JavaScript">
function bukajendela(url) {
 window.open(url, "window_baru", "width=800,height=700,left=120,top=10,resizable=0,scrollbars=1");
}

</script>
  <link rel="stylesheet" href="css/bootstrap-datepicker.css" type="text/css" />
 <script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<?php

if (!defined('cms-ADMINISTRATOR')) {
	Header("Location: ../index.php");
	exit;
}

if (!cek_login()){
    warning("Access Denied!.... You Must Login First","index.php", 3, 2);
    exit;
}

//$index_hal = 1;


include 'modul/functions.php';



switch (@$_GET['action']){


	
	
	
	
	
		
	
	
default:


$prodi = cleartext($_GET['prodi']);
$gel = cleartext($_GET['gel']);


$propinsi52= $koneksi_db->sql_query("SELECT * FROM mod_data_prodi ORDER By id ASC");
while($pr1xy2=$koneksi_db->sql_fetchrow($propinsi52)){
	$idkat23 = $pr1xy2['kode'];
$namakat23 = $pr1xy2['nama'];
$pilihkat2 .= '<option value="admin.php?pilih=lulus&modul=yes&prodi='.$idkat23.'">'.$namakat23.'</option>';
}

$q3 = $koneksi_db->sql_query ("SELECT * FROM `mod_data_prodi`  WHERE kode='".$prodi."'");
while ($data3 = $koneksi_db->sql_fetchrow($q3)){
	$nama2333 = $data3['nama'];
		$tampung = $data3['tampung'];
}




echo '

';
if (!$prodi)
{echo '
<select name="prodi" onChange="MM_jumpMenu(\'parent\',this,0)">
<option value="">-- Pilih Prodi --</option>'.$pilihkat2.'
</select>
<select name="gel">
<option value="">-- Pilih Gelombang --</option>
</select>

';
	 
} else {
	echo '
	<select name="prodi" onChange="MM_jumpMenu(\'parent\',this,0)">
<option value="">'.$nama2333 .'</option>'.$pilihkat2.'
</select>

<select name="gel" onChange="MM_jumpMenu(\'parent\',this,0)">';


if (!$gel)
{
	echo '
<option value="">-- Pilih Gelombang --</option>';
} else {
		echo '
<option value="">'.$gel.'</option>';
	
}

	echo '
<option value="admin.php?pilih=lulus&modul=yes&prodi='.$prodi.'&gel=1">1</option>
<option value="admin.php?pilih=lulus&modul=yes&prodi='.$prodi.'&gel=2">2</option>
<option value="admin.php?pilih=lulus&modul=yes&prodi='.$prodi.'&gel=3">3</option>
</select>

';
	
}


echo '













<br/><br/>
';


if(!$gel )
{
	
} else {


$content .= '
<form method="POST" action="" id="namaform">
<div class="table-responsive">
<table class="table table-hover">';

$content .= '<tr>
<th>No.</td>
<th>Nomor</td>

<th>Nama Lengkap</th>
<th>Nilai Akhir</th>
<th>Status</th>
<th>Berkas</th>
</tr>';



$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_pmb` WHERE status='1' AND prodi='$prodi' AND lulus='Lulus' AND gel='$gel' ORDER By `nilai` DESC LIMIT $tampung");
while ($data = $koneksi_db->sql_fetchrow($query)){
$no ++;
$id = md5($data['id']);


$id2 = $data['id'];
$nomor = $data['nomor'];

$content .= '<tr>


<td>'.$no.'.</td>
<td>'.$data['nomor'].'</td>
<td>'.$data['nama'].'</td>
';

$resultkx = $koneksi_db->sql_query('SELECT SUM(na) AS value_sum FROM mod_data_lulus WHERE nomor="'.$nomor.'" AND  prodi="'.$prodi.'"'); 
$rowkx = $koneksi_db->sql_fetchrow($resultkx); 
$sumkx = $rowkx['value_sum'];   

$content .= '

<td>'.$data['nilai'].'</td>
<td>'.$data['lulus'].'</td>

<td>
';
if($data['statusberkas']==1){

$content .= '

<a href="files/berkas/'.$data['foto2'].'" target="_blank" class="btn btn-primary btn-xs">Foto</a> 
<a href="files/berkas/'.$data['foto3'].'" target="_blank" class="btn btn-primary btn-xs">Ijazah</a> 
<a href="files/berkas/'.$data['foto4'].'" target="_blank" class="btn btn-primary btn-xs">KTP</a> 
<a href="files/berkas/'.$data['foto5'].'" target="_blank" class="btn btn-primary btn-xs">KK</a>';
}
 else 
{
$content .= '

-';
}



$content .= '

</td>


</tr>';
}




$content .= '</table></div></form>
<br/>
<a href="excel.php?prodi='.$prodi.'">Export Excel</a>
';





}


break;	

}














/////////////
echo $content;

?> <script src="js/bootstrap-datepicker2.js"></script>
<script>
$(function(){
	$(".tcal").datepicker({
	format:'yyyy-mm-dd'
	});
 });
</script>