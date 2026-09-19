<h4>Nilai USM</h4>

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
$pilihkat2 .= '<option value="admin.php?pilih=nilai&modul=yes&prodi='.$idkat23.'">'.$namakat23.'</option>';
}

$q3 = $koneksi_db->sql_query ("SELECT * FROM `mod_data_prodi`  WHERE kode='".$prodi."'");
while ($data3 = $koneksi_db->sql_fetchrow($q3)){
	$nama2333 = $data3['nama'];
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
<option value="admin.php?pilih=nilai&modul=yes&prodi='.$prodi.'&gel=1">1</option>
<option value="admin.php?pilih=nilai&modul=yes&prodi='.$prodi.'&gel=2">2</option>
<option value="admin.php?pilih=nilai&modul=yes&prodi='.$prodi.'&gel=3">3</option>
</select>

';
	
}


echo '













<br/><br/>
';


if(!$gel )
{
	
} else {
	
	
	


if ($_POST['submit']){

$prodi2 = $_POST['prodi'];
$nomor2 = $_POST['nomor'];
$aspek2 = $_POST['aspek'];
$nilai2 = $_POST['nilai'];
  $bobot2 = $_POST['bobot'];			  
foreach($nomor2 as $key=>$val) 
{
    $prodi22 = $prodi2[$key];
	$aspek22 = $aspek2[$key];
	$nilai22 = $nilai2[$key];
	$bobot22 = $bobot2[$key];
	$na = ($bobot22/100)*$nilai22;
		
$ada=$koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT * FROM mod_data_nilai where prodi='".$prodi22."' and nomor='".$val."' and aspek='".$aspek22."'"));


if ($ada > 0) {
	$insert = $koneksi_db->sql_query ("UPDATE `mod_data_nilai` SET `nilai`='$nilai22',`bobot`='$bobot22',`na`='$na'
	WHERE `nomor`='$val' AND `prodi`='$prodi22' AND `aspek`='$aspek22'");

}else {

  $insert = $koneksi_db->sql_query("insert into `mod_data_nilai` SET `nomor`='$val',`prodi`='$prodi22',`aspek`='$aspek22',`nilai`='$nilai22',`bobot`='$bobot22',`na`='$na'");

 
}
	
	
	
	$resultk = $koneksi_db->sql_query('SELECT SUM(na) AS value_sum FROM mod_data_nilai WHERE nomor="'.$val.'" AND  prodi="'.$prodi22.'"'); 
$rowk = $koneksi_db->sql_fetchrow($resultk); 
$sumk = $rowk['value_sum'];   
	
	$adaa=$koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT * FROM mod_data_aspek"));
	
	
	
	$propinsi12xx2 = $koneksi_db->sql_query("SELECT * FROM mod_data_periode WHERE id='1'");
while($p11xx2=$koneksi_db->sql_fetchrow($propinsi12xx2)){
$nmin = $p11xx2['nilaimin'];
}		
	
	
	if ($sumk >= $nmin) {
		
		$ll = 'Lulus';
	}else {
		$ll = 'Tidak Lulus';
	}
	
	$nax = $sumk/$adaa;
	
		$insert2 = $koneksi_db->sql_query ("UPDATE `mod_data_pmb` SET `nilai`='$sumk',`lulus`='$ll'
	WHERE `nomor`='$val'");
	
	
	
	
	
	
	
	
	
	
	
}






}











$num = $koneksi_db->sql_query("SELECT `id` FROM `mod_data_pmb`  WHERE status='1' AND prodi='$prodi'");
$jumlah = $koneksi_db->sql_numrows ($num);
//mysqli_free_result ($num);

$limit = 2000;
if (empty($_GET['offset']) and !isset ($_GET['offset'])) {
$offset = 0;
}else {
$offset = int_filter ($_GET['offset']);	
}

$a = new paging ($limit);

// Pembagian halaman dimulai
 if (!isset ($_GET['pg'],$_GET['stg'])){
	  $_GET['pg'] = 1;
	  $_GET['stg'] = 1;
  }
  
  
$qs = '';
$bulan =date('m');	
$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
$bulankartu = $array_bulan[date('n')];	
$tahun =date('Y');	
$content .= '
<form method="POST" action="" id="namaform">
<div class="table-responsive">
<table class="table table-hover">';

$content .= '<tr>
<th>No.</td>
<th>Nomor</td>

<th>Nama Lengkap</th>
';


$query2 = $koneksi_db->sql_query ("SELECT * FROM `mod_data_aspek` ORDER By `id` ASC");
while ($data2 = $koneksi_db->sql_fetchrow($query2)){
	
	$content .= '<th>'.$data2['nama'].' ('.$data2['bobot'].'%)</th>';
}






$content .= '
<th>Nilai Akhir (100%)</th>
<th>Status</th>
</tr>';



$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_pmb` WHERE status='1' AND prodi='$prodi' AND gel='$gel' AND lulus!='Lulus' ORDER By `id` ASC");
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


$query2 = $koneksi_db->sql_query ("SELECT * FROM `mod_data_aspek` ORDER By `id` ASC");
while ($data2 = $koneksi_db->sql_fetchrow($query2)){
	
	$id3 = $data2['id'];
		$bobot = $data2['bobot'];
	
	
	$prop1xy2= $koneksi_db->sql_query("SELECT * FROM mod_data_nilai WHERE nomor='$nomor' AND aspek='$id3' AND prodi='$prodi'");
while($pr1xy2=$koneksi_db->sql_fetchrow($prop1xy2)){
$namakat2 = $pr1xy2['nilai'];
}

		$adaxx=$koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT * FROM mod_data_nilai where prodi='".$prodi."' and nomor='".$nomor."' and aspek='".$id3."'"));

	
	$content .= '
	
	<input type="hidden" name="nomor[]" value="'.$nomor.'"/>
<input type="hidden" name="prodi[]" value="'.$prodi.'"/>
<input type="hidden" name="aspek[]" value="'.$id3.'"/>
<input type="hidden" name="bobot[]" value="'.$bobot.'"/>';
	if($adaxx > 0)
	{
			$content .= '<td><input type="text" name="nilai[]" size="5" value="'.$namakat2.'" style="border:1px solid #d1d1d1;margin-top:0px;"></td>';
	} else {
			$content .= '<td><input type="text" name="nilai[]" size="5" style="border:1px solid #d1d1d1;margin-top:0px;"></td>';
	}
	
}


$resultkx = $koneksi_db->sql_query('SELECT SUM(na) AS value_sum FROM mod_data_nilai WHERE nomor="'.$nomor.'" AND  prodi="'.$prodi.'"'); 
$rowkx = $koneksi_db->sql_fetchrow($resultkx); 
$sumkx = $rowkx['value_sum'];   

$content .= '

<td><input type="text" size="5" value="'.$sumkx.'" style="border:1px solid #d1d1d1;margin-top:0px;" disabled="disable"></td>
<td>'.$data['lulus'].'</td>
</tr>';
}


$content .= '<tr><td>&nbsp;</td><td>&nbsp;</td>
';


$query2 = $koneksi_db->sql_query ("SELECT * FROM `mod_data_aspek` ORDER By `id` ASC");
while ($data2 = $koneksi_db->sql_fetchrow($query2)){
	
	$content .= '<td>&nbsp;</td>';
}






$content .= '
<td>&nbsp;</td>

';




$content .= '
    <td><input type="submit" name="submit" value="Proses "></td>
  </tr>';  

$content .= '</table></div>
<br/>
<a href="admin.php?pilih=nilai&modul=yes&prodi='.$prodi.'&gel='.$gel.'" class="btn btn-primary" style="color:white;" onclick=bukajendela("nilaiusm.php?prodi='.$prodi.'&gel='.$gel.'")><i class="fa fa-print"></i> Print</a>

</form>';


$content .= '<p align=center>';
$content .= $a-> getPaging($jumlah, $_GET['pg'], $_GET['stg']);
$content .= '</p>';


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