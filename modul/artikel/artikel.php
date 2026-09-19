<?php


if (!defined('cms-KOMPONEN')) {
    Header("Location: ../index.php");
    exit;
}





$ikon_2 = '';
$ikon_3 = '';

$index_hal=1;

$_GET['aksi'] = !isset($_GET['aksi']) ? null : $_GET['aksi'];
$_GET['id'] = !isset($_GET['id']) ? null : int_filter($_GET['id']);

$tengah = '';

if($_GET['aksi']==""){
        $tengah.='<div class="element-size-67"><div class="cs-campunews custom-fig col-md-12"><div class="error">Harus sesuai prosedur.</div>';
        $tengah .='<meta http-equiv="refresh" content="3; url=">';
}

if($_GET['aksi']=="lihat"){

$id = int_filter($_GET['id']);

if (file_exists("gambar/6.gif")){
    $ikon_2 = "<img src=\"gambar/6.gif\" alt=\"\" border=\"0\" />";
}
if (file_exists("gambar/7.gif")){
    $ikon_3 = "<img src=\"gambar/7.gif\" alt=\"\" border=\"0\" />";
}

$hasil  = $koneksi_db->sql_query("SELECT * FROM artikel WHERE id='$id' AND publikasi=1");

$data = $koneksi_db->sql_fetchrow($hasil);

$judulnya = $data['judul'];
$topik = $data['topik'];
$tagx = $data['tags'];
$tgll = $data['tgl'];
$gambar = $data['gambar'];
$hits = $data['hits'];
$hitx = ''.$data['hits'].' view';
$link = $data['link'];
$kont = $data['konten'];
$urlkonten=str_replace(" ", "-", $judulnya);
$urltgl=str_replace("-", "/", $data['tgl']);
$meta = $data['meta'];

$judul_situs = $data['judul'];
if(!$meta)
{
	$_META['description'] = limittxt(htmlentities(strip_tags($data['konten'])),140);
} else {
	$_META['description'] = $meta;
	
}
$_META['keywords'] = empty($data['tags']) ? implode(',',explode(' ',htmlentities(strip_tags($data['judul'])))) : $data['tags'];






$hits = $hits +1;
$updatehits = $koneksi_db->sql_query("UPDATE artikel SET hits='$hits' WHERE id='$id'");

$titlenya = "$data[judul]";

$data[5]=$data['tgl'];
$ket= "$data[5]";
$by = '';





		$isinya .= ''.$data['konten'].'';
		








$isinya .= "<a href=\"cetak.php?id=$data[id]\" title=\"$data[judul]\"><i class='fa fa-print'></i> Versi cetak</a><br/>";








include 'modul/function.php';


$urltagx=str_replace(" ", ",", $judulnya);

if(!$tagx)
	
	{
		
		$hasil = $koneksi_db->sql_query("SELECT tags FROM `artikel` WHERE id='$id' AND publikasi = 1");
$TampungData = array();
	while ($data = $koneksi_db->sql_fetchrow($hasil)) {
		$tags = explode(',',strtolower(trim($urltagx)));
		foreach($tags as $val) {
					$TampungData[] = $val;
					
			}
	}

$totalTags = count($TampungData);
$jumlah_tag = array_count_values($TampungData);
ksort($jumlah_tag);
if ($totalTags > 0) {
$output = array();
$tag_mod = array();
$tag_mod['fontsize']['max'] = 20;
$tag_mod['fontsize']['min'] = 9;

$min_count = min($jumlah_tag);
$spread = max($jumlah_tag) - $min_count;
	if ( $spread <= 0 )
		$spread = 1;
	$font_spread = $tag_mod['fontsize']['max'] - $tag_mod['fontsize']['min'];
	if ( $font_spread <= 0 )
		$font_spread = 1;
	$font_step = $font_spread / $spread;
	
	

foreach($jumlah_tag as $key=>$val) {
$font_size = ( $tag_mod['fontsize']['min'] + ( ( $val - $min_count ) * $font_step ) );
	$output[] = '<a href="tags/'.urlencode($key).'.html" title="'.$val.' artikel"><span>#'.$key .'</span></a>';
}
$isinya .=  implode(', ',$output);
}

	} else {
		
		
		


$hasil = $koneksi_db->sql_query("SELECT tags FROM `artikel` WHERE id='$id' AND publikasi = 1");
$TampungData = array();
	while ($data = $koneksi_db->sql_fetchrow($hasil)) {
		$tags = explode(',',strtolower(trim($data['tags'])));
		foreach($tags as $val) {
					$TampungData[] = $val;
					
			}
	}

$totalTags = count($TampungData);
$jumlah_tag = array_count_values($TampungData);
ksort($jumlah_tag);
if ($totalTags > 0) {
$output = array();
$tag_mod = array();
$tag_mod['fontsize']['max'] = 20;
$tag_mod['fontsize']['min'] = 9;

$min_count = min($jumlah_tag);
$spread = max($jumlah_tag) - $min_count;
	if ( $spread <= 0 )
		$spread = 1;
	$font_spread = $tag_mod['fontsize']['max'] - $tag_mod['fontsize']['min'];
	if ( $font_spread <= 0 )
		$font_spread = 1;
	$font_step = $font_spread / $spread;
	
	

foreach($jumlah_tag as $key=>$val) {
$font_size = ( $tag_mod['fontsize']['min'] + ( ( $val - $min_count ) * $font_step ) );
	$output[] = '<a href="tags/'.urlencode($key).'.html" title="'.$val.' artikel"><span>#'.$key .'</span></a>';
}
$isinya .=  implode(', ',$output);
}




	}








$isinya .= "







";


themenews($id, $titlenya, $ket,  $isinya, datetimess($tgll));


//Artikel Terkait

$query = $koneksi_db->sql_query( "SELECT * FROM topik WHERE id='$topik'" );
//$jumlah = $koneksi_db->sql_numrows($query);
while ($data1 = $koneksi_db->sql_fetchrow($query)) {
    $rubrik=$data1[1];
}
$hitungjumlah = $koneksi_db->sql_query( "SELECT id FROM artikel WHERE id!='$id' AND publikasi=1 and topik='$topik'");
$jumlah = $koneksi_db->sql_numrows($hitungjumlah);
//if($jumlah>1){

$tengah .='<br/><br/><h5>Artikel Terkait</h5>
						
										

';

$tengah .='';
$query2 = $koneksi_db->sql_query( "SELECT id, judul,tgl,gambar,konten,hits FROM artikel WHERE id!='$id' AND publikasi=1 and topik=$topik ORDER BY tgl DESC LIMIT 6" );

while ($data = $koneksi_db->sql_fetchrow($query2)) {
	$url=str_replace(" ", "-", $data[1]);
$id2    = $data[0];
$judul2    = $data[1];
	$gambar2 = $data[8];
$tengah .= '
							
	   
                                                <h5 style="font-size:18px;margin-bottom:0px;">
                                                   <b> <a href="artikel/'.$data[0].'/'.$url.'.html" title="'.$data[1].'">'.$data[1].'</a></b>
                                                </h5> <span><i class="fa fa-calendar"></i> '.datetimess($data['tgl']).'</span>
												<p>'.limitTXT(strip_tags($data['konten']),180).' </p>
								
											
											
											
									
										';
}

$tengah .='
';
//}
//End Artikel Terkait










} //end fuction news

