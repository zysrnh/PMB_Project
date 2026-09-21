<?php
include 'ikutan/config.php';
include 'ikutan/mysqli.php';
$kota5 = cleartext($_REQUEST['kota5'] ?? '');
$kec5 = $koneksi_db->sql_query("SELECT id,nama_kecamatan FROM kecamatan WHERE kabkota_id='$kota5' ORDER BY id ASC");
echo "<option value=\"\">-- Pilih Kecamatan --</option>\n";
if ($kec5) {
    while($kec = $koneksi_db->sql_fetchrow($kec5)){
        echo "<option value=\"".htmlspecialchars($kec['id'])."\">".htmlspecialchars($kec['nama_kecamatan'])."</option>\n";
    }
}
?>
