<?php
global $koneksi_db, $maxkonten;
$perintah="SELECT * FROM mod_data_profil";
$hasil = $koneksi_db->sql_query( $perintah );
$coint_i = 0;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
    $coint_i++;
    $id = md5($data['id']);

    echo '   
<div class="kingster-mobile-header-wrap">
    <div class="kingster-top-bar" style="background:#0b4d3c; border-bottom: 1px solid rgba(255,255,255,0.1); padding: 6px 0;">
        <div class="kingster-top-bar-container kingster-container">
            <div class="kingster-top-bar-container-inner clearfix">
                <div class="kingster-top-bar-right kingster-item-pdlr" style="text-align: right; font-size: 12px; color: #e2e8f0;">
                    <span><i class="fa fa-phone" style="color: #c89a3b; margin-right: 4px;"></i> '.$data['telp'].'</span>
                    <span style="margin: 0 8px; opacity: 0.4;">|</span>
                    <span><i class="fa fa-envelope-o" style="color: #c89a3b; margin-right: 4px;"></i> '.$data['email'].'</span>
                </div>
            </div>
        </div>
    </div>
    <div class="kingster-mobile-header kingster-header-background kingster-style-slide kingster-sticky-mobile-navigation" id="kingster-mobile-header" style="background: #ffffff; border-bottom: 1px solid #e2e8f0;">
        <div class="kingster-mobile-header-container kingster-container clearfix">
            <div class="kingster-logo kingster-item-pdlr" style="padding-top: 10px; padding-bottom: 10px;">
                <div class="kingster-logo-inner">
                    <a href="index.html">
                        <img src="images/'.$data['foto'].'" width="160" height="45" style="height: auto; max-height: 45px; width: auto;" alt="'.$data['nama'].'" />
                    </a>
                </div>
            </div>
'; 	
} ?>