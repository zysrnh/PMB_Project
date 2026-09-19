

<?php
$perintah = "SELECT * FROM slider ORDER By id DESC LIMIT 1";
$hasil = $koneksi_db->sql_query($perintah);
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
    echo '
    <div style="width: 100%; background: #073529; overflow: hidden; max-height: 520px; display: flex; align-items: center; justify-content: center;">
        <img src="images/slides/'.$data['foto'].'" alt="'.$data['nama'].'" style="width: 100%; height: auto; max-height: 520px; object-fit: cover; object-position: center;">
    </div>';
}
?>