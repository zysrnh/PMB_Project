<h4>Data PMB</h4>

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


default:	
	
$user = $_SESSION['UserName'];

$k1kx = $koneksi_db->sql_query("SELECT * FROM mod_data_pmb WHERE nomor='$user'");
while($kk1kx=$koneksi_db->sql_fetchrow($k1kx)){
	$statusx = $kk1kx['status'];
}

if($statusx==1)
{
	$content .= '<div class="sukses">Data anda sudah di validasi panitia.</div>';
	
	
if (!isset ($_POST['submit'])){
$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_pmb` WHERE `nomor` = '$user'");
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

if($jenis==1)
{
	$jj = 'Mahasiswa Baru';
	
} elseif($jenis==3) {
	
		$jj = 'Pindahan Ma`ahad al Imarat';
}else {
	
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
<form method="POST" action="" enctype="multipart/form-data" name="input_jabatan">
<table width=100%>
<tr>
<td>Gelombang</td>
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




	
			

	
			
	<tr>
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
<td>Terima KIP</td><td>:</td><td>'.$kps.'</td></tr>
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


';
} 
elseif($statusx==2)
{
	$content .= '<div class="error">Maaf data anda tidak valid.</div>';
}
else {
	
	
	









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
	$nisn = cleantext($_POST['nisn']);

$prop23 = $koneksi_db->sql_query("SELECT * FROM kodepos WHERE kelurahan_id='$kel'");
while($pr23=$koneksi_db->sql_fetchrow($prop23)){
	$nlo = $pr23['no_kodepos'];
}


$status = cleantext($_POST['status']);

	$kodepos = $nlo;
$rt = cleantext($_POST['rt']);
$rw = cleantext($_POST['rw']);
$sekolah = cleantext($_POST['sekolah']);


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
`kip`='$kps',
`nokps`='$nokps',
`ibu`='$ibu',`sekolah`='$sekolah',`nisn`='$nisn' WHERE `nomor` = '$user'");
	if ($insert) {
		
		
		
		$content .= '<div class=sukses>Data berhasil diubah.</div>';
		

		}
	else {
		$content .= '<div class=error>Data Gagal Di Update<br>'.mysql_error().'</div>';
		if (eregi ($no_induk,mysql_error())) {
			input_alert('no_induk');
		}
		
		
		}
	
	
	
	
	
}

if (!isset ($_POST['submit'])){
$query = $koneksi_db->sql_query ("SELECT * FROM `mod_data_pmb` WHERE `nomor` = '$user'");
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

$propinsi5 = $koneksi_db->sql_query("SELECT * FROM provinsi ORDER BY id ASC");
while($p11=$koneksi_db->sql_fetchrow($propinsi5)){
$kode1 = $p11['id'];
	$nama1 = $p11['nama_provinsi'];
$asal44 .= '<option value="'.$kode1.'">'.$nama1.'</option>';
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
<td>Gelombang</td>
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
<td><input type="text" name="sumber2" value="'.$sumber2.'" placeholder="Keterangan"></td>
</tr>
			
		
						
			
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
				<option value="3">Pindahan Ma`ahad al Imarat</option>
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
<td>Terima KIP</td><td>:</td><td><select name="kps" required>
			<option value="'.$kps.'">'.$kps.'</option>
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
<td>Asal Sekolah/Perguruan Tinggi</td>
<td>:</td>
<td>'.input_text ('sekolah',@$_POST['sekolah']).'</td>
</tr>


<tr>
<td>NISN</td>
<td>:</td>
<td>'.input_text ('nisn',@$_POST['nisn']).'</td>
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
	
	


}














/////////////
echo $content;

?> 