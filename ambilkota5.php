<?php
include 'ikutan/config.php';
include 'ikutan/mysqli.php';
$propinsi5 = $_GET['propinsi5'];
$kota5 = $koneksi_db->sql_query("SELECT id,nama_kabkota FROM kabkota WHERE provinsi_id='$propinsi5' order by id");
echo "<option>-- Pilih Kota/Kabupaten --</option>";
while($k = $koneksi_db->sql_fetchrow($kota5)){
    echo "<option value=\"".$k['id']."\">".$k['nama_kabkota']."</option>\n";
}
?>
