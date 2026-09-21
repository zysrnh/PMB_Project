<div class="widget kingster-widget" style="background: #ffffff; border: 1px solid #e2e8f0; border-top: 3px solid #0b4d3c; padding: 20px 24px; margin-bottom: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
    <div style="margin-bottom: 16px; padding-bottom: 10px; border-bottom: 2px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
        <h3 style="font-family: var(--font-heading); font-size: 16px; font-weight: 800; text-transform: uppercase; color: #0f172a; margin: 0; letter-spacing: 0.5px;">
            Informasi PMB
        </h3>
    </div>

    <div class="gdlr-core-recent-post-widget-wrap">
        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
<?php
global $koneksi_db;
$perintah = "SELECT * FROM artikel WHERE publikasi='1' ORDER BY `id` DESC LIMIT 5";
$hasil = $koneksi_db->sql_query($perintah);
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
    $judul_artikel = function_exists('clean_emoji') ? clean_emoji($data[1]) : $data[1];
    $url = str_replace(" ", "-", $judul_artikel);
    echo '
        <li style="border-bottom: 1px solid #f8fafc; padding-bottom: 8px;">
            <a href="artikel/' . $data[0] . '/' . $url . '.html" title="' . htmlspecialchars($judul_artikel) . '" style="display: flex; align-items: flex-start; gap: 8px; color: #334155; text-decoration: none; font-size: 13.5px; font-weight: 600; line-height: 1.45; transition: color 0.15s ease;">
                <i class="fa fa-angle-right" style="color: #c89a3b; font-size: 14px; margin-top: 3px; flex-shrink: 0;"></i>
                <span>' . htmlspecialchars($judul_artikel) . '</span>
            </a>
        </li>';
}
?>
        </ul>
    </div>
</div>