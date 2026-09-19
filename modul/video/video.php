<h4>Gallery Video</h4>
<?php




$content='';

$index_hal = 1;

include 'modul/functions.php';






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









$num = $koneksi_db->sql_query("SELECT `id` FROM `mod_data_video` $query_add");
$jumlah = $koneksi_db->sql_numrows ($num);
//////mysql_free_result ($num);

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
  
 






$referer = referer_encode();







$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_video` $query_add $SORT_SQL ORDER By `id` DESC LIMIT $offset, $limit");



$warna = null;
while ($data = $koneksi_db->sql_fetchrow($query)){
if (!isset($warna)) $warna = 'style="background:#"';
else $warna = null;	
$id = md5($data['id']);

$content .= '




<div class="col-md-6 col-sm-6" style="margin-left:-14px;">
                            <a href="https://www.youtube.com/embed/'.$data['video'].'" target="_blank">   <img src="https://img.youtube.com/vi/'.$data['video'].'/hqdefault.jpg" alt="'.$data['nama'].'" style="margin-bottom:16px;">
                            
                        </a>
					</div>















 

			

	
              
                    	
                        
                    
        
        ';
}


$content .= '  
	
             <p align=center>';
$content .= $a-> getPagingvideo($jumlah, $_GET['pg'], $_GET['stg']);
$content .= '</p>';




break;	

}














/////////////
echo $content;

?> 

