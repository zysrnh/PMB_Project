


		
			<?php
$perintah="SELECT * FROM slider ORDER By id DESC LIMIT 1";
$hasil = $koneksi_db->sql_query( $perintah );
$coint_i = 0;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
				$coint_i++;
				
				if($coint_i==1)
				{
					$aktifs = 'active';
				} else {
					
					$aktifs = '';
				}
			
 echo '



<img src="images/slides/'.$data['foto'].'" alt="'.$data['nama'].'"  width="1920" height="766" data-lazyload="images/slides/'.$data['foto'].'" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
	





 


  ';
 
 
 

					
} ?>	                 
		