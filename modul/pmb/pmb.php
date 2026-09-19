<h4>PMB CLASS ONLINE IAIPI BANDUNG</h4>


  <script language="JavaScript">
function bukajendela(url) {
 window.open(url, "window_baru", "width=800,height=700,left=120,top=10,resizable=0,scrollbars=1");
}

</script>
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

	include "classes/class.phpmailer.php";

//$index_hal = 1;


include 'modul/functions.php';



switch (@$_GET['action']){


	
	
	
	

		
	
default:




	





















$propinsi12xx2x = $koneksi_db->sql_query("SELECT * FROM mod_data_periode WHERE id='1'");
while($p11xx2x=$koneksi_db->sql_fetchrow($propinsi12xx2x)){
	$mulai = $p11xx2x['mulai'];
$akhir = $p11xx2x['akhir'];
	$mulai2 = $p11xx2x['mulai2'];
$akhir2 = $p11xx2x['akhir2'];
	$mulai3 = $p11xx2x['mulai3'];
$akhir3 = $p11xx2x['akhir3'];
}		




$queryc         = $koneksi_db->sql_query ("SELECT * FROM mod_data_periode WHERE mulai <= CURDATE() and akhir >= CURDATE()");
$total         = $koneksi_db->sql_numrows($queryc);
$data          = $koneksi_db->sql_fetchrow ($query);
$query2        = $koneksi_db->sql_query ("SELECT * FROM mod_data_periode WHERE mulai2 <= CURDATE() and akhir2 >= CURDATE()");
$total2         = $koneksi_db->sql_numrows($query2);
$data2         = $koneksi_db->sql_fetchrow ($query2);
$query3        = $koneksi_db->sql_query ("SELECT * FROM mod_data_periode WHERE mulai3 <= CURDATE() and akhir3 >= CURDATE()");
$total3        = $koneksi_db->sql_numrows($query3);
$data3         = $koneksi_db->sql_fetchrow ($query3);


if ($total > 0 ){
	$xt1 = '1';
	
$xb= '
<tr>
<td>Periode</td>
<td>:</td>
<td><input type="text" value="1" disabled="disabled"><input type="hidden" name="gel" value="1"></td>
</tr>
';
} else {
$content .= '';
	$xt1 = '0';
}
if ($total2 > 0 ){
	$xt2 = '1';
$xb= '
<tr>
<td>Periode</td>
<td>:</td>
<td><input type="text" value="2" disabled="disabled"><input type="hidden" name="gel" value="2"></td>
</tr>';
} else {
$content .= '';
	$xt2 = '0';
}

if ($total3 > 0 ){
	$xt3 = '1';
$xb ='
<tr>
<td>Periode</td>
<td>:</td>
<td><input type="text" value="3" disabled="disabled"><input type="hidden" name="gel" value="3"></td>
</tr>';
} else {
	$xt3 = '0';
$content .= '';
}











$datawajibdiisi = array ('nama');

if (isset ($_POST['submit'])){
	
	
$error = '';	
	
foreach ($datawajibdiisi as $k=>$v){
	
	if (empty ($_POST[$v])){
		input_alert($v);
		$error .= '- Error at Form : '.$v.'<br />';
	}
}



$gel = cleantext($_POST['gel']);

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
$lahir2 = str_replace("-", "", $lahir);

$prop1xys= $koneksi_db->sql_query("SELECT * FROM mod_data_jumlah ORDER By id DESC LIMIT 1");
while($pr1xys=$koneksi_db->sql_fetchrow($prop1xys)){
	$idkats = $pr1xys['id'];
}
$prop1xysx= $koneksi_db->sql_query("SELECT * FROM mod_data_periode ORDER By id DESC LIMIT 1");
while($pr1xysx=$koneksi_db->sql_fetchrow($prop1xysx)){
	$idkatsx = $pr1xysx['tahun'];
$biaya = $pr1xysx['biaya'];
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
















if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT nik FROM mod_data_pmb WHERE nik='$nik'")) > 0) $error .= "Error: Username ".$nik." sudah terdaftar , silahkan ulangi.<br />";
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
`ibu`,`gel`,`sekolah`,`biaya`,`nisn`) VALUES ('$nomor',
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
'$ibu','$gel','$sekolah','$biaya','$nisn')");
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
		
$berkas2= datetimess($berkas);		
	$usm2  = datetimess($usm);	
		
		
	$lahir2 = str_replace("-", "", $lahir);	
		
		
		
		
		$mail = new PHPMailer; 
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl'; 
$mail->Host = "selayar.iixcp.rumahweb.net"; //host masing2 provider email
$mail->SMTPDebug = 2;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Timeout = 60; // timeout pengiriman (dalam detik)
$mail->SMTPKeepAlive = true; 



$mail->Username = "pmb@iaipibandung.ac.id"; //user email
$mail->Password = "pmb@22"; //password email 
$mail->SetFrom("pmb@iaipibandung.ac.id","IAI PERSIS BANDUNG "); //set email pengirim
$mail->Subject = "Form Registrasi"; //subyek email
$mail->AddAddress("$email","$nama");  //tujuan email
$mail->MsgHTML("

Selamat, pendaftaran anda berhasil.<br/>
Akun anda sudah aktif silahkan login dengan informasi berikut:<br/>
Username : $nomor<br/>
Password : $lahir2<br/>
<br/>

Kemudian anda diwajibkan datang ke bagian kepanitiaan PMB dengan membawa berkas persyaratan.<br/>
Berkas paling lambat di kumpulkan pada $berkas2<br/>
Informasi tambahan : Pelaksanaan USM pada $usm2<br/><br/>
Terimakasih.");
		
			  $mail->SMTPDebug = false;
$mail->Send();


			
		$content .= '<div class=sukses>Alhamdulillah Pendaftaran Anda Berhasil, segera lakukan pembayaran uang Pendaftaran<br/><i class="fa fa-whatsapp"></i>  <a href=https://chat.whatsapp.com/HC9B26K95xJ44YDmllnMpV target="_blank" rel="noopener">Silahkan gabung WhatsApp Group Calon Mahasiswa Baru</a><br/> <a href="#" onclick=bukajendela("login.php?id='.md5($nomor).'")><i class="fa fa-print"></i> Cetak/Save/Cek e-Email Login Pendaftaran</a></div>';
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


if($xt1==1||$xt2==1||$xt3==1)
{
	


$content .= '
<form method="POST" action="" enctype="multipart/form-data" name="input_jabatan">
<table width=100%>
'.$xb.'
<tr><td>Jenis Kelas</td><td>:</td><td><select name="sumber" required>
			<option value="">-- Pilih Salah Satu --</option>
			<option value="Class Online">Class Online</option>
			</select>
			
			</td></tr>
			
			
			<tr>
<td></td>
<td></td>
<td><input type="text" name="sumber2" placeholder="Keterangan"></td>
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
<td>'.input_number ('telp',@$_POST['telp']).'</td>
</tr>
		


	
			
	<tr>
<td>Email</td>
<td>:</td>
<td>'.input_text ('email',@$_POST['email']).'</td>
</tr>
		
	<tr>
<td>Nama Ibu Kandung</td>
<td>:</td>
<td>'.input_text ('ibu',@$_POST['ibu']).'</td>
</tr>
		
<tr>
<td>Asal Perguruan Tinggi</td>
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
<td><input type="submit" name="submit" value="Daftar"></td>
</tr>

</table>
</form>
';

} else {
	
	$content .= '<div class="error">PMB Online sudah ditutup.</div>';
}

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