<h4>Gallery Foto</h4>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<?php




$content='';

$index_hal = 1;

include 'modul/functions.php';






switch (@$_GET['action']){

	
		
case 'filter':
$kid = int_filter($_GET['kid']);




$query_add = '';
if (isset ($_GET['str']) && !empty($_GET['str'])){
	$str = substr($_GET['str'],0,1);
$query_add .= "WHERE LEFT (`nama`,1) = '$str'";
}









$num = $koneksi_db->sql_query("SELECT `id` FROM `mod_data_foto` WHERE kat='$kid' $query_add");
$jumlah = $koneksi_db->sql_numrows ($num);
///mysql_free_result ($num);

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
  







  
$content .= <<<js
<script language="javascript">
all_checked = true;
function checkall(formName, boxName) {
	for(i = 0; i < document.getElementById(formName).elements.length; i++)
	{
		var formElement = document.getElementById(formName).elements[i];
		if(formElement.type == 'checkbox' && formElement.nama == boxName && formElement.disabled == false)
		{
			formElement.checked = all_checked;
		}
	}	
all_checked = all_checked ? false : true;
}
</script>


js;

$referer = referer_encode();

$content .= '<form method="GET" action="">';

$propinsi = $koneksi_db->sql_query("SELECT * FROM mod_data_fotokat ORDER BY id");
while($p=$koneksi_db->sql_fetchrow($propinsi)){
$id = $p['id'];
	$nama = $p['nama'];
	$urlkat=str_replace(" ", "-", $nama);
$asal4 .= '<option value="gallery/'.$p['id'].'/'.$urlkat.'.html">'.$nama.'</option>';
}
$propinsix = $koneksi_db->sql_query("SELECT * FROM mod_data_fotokat WHERE id='$kid'");
while($px=$koneksi_db->sql_fetchrow($propinsix)){
$idx = $px['id'];
	$namax = $px['nama'];
}



$pilih = cleartext($_GET['pilih']);

$seo1= $koneksi_db->sql_query("SELECT * FROM mod_data_meta WHERE nama='$pilih'");
while($pr1xypd=$koneksi_db->sql_fetchrow($seo1)){
	$judulseo1 = $pr1xypd['judul'];
$desseo1 = $pr1xypd['meta'];
$keyseo1 = $pr1xypd['tags'];
}

$judul_situs = ''.$judulseo1.' '.$namax.'';
$_META['description'] = $desseo1;
$_META['keywords'] = $keyseo1;







if (empty ($namax)){
			$content .= '<br/><div class="error">Halaman tidak tersedia.</div>';
}else {







$content .= ' 

<select nama="kid" onChange="MM_jumpMenu(\'parent\',this,0)">

<option value="">'.$namax.'</option>';
  $content .= ''.$asal4.'
  
  ';



$content .= '</select></form>';



$content .= '
 <br/> <br/>

  
                  
';




$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_foto` WHERE kat='$kid' $query_add $SORT_SQL ORDER By `id` DESC  LIMIT $offset, $limit");



$warna = null;
while ($data = $koneksi_db->sql_fetchrow($query)){
if (!isset($warna)) $warna = 'style="background:#"';
else $warna = null;	
$id = md5($data['id']);
$kid = $data['kat'];

$propinsi121 = $koneksi_db->sql_query("SELECT * FROM mod_data_fotokat WHERE id='$kid'");
while($p111=$koneksi_db->sql_fetchrow($propinsi121)){
$namaz = $p111['nama'];
}
$content .= '




<div class="col-md-6 col-sm-6" style="margin-left:-14px;">
                  
                            <img src="images/foto/'.$data['foto'].'" alt="Foto '.$data['nama'].'" style="margin-bottom:16px;">
                       
					</div>


        ';
}






$content .= '  
		
  
				
             <p align=center>';
$content .= $a-> getPagingkatfoto($jumlah, $_GET['pg'], $_GET['stg'],$kid);
$content .= '</p>';


}

break;	
	
	
	
	
	
	
	
	
	
	
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









$num = $koneksi_db->sql_query("SELECT `id` FROM `mod_data_foto` $query_add");
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


$asal4='';
$propinsi = $koneksi_db->sql_query("SELECT * FROM mod_data_fotokat ORDER BY id");
while($p=$koneksi_db->sql_fetchrow($propinsi)){
$id = $p['id'];
	$nama = $p['nama'];
	$urlkat=str_replace(" ", "-", $nama);
$asal4 .= '<option value="gallery/'.$p['id'].'/'.$urlkat.'.html">'.$nama.'</option>';
}

$content .= ' 

<select nama="kid" onChange="MM_jumpMenu(\'parent\',this,0)">

<option value="">-- Pilih Kategori --</option>';
  $content .= ''.$asal4.'
  
  ';



$content .= '</select></form><br/> <br/>';



$content .= '
 

  
                  
';





$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_foto` $query_add $SORT_SQL ORDER By `id` DESC LIMIT $offset, $limit");



$warna = null;
while ($data = $koneksi_db->sql_fetchrow($query)){
if (!isset($warna)) $warna = 'style="background:#"';
else $warna = null;	
$id = md5($data['id']);
$kid = $data['kat'];

$propinsi121 = $koneksi_db->sql_query("SELECT * FROM mod_data_fotokat WHERE id='$kid'");
while($p111=$koneksi_db->sql_fetchrow($propinsi121)){
$namax = $p111['nama'];
}

$coint_i++;
$content .= ' 



<div class="col-md-6 col-sm-6" style="margin-left:-14px;">
                  
                            <img src="images/foto/'.$data['foto'].'" alt="Foto '.$data['nama'].'" style="margin-bottom:16px;">
                       
					</div>
 







 

			

	
              
                    	
                        
                    
        
        ';
}


$content .= '  
											
	     
 
             <p align=center>';
$content .= $a-> getPagingfoto($jumlah, $_GET['pg'], $_GET['stg']);
$content .= '</p>';




break;	

}














/////////////
echo $content;

?> 
			<script src="js/jquery2x.js"></script>	