if($_GET['aksi']=="arsip"){

$topik    = int_filter($_GET['topik']);



$hasil = $koneksi_db->sql_query( "SELECT * FROM topik WHERE id=$topik" );
$data = $koneksi_db->sql_fetchrow($hasil);
$rubrik = $data['topik'];
$ket = $data['ket'];
$urlkontenx=str_replace(" ", ", ", $rubrik);
$judul_situs = $data['topik'];
$_META['description'] = ''.$ket.'';
$_META['keywords'] = 'Artikel '.$rubrik.', '.$urlkontenx.'';




$tengah .='
          ';

if (empty ($rubrik)){
 $tengah.='<div class="error">Halaman tidak tersedia.</div>';
        $tengah .='<meta http-equiv="refresh" content="3; url=index.php">';
}else {







$tengah .='
<h4>Kategori '.$rubrik.'</h4>
';

$limit = 10;
$offset = int_filter(@$_GET['offset']);
$pg        = int_filter(@$_GET['pg']);
$stg    = int_filter(@$_GET['stg']);

$totals = $koneksi_db->sql_query( "SELECT id FROM artikel WHERE publikasi=1 AND topik=$topik" );
$jumlah = $koneksi_db->sql_numrows( $totals );
$a = new paging ($limit);
if ($jumlah>0 ){

$hasil = $koneksi_db->sql_query( "SELECT * FROM artikel WHERE publikasi=1 AND topik=$topik ORDER BY id DESC LIMIT $offset, $limit" );

while ($data = $koneksi_db->sql_fetchrow($hasil)) {

$url=str_replace(" ", "-", $data[1]);
	$post   = $data[2];
					$na = catch_that_image($post);
	$user2    = $data[3];

$urltgl=str_replace("-", "/", $data[5]);

$gambar2 = $data['gambar'];
	






$tengah .='
	      <h5 style="font-size:18px;margin-bottom:0px;">
                                                   <b> <a href="artikel/'.$data[0].'/'.$url.'.html" title="'.$data[1].'">'.$data[1].'</a></b>
                                                </h5> <span><i class="fa fa-calendar"></i> '.datetimess($data['tgl']).'</span>
												<p>'.limitTXT(strip_tags($data['konten']),180).' </p>


';

} //end while



$tengah .='';

if($jumlah>10){
$tengah .='<div>';
$tengah.="<center>";
if (empty($_GET['offset']) and !isset ($_GET['offset'])) {
$offset = 0;

}

if (empty($_GET['pg']) and !isset ($_GET['pg'])) {
$pg = 1;
}

if (empty($_GET['stg']) and !isset ($_GET['stg'])) {
$stg = 1;
}
$tengah.= $a-> getPaging6($jumlah, $pg, $stg, $topik, $rubrik);
$tengah.="</center>";
}

} else{
        $tengah.='<div class="error">Artikel tidak tersedia.</div>';
        $style_include[] ='<meta http-equiv="refresh" content="3; url=index.php" />';
}

} //end if kosong

} //end function arsip




echo $tengah;


?>
