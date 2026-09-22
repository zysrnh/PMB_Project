<?php
include 'ikutan/config.php';
include 'ikutan/mysqli.php';
$propinsi5 = cleartext(isset($_REQUEST['propinsi5']) ? $_REQUEST['propinsi5'] : '');
$kota5 = $koneksi_db->sql_query("SELECT id,nama_kabkota FROM kabkota WHERE provinsi_id='$propinsi5' ORDER BY id ASC");
echo "<option value=\"\">-- Pilih Kota/Kabupaten --</option>\n";
if ($kota5) {
    while($k = $koneksi_db->sql_fetchrow($kota5)){
        echo "<option value=\"".htmlspecialchars($k['id'])."\">".htmlspecialchars($k['nama_kabkota'])."</option>\n";
    }
}
?>
