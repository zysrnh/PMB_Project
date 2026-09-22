<?php
include 'ikutan/config.php';
include 'ikutan/mysqli.php';
$kec5 = cleartext(isset($_REQUEST['kec5']) ? $_REQUEST['kec5'] : '');
$desa5 = $koneksi_db->sql_query("SELECT id,nama_kelurahan FROM kelurahan WHERE kecamatan_id='$kec5' ORDER BY id ASC");
echo "<option value=\"\">-- Pilih Kelurahan --</option>\n";
if ($desa5) {
    while($desa = $koneksi_db->sql_fetchrow($desa5)){
        echo "<option value=\"".htmlspecialchars($desa['id'])."\">".htmlspecialchars($desa['nama_kelurahan'])."</option>\n";
    }
}
?>
