<h4>Konfirmasi Pendaftaran</h4>

  <a href="admin.php?pilih=pmb&amp;modul=yes">List Data</a> | 
  <a href="admin.php?pilih=pmb&amp;modul=yes&amp;action=cari">Cari Data</a>
  
  
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
$kel = cleantext($_POST['kel']);
$kec = cleantext($_POST['kec']);
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
`kel`,
`kec`,
`kps`,
`nokps`,
`ibu`) VALUES ('$nomor',
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
'$kel',
'$kec',
'$kps',
'$nokps',
'$ibu')");
	if ($insert) {
		
		
				$insert3s = $koneksi_db->sql_query ("INSERT INTO `mod_data_jumlah` (`nama`) VALUES ('1')");
		$insert2 = $koneksi_db->sql_query ("INSERT INTO `mod_data_pmb` (`nama`,`alamat`,`telp`,`email`,`user`,`password`) VALUES ('$nama','$kel','$telp','$email','$user','$password')");
		
		
				
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




Selamat, pendaftaran Online anda berhasil.<br/>
Akun anda sudah aktif silahkan login di <p><a href="pmb.staipibdg.ac.id">pmb.staipibdg.ac.id</a></p> dengan Username dan Password berikut:<br/>
Username : $nomor<br/>
Password : $lahir2<br/>
<br/>

Selanjutnya lakukan pembayaran uang Pendaftaran di Kantor Kas BMT Berkah Umat Jalan Ciganitri No.2 atau Transfer ke Norek  397920200271 0001 CIMB NIAGA SYARIAH (Kode Bank 022) :<br/>
<ul>";
$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_berkas` ORDER By `id` ASC");
while ($data = $koneksi_db->sql_fetchrow($query)){
$datab = $data['nama'];
$msg = "<li>$datab</li> ";

}
$msg = "</ul><br/>
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

<tr><td>Sumber Informasi STAI</td><td>:</td><td><select name="sumber" required>
			<option value="">-- Pilih Salah Satu --</option>
			<option value="Iklan di Facebook">Iklan di Facebook</option>
			<option value="Iklan di Media Masa">Iklan di Media Masa</option>
			<option value="Guru di Sekolah">Guru di Sekolah</option>
			<option value="SWebsite STAI">Website STAI</option>
			<option value="Alumni STAI">Alumni STAI</option>
			<option value="Lainnya">Lainnya</option>
			</select>
			
			</td></tr>
			
			
			<tr>
<td></td>
<td></td>
<td><input type="text" name="sumber2" placeholder="Keterangan"></td>
</tr>
			
			
<tr><td>Berkas Pendaftaran diantar oleh</td><td>:</td><td><select name="oleh" required>
			<option value="">-- Pilih Salah Satu --</option>
			<option value="Sendiri">Sendiri</option>
			<option value="Guru di Sekolah">Guru di Sekolah</option>
			<option value="Lainnya">Lainnya</option>
			</select>
			
			</td></tr>
			
			
			<tr>
<td></td>
<td></td>
<td><input type="text" name="oleh2" placeholder="Nama Pengantar"></td>
</tr>
						
			
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
			'.$asal44.'
			</select></td>
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
<td>Kelurahan</td>
<td>:</td>
<td>'.input_text ('kel',@$_POST['kel']).'</td>
</tr>
		
			
	<tr>
<td>Kecamatan</td>
<td>:</td>
<td>'.input_text ('kec',@$_POST['kec']).'</td>
</tr>
		
	<tr>
<td>Terima KPS</td><td>:</td><td><select name="kps" required>
			<option value="">-- Pilih Salah Satu --</option>
			<option value="Ya">Ya</option>
			<option value="Tidak">Tidak</option>
			</select></td></tr>
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
<td>&nbsp;&nbsp;&nbsp;Nama </td><td>:&nbsp;&nbsp;&nbsp;</td><td>'.input_text ('search',@$_GET['search'],$type='text',$size=33,$opt='').'</td>
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


$num = $koneksi_db->sql_query("SELECT `id` FROM `mod_data_pmb` $query_add AND tipe='Pasif'");
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

<th>Nama</th>
<th>Email</th>
<th>No. Telp</th>
	<th>Action</th>
	<th><a href="javascript:checkall(\'namaform\', \'delete[]\');">Delete</a></th>
</tr>';



$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_pmb` $query_add AND tipe='Pasif' ORDER By `id` ASC LIMIT $offset, $limit");



$warna = null;
while ($data = $koneksi_db->sql_fetchrow($query)){
if (!isset($warna)) $warna = 'style="background:#f9f9f9"';
else $warna = null;	
$no ++;
$id = $data['id'];
$content .= '<tr>
	<td>'.$no.'</td>

<td>'.$data['nama'].'</td>
<td>'.$data['email'].'</td>
<td>'.$data['telp'].'</td>

	<td><a href="admin.php?pilih=pmb&amp;modul=yes&amp;action=edit&amp;id='.$id.'&amp;referer='.$referer.'">Konfirmasi</a></td>
	<td><input type="checkbox" name="delete[]" value="'.$id.'" style="border:0px"></td>
	
</tr>';
}


$content .= '<tr><td>&nbsp;</td>

<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
    <td><input type="submit" name="deleted" value="Delete" onclick="return confirm (\'Do You Want to Delete the Data\')"></td>
  </tr>';  

$content .= '</table></div>';



$content .= '<p align=center>';
$content .= $a-> getPaging($jumlah, $_GET['pg'], $_GET['stg']);
$content .= '</p>';

	
	
}







