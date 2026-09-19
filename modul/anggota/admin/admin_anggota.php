<h4>
Data Anggota
</h4>

<link rel="stylesheet" href="css/bootstrap-datepicker.css" type="text/css" />
  <script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#propinsi5").change(function(){
    var propinsi5 = $("#propinsi5").val();
    $.ajax({
        url: "ambilkota5.php",
        data: "propinsi5="+propinsi5,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota5").html(msg);
        }
    });
  });
  $("#kota5").change(function(){
    var kota5 = $("#kota5").val();
    $.ajax({
        url: "ambilkecamatan5.php",
        data: "kota5="+kota5,
        cache: false,
        success: function(msg){
            $("#kec5").html(msg);
        }
    });
  });
    $("#kec5").change(function(){
    var kec5 = $("#kec5").val();
    $.ajax({
        url: "ambildesa5.php",
        data: "kec5="+kec5,
        cache: false,
        success: function(msg){
            $("#desa5").html(msg);
        }
    });
  });
});

</script> 

  <a href="admin.php?pilih=anggota&amp;modul=yes">List Data</a> | 
  <a href="admin.php?pilih=anggota&amp;modul=yes&amp;action=add">Add Data</a> |
  <a href="admin.php?pilih=anggota&amp;modul=yes&amp;action=cari">Cari Data</a>  | 
  <a href="admin.php?pilih=anggota&amp;modul=yes&amp;action=import">Import Data</a> | 
    <a href="excel.php">Export Data</a> 
  
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



