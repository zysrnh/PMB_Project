<h4>Data PMB</h4>
 <script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
  <a href="admin.php?pilih=pmb&amp;modul=yes">List Data</a> | 
    <a href="admin.php?pilih=pmb&amp;modul=yes&amp;action=add">Add Data</a> |
  <a href="admin.php?pilih=pmb&amp;modul=yes&amp;action=cari">Cari Data</a>
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
    <script language="JavaScript">
function bukajendela(url) {
 window.open(url, "window_baru", "width=800,height=700,left=120,top=10,resizable=0,scrollbars=1");
}

</script>
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





$prodi = cleantext($_POST['prodi']);
$sumber = cleantext($_POST['sumber']);
$sumber2 = cleantext($_POST['sumber2']);
$oleh = cleantext($_POST['oleh']);
$oleh2 = cleantext($_POST['oleh2']);
$nama = cleantext($_POST['nama']);
$tempat = cleantext($_POST['tempat']);
$lahir = cleantext($_POST['lahir']);
$kelamin = cleantext($_POST['kelamin']);
$nik = cleantext($_POST['nik']);
$agama = cleantext($_POST['agama']);
$telp = cleantext($_POST['telp']);
$email = cleantext($_POST['email']);
$kwn = cleantext($_POST['kwn']);
$jenis = cleantext($_POST['jenis']);
$tanggal = date('Y-m-d');
$prov = cleantext($_POST['prov']);
$kab = cleantext($_POST['kab']);
$kec = cleantext($_POST['kec']);
$kel = cleantext($_POST['kel']);
$alamat = cleantext($_POST['alamat']);
$kps = cleantext($_POST['kps']);
$nokps = cleantext($_POST['nokps']);
$ibu = cleantext($_POST['ibu']);

$lahir2 = str_replace("-", "", $lahir);

$prop1xys= $koneksi_db->sql_query("SELECT * FROM mod_data_jumlah ORDER By id DESC LIMIT 1");
while($pr1xys=$koneksi_db->sql_fetchrow($prop1xys)){
	$idkats = $pr1xys['id'];
}
$prop1xysx= $koneksi_db->sql_query("SELECT * FROM mod_data_periode ORDER By id DESC LIMIT 1");
while($pr1xysx=$koneksi_db->sql_fetchrow($prop1xysx)){
	$idkatsx = $pr1xysx['tahun'];
}


$tahun =$idkatsx;

$nomor = ''.$tahun.''.$idkats.'';
$user = $nomor;
$password = md5($lahir2);




$prop23 = $koneksi_db->sql_query("SELECT * FROM kodepos WHERE kelurahan_id='$kel'");
while($pr23=$koneksi_db->sql_fetchrow($prop23)){
	$nlo = $pr23['no_kodepos'];
}

$kodepos = $nlo;
$rt = cleantext($_POST['rt']);
$rw = cleantext($_POST['rw']);
$sekolah = cleantext($_POST['sekolah']);


if ($error != ''){
	$content .= '<div class=error>'.$error.'</div>';

}else {

   
    
	$insert = $koneksi_db->sql_query ("INSERT INTO `mod_data_pmb` (`nomor`,
`prodi`,
`sumber`,
`sumber2`,
`oleh`,
`oleh2`,
`nama`,
`tempat`,
`lahir`,
`kelamin`,
`nik`,
`agama`,
`telp`,
`email`,
`kwn`,
`jenis`,
`tanggal`,
`prov`,
`kab`,
`kec`,
`kel`,`kodepos`,`rt`,`rw`,`alamat`,
`kps`,
`nokps`,
`ibu`,`sekolah`) VALUES ('$nomor',
'$prodi',
'$sumber',
'$sumber2',
'$oleh',
'$oleh2',
'$nama',
'$tempat',
'$lahir',
'$kelamin',
'$nik',
'$agama',
'$telp',
'$email',
'$kwn',
'$jenis',
'$tanggal',
'$prov',
'$kab',
'$kec',
'$kel','$kodepos','$rt','$rw','$alamat',
'$kps',
'$nokps',
'$ibu','$sekolah')");
	if ($insert) {
		
		
				$insert3s = $koneksi_db->sql_query ("INSERT INTO `mod_data_jumlah` (`nama`) VALUES ('1')");
		$insert2 = $koneksi_db->sql_query ("INSERT INTO `pengguna` (`nama`,`alamat`,`telp`,`email`,`user`,`password`) VALUES ('$nama','$kel','$telp','$email','$user','$password')");
		
		
				
$propinsi12xx = $koneksi_db->sql_query("SELECT * FROM mod_data_profil WHERE id='1'");
while($p11xx=$koneksi_db->sql_fetchrow($propinsi12xx)){
	$namak = $p11xx['nama'];
$telpx = $p11xx['telp'];
$emailx = $p11xx['email'];
$alamatx = $p11xx['alamat'];
}		
		
		
$propinsi12xx2 = $koneksi_db->sql_query("SELECT * FROM mod_data_periode WHERE id='1'");
while($p11xx2=$koneksi_db->sql_fetchrow($propinsi12xx2)){
	$berkas = $p11xx2['berkas'];
$usm = $p11xx2['usm'];
}				
		
$berkas2= datetimess($berkas) ;		
	$usm2  = datetimess($usm) ;	
		
		
	$lahir2 = str_replace("-", "", $lahir);	
		
		
$subject = "$judul_situs - Form Pendaftaran";
$msg = "
$judul_situs - Form Registrasi




Selamat, pendaftaran anda berhasil.<br/>
Akun anda sudah aktif silahkan login dengan informasi berikut:<br/>
Username : $nomor<br/>
Password : $lahir2<br/>
<br/>

Kemudian anda diwajibkan datang ke bagian kepanitiaan PMB dengan membawa berkas persyaratan.<br/>
Berkas paling lambar di kumpulkan pada $berkas2<br/>
Informasi tambahan : Pelaksanaan USM pada $lahir2<br/><br/>
Terimakasih.

";
	    mail_send($email, $email_master, $subject, $msg, 1, 1);
	    Posted('contact');		
		
			

			
		$content .= '<div class=sukses>Pendaftaran berhasil.<br/> <a href="#" onclick=bukajendela("bukti.php?id='.md5($nomor).'")> Cetak Bukti Pendaftaran</a></div>';
		}
	else {
		$content .= '<div class=error>Data Gagal Dimasukkan<br>'.mysql_error().'</div>';
		if (eregi ($no_induk,mysql_error())) {
			input_alert('no_induk');
		}
		}
		
		
	
}	
	
	
	
	
}