break;	
	
	

		
	
case 'edit':


$id = int_filter($_GET['id']);
if (!empty ($_GET['id'])){



if (isset ($_POST['submit'])){
	
	
	


$bayar = cleantext($_POST['bayar']);
$user = cleantext($_POST['user']);
$email = cleantext($_POST['email']);
$nama = cleantext($_POST['nama']);
	

	$insert = $koneksi_db->sql_query ("UPDATE `mod_data_pmb` SET `tipe`='Aktif',`nama`='$nama' WHERE `id` = '$id'");
	if ($insert) {
		
		
		
				
		
		
$subject = "$judul_situs - Form Penpmban";
$msg = "
$judul_situs - Konfirmasi Penpmban



Terimakasih atas pembayaran yang telah Bapak/Ibu kirimkan, dengan ini Bapak/Ibu telah terpmb sebagai Anggota Koperasi Syariah Ummat Karawang.<br/><br/>
No. Anggota : $user<br/>
Nama Anggota : $nama<br/><br/>

Status penpmban anda sudah Aktif, silahkan gunakan username dan password berikut untuk melakukan login :<br/>
Username : $user<br/>
Password : $user<br/>
<br/>

";
	    mail_send($email, $email, $subject, $msg, 1, 1);
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
$user = $getdata['user'];
$email = $getdata['email'];
}

$content .= '
<form method="POST" action="" enctype="multipart/form-data" name="input_jabatan">
<table width=100%>

<input type="hidden" value="'.$email.'" name="email">
<input type="hidden" value="'.$user.'" name="user">
<input type="hidden" value="'.$nama.'" name="nama">
<tr>
<td>Nama</td>
<td>:</td>
<td><input type="text" value="'.$nama.'" disabled="disable" size="33"></td>
</tr>
<tr>
<td>Email</td>
<td>:</td>
<td><input type="text" value="'.$email.'" disabled="disable" size="33"></td>
</tr>
<tr>
<td>No. Telp</td>
<td>:</td>
<td><input type="text" value="'.$telp.'" disabled="disable" size="33"></td>
</tr>
<tr>
<td></td>
<td></td>
<td><select><option>Konfirmasi</option></select></td>
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


























if (isset ($_POST['deleted'])){
	if (is_array (@$_POST['delete'])){
	foreach ($_POST['delete'] as $k=>$v){
		$query = $koneksi_db->sql_query ("DELETE FROM `mod_data_pmb` WHERE `id`='$v'");
	}
	}
	
}


$num = $koneksi_db->sql_query("SELECT `id` FROM `mod_data_pmb` WHERE tipe='Pasif' $query_add");
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

<th>Nomor</th>
<th>Nama</th>
<th>Kecamatan</th>
	<th>Action</th>
	<th><a href="javascript:checkall(\'namaform\', \'delete[]\');">Delete</a></th>
</tr>';



$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_pmb` $query_add ORDER By `id` DESC LIMIT $offset, $limit");



$warna = null;
while ($data = $koneksi_db->sql_fetchrow($query)){
if (!isset($warna)) $warna = 'style="background:#f9f9f9"';
else $warna = null;	
$no ++;
$id = $data['id'];
$content .= '<tr>
	<td>'.$no.'</td>
<td>'.$data['nomor'].'</td>
<td>'.$data['nama'].'</td>

<td>'.$data['kec'].'</td>

	<td><a href="admin.php?pilih=pmb&amp;modul=yes&amp;action=edit&amp;id='.$id.'&amp;referer='.$referer.'">+ Konfirm</a></td>
	<td><input type="checkbox" name="delete[]" value="'.$id.'" style="border:0px"></td>
	
</tr>';
}


$content .= '<tr><td>&nbsp;</td>

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