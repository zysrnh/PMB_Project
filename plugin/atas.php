<?php
global $koneksi_db, $maxkonten;
$perintah="SELECT * FROM mod_data_profil";
$hasil = $koneksi_db->sql_query( $perintah );
$coint_i = 0;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
    $coint_i++;
    $id = md5($data['id']);

 echo '   
<div class="kingster-mobile-header-wrap" style="border-radius: 0px;">
    <div class="kingster-top-bar" style="background:#0b4d3c !important; padding: 7px 10px; border-bottom: 1px solid rgba(255,255,255,0.1); border-radius: 0px;">
        <div class="kingster-top-bar-background" style="background:#0b4d3c !important; display:none;"></div>
        <div class="kingster-top-bar-container kingster-container">
            <div class="kingster-top-bar-container-inner clearfix">
                <div class="kingster-top-bar-right kingster-item-pdlr" style="text-align: center;">
                    <ul id="kingster-top-bar-menu" class="sf-menu kingster-top-bar-menu kingster-top-bar-right-menu" style="display: flex; justify-content: center; flex-wrap: wrap; gap: 12px; margin: 0; padding: 0; list-style: none;">
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9306 kingster-normal-menu" style="color: #ecfdf5; font-size: 12px; font-weight: 500;">
                            <i class="fa fa-phone" style="color: #c89a3b; margin-right: 4px;"></i> Telp. '.$data['telp'].'
                        </li>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9306 kingster-normal-menu" style="color: rgba(255,255,255,0.3); font-size: 12px;">|</li>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9306 kingster-normal-menu" style="color: #ecfdf5; font-size: 12px; font-weight: 500;">
                            <i class="fa fa-envelope-o" style="color: #c89a3b; margin-right: 4px;"></i> Email : '.$data['email'].'
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="kingster-mobile-header kingster-header-background kingster-style-slide kingster-sticky-mobile-navigation" id="kingster-mobile-header" style="background: #ffffff !important; border-bottom: 1px solid #e2e8f0; border-radius: 0px;">
        <div class="kingster-mobile-header-container kingster-container clearfix">
            <div class="kingster-logo kingster-item-pdlr">
                <div class="kingster-logo-inner">
                    <a class="" href="index.html">
                        <img src="images/'.$data['foto'].'" width="160" height="50" style="max-height: 48px; width: auto;" alt="'.$data['nama'].'" />
                    </a>
                </div>
            </div>'; 	
} ?>