$propinsi5x = $koneksi_db->sql_query("SELECT * FROM mod_data_agama ORDER BY id ASC");
while($p11x=$koneksi_db->sql_fetchrow($propinsi5x)){
$kode1x = $p11x['id'];
	$nama1x = $p11x['nama'];
$asal44x .= '<option value="'.$kode1x.'">'.$nama1x.'</option>';
}


$propinsi52= $koneksi_db->sql_query("SELECT * FROM mod_data_prodi ORDER BY id ASC");
while($p112=$koneksi_db->sql_fetchrow($propinsi52)){
$kode12 = $p112['kode'];
	$nama12 = $p112['nama'];
$asal442 .= '<option value="'.$kode12.'">'.$nama12.'</option>';
}


$propinsi5 = $koneksi_db->sql_query("SELECT * FROM provinsi ORDER BY id ASC");
while($p11=$koneksi_db->sql_fetchrow($propinsi5)){
$kode1 = $p11['id'];
	$nama1 = $p11['nama_provinsi'];
$asal44 .= '<option value="'.$kode1.'">'.$nama1.'</option>';
}
$content .= '
<form method="POST" action="" enctype="multipart/form-data" name="input_jabatan">
<table width=100%>

<tr><td>Jenis Kelas</td><td>:</td><td><select name="sumber" required>
			<option value="">-- Pilih Salah Satu --</option>
			<option value="Online">Online</option>
			<option value="Offline">Offline</option>
			</select>
			
			</td></tr>
			
			
			<tr>
<td></td>
<td></td>

			
<tr>
<td></td>
<td></td>
		
			
<tr>
<td>Pilihan Prodi</td>
<td>:</td>
<td><select name="prodi" required>
			<option value="">-- Pilih Salah Satu --</option>
			'.$asal442.'
			</select></td>
</tr>			
			
			
			

<tr>
<td>Nama Lengkap</td>
<td>:</td>
<td>'.input_text ('nama',@$_POST['nama']).'</td>
</tr>

<tr>
<td>Tempat Lahir</td>
<td>:</td>
<td>'.input_text ('tempat',@$_POST['tempat']).'</td>
</tr>


<tr><td>Tanggal Lahir</td><td>:</td><td><input type="text" name="lahir" class="tcal date required" id=""></td></tr>



<tr><td>Jenis Kelamin</td><td>:</td><td><select name="kelamin" required>
			<option value="">-- Pilih Salah Satu --</option>
			<option value="L">L</option>
			<option value="P">P</option>
			</select></td></tr>



		
			<tr>
<td>NIK</td>
<td>:</td>
<td>'.input_text ('nik',@$_POST['nik']).'</td>
</tr>
		



			<tr>
<td>Agama</td>
<td>:</td>
<td><select name="agama" required>
			<option value="">-- Pilih Salah Satu --</option>
			'.$asal44x.'
			</select></td>
</tr>	




	
	
	
			
	<tr>
<td>Kewarganegaraan</td><td>:</td><td><select name="kwn" required>
			<option value="">-- Pilih Salah Satu --</option>
			<option value="ID">ID</option>
			<option value="WNA">WNA</option>
			</select></td></tr>

		
	<tr>
<td>Jenis Pendaftaran</td><td>:</td><td><select name="jenis" required>
			<option value="">-- Pilih Salah Satu --</option>
			<option value="1">Mahasiswa Baru</option>
			<option value="2">Pindahan</option>
			</select></td></tr>

			
	

