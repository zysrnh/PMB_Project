<h4>
Periode PMB
</h4>
  <link rel="stylesheet" href="css/bootstrap-datepicker.css" type="text/css" />
  <a href="admin.php?pilih=periode&amp;modul=yes">List Data</a>
      <?php

if (!defined('cms-ADMINISTRATOR')) {
	Header("Location: ../index.php");
	exit;
}

if (!cek_login()){
    warning("Access Denied!.... You Must Login First","index.php", 3, 2);
    exit;
}

//$index_hal = 1;


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


	

case 'edit':


$id = $_GET['id'];
if (!empty ($_GET['id'])){


if (isset ($_POST['submit'])){
	
	


$tahun = cleantext($_POST['tahun']);
$mulai = cleantext($_POST['mulai']);
$akhir = cleantext($_POST['akhir']);
$usm = cleantext($_POST['usm']);
$reg = cleantext($_POST['reg']);
$mulai2 = cleantext($_POST['mulai2']);
$akhir2 = cleantext($_POST['akhir2']);
$mulai3 = cleantext($_POST['mulai3']);
$akhir3 = cleantext($_POST['akhir3']);
$biaya = cleantext($_POST['biaya']);
	$berkas = cleantext($_POST['berkas']);
	$nilaimin = cleantext($_POST['nilaimin']);
if ($error != ''){
	$content .= '<div class=error>'.$error.'</div>';
}else {
	$insert = $koneksi_db->sql_query ("UPDATE `mod_data_periode` SET `biaya`='$biaya',`tahun`='$tahun',`mulai`='$mulai',`akhir`='$akhir',`mulai2`='$mulai2',`akhir2`='$akhir2',`mulai3`='$mulai3',`akhir3`='$akhir3',`usm`='$usm',`reg`='$reg',`berkas`='$berkas',`nilaimin`='$nilaimin' WHERE md5(`id`) = '$id'");
	if ($insert) {
		$content .= '<div class=sukses>Data has been update.</div>';
		header ("location: ".referer_decode($_GET['referer'])."");
		exit;
		}
	else {
		$content .= '<div class=error>Data Gagal Di Update<br>'.mysql_error().'</div>';
		if (eregi ($no_induk,mysql_error())) {
			input_alert('no_induk');
		}
		
		
		}
	
}	
	
	
	
	
}

if (!isset ($_POST['submit'])){
$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_periode` WHERE md5(`id`) = '$id'");
$getdata = mysqli_fetch_assoc($query);

$_POST = $getdata;
$mulaix = $getdata['mulai'];
$akhirx = $getdata['akhir'];
$usm = $getdata['usm'];
$tahun = $getdata['tahun'];
$reg = $getdata['reg'];
$berkas = $getdata['berkas'];

$mulaix2 = $getdata['mulai2'];
$akhirx2 = $getdata['akhir2'];
$mulaix3 = $getdata['mulai3'];
$akhirx3 = $getdata['akhir3'];
}

$mulai = date('Y');
$akhir = $mulai-4;
for ($i=$mulai; $i>$akhir; $i--) {
	$cl = ($i == $p) ? "selected" : "";
	$opsi .= "<option value=\"$i\" $cl>$i</option>";
	}
$content .= '
<form method="POST" action="" enctype="multipart/form-data" name="input_jabatan">
<table width=100%>

<tr>
<td>Tahun PMB</td>
<td>:</td>
<td><select name="tahun">
<option value="'.$tahun.'">'.$tahun.'</option>
'.$opsi.'

</select></td>
</tr>


<tr><td><br/><b>Periode 1</b></td><td></td><td></td></tr>
<tr><td>Tanggal Mulai</td><td>:</td><td><input type="text" name="mulai" class="tcal date required" id="" value="'.$mulaix.'"></td></tr>
<tr><td>Tanggal Akhir</td><td>:</td><td><input type="text" name="akhir" class="tcal date required" id="" value="'.$akhirx.'"></td></tr>

<tr><td><br/><b>Periode 2</b></td><td></td><td></td></tr>
<tr><td>Tanggal Mulai</td><td>:</td><td><input type="text" name="mulai2" class="tcal date required" id="" value="'.$mulaix2.'"></td></tr>
<tr><td>Tanggal Akhir</td><td>:</td><td><input type="text" name="akhir2" class="tcal date required" id="" value="'.$akhirx2.'"></td></tr>

<tr><td><br/><b>Periode 3</b></td><td></td><td></td></tr>
<tr><td>Tanggal Mulai</td><td>:</td><td><input type="text" name="mulai3" class="tcal date required" id="" value="'.$mulaix3.'"></td></tr>
<tr><td>Tanggal Akhir</td><td>:</td><td><input type="text" name="akhir3" class="tcal date required" id="" value="'.$akhirx3.'"></td></tr>




<tr><td><br/>Tanggal Pemberkasan</td><td><br/>:</td><td><br/><input type="text" name="berkas" class="tcal date required" id="" value="'.$berkas.'"></td></tr>
<tr><td>Tanggal USM</td><td>:</td><td><input type="text" name="usm" class="tcal date required" id="" value="'.$usm.'"></td></tr>
<tr><td>Tanggal Registrasi</td><td>:</td><td><input type="text" name="reg" class="tcal date required" id="" value="'.$reg.'"></td></tr>

<tr>
<td>Nilai Minimal Lulus USM</td>
<td>:</td>
<td>'.input_text ('nilaimin',@$_POST['nilaimin']).'</td>
</tr>
<tr>
<td>Biaya Pendaftaran</td>
<td>:</td>
<td>'.input_text ('biaya',@$_POST['biaya']).'</td>
</tr>
<tr>
<td></td>
<td></td>
<td><input type="submit" name="submit" value="Edit"></td>
</tr>

</table>
</form>
';

}

break;	
	
	
	
	
default:

if (isset ($_POST['deleted'])){
	if (is_array (@$_POST['delete'])){
	foreach ($_POST['delete'] as $k=>$v){
		$query = $koneksi_db->sql_query ("DELETE FROM `mod_data_periode` WHERE md5(`id`)='$v'");
	}
	}
	
}



$query_add = '';
if (isset ($_GET['str']) && !empty($_GET['str'])){
	$str = substr($_GET['str'],0,1);
$query_add .= "WHERE LEFT (`nama`,1) = '$str'";
}







$num = $koneksi_db->sql_query("SELECT `id` FROM `mod_data_periode` $query_add");
$jumlah = $koneksi_db->sql_numrows ($num);
//mysqli_free_result ($num);

$limit = 20;
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
  
 
$str_abjad = array ('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
$gabung_str = '| ';
foreach ($str_abjad AS $k=>$v){
	if ($_GET['str'] == $v){
	$gabung_str .= '<b>'.$v.'</b> | ';		
	}else {
	$gabung_str .= '<a href="'.basename($_SERVER['PHP_SELF']).'?'.$qs.'&amp;str='.$v.'">'.$v.'</a> | ';	
	}
} 






  
$content .= <<<js
<script language="javascript">
all_checked = true;
function checkall(formName, boxName) {
	for(i = 0; i < document.getElementById(formName).elements.length; i++)
	{
		var formElement = document.getElementById(formName).elements[i];
		if(formElement.type == 'checkbox' && formElement.name == boxName && formElement.disabled == false)
		{
			formElement.checked = all_checked;
		}
	}	
all_checked = all_checked ? false : true;
}
</script>


js;

$referer = referer_encode();
$content .= '<form method="POST" action="" id="namaform">
<div class="table-responsive">
<table class="table table-hover">';

$content .= '<tr>


<td>Tahun PMB</td>
	<td>Nilai Min. Lulus USM</td>
<td>Mulai</td>
<td>Pemberkasan</td>
<td>USM</td>
<td>Biaya</td>
	<td>Edit</td>

</tr>';



$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_periode` $query_add ORDER By `id` ASC LIMIT $offset, $limit");



$warna = null;
while ($data = $koneksi_db->sql_fetchrow($query)){
if (!isset($warna)) $warna = 'style="background:#f9f9f9"';
else $warna = null;	
$no ++;
$id = md5($data['id']);
$content .= '<tr>

<td>'.$data['tahun'].'</td>
<td>'.$data['nilaimin'].'</td>
<td>'.datetimess($data['mulai']).' <br/>s/d<br/>'.datetimess($data['akhir']).'</td>
<td>'.datetimess($data['berkas']).'</td>
<td>'.datetimess($data['usm']).'</td>
<td>'.matauang($data['biaya']).'</td>
	<td><a href="admin.php?pilih=periode&amp;modul=yes&amp;action=edit&amp;id='.$id.'&amp;referer='.$referer.'">Edit</a></td>

	
</tr>';
}


$content .= '</table></div>';


$content .= '<p align=center>';
$content .= $a-> getPaging($jumlah, $_GET['pg'], $_GET['stg']);
$content .= '</p>';




break;	

}














/////////////
echo $content;

?> 

<script src="js/bootstrap-datepicker2.js"></script>
<script>
$(function(){
	$(".tcal").datepicker({
	format:'yyyy-mm-dd'
	});
 });
</script>

