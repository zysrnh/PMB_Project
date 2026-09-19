<?php
$hasil = $koneksi_db->sql_query("SELECT * FROM menu WHERE published=1 ORDER BY ordering");

while ($data = $koneksi_db->sql_fetchrow($hasil)) {
    $parent = $data['id'];
    $link_menu = $data['menu'];
    $link_url = $data['url'];
    
    $subhasil = $koneksi_db->sql_query("SELECT * FROM submenu WHERE published=1 AND parent='$parent' ORDER BY ordering");
    $jmlsub = $koneksi_db->sql_numrows($subhasil);

    if ($jmlsub > 0) {
        echo '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children kingster-normal-menu">
                <a href="#">' . htmlspecialchars($link_menu) . '</a>
                <ul class="sub-menu">';

        while ($subdata = $koneksi_db->sql_fetchrow($subhasil)) {
            $parent2 = $subdata['id'];
            $subhasil2 = $koneksi_db->sql_query("SELECT * FROM submenumenu WHERE published=1 AND parent='$parent2' ORDER BY ordering");
            $jmlsub2 = $koneksi_db->sql_numrows($subhasil2);

            if ($jmlsub2 > 0) {
                echo '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                        <a href="javascript:void(0);">' . htmlspecialchars($subdata['menu']) . '</a>
                        <ul class="sub-menu">';

                while ($subdata2 = $koneksi_db->sql_fetchrow($subhasil2)) {
                    echo '<li><a href="' . htmlspecialchars($subdata2['url']) . '">' . htmlspecialchars($subdata2['menu']) . '</a></li>';
                }

                echo '</ul></li>';
            } else {
                echo '<li><a href="' . htmlspecialchars($subdata['url']) . '">' . htmlspecialchars($subdata['menu']) . '</a></li>';
            }
        }
        echo '</ul></li>';
    } else {
        echo '<li><a href="' . htmlspecialchars($link_url) . '">' . htmlspecialchars($link_menu) . '</a></li>';
    }
}
?>