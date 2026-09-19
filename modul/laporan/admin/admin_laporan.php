<h4>
Laporan PMB 
</h4>


  
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

$referer = referer_encode();
$content .= '<form method="POST" action="" id="namaform">
<div class="table-responsive">
<table class="table table-hover">';

$content .= '<tr>
	<th>No.</td>
<th>Kode</th>
<th>Nama</th>
<th>Tampung</th>
	<th>Pendaftar</th>
<th>Konfirmasi</th>
<th>Lulus</th>
</tr>';



$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_prodi` ORDER By `id` ASC");



$warna = null;
while ($data = $koneksi_db->sql_fetchrow($query)){
if (!isset($warna)) $warna = 'style="background:#f9f9f9"';
else $warna = null;	
$no ++;
$id = $data['kode'];

$ada=$koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT * FROM mod_data_pmb where prodi='".$id."'"));
$ada2=$koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT * FROM mod_data_pmb where prodi='".$id."' AND status='1'"));
$ada3=$koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT * FROM mod_data_pmb where prodi='".$id."' AND status='1' AND lulus='Lulus'"));

$content .= '<tr>
	<td>'.$no.'</td>
<td>'.$data['kode'].'</td>

<td>'.$data['nama'].'</td>
<td>'.$data['tampung'].'</td>
	<td>'.$ada.'</td>
<td>'.$ada2.'</td>
	<td><a href="admin.php?pilih=lulus&modul=yes&prodi='.$data['kode'].'">'.$ada3.'</a></td>
</tr>';
}



$content .= '</table></div>
<br/>
<a href="excellap.php" class="btn btn-primary" style="color:white;" ><i class="fa fa-download"></i> Download</a>




';





break;	

}














/////////////
echo $content;

?> 