switch (@$_GET['action']){


	
	
	
	
	
		
	
case 'cari':


$_GET['field'] = !isset ($_GET['field']) ? 'nama' : $_GET['field'];



$content .= '
<form method="GET" action="">
<table border=0>
<tr>
<td>&nbsp;&nbsp;&nbsp;Cari </td><td>:&nbsp;&nbsp;&nbsp;</td><td>'.input_text ('search',@$_GET['search'],$type='text',$size=33,$opt='').'</td>
</tr>
<tr>
<td></td><td></td><td><input type="submit" name="submit" value="Search"></td>
</tr>
</table>
<input type="hidden" name="pilih" value="anggota" />
<input type="hidden" name="modul" value="yes" />
<input type="hidden" name="action" value="cari" />

</form>
<br>
';
 

$filter_field = array ('nama');
if (!empty ($_GET['search']) && !empty($_GET['field']) && in_array ($_GET['field'],$filter_field)){
$search = cleantext($_GET['search']);
$field = cleantext($_GET['field']);

$SQLOPERATOR = "LIKE '%$search%'";
if ($field == 'gaji_tamat'){
	$SQLOPERATOR = "= '$search'";
}

$query_add = "WHERE `$field` $SQLOPERATOR";

if (isset ($_POST['deleted'])){
	if (is_array (@$_POST['delete'])){
	foreach ($_POST['delete'] as $k=>$v){
			$query = $koneksi_db->sql_query ("DELETE FROM `pengguna` WHERE `user`='$v'");
		$query2 = $koneksi_db->sql_query ("DELETE FROM `pengguna` WHERE `user`='$v'");
	}
	}
	
}


$SORT_SQL = '';
$filter_field = array ('nama');
if (isset ($_GET['sort']) && !empty($_GET['sort']) && in_array ($_GET['order'],$filter_field)){
	$sort = $_GET['sort'];
	$order = $_GET['order'];
	if ($sort == 'asc') $sortSQL = 'ASC';
	else if ($sort == 'dsc') $sortSQL = 'DESC';
	
$SORT_SQL = "ORDER BY `$order` $sortSQL";
}


$num = $koneksi_db->sql_query("SELECT `UserId` FROM `pengguna` $query_add AND level='User'");
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
	<th>No.</td>
<th>Kode</th>
<th>Nama</th>
<th>KTP</th>
<th>Saldo</th>
	<th>Edit</th>
	<th><a href="javascript:checkall(\'namaform\', \'delete[]\');">Delete</a></th>
</tr>';




$query = $koneksi_db->sql_query ("SELECT * FROM `pengguna` $query_add AND level='User' ORDER By `UserId` DESC LIMIT $offset, $limit");



$warna = null;
while ($data = $koneksi_db->sql_fetchrow($query)){
if (!isset($warna)) $warna = 'style="background:#f9f9f9"';
else $warna = null;	
$no ++;
$id = md5($data['UserId']);
$gaji = $data['gaji'];
$prop1xy2= $koneksi_db->sql_query("SELECT * FROM mod_data_gaji WHERE id='$gaji'");
while($pr1xy2=$koneksi_db->sql_fetchrow($prop1xy2)){
$namakat2 = $pr1xy2['nama'];
}

$user = $data['user'];
$result = $koneksi_db->sql_query('SELECT SUM(masuk) AS value_sum FROM mod_data_transaksi WHERE kode="'.$user.'"'); 
$row = $koneksi_db->sql_fetchrow($result); 
$sum = $row['value_sum'];


$result2 = $koneksi_db->sql_query('SELECT SUM(keluar) AS value_sum FROM mod_data_transaksi WHERE kode="'.$user.'"'); 
$row2 = $koneksi_db->sql_fetchrow($result2); 
$sum2= $row2['value_sum'];

$sum3 = $sum - $sum2;



$content .= '<tr>
	<td>'.$no.'</td>
<td>'.$data['user'].' </td>
<td>'.$data['nama'].'</td>
<td><a href="images/ktp/'.$data['foto'].'">Download</a></td>
<td>Rp. '.matauang($sum3).'</td>

	<td><a href="admin.php?pilih=anggota&amp;modul=yes&amp;action=edit&amp;id='.$id.'&amp;referer='.$referer.'">Edit</a></td>
	<td><input type="checkbox" name="delete[]" value="'.$data['user'].'" style="border:0px"></td>
	
</tr>';
}


$content .= '<tr><td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
    <td><input type="submit" name="deleted" value="Delete" onclick="return confirm (\'Do You Want to Delete the Data\')"></td>
  </tr>';  

$content .= '</table></div>';



$content .= '<p align=center>';
$content .= $a-> getPaging($jumlah, $_GET['pg'], $_GET['stg']);
$content .= '</p>';

	
	
}







break;	
	
	

		
	
case 'add':



$datawajibdiisi = array ('nama');

if (isset ($_POST['submit'])){
	
	
$error = '';	
	
foreach ($datawajibdiisi as $k=>$v){
	
	if (empty ($_POST[$v])){
		input_alert($v);
		$error .= '- Error at Form : '.$v.'<br />';
	}
}


$user = cleantext($_POST['user']);
$password = md5($user);

$nama = cleantext($_POST['nama']);

if ($error != ''){
	$content .= '<div class=error>'.$error.'</div>';
}else {

   
    		$insert = $koneksi_db->sql_query ("INSERT INTO `pengguna` (`nama`,`alamat`,`telp`,`level`,`user`,`password`) VALUES ('$nama','$alamat','$telp','User','$user','$password')");
	if ($insert) {
		


		$content .= '<div class=sukses>Data has been insert.</div>';
		}
	else {
		$content .= '<div class=error>Data Gagal Dimasukkan<br>'.mysql_error().'</div>';
		if (eregi ($no_induk,mysql_error())) {
			input_alert('no_induk');
		}
		}
		
		
	
}	
	
	
	
	
}



$content .= '
<form method="POST" action="" enctype="multipart/form-data" name="input_gaji">
<table width=100%>
<tr>
<td>Kode</td>
<td>:</td>
<td>'.input_text ('user',@$_POST['user']).'</td>
</tr>

<tr>
<td>Nama</td>
<td>:</td>
<td>'.input_text ('nama',@$_POST['nama']).'</td>
</tr>






<tr>
<td></td>
<td></td>
<td><input type="submit" name="submit" value="Tambah"></td>
</tr>

</table>
</form>
';



break;	
	
	
	
case 'edit':


$id = $_GET['id'];
if (!empty ($_GET['id'])){

$datawajibdiisi = array ('nama');

if (isset ($_POST['submit'])){
	
	
$error = '';	
	
foreach ($datawajibdiisi as $k=>$v){
	
	if (empty ($_POST[$v])){
		input_alert($v);
		$error .= '<li>Error In Form Filling : '.$v.'</li>';
	}
}
$telp = cleantext($_POST['telp']);
$nama = cleantext($_POST['nama']);
$sim = cleantext($_POST['sim']);
$nomor = cleantext($_POST['nomor']);
$alias = cleantext($_POST['alias']);
$kelamin = cleantext($_POST['kelamin']);
$tempat = cleantext($_POST['tempat']);
$lahir = cleantext($_POST['lahir']);
$ibu = cleantext($_POST['ibu']);
$prov = cleantext($_POST['prov']);
$kab = cleantext($_POST['kab']);
$kec = cleantext($_POST['kec']);
$kel = cleantext($_POST['kel']);
$kerja = cleantext($_POST['kerja']);
$pend = cleantext($_POST['pend']);
$lokasi = cleantext($_POST['lokasi']);
$lokasiu = cleantext($_POST['lokasiu']);
$statusp = cleantext($_POST['statusp']);
$pendapatan = cleantext($_POST['pendapatan']);
$statusd = cleantext($_POST['statusd']);
$nomora = cleantext($_POST['nomora']);
$biayap = cleantext($_POST['biayap']);
$biayaw = cleantext($_POST['biayaw']);
$biayapk = cleantext($_POST['biayapk']);
$biayaks = cleantext($_POST['biayaks']);
$wadi = cleantext($_POST['wadi']);
$lain = cleantext($_POST['lain']);
$tabj = cleantext($_POST['tabj']);
$tabp = cleantext($_POST['tabp']);
$tabl = cleantext($_POST['tabl']);
$tabw = cleantext($_POST['tabw']);
$alamat = cleantext($_POST['alamat']);


	
if ($error != ''){
	$content .= '<div class=error>'.$error.'</div>';
}else {
	$insert = $koneksi_db->sql_query ("UPDATE `pengguna` SET `nama`='$nama',`sim`='$sim',`telp`='$telp',
`nomor`='$nomor',
`alias`='$alias',
`kelamin`='$kelamin',
`tempat`='$tempat',
`lahir`='$lahir',
`ibu`='$ibu',
`prov`='$prov',
`kab`='$kab',
`kec`='$kec',
`kel`='$kel',
`kerja`='$kerja',
`pend`='$pend',
`lokasi`='$lokasi',
`lokasiu`='$lokasiu',
`statusp`='$statusp',
`pendapatan`='$pendapatan',
`statusd`='$statusd',
`nomora`='$nomora',
`biayap`='$biayap',
`biayaw`='$biayaw',
`biayapk`='$biayapk',
`biayaks`='$biayaks',
`wadi`='$wadi',
`lain`='$lain',
`tabj`='$tabj',
`tabp`='$tabp',
`tabl`='$tabl',
`tabw`='$tabw',
`alamat`='$alamat' WHERE md5(`UserId`) = '$id'");
	if ($insert) {
		$content .= '<div class=sukses>Data berhasil diubah.</div>';
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
$query = $koneksi_db->sql_query ("SELECT * FROM `pengguna` WHERE md5(`UserId`) = '$id'");
$getdata = mysqli_fetch_assoc($query);

$_POST = $getdata;
$biayap = $getdata['biayap'];
	$biayaw = $getdata['biayaw'];
	$biayapk = $getdata['biayapk'];
	$biayaks = $getdata['biayaks'];
	$wadi = $getdata['wadi'];
	$pend = $getdata['pend'];
	$kerja = $getdata['kerja'];
	$kelamin = $getdata['kelamin'];
	$sim = $getdata['sim'];
	$prov = $getdata['prov'];
$kab = $getdata['kab'];
$kec = $getdata['kec'];
$kel = $getdata['kel'];
$lahir = $getdata['lahir'];
$statusd = $getdata['statusd'];
$statusp = $getdata['statusp'];
$pendapatan = $getdata['pendapatan'];
}



$propinsi5 = $koneksi_db->sql_query("SELECT * FROM provinsi ORDER BY id ASC");
while($p11=$koneksi_db->sql_fetchrow($propinsi5)){
$kode1 = $p11['id'];
	$nama1 = $p11['nama_provinsi'];
$asal44 .= '<option value="'.$kode1.'">'.$nama1.'</option>';
}

$k2 = $koneksi_db->sql_query("SELECT * FROM provinsi WHERE id='$prov'");
while($kk2=$koneksi_db->sql_fetchrow($k2)){
$idk2 = $kk2['id'];
	$namak2 = $kk2['nama_provinsi'];
}

$k3 = $koneksi_db->sql_query("SELECT * FROM kabkota WHERE id='$kab'");
while($kk3=$koneksi_db->sql_fetchrow($k3)){
$idk3 = $kk3['id'];
	$namak3 = $kk3['nama_kabkota'];
}

$k4 = $koneksi_db->sql_query("SELECT * FROM kecamatan WHERE id='$kec'");
while($kk4=$koneksi_db->sql_fetchrow($k4)){
$idk4 = $kk4['id'];
	$namak4 = $kk4['nama_kecamatan'];
}

$k5 = $koneksi_db->sql_query("SELECT * FROM kelurahan WHERE id='$kel'");
while($kk5=$koneksi_db->sql_fetchrow($k5)){
$idk5 = $kk5['id'];
	$namak5 = $kk5['nama_kelurahan'];
}



$content .= '
<form method="POST" action="" enctype="multipart/form-data" name="input_gaji">
<table width=100%>



<tr><td>Jenis Identitas</td><td>:</td><td><select name="sim" required>
			<option value="'.$sim.'">'.$sim.'</option>
			<option value="KTP">KTP</option>
			<option value="SIM">SIM</option>
			</select></td></tr>
			
			
			<tr>
<td>Nomor Identitas</td>
<td>:</td>
<td>'.input_text ('nomor',@$_POST['nomor']).'</td>
</tr>

<tr>
<td>Nama</td>
<td>:</td>
<td>'.input_text ('nama',@$_POST['nama']).'</td>
</tr>

<tr>
<td>Alias</td>
<td>:</td>
<td>'.input_text ('alias',@$_POST['alias']).'</td>
</tr>



<tr><td>Jenis Kelamin</td><td>:</td><td><select name="kelamin" required>
			<option value="'.$kelamin.'">'.$kelamin.'</option>
			<option value="Laki-laki">Laki-laki</option>
			<option value="Perempuan">Perempuan</option>
			</select></td></tr>



			<tr>
<td>Tempat Lahir</td>
<td>:</td>
<td>'.input_text ('tempat',@$_POST['tempat']).'</td>
</tr>
			
<tr><td>Tanggal Lahir</td><td>:</td><td><input type="text" name="lahir" class="tcal date required" id="" value="'.$lahir.'" ></td></tr>
			
			
			
	<tr>
<td>Ibu Kandung</td>
<td>:</td>
<td>'.input_text ('ibu',@$_POST['ibu']).'</td>
</tr>
		



<tr>
<td>Provinsi</td>
<td>:</td>
<td><select name="prov" id="propinsi5">
<option value="'.$idk2.'">'.$namak2.'</option>
'.$asal44.'
</select></td>
</tr>
<tr>
<td>Kota/Kabupaten</td>
<td>:</td>
<td><select name="kab" id="kota5">
<option value="'.$idk3.'">'.$namak3.'</option>'
;
//mengambil nama-nama propinsi yang ada di database
$kota5 = $koneksi_db->sql_query("SELECT * FROM kabkota ORDER BY id ASC");
while($p=$koneksi_db->sql_fetchrow($propinsi5)){
echo "<option value=\"$p[id_kabkot]\">$p[nama_kabkot]</option>\n";
}
$content .= '
</select>

</td>
</tr>



<tr>
<td>Kecamatan</td>
<td>:</td>
<td><select name="kec" id="kec5">
<option value="'.$idk4.'">'.$namak4.'</option>'
;
//mengambil nama-nama propinsi yang ada di database
$kec5 = $koneksi_db->sql_query("SELECT * FROM kecamatan ORDER BY id");
while($p5=$koneksi_db->sql_fetchrow($kota5)){

}
$content .= '
</select>

</td>
</tr>
<tr>
<td>Kelurahan</td>
<td>:</td>
<td><select name="kel" id="desa5">
<option value="'.$idk5.'">'.$namak5.'</option>'
;
//mengambil nama-nama propinsi yang ada di database
$desa5 = $koneksi_db->sql_query("SELECT * FROM kelurahan ORDER BY id");
while($p5=$koneksi_db->sql_fetchrow($kec5)){

}
$content .= '
</select>

</td>
</tr>

<tr>
<td>Alamat</td>
<td>:</td>
<td>'.input_text ('alamat',@$_POST['alamat']).'</td>
</tr>

<tr>
<td>No. Telp</td>
<td>:</td>
<td>'.input_text ('telp',@$_POST['telp']).'</td>
</tr>









<tr><td>Pekerjaan</td><td>:</td><td><select name="kerja" required>
			<option value="'.$kerja.'">'.$kerja.'</option>
			<option value="PNS">PNS </option>
		<option value="TNI/POLRI">TNI/POLRI</option>
			<option value="Wiraswasta">Wiraswasta</option>
			<option value="Karyawan">Karyawan</option>
				<option value="Lainnya">Lainnya</option>	
				
				
			</select></td></tr>



<tr><td>Pendidikan</td><td>:</td><td><select name="pend" required>
			<option value="'.$pend.'">'.$pend.'</option>
			<option value="SD">SD </option>
			<option value="SMP">SMP </option>
				<option value="SMA/SMK">SMA/SMK </option>
					<option value="D3">D3 </option>
						<option value="S1">S1 </option>
							<option value="S2">S2 </option>
			</select></td></tr>


<tr>
<td>Lokasi Nasabah</td>
<td>:</td>
<td>'.input_text ('lokasi',@$_POST['lokasi']).'</td>
</tr>

<tr>
<td>Lokasi Usaha</td>
<td>:</td>
<td>'.input_text ('lokasiu',@$_POST['lokasiu']).'</td>
</tr>

<tr><td>Status Pernikahan</td><td>:</td><td><select name="statusp" required>
			<option value="'.$statusp.'">'.$statusp.'</option>
			<option value="Belum Menikah">Belum Menikah</option>
			<option value="Sudah Menikah">Sudah Menikah</option>
			<option value="Janda/Duda">Janda/Duda</option>
			</select></td></tr>
<tr>
<td>Email</td>
<td>:</td>
<td>'.input_text ('email',@$_POST['email']).'</td>
</tr>

<tr><td>Pendapatan</td><td>:</td><td><select name="pendapatan" required>
			<option value="'.$pendapatan.'">'.$pendapatan.'</option>
			<option value="< Rp. 3 Juta">< Rp. 3 Juta</option>
			<option value="Rp. 3 Juta - Rp. 5 Juta">Rp. 3 Juta - Rp. 5 Juta</option>
			<option value="> Rp. 5 Juta">> Rp. 5 Juta</option>
			</select></td></tr>



<tr><td>Apakah Anda Sudah Terdaftar Anggota</td><td>:</td><td><select name="statusd" required>
			<option value="'.$statusd.'">'.$statusd.'</option>
			<option value="Ya">Ya</option>
			<option value="Tidak">Tidak</option>
			</select></td></tr>


<tr>
<td>Isi Nomor Anggota Jika Ya</td>
<td>:</td>
<td>'.input_text ('nomora',@$_POST['nomora']).'</td>
</tr>




<tr>
<td><br/><b>Biaya Registrasi</b></td>
<td></td>
<td></td>
</tr>

<tr>
<td>Simpanan Pokok KS Ummat Karawang</td>
<td>:</td>
<td><input type="text" name="biayap" value="'.$biayap.'"></td>
</tr>
<tr>
<td>Simpanan Wajib KS Ummat Karawang</td>
<td>:</td>
<td><input type="text" name="biayaw" value="'.$biayaw.'"></td>
</tr>

<tr>
<td>Simpanan Pokok KS 212</td>
<td>:</td>
<td><input type="text" name="biayapk" value="'.$biayapk.'"></td>
</tr>

<tr>
<td>Simpanan Wajib KS 212</td>
<td>:</td>
<td><input type="text" name="biayaks" value="'.$biayaks.'"></td>
</tr>

<tr>
<td>Wadi ah</td>
<td>:</td>
<td><input type="text" name="wadi" value="'.$wadi.'"></td>
</tr>

<tr>
<td>Lain-lain</td>
<td>:</td>
<td>'.input_text ('lain',@$_POST['lain']).'</td>
</tr>



<tr>
<td><br/><b>Tabungan Investasi</b></td>
<td></td>
<td></td>
</tr>

<tr>
<td>Jaringan Mini Market 212 Mart</td>
<td>:</td>
<td>'.input_text ('tabj',@$_POST['tabj']).'</td>
</tr>

<tr>
<td>Properti Syariah</td>
<td>:</td>
<td>'.input_text ('tabp',@$_POST['tabp']).'</td>
</tr>

<tr>
<td>Lembaga Keuangan Syariah</td>
<td>:</td>
<td>'.input_text ('tabl',@$_POST['tabl']).'</td>
</tr>

<tr>
<td>Wakaf</td>
<td>:</td>
<td>'.input_text ('tabw',@$_POST['tabw']).'</td>
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
		$query2 = $koneksi_db->sql_query ("DELETE FROM `pengguna` WHERE `user`='$v'");
	}
	}
	
}


$num = $koneksi_db->sql_query("SELECT `UserId` FROM `pengguna` WHERE level='User' $query_add");
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
	<th>No.</td>
<th>Kode</th>
<th>Nama</th>
<th>KTP</th>
<th>Saldo</th>
	<th>Edit</th>
	<th><a href="javascript:checkall(\'namaform\', \'delete[]\');">Delete</a></th>
</tr>';



$query = $koneksi_db->sql_query ("SELECT * FROM `pengguna` WHERE level='User' $query_add ORDER By `UserId` DESC LIMIT $offset, $limit");



$warna = null;
while ($data = $koneksi_db->sql_fetchrow($query)){
if (!isset($warna)) $warna = 'style="background:#f9f9f9"';
else $warna = null;	
$no ++;
$id = md5($data['UserId']);
$gaji = $data['gaji'];
$prop1xy2= $koneksi_db->sql_query("SELECT * FROM mod_data_gaji WHERE id='$gaji'");
while($pr1xy2=$koneksi_db->sql_fetchrow($prop1xy2)){
$namakat2 = $pr1xy2['nama'];
}

$user = $data['user'];
$result = $koneksi_db->sql_query('SELECT SUM(masuk) AS value_sum FROM mod_data_transaksi WHERE kode="'.$user.'"'); 
$row = $koneksi_db->sql_fetchrow($result); 
$sum = $row['value_sum'];


$result2 = $koneksi_db->sql_query('SELECT SUM(keluar) AS value_sum FROM mod_data_transaksi WHERE kode="'.$user.'"'); 
$row2 = $koneksi_db->sql_fetchrow($result2); 
$sum2= $row2['value_sum'];

$sum3 = $sum - $sum2;



$content .= '<tr>
	<td>'.$no.'</td>
<td>'.$data['user'].' </td>
<td>'.$data['nama'].'</td>
<td><a href="images/ktp/'.$data['foto'].'">Download</a></td>
<td>Rp. '.matauang($sum3).'</td>

	<td><a href="admin.php?pilih=anggota&amp;modul=yes&amp;action=edit&amp;id='.$id.'&amp;referer='.$referer.'">Edit</a></td>
	<td><input type="checkbox" name="delete[]" value="'.$data['user'].'" style="border:0px"></td>
	
</tr>';
}


$content .= '<tr><td>&nbsp;</td>

<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
    <td><input type="submit" name="deleted" value="Delete" onclick="return confirm (\'Do You Want to Delete the Data\')"></td>
  </tr>';  

$content .= '</table></div>';


$content .= '<p align=center>';
$content .= $a-> getPaging($jumlah, $_GET['pg'], $_GET['stg']);
$content .= '</p>';




break;	



case 'import':
$content .= '
<form method="POST" action="admin.php?pilih=excelanggota&modul=yes" enctype="multipart/form-data" name="input_siswa">
<input name="userfile" type="file" />
<input name="upload" type="submit" value="Import" class="button red" /> <a href="simpan/anggota.xls">Format Excel ?</a>
</form>';
break;	



}














/////////////
echo $content;

?> <script src="js/bootstrap-datepicker2.js"></script>
<script>
$(function(){
	$(".tcal").datepicker({
	format:'yyyy-mm-dd'
	});
 });
</script>