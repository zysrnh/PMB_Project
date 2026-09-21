<?php
global $koneksi_db, $maxkonten;
$perintah="SELECT * FROM mod_data_profil";
$hasil = $koneksi_db->sql_query( $perintah );
$coint_i = 0;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
    $coint_i++;
    $id = md5($data['id']);

 echo '   
<div class="kingster-body-outer-wrapper" style="border-radius: 0px;">
<div class="kingster-body-wrapper clearfix kingster-with-frame" style="border-radius: 0px;">
<div class="kingster-top-bar" style="background:#0b4d3c !important; border-bottom: 1px solid rgba(255,255,255,0.1); padding: 8px 0; border-radius: 0px;">
    <div class="kingster-top-bar-background" style="background:#0b4d3c !important; display:none;"></div>
    <div class="kingster-top-bar-container kingster-container">
        <div class="kingster-top-bar-container-inner clearfix">
            <div class="kingster-top-bar-right kingster-item-pdlr">
                <ul id="kingster-top-bar-menu" class="sf-menu kingster-top-bar-menu kingster-top-bar-right-menu">
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9306 kingster-normal-menu" style="color:#ecfdf5; font-size:13px; font-weight:500;">
                        <i class="fa fa-phone" style="color:#c89a3b; margin-right:4px;"></i> Telp. '.$data['telp'].' &nbsp;|&nbsp; 
                    </li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9306 kingster-normal-menu" style="color:#ecfdf5; font-size:13px; font-weight:500;">
                        <i class="fa fa-envelope-o" style="color:#c89a3b; margin-right:4px;"></i> Email : '.$data['email'].'
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>	
<header class="kingster-header-wrap kingster-header-style-plain kingster-style-menu-right kingster-sticky-navigation kingster-style-fixed" data-navigation-offset="75px" style="background:#ffffff; border-bottom:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,0.05); border-radius: 0px;" >
<div class="kingster-header-background" style="background:#ffffff;"></div>
<div class="kingster-header-container kingster-container">
<div class="kingster-header-container-inner clearfix">
<div class="kingster-logo kingster-item-pdlr"><div class="kingster-logo-inner"><a class="" href="index.html" ><img src="images/'.$data['foto'].'" width="180" height="50" style="max-height: 52px; width: auto;" alt="'.$data['nama'].'" /></a></div></div>
<div class="kingster-navigation kingster-item-pdlr clearfix " >
<div class="kingster-main-menu" id="kingster-main-menu" >
<ul id="menu-pmb-menu-1" class="sf-menu">
'; 
} ?>