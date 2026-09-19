<?php
include 'ikutan/config.php';
include 'ikutan/mysqli.php';
$kec5 = $_GET['kec5'];
$desa5 = $koneksi_db->sql_query("SELECT id,nama_kelurahan FROM kelurahan WHERE  kecamatan_id='$kec5' order by id");

echo "<option>-- Pilih Kelurahan --</option>";
while($desa = $koneksi_db->sql_fetchrow($desa5)){
	
    echo "<option value=\"".$desa['id']."\">".$desa['nama_kelurahan']."</option>\n";
}
?>