<tr>
<td>Provinsi</td>
<td>:</td>
<td><select name="prov" id="propinsi5" required>
<option value="">--Pilih Provinsi--</option>
'.$asal44.'
</select></td>
</tr>
<tr>
<td>Kota/Kabupaten</td>
<td>:</td>
<td><select name="kab" id="kota5" required>
<option value="">--Pilih Kota/Kabupaten--</option>'
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
<td><select name="kec" id="kec5" required>
<option value="">--Pilih Kecamatan--</option>'
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
<td><select name="kel" id="desa5" required>
<option value="">--Pilih Kelurahan--</option>'
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
<td></td>
<td></td>
<td><input type="text" name="rt" size="4" placeholder="RT"> <input type="text" name="rw" size="4" placeholder="RW"></td>
</tr>


		
	<tr>
<td>No. Telp.</td>
<td>:</td>
<td>'.input_text ('telp',@$_POST['telp']).'</td>
</tr>
		


	
			
	<tr>
<td>Email</td>
<td>:</td>
<td>'.input_text ('email',@$_POST['email']).'</td>
</tr>
		

		
<tr>
<td></td>
<td></td>
<td><input type="text" name="nokps" placeholder="Nomor KPS"></td>
</tr>
			


		
			
	<tr>
<td>Nama Ibu Kandung</td>
<td>:</td>
<td>'.input_text ('ibu',@$_POST['ibu']).'</td>
</tr>
		
<tr>
<td>Asal Sekolah/Perguruan Tinggi</td>
<td>:</td>
<td>'.input_text ('sekolah',@$_POST['sekolah']).'</td>
</tr>





<tr>
<td></td>
<td></td>
<td><input type="submit" name="submit" value="Daftar"></td>
</tr>

</table>
</form>
';


	break;
	
	
	
		
	
case 'cari':


$_GET['field'] = !isset ($_GET['field']) ? 'nama' : $_GET['field'];



$content .= '
<form method="GET" action="">
<table border=0>
<tr>
<td>Nama </td><td>:&nbsp;&nbsp;&nbsp;</td><td>'.input_text ('search',@$_GET['search'],$type='text',$size=33,$opt='').'</td>
</tr>
<tr>
<td></td><td></td><td><input type="submit" name="submit" value="Search"></td>
</tr>
</table>
<input type="hidden" name="pilih" value="pmb" />
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
if ($field == 'jabatan_tamat'){
	$SQLOPERATOR = "= '$search'";
}

$query_add = "WHERE `$field` $SQLOPERATOR";

