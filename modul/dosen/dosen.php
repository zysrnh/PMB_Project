


<?php

include 'modul/functions.php';




$_GET['str'] = isset($_GET['str']) ? $_GET['str'] : null;
$_GET['sort'] = isset($_GET['sort']) ? $_GET['sort'] : NULL;
$_GET['order'] = isset($_GET['order']) ? $_GET['order'] : NULL;

$sort_url_orderby = $_GET['sort'] == 'asc' ? 'dsc' : 'asc';

function sortorder($sort_url_orderby,$field,$judul){
//order name
$qs = '';
	
 $arr = explode("&",$_SERVER["QUERY_STRING"]);
      
      if (is_array($arr)) {
        for ($i=0;$i<count($arr);$i++) {
          if (!is_int(strpos($arr[$i],"sort=")) && !is_int(strpos($arr[$i],"order=")) && trim($arr[$i]) != "") {
	          list ($kunci,$isi) = explode ('=',$arr[$i]);
	          $isi = urldecode($isi);
	          $isi = urlencode ($isi);
	          
              $qs .= $kunci . '=' . $isi ."&amp;";
          }
        }
      }	
	



$sort_url_name = '<a title="Sort Berdasarkan '.$judul.'" href="?'.$qs.'&amp;sort='.$sort_url_orderby.'&amp;order='.$field.'">'.$judul.'</a>';
$sort_url_name_img = '';
if (isset($_GET['sort']) && $_GET['order'] == $field){
$sort_url_name_img = $_GET['sort'] == 'asc' ? '&nbsp;<IMG height=10 alt=^ src="gambar/_arrowup.gif" width=10 align=absMiddle border=0>' : '&nbsp;<IMG height=10 alt=^ src="gambar/_arrowdown.gif" width=10 align=absMiddle border=0>';
}

return $sort_url_name.$sort_url_name_img;
}


switch (@$_GET['action']){

	
	
	
default:
$pilih = cleartext($_GET['pilih']);

$seo1= $koneksi_db->sql_query("SELECT * FROM mod_data_meta WHERE nama='$pilih'");
while($pr1xypd=$koneksi_db->sql_fetchrow($seo1)){
	$judulseo1 = $pr1xypd['judul'];
$desseo1 = $pr1xypd['meta'];
$keyseo1 = $pr1xypd['tags'];
}


$judul_situs = $judulseo1;
$_META['description'] = $desseo1;
$_META['keywords'] = $keyseo1;


$query_add = '';
if (isset ($_GET['str']) && !empty($_GET['str'])){
	$str = substr($_GET['str'],0,1);
$query_add .= "WHERE LEFT (`nama`,1) = '$str'";
}




$num = $koneksi_db->sql_query("SELECT `id` FROM `mod_data_dosen` $query_add");
$jumlah = $koneksi_db->sql_numrows ($num);
//mysql_free_result ($num);

$limit = 12;
if (empty($_GET['offset']) and !isset ($_GET['offset'])) {
$offset = 0;
}else {
$offset = int_filter ($_GET['offset']);	
}

$a = new paging ($limit);

// Pembagian halaman dimulai
 if (!isset ($_GET['pg'],$_GET['stg'])){
	  $_GET['pg'] = 1;
	  $_GET['stg'] = 1;
  }
  
  
$qs = '';
	
 $arr = explode("&",$_SERVER["QUERY_STRING"]);
      
      if (is_array($arr)) {
        for ($i=0;$i<count($arr);$i++) {
          if (!is_int(strpos($arr[$i],"str=")) && trim($arr[$i]) != "") {
	          list ($kunci,$isi) = explode ('=',$arr[$i]);
	          $isi = urldecode($isi);
	          $isi = urlencode ($isi);
	          
              $qs .= $kunci . '=' . $isi ."&amp;";
          }
        }
      }  
  
 






  
$content .= '     <h4>Dosen dan Karyawan</h4>  <div class="row justify-content-center">';






$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_dosen` $query_add ORDER By `id` ASC LIMIT $offset, $limit");



$warna = null;
while ($data = $koneksi_db->sql_fetchrow($query)){
if (!isset($warna)) $warna = 'style="background:#"';
else $warna = null;	
$no++;
$id = $data['id'];
	$url=str_replace(" ", "-", $data[1]);

$content .= '




<div class="col-lg-4 col-sm-6">
            	<div class="team_box team_style1 box_shadow1 animation" data-animation="fadeInUp" data-animation-delay="0.01s">
                	<div class="team_img">
                    	<img src="images/dosen/'.$data['foto'].'" alt="'.$data['nama'].'">
                        <ul class="list_none social_icons social_white">
                            <li><a href="'.$data['fb'].'"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="'.$data['tw'].'"><i class="ion-social-twitter"></i></a></li>
        
                            <li><a href="'.$data['in'].'"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                    <div class="team_title radius_lbrb_10 text-center">
                        <h5><a href="dosen/'.$data['id'].'/'.$url.'.html">'.$data['nama'].'</a></h5>
                        <span>'.$data['pekerjaan'].'</span>
                    </div>
                </div>
            </div>
					














								

';
}





$content .= '       </div><p align=center>';
$content .= $a-> getPagingdosen($jumlah, $_GET['pg'], $_GET['stg']);
$content .= '</p>';




break;	





	
case 'detail':
$id = int_filter($_GET['id']);



$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_dosen` WHERE id='$id'");



$warna = null;
while ($data = $koneksi_db->sql_fetchrow($query)){
if (!isset($warna)) $warna = 'style="background:#"';
else $warna = null;	
$no++;

$kett = limitTXT2(strip_tags($data['ket']),160);
$urlt=str_replace(" ", ", ", $kett);

$judul_situs = $data['nama'];
$_META['description'] = limitTXT2(strip_tags($data['ket']),160);
$_META['keywords'] = $urlt;


$content .= '
        <div class="row">
<div class="col-lg-4 col-md-6">
            	<div class="team_single radius_all_10 box_shadow1">
                	<div class="team_img">
                    	<img class="radius_ltrt_10" src="images/dosen/'.$data['foto'].'"  alt="'.$data['nama'].'">
                    </div>
                    <div class="team_single_info">
                        <div class="team_name">
                            <h5>'.$data['nama'].'</h5>
                            <span>'.$data['pekerjaan'].'</span>
                        </div>
                        <h6 class="mb-3">Contact info:</h6>
                        <ul class="contact_info list_none">
                         
                            <li>
                                <span>Phone:</span>
                                <p>'.$data['hp'].'</p>
                            </li>
                            <li>
                                <span>Social:</span>
                                <ul class="list_none social_icons radius_social">
                                    <li><a href="'.$data['fb'].'" class="sc_facebook"><i class="ion-social-facebook"></i></a></li>
                                    <li><a href="'.$data['tw'].'" class="sc_twitter"><i class="ion-social-twitter"></i></a></li>
            
                                    <li><a href="'.$data['in'].'" class="sc_instagram"><i class="ion-social-instagram-outline"></i></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
			
			
			
			
			
			
            <div class="col-lg-8 col-md-6">
   <h5 class="mb-3">Keterangan</h5>

'.$data['ket'].'

</div>
			
						
							
							
</div>
		
			<br/>
<a href="dosen.html">Kembali</a>			
					
';
}






break;	



}














/////////////
echo $content;

?>