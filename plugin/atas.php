
			<?php
global $koneksi_db, $maxkonten;
$perintah="SELECT * FROM mod_data_profil";
$hasil = $koneksi_db->sql_query( $perintah );
$coint_i = 0;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
				$coint_i++;
				$id = md5($data['id']);
			
					
					
			
 echo '   
 


<div class="kingster-mobile-header-wrap" ><div class="kingster-top-bar"  style="background:'.$data['warnah'].';"><div class="kingster-top-bar-background" ></div><div class="kingster-top-bar-container kingster-container " >
<div class="kingster-top-bar-container-inner clearfix" ><div class="kingster-top-bar-right kingster-item-pdlr"><ul id="kingster-top-bar-menu" class="sf-menu kingster-top-bar-menu kingster-top-bar-right-menu">
<li  class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9306 kingster-normal-menu">Telp. '.$data['telp'].' | </li>

<li  class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9306 kingster-normal-menu">Email : '.$data['email'].'</li>

</ul>


</div></div></div></div><div class="kingster-mobile-header kingster-header-background kingster-style-slide kingster-sticky-mobile-navigation " id="kingster-mobile-header" >
<div class="kingster-mobile-header-container kingster-container clearfix" ><div class="kingster-logo  kingster-item-pdlr">
<div class="kingster-logo-inner"><a class="" href="index.html" >
<img  src="images/'.$data['foto'].'" width="120" height="50  srcset="images/'.$data['foto'].' 400w, images/'.$data['foto'].' 600w, images/'.$data['foto'].' 722w"  sizes="(max-width: 767px) 100vw, (max-width: 1150px) 100vw, 1150px"  alt="" />
</a>
</div>
</div>




 
'; 	
					
} ?>	
						