if (isset ($_POST['deleted'])){
	if (is_array (@$_POST['delete'])){
	foreach ($_POST['delete'] as $k=>$v){
		$query = $koneksi_db->sql_query ("DELETE FROM `mod_data_pmb` WHERE `id`='$v'");
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


$num = $koneksi_db->sql_query("SELECT `id` FROM `mod_data_pmb` $query_add");
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

<th>Nomor</th>
<th>Nama</th>
<th>Pilihan</th>
<th>Pembayaran</th>
	<th>Action</th>
	<th><a href="javascript:checkall(\'namaform\', \'delete[]\');">Delete</a></th>
</tr>';


$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_pmb` $query_add ORDER By `id` ASC LIMIT $offset, $limit");



$warna = null;
while ($data = $koneksi_db->sql_fetchrow($query)){
if (!isset($warna)) $warna = 'style="background:#f9f9f9"';
else $warna = null;	
$no ++;
$id = $data['id'];
$prodi = $data['prodi'];
$k1k = $koneksi_db->sql_query("SELECT * FROM mod_data_prodi WHERE kode='$prodi'");
while($kk1k=$koneksi_db->sql_fetchrow($k1k)){
$idk1k = $kk1k['id'];
	$namak1k = $kk1k['nama'];
}
$status = $data['status'];
if($status==1)
{
	$sst = '<td><img src="images/tick.gif"></td>';
} elseif ($status==2)

{
		$sst = '<td><img src="images/cross.png"></td>';
} else {
	
		$sst = '<td><a href="admin.php?pilih=pmb&amp;modul=yes&amp;action=edit&amp;id='.$id.'&amp;referer='.$referer.'">Konfirm</a></td>';
}


$statusb = $data['statusb'];
$bayar = $data['bayar'];
if($statusb==1)
{
	
	if($bayar==1)
	{
		$sstb = '<td><img src="images/tick.gif"></td>';
	} else {
		
			$sstb = '<td><a href="admin.php?pilih=pmb&amp;modul=yes&amp;action=editb&amp;id='.$id.'&amp;referer='.$referer.'">Konfirm</a></td>';
	}
	
	
	
}  else {
		$sstb = '<td><img src="images/cross.png"></td>';
	
}


$content .= '<tr>
	<td>'.$no.'</td>
<td><a href="admin.php?pilih=pmb&amp;modul=yes&amp;action=detail&amp;id='.$id.'">'.$data['nomor'].'</a></td>
<td>'.$data['nama'].'</td>

<td>'.$namak1k.'</td>
'.$sstb.'
'.$sst.'
	
	<td><input type="checkbox" name="delete[]" value="'.$id.'" style="border:0px"></td>
	
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
	
	

	
	
	
		
	
case 'detail':


$id = int_filter($_GET['id']);

if (!isset ($_POST['submit'])){
$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_pmb` WHERE `id` = '$id'");
$getdata = mysqli_fetch_assoc($query);

$_POST = $getdata;
$nama = $getdata['nama'];
$telp = $getdata['telp'];
$sumber = $getdata['sumber'];
$sumber2 = $getdata['sumber2'];
$oleh = $getdata['oleh'];
$oleh2 = $getdata['oleh2'];
$email = $getdata['email'];
$lahir = $getdata['lahir'];
$prodi = $getdata['prodi'];
$jenis = $getdata['jenis'];
$agama = $getdata['agama'];
$kelamin = $getdata['kelamin'];
$kwn = $getdata['kwn'];
$kps = $getdata['kps'];
$prov = $getdata['prov'];
$kab = $getdata['kab'];
$kec = $getdata['kec'];
$kel = $getdata['kel'];
$rt = $getdata['rt'];
$rw = $getdata['rw'];
$gel = $getdata['gel'];
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

if($jenis==1)
{
	$jj = 'Mahasiswa Baru';
	
} else {
	
		$jj = 'Pindahan';
}

$k1k = $koneksi_db->sql_query("SELECT * FROM mod_data_prodi WHERE kode='$prodi'");
while($kk1k=$koneksi_db->sql_fetchrow($k1k)){
$idk1k = $kk1k['id'];
	$namak1k = $kk1k['nama'];
}
$k1j = $koneksi_db->sql_query("SELECT * FROM mod_data_agama WHERE id='$agama'");
while($kk1j=$koneksi_db->sql_fetchrow($k1j)){
$idk1j = $kk1j['id'];
	$namak1j = $kk1j['nama'];
	
}

$propinsi5 = $koneksi_db->sql_query("SELECT * FROM mod_data_agama ORDER BY id ASC");
while($p11=$koneksi_db->sql_fetchrow($propinsi5)){
$kode1 = $p11['id'];
	$nama1 = $p11['nama'];
$asal44 .= '<option value="'.$kode1.'">'.$nama1.'</option>';
}


$propinsi52= $koneksi_db->sql_query("SELECT * FROM mod_data_prodi ORDER BY id ASC");
while($p112=$koneksi_db->sql_fetchrow($propinsi52)){
$kode12 = $p112['kode'];
	$nama12 = $p112['nama'];
$asal442 .= '<option value="'.$kode12.'">'.$nama12.'</option>';
}



$content .= '
<form method="POST" action="" enctype="multipart/form-data" name="input_jabatan">
<table width=100%>
<tr>
<td>Periode</td>
<td>:</td>
<td>'.$gel.'</td>
</tr>
<tr><td>Tanggal Daftar</td><td>:</td><td>'.datetimess($getdata['tanggal']).'</td></tr>
<tr><td>Jenis Kelas</td><td>:</td><td>'.$sumber.'
			
			</td></tr>
			
			
			<tr>
<td></td>
<td></td>
<td>'.$getdata['sumber2'].'</td>
</tr>
			
			
<tr>
<td></td>
<td></td>
<td>'.$getdata['oleh2'].'</td>
</tr>
						
			
			<tr>
<td>Pilihan Prodi</td>
<td>:</td>
<td>'.$namak1k.'</td>
</tr>			
			
			
			

<tr>
<td>Nama Lengkap</td>
<td>:</td>
<td>'.$getdata['nama'].'</td>
</tr>

<tr>
<td>Tempat Lahir</td>
<td>:</td>
<td>'.$getdata['tempat'].'</td>
</tr>


<tr><td>Tanggal Lahir</td><td>:</td><td>'.datetimess($getdata['lahir']).'</td></tr>



<tr><td>Jenis Kelamin</td><td>:</td><td>'.$kelamin.'</td></tr>



		
			<tr>
<td>NIK</td>
<td>:</td>
<td>'.$getdata['nik'].'</td>
</tr>
		



			<tr>
<td>Agama</td>
<td>:</td>
<td>'.$namak1j.'</td>
</tr>	




	
			

<td>Kewarganegaraan</td><td>:</td><td>'.$kwn.'</td></tr>

		
	<tr>
<td>Jenis Pendaftaran</td><td>:</td><td>'.$jj.'</td></tr>

			
		

<tr>
<td>Provinsi</td>
<td>:</td>
<td>'.$namak2.'</td>
</tr>
<tr>
<td>Kota/Kabupaten</td>
<td>:</td>
<td>'.$namak3.'

</td>
</tr>



<tr>
<td>Kecamatan</td>
<td>:</td>
<td>'.$namak4.'

</td>
</tr>
<tr>
<td>Kelurahan</td>
<td>:</td>
<td>'.$namak5.'

</td>
</tr>
	<tr>
<td>Alamat</td>
<td>:</td>
<td>'.$getdata['alamat'].'</td>
</tr>
			<tr>
<td>Kodepos</td>
<td>:</td>
<td>'.$getdata['kodepos'].'</td>
</tr>
					
					<tr>
<td></td>
<td></td>
<td>RT: '.$getdata['rt'].', RW: '.$getdata['rw'].'</td>
</tr>

	<tr>
<td>No. Telp.</td>
<td>:</td>
<td>'.$getdata['telp'].'</td>
</tr>
		


	
			
	<tr>
<td>Email</td>
<td>:</td>
<td>'.$getdata['email'].'</td>
</tr>
		
	
			
	<tr>
		
<td></td>
<td></td>
<td>'.$getdata['nokps'].'</td>
</tr>
			


		
			
	<tr>
<td>Nama Ibu Kandung</td>
<td>:</td>
<td>'.$getdata['ibu'].'</td>
</tr>
				<tr>
<td>Asal Sekolah/Perguruan Tinggi</td>
<td>:</td>
<td>'.$getdata['sekolah'].'</td>
</tr>	



</table>
</form>

<br/> <a href="#" onclick=bukajendela("bukti.php?id='.md5($getdata['nomor']).'")> Cetak Bukti Pendaftaran</a>  | <a href="admin.php?pilih=pmb&modul=yes">Kembali</a>
';



break;	
	
		
	
	
	
	
	
	
	
	
	
	
		
	
case 'edit':


$id = int_filter($_GET['id']);
if (!empty ($_GET['id'])){



if (isset ($_POST['submit'])){
	
	

$prodi = cleantext($_POST['prodi']);
$sumber = cleantext($_POST['sumber']);
$sumber2 = cleantext($_POST['sumber2']);
$oleh = cleantext($_POST['oleh']);
$oleh2 = cleantext($_POST['oleh2']);
$nama = cleantext($_POST['nama']);
$tempat = cleantext($_POST['tempat']);
$lahir = cleantext($_POST['lahir']);
$kelamin = cleantext($_POST['kelamin']);
$nik = cleantext($_POST['nik']);
$agama = cleantext($_POST['agama']);
$telp = cleantext($_POST['telp']);
$email = cleantext($_POST['email']);
$kwn = cleantext($_POST['kwn']);
$jenis = cleantext($_POST['jenis']);
$tanggal = date('Y-m-d');
$prov = cleantext($_POST['prov']);
$kab = cleantext($_POST['kab']);
$kec = cleantext($_POST['kec']);
$kel = cleantext($_POST['kel']);
$alamat = cleantext($_POST['alamat']);
$kps = cleantext($_POST['kps']);
$nokps = cleantext($_POST['nokps']);
$ibu = cleantext($_POST['ibu']);
	
$prop23 = $koneksi_db->sql_query("SELECT * FROM kodepos WHERE kelurahan_id='$kel'");
while($pr23=$koneksi_db->sql_fetchrow($prop23)){
	$nlo = $pr23['no_kodepos'];
}

$kodepos = $nlo;
$rt = cleantext($_POST['rt']);
$rw = cleantext($_POST['rw']);
$sekolah = cleantext($_POST['sekolah']);


$status = cleantext($_POST['status']);

	

	$insert = $koneksi_db->sql_query ("UPDATE `mod_data_pmb` SET `prodi`='$prodi',
`sumber`='$sumber',
`sumber2`='$sumber2',
`oleh`='$oleh',
`oleh2`='$oleh2',
`nama`='$nama',
`tempat`='$tempat',
`lahir`='$lahir',
`kelamin`='$kelamin',
`nik`='$nik',
`agama`='$agama',
`telp`='$telp',
`email`='$email',
`kwn`='$kwn',
`jenis`='$jenis',
`prov`='$prov',
`kab`='$kab',
`kec`='$kec',
`kel`='$kel',`kodepos`='$kodepos',`rt`='$rt',`rw`='$rw',
`alamat`='$alamat',
`kps`='$kps',
`nokps`='$nokps',
`ibu`='$ibu',`status`='$status',`sekolah`='$sekolah' WHERE `id` = '$id'");
	if ($insert) {
		
		
		
				
		
		
$subject = "$judul_situs - Konfirmasi Pendaftaran";
$msg = "
$judul_situs - Konfirmasi Pendaftaran



Selamat data $nama telah berhasil di konfirmasi dan dinyatakan valid.
<br/>

";
	    mail_send($email, $email_master, $subject, $msg, 1, 1);
	    Posted('contact');		
		
		
		
		
		
		
		
		
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

if (!isset ($_POST['submit'])){
$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_pmb` WHERE `id` = '$id'");
$getdata = mysqli_fetch_assoc($query);

$_POST = $getdata;
$nama = $getdata['nama'];
$telp = $getdata['telp'];
$sumber = $getdata['sumber'];
$sumber2 = $getdata['sumber2'];
$oleh = $getdata['oleh'];
$oleh2 = $getdata['oleh2'];
$email = $getdata['email'];
$lahir = $getdata['lahir'];
$prodi = $getdata['prodi'];
$jenis = $getdata['jenis'];
$agama = $getdata['agama'];
$kelamin = $getdata['kelamin'];
$kwn = $getdata['kwn'];
$kps = $getdata['kps'];
$prov = $getdata['prov'];
$kab = $getdata['kab'];
$kec = $getdata['kec'];
$kel = $getdata['kel'];
$rt = $getdata['rt'];
$rw = $getdata['rw'];
$gel = $getdata['gel'];
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

$propinsi5 = $koneksi_db->sql_query("SELECT * FROM provinsi ORDER BY id ASC");
while($p11=$koneksi_db->sql_fetchrow($propinsi5)){
$kode1 = $p11['id'];
	$nama1 = $p11['nama_provinsi'];
$asal44 .= '<option value="'.$kode1.'">'.$nama1.'</option>';
}


if($jenis==1)
{
	$jj = 'Mahasiswa Baru';
	
} else {
	
		$jj = 'Pindahan';
}

$k1k = $koneksi_db->sql_query("SELECT * FROM mod_data_prodi WHERE kode='$prodi'");
while($kk1k=$koneksi_db->sql_fetchrow($k1k)){
$idk1k = $kk1k['id'];
	$namak1k = $kk1k['nama'];
}
$k1j = $koneksi_db->sql_query("SELECT * FROM mod_data_agama WHERE id='$agama'");
while($kk1j=$koneksi_db->sql_fetchrow($k1j)){
$idk1j = $kk1j['id'];
	$namak1j = $kk1j['nama'];
	
}

$propinsi5x = $koneksi_db->sql_query("SELECT * FROM mod_data_agama ORDER BY id ASC");
while($p11x=$koneksi_db->sql_fetchrow($propinsi5x)){
$kode1x = $p11x['id'];
	$nama1x = $p11x['nama'];
$asal44x .= '<option value="'.$kode1x.'">'.$nama1x.'</option>';
}


$propinsi52= $koneksi_db->sql_query("SELECT * FROM mod_data_prodi ORDER BY id ASC");
while($p112=$koneksi_db->sql_fetchrow($propinsi52)){
$kode12 = $p112['kode'];
	$nama12 = $p112['nama'];
$asal442 .= '<option value="'.$kode12.'">'.$nama12.'</option>';
}



$content .= '
<form method="POST" action="" enctype="multipart/form-data" name="input_jabatan">
<table width=100%>
<tr>
<td>Periode</td>
<td>:</td>
<td><input type="text" value="'.$gel.'" disabled="disable"></td>
</tr>
<tr><td>Jenis Kelas</td><td>:</td><td><select name="sumber" required>
			<option value="'.$sumber.'">'.$sumber.'</option>
			<option value="Online">Online</option>
			<option value="Offline">Offline</option>
			</select>
			
			</td></tr>
			
			
			<tr>
<td></td>
<td></td>

			
			
<tr>
<td></td>
<td></td>
<tr>
<td>Pilihan Prodi</td>
<td>:</td>
<td><select name="prodi" required>
			<option value="'.$prodi.'">'.$namak1k.'</option>
			'.$asal442.'
			</select></td>
</tr>			
			
			
			

<tr>
<td>Nama Lengkap</td>
<td>:</td>
<td>'.input_text ('nama',@$_POST['nama']).'</td>
</tr>

<tr>
<td>Tempat Lahir</td>
<td>:</td>
<td>'.input_text ('tempat',@$_POST['tempat']).'</td>
</tr>


<tr><td>Tanggal Lahir</td><td>:</td><td><input type="text" name="lahir" value="'.$lahir.'" class="tcal date required" id=""></td></tr>



<tr><td>Jenis Kelamin</td><td>:</td><td><select name="kelamin" required>
			<option value="'.$kelamin.'">'.$kelamin.'</option>
			<option value="L">L</option>
			<option value="P">P</option>
			</select></td></tr>



		
			<tr>
<td>NIK</td>
<td>:</td>
<td>'.input_text ('nik',@$_POST['nik']).'</td>
</tr>
		



			<tr>
<td>Agama</td>
<td>:</td>
<td><select name="agama" required>
			<option value="'.$agama.'">'.$namak1j.'</option>
			'.$asal44x.'
			</select></td>
</tr>	




	
			
	<tr>
<td>Kewarganegaraan</td><td>:</td><td><select name="kwn" required>
			<option value="'.$kwn.'">'.$kwn.'</option>
			<option value="ID">ID</option>
			<option value="WNA">WNA</option>
			</select></td></tr>

		
	<tr>
<td>Jenis Pendaftaran</td><td>:</td><td><select name="jenis" required>
			<option value="'.$jenis.'">'.$jj.'</option>
			<option value="1">Mahasiswa Baru</option>
			<option value="2">Pindahan</option>
			</select></td></tr>

			


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
<td></td>
<td></td>
<td><input type="text" name="rt" size="4" value="'.$rt.'" placeholder="RT"> <input type="text" value="'.$rw.'" name="rw" size="4" placeholder="RW"></td>
</tr>

	
			
	<tr>
<td>No. Telp.</td>
<td>:</td>
<td>'.input_text ('telp',@$_POST['telp']).'</td>
</tr>
		


	
			
	<tr>
<td>Email</td>
<td>:</td>
<td>'.input_text ('email',@$_POST['email']).'</td>
</tr>
		
		
<tr>
<td></td>
<td></td>
<td><input type="text" name="nokps" placeholder="Nomor KPS"></td>
</tr>
			


		
			
	<tr>
<td>Nama Ibu Kandung</td>
<td>:</td>
<td>'.input_text ('ibu',@$_POST['ibu']).'</td>
</tr>
		<tr>
<td>Asal Sekolah/Perguruan Tinggi</td>
<td>:</td>
<td>'.input_text ('sekolah',@$_POST['sekolah']).'</td>
</tr>



<tr>
<td>Konfirmasi</td>
<td>:</td>
<td><select name="status"><option value="1">Data Valid</option>
<option value="2">Data Tidak Valid</option>
</select></td>
</tr>

<tr>
<td></td>
<td></td>
<td><input type="submit" name="submit" value="Proses"></td>
</tr>

</table>
</form>
';

}

break;	
	
	
		
	
case 'editb':


$id = int_filter($_GET['id']);
if (!empty ($_GET['id'])){



if (isset ($_POST['submit'])){
	
	

$bayar = cleantext($_POST['bayar']);

	

	$insert = $koneksi_db->sql_query ("UPDATE `mod_data_pmb` SET `bayar`='$bayar' WHERE `id` = '$id'");
	if ($insert) {
		
		
		
				
		
		
$subject = "$judul_situs - Konfirmasi Pembayaran";
$msg = "
$judul_situs - Konfirmasi Pembayaran



Selamat data $nama telah berhasil di konfirmasi konfirmasi pembayaran, silahkan login dan cetak bukti pendaftaran.
<br/>

";
	    mail_send($email, $email_master, $subject, $msg, 1, 1);
	    Posted('contact');		
		
		
		
		
		
		
		
		
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

if (!isset ($_POST['submit'])){
$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_pmb` WHERE `id` = '$id'");
$getdata = mysqli_fetch_assoc($query);

$_POST = $getdata;
$nama = $getdata['nama'];
$telp = $getdata['telp'];
$sumber = $getdata['sumber'];
$sumber2 = $getdata['sumber2'];
$oleh = $getdata['oleh'];
$oleh2 = $getdata['oleh2'];
$email = $getdata['email'];
$lahir = $getdata['lahir'];
$prodi = $getdata['prodi'];
$jenis = $getdata['jenis'];
$agama = $getdata['agama'];
$kelamin = $getdata['kelamin'];
$kwn = $getdata['kwn'];
$kps = $getdata['kps'];
$prov = $getdata['prov'];
$kab = $getdata['kab'];
$kec = $getdata['kec'];
$kel = $getdata['kel'];
$rt = $getdata['rt'];
$rw = $getdata['rw'];
$gel = $getdata['gel'];
$bayar = $getdata['bayar'];
$foto = $getdata['foto'];
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

$propinsi5 = $koneksi_db->sql_query("SELECT * FROM provinsi ORDER BY id ASC");
while($p11=$koneksi_db->sql_fetchrow($propinsi5)){
$kode1 = $p11['id'];
	$nama1 = $p11['nama_provinsi'];
$asal44 .= '<option value="'.$kode1.'">'.$nama1.'</option>';
}


if($jenis==1)
{
	$jj = 'Mahasiswa Baru';
	
} else {
	
		$jj = 'Pindahan';
}

$k1k = $koneksi_db->sql_query("SELECT * FROM mod_data_prodi WHERE kode='$prodi'");
while($kk1k=$koneksi_db->sql_fetchrow($k1k)){
$idk1k = $kk1k['id'];
	$namak1k = $kk1k['nama'];
}
$k1j = $koneksi_db->sql_query("SELECT * FROM mod_data_agama WHERE id='$agama'");
while($kk1j=$koneksi_db->sql_fetchrow($k1j)){
$idk1j = $kk1j['id'];
	$namak1j = $kk1j['nama'];
	
}

$propinsi5x = $koneksi_db->sql_query("SELECT * FROM mod_data_agama ORDER BY id ASC");
while($p11x=$koneksi_db->sql_fetchrow($propinsi5x)){
$kode1x = $p11x['id'];
	$nama1x = $p11x['nama'];
$asal44x .= '<option value="'.$kode1x.'">'.$nama1x.'</option>';
}


$propinsi52= $koneksi_db->sql_query("SELECT * FROM mod_data_prodi ORDER BY id ASC");
while($p112=$koneksi_db->sql_fetchrow($propinsi52)){
$kode12 = $p112['kode'];
	$nama12 = $p112['nama'];
$asal442 .= '<option value="'.$kode12.'">'.$nama12.'</option>';
}



$content .= '
<form method="POST" action="" enctype="multipart/form-data" name="input_jabatan">
<table width=100%>

			

<tr>
<td width=20%>Nama Lengkap</td>
<td>:</td>
<td>'.$nama.'</td>
</tr>

<tr>
<td>Pilihan Prodi</td>
<td>:</td>
<td>'.$namak1k.'</td>
</tr>


<tr><td>Bukti Transfer</td><td>:</td><td><img src="files/pembayaran/'.$foto.'" width=80%></td></tr>



<tr>
<td>Pembayaran</td>
<td>:</td>
<td><select name="bayar"><option value="1">Konfirmasi</option>
<option value="0">Tolak</option>
</select></td>
</tr>

<tr>
<td></td>
<td></td>
<td><input type="submit" name="submit" value="Proses"></td>
</tr>

</table>
</form>
';

}

break;	
	
	
	
default:







$prodi = cleartext($_GET['prodi']);
$gel = cleartext($_GET['gel']);


$propinsi52= $koneksi_db->sql_query("SELECT * FROM mod_data_prodi ORDER By id ASC");
while($pr1xy2=$koneksi_db->sql_fetchrow($propinsi52)){
	$idkat23 = $pr1xy2['kode'];
$namakat23 = $pr1xy2['nama'];
$pilihkat2 .= '<option value="admin.php?pilih=pmb&modul=yes&prodi='.$idkat23.'">'.$namakat23.'</option>';
}

$q3 = $koneksi_db->sql_query ("SELECT * FROM `mod_data_prodi`  WHERE kode='".$prodi."'");
while ($data3 = $koneksi_db->sql_fetchrow($q3)){
	$nama2333 = $data3['nama'];
}




echo '

';
if (!$prodi)
{echo '<br/>
<select name="prodi" onChange="MM_jumpMenu(\'parent\',this,0)">
<option value="">-- Pilih Prodi --</option>'.$pilihkat2.'
</select>
<select name="gel">
<option value="">-- Pilih Periode --</option>
</select>

';
	 
} else {
	echo '<br/>
	<select name="prodi" onChange="MM_jumpMenu(\'parent\',this,0)">
<option value="">'.$nama2333 .'</option>'.$pilihkat2.'
</select>

<select name="gel" onChange="MM_jumpMenu(\'parent\',this,0)">';


if (!$gel)
{
	echo '
<option value="">-- Pilih Periode --</option>';
} else {
		echo '
<option value="">'.$gel.'</option>';
	
}

	echo '
<option value="admin.php?pilih=pmb&modul=yes&prodi='.$prodi.'&gel=1">1</option>
<option value="admin.php?pilih=pmb&modul=yes&prodi='.$prodi.'&gel=2">2</option>
<option value="admin.php?pilih=pmb&modul=yes&prodi='.$prodi.'&gel=3">3</option>
</select>

';
	
}


echo '













<br/>
';




















if (isset ($_POST['deleted'])){
	if (is_array (@$_POST['delete'])){
	foreach ($_POST['delete'] as $k=>$v){
		$query = $koneksi_db->sql_query ("DELETE FROM `mod_data_pmb` WHERE `id`='$v'");
	}
	}
	
}


if (!$gel && !$prodi)
{
	$num = $koneksi_db->sql_query("SELECT `id` FROM `mod_data_pmb` $query_add");



}
elseif(!$gel)
{
	$num = $koneksi_db->sql_query("SELECT `id` FROM `mod_data_pmb` WHERE prodi='$prodi'");

}
else {
	$num = $koneksi_db->sql_query("SELECT `id` FROM `mod_data_pmb` WHERE prodi='$prodi' AND gel='$gel'");

	
}


$jumlah = $koneksi_db->sql_numrows ($num);
//mysqli_free_result ($num);

$limit = 2000;
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

<th>Nomor</th>
<th>Nama</th>
<th>Pilihan</th>
<th>Pembayaran</th>
	<th>Action</th>
	<th><a href="javascript:checkall(\'namaform\', \'delete[]\');">Delete</a></th>
</tr>';

if (!$gel && !$prodi)
{
	$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_pmb` ORDER By `id` DESC");


}
elseif(!$gel)
{
	$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_pmb` WHERE prodi='$prodi' ORDER By `id` DESC");

}
else {
	$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_pmb` WHERE prodi='$prodi' AND gel='$gel' ORDER By `id` DESC");
	
}


$warna = null;
while ($data = $koneksi_db->sql_fetchrow($query)){
if (!isset($warna)) $warna = 'style="background:#f9f9f9"';
else $warna = null;	
$no ++;
$id = $data['id'];
$prodi = $data['prodi'];
$k1k = $koneksi_db->sql_query("SELECT * FROM mod_data_prodi WHERE kode='$prodi'");
while($kk1k=$koneksi_db->sql_fetchrow($k1k)){
$idk1k = $kk1k['id'];
	$namak1k = $kk1k['nama'];
}
$status = $data['status'];
if($status==1)
{
	$sst = '<td><img src="images/tick.gif"></td>';
} elseif ($status==2)

{
		$sst = '<td><img src="images/cross.png"></td>';
} else {
	
		$sst = '<td><a href="admin.php?pilih=pmb&amp;modul=yes&amp;action=edit&amp;id='.$id.'&amp;referer='.$referer.'">Konfirm</a></td>';
}


$statusb = $data['statusb'];
$bayar = $data['bayar'];
if($statusb==1)
{
	
	if($bayar==1)
	{
		$sstb = '<td><a href="#" onclick=bukajendela("bukti-bayar.php?id='.$id.'")><i class="fa fa-print"></i> Print</a></td>';
	} else {
		
			$sstb = '<td><a href="admin.php?pilih=pmb&amp;modul=yes&amp;action=editb&amp;id='.$id.'&amp;referer='.$referer.'">Konfirm</a></td>';
	}
	
	
	
}  else {
		$sstb = '<td><img src="images/cross.png"></td>';
	
}


$content .= '<tr>
	<td>'.$no.'</td>
<td><a href="admin.php?pilih=pmb&amp;modul=yes&amp;action=detail&amp;id='.$id.'">'.$data['nomor'].'</a></td>
<td>'.$data['nama'].'</td>

<td>'.$namak1k.'</td>
'.$sstb.'
'.$sst.'
	
	<td><input type="checkbox" name="delete[]" value="'.$id.'" style="border:0px"></td>
	
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




break;	

}














/////////////
echo $content;

?> 