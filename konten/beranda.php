<?php
$hasil = $koneksi_db->sql_query("SELECT * FROM menu WHERE published=1 ORDER BY ordering");

while ($data = $koneksi_db->sql_fetchrow($hasil)) {
    $parent = $data['id'];
    $link_menu = clean_emoji($data['menu']);
    $link_url = str_replace(array('https://pmb.iaipibandung.ac.id/', 'http://pmb.iaipibandung.ac.id/', '&amp;'), array('', '', '&'), $data['url']);
    
    $subhasil = $koneksi_db->sql_query("SELECT * FROM submenu WHERE published=1 AND parent='$parent' ORDER BY ordering");
    $jmlsub = $koneksi_db->sql_numrows($subhasil);

    if ($jmlsub > 0) {
        echo '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children kingster-normal-menu">
                <a href="#">' . htmlspecialchars($link_menu) . '</a>
                <ul class="sub-menu">';

        while ($subdata = $koneksi_db->sql_fetchrow($subhasil)) {
            $parent2 = $subdata['id'];
            $sub_menu = clean_emoji($subdata['menu']);
            $sub_url = str_replace(array('https://pmb.iaipibandung.ac.id/', 'http://pmb.iaipibandung.ac.id/', '&amp;'), array('', '', '&'), $subdata['url']);
            
            $subhasil2 = $koneksi_db->sql_query("SELECT * FROM submenumenu WHERE published=1 AND parent='$parent2' ORDER BY ordering");
            $jmlsub2 = $koneksi_db->sql_numrows($subhasil2);

            if ($jmlsub2 > 0) {
                echo '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                        <a href="javascript:void(0);">' . htmlspecialchars($sub_menu) . '</a>
                        <ul class="sub-menu">';

                while ($subdata2 = $koneksi_db->sql_fetchrow($subhasil2)) {
                    $sub2_menu = clean_emoji($subdata2['menu']);
                    $sub2_url = str_replace(array('https://pmb.iaipibandung.ac.id/', 'http://pmb.iaipibandung.ac.id/', '&amp;'), array('', '', '&'), $subdata2['url']);
                    echo '<li><a href="' . htmlspecialchars($sub2_url) . '">' . htmlspecialchars($sub2_menu) . '</a></li>';
                }

                echo '</ul></li>';
            } else {
                echo '<li><a href="' . htmlspecialchars($sub_url) . '">' . htmlspecialchars($sub_menu) . '</a></li>';
            }
        }
        echo '</ul></li>';
    } else {
        echo '<li><a href="' . htmlspecialchars($link_url) . '">' . htmlspecialchars($link_menu) . '</a></li>';
    }
}
?>