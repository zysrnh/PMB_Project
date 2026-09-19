<?php
global $koneksi_db, $maxkonten;
$perintah="SELECT * FROM mod_data_profil";
$hasil = $koneksi_db->sql_query( $perintah );
$coint_i = 0;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
    $coint_i++;
    $id = md5($data['id']);

    echo '   
<div class="kingster-body-outer-wrapper">
    <div class="kingster-body-wrapper clearfix kingster-with-frame">
        <!-- Top Bar -->
        <div class="kingster-top-bar" style="background:#0b4d3c; border-bottom: 1px solid rgba(255,255,255,0.1); padding: 8px 0;">
            <div class="kingster-top-bar-container kingster-container">
                <div class="kingster-top-bar-container-inner clearfix" style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="font-size: 13px; color: #ecfdf5; font-weight: 500;">
                        <span style="background: #c89a3b; color: #073529; font-size: 10px; font-weight: 800; padding: 2px 6px; text-transform: uppercase; margin-right: 8px;">INFO PMB</span>
                        Selamat Datang di Portal PMB '.$data['nama'].'
                    </div>
                    <div class="kingster-top-bar-right" style="font-size: 13px; color: #e2e8f0;">
                        <span style="margin-right: 15px;"><i class="fa fa-phone" style="color: #c89a3b; margin-right: 4px;"></i> '.$data['telp'].'</span>
                        <span><i class="fa fa-envelope-o" style="color: #c89a3b; margin-right: 4px;"></i> '.$data['email'].'</span>
                    </div>
                </div>
            </div>
        </div>	

        <!-- Main Header -->
        <header class="kingster-header-wrap kingster-header-style-plain kingster-style-menu-right kingster-sticky-navigation kingster-style-fixed" data-navigation-offset="75px" style="background: #ffffff; border-bottom: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div class="kingster-header-background" style="background: #ffffff;"></div>
            <div class="kingster-header-container kingster-container">
                <div class="kingster-header-container-inner clearfix" style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="kingster-logo kingster-item-pdlr" style="padding-top: 12px; padding-bottom: 12px;">
                        <div class="kingster-logo-inner">
                            <a href="index.html">
                                <img src="images/'.$data['foto'].'" width="180" height="50" style="height: auto; max-height: 52px; width: auto;" alt="'.$data['nama'].'" />
                            </a>
                        </div>
                    </div>
                    <div class="kingster-navigation kingster-item-pdlr clearfix">
                        <div class="kingster-main-menu" id="kingster-main-menu">
                            <ul id="menu-pmb-menu-1" class="sf-menu" style="font-family: var(--font-heading); font-weight: 600; font-size: 14px;">
'; 
} ?>