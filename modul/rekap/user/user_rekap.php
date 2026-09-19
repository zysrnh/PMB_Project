<?php



$index_hal = 1;

include 'modul/functions.php';
?>
<h4>
Data Laporan
</h4>
  <script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<link rel="stylesheet" href="css/bootstrap-datepicker.css" type="text/css" />
 <script src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
        </script>

        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#example2').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
        </script>
  
  
<link rel="stylesheet" media="screen" href="modul/client/css/client.css" />
<style type="text/css">
#tabel {
padding:0px;
}

#tabel tr.head {
height:20px;
background:#;
}
#tabel tr.head td{
	border-right: 1px solid #d1d1d1;
	border-bottom: 1px solid #d1d1d1;
	border-top: 1px solid #d1d1d1;
	background: #;
	padding-top:4px;
	padding-bottom:4px;
	padding-left:8px;
	padding-right:8px;
	color: #4f6b72;
	font-weight:bold;
}
#tabel tr.head td.depan, tr.isi td.depan{
border-left: 1px solid #d1d1d1;
}
#tabel tr.isi td{
border-right: 1px solid #d1d1d1;
	border-bottom: 1px solid #d1d1d1;
	padding-top:4px;
	padding-bottom:4px;
	padding-left:8px;
	padding-right:8px;
	color: #4f6b72;
}
.table_border_bottom{
border-bottom: 1px solid #d1d1d1;	
}

</style>



<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script> <?php
  
global $koneksi_db; 
if (isset($_POST[daritgl])) {
$_SESSION[daritgl] = $_POST[daritgl];
} else {
$_SESSION[daritgl] = $_SESSION[daritgl];
}

if (isset($_POST[sampaitgl])) {
$_SESSION[sampaitgl] = $_POST[sampaitgl];
} else {
$_SESSION[sampaitgl] = $_SESSION[sampaitgl];
}


$daritgl = !empty($_SESSION[daritgl]) ? $_SESSION[daritgl] : '';
$sampaitgl = !empty($_SESSION[sampaitgl]) ? $_SESSION[sampaitgl] : '';

echo rentangTGL($daritgl, $sampaitgl);






$referer = referer_encode();
echo '<form method="POST" action="" id="namaform">
<div class="table-responsive">
<table class="table table-hover">';

echo '<tr><td>No.</td>
<th>Tanggal</th>
<th>Kode</th>
<th>Nama</th>

<th>Debit</th>
<th>Kredit</th>
</tr>';
$user = $_SESSION['UserName'];

$whr = array();
$whr[] = "tanggal >= '$daritgl' "; 
$whr[] = "tanggal <= '$sampaitgl'  "; 
$whr[] = "kode = '$user'  "; 
if (!empty($whr)) $strwhr = "where " .implode(' and ', $whr);

$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_transaksi` $strwhr  ORDER BY `id` ASC");
$jumlah = @$koneksi_db->sql_numrows ($query);
if ($jumlah > 0) {
while ($data = @mysqli_fetch_assoc($query)){
$no++;


$id = md5($data['id']);




$total = $total + $data['masuk'];
$total2 = $total2 + $data['keluar'];






echo '<tr class=isi '.$warna.'>
<td valign=top>'.$no.'.</td>
<td>'.datetimess($data['tanggal']).'</td>
<td>'.$data['kode'].' </td>
<td>'.$data['nama'].'</td>

<td>Rp. '.matauang($data['masuk']).'</td>
<td>Rp. '.matauang($data['keluar']).'</td>

		


	
</tr>';

}

echo '<tr>
<td colspan=4>Total</td>
     <td>Rp. '.matauang($total).'</td>
 <td>Rp. '.matauang($total2).'</td>
  </tr>'; 
  
 
 } else {
 echo '<tr><td colsapn=5> Tidak ada Transaksi</td></tr>';
 }

echo '</table></div>';
	






















?>

<script>
$(function(){
	$(".tcal").datepicker({
	format:'yyyy-mm-dd'
	});
 });
</script>
