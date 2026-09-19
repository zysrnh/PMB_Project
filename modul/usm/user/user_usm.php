<h4>Status USM</h4>


  
  
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
	$statusx = $kk1kx['lulus'];
$statusberkas = $kk1kx['statusberkas'];
}



if (isset ($_POST['submit'])){
	
	

$nama = cleantext($_POST['nama']);


	
$image_name2		=$_FILES['image2']['name'];
$image_size2		=$_FILES['image2']['size'];
$image_type2		=$_FILES['image2']['type'];

$image_name3		=$_FILES['image3']['name'];
$image_size3		=$_FILES['image3']['size'];
$image_type3		=$_FILES['image3']['type'];

$image_name4		=$_FILES['image4']['name'];
$image_size4		=$_FILES['image4']['size'];
$image_type4		=$_FILES['image4']['type'];

$image_name5		=$_FILES['image5']['name'];
$image_size5		=$_FILES['image5']['size'];
$image_type5		=$_FILES['image5']['type'];




$url=str_replace(" ", "-", $user);

$foto2	="$url-2.jpg";
$foto3	="$url-3.jpg";
$foto4	="$url-4.jpg";
$foto5	="$url-5.jpg";

$check2 = getimagesize($_FILES['image2']['tmp_name']);
$check3 = getimagesize($_FILES['image3']['tmp_name']);
$check4 = getimagesize($_FILES['image4']['tmp_name']);
$check5 = getimagesize($_FILES['image5']['tmp_name']);

if($check !== false && $check2 !== false && $check3 !== false && $check4 !== false && $check5 !== false && $check6 !== false) {
	
	$insert = $koneksi_db->sql_query ("UPDATE `mod_data_pmb` SET `foto2`='$foto2',`foto3`='$foto3',`foto4`='$foto4',`foto5`='$foto5',`statusberkas`='1' WHERE `nomor` = '$user'");
	$content .= '<div class="sukses">Anda sudah berhasil melakukan upload berkas.</div>';
	copy($_FILES['image2']['tmp_name'], "./files/berkas/temp/".$foto2."");
				copy($_FILES['image3']['tmp_name'], "./files/berkas/temp/".$foto3."");
					copy($_FILES['image4']['tmp_name'], "./files/berkas/temp/".$foto4."");
						copy($_FILES['image5']['tmp_name'], "./files/berkas/temp/".$foto5."");

	if($image_type2=='image/jpeg')
{
	function createthumbs2($origImagePath, $tnImagePath, $fname, $thumbWidth)
{
    // 1. open the originals directory
    $dir = opendir($origImagePath);
    // 2. Find the original imaeg file
    // 3. load image and get image size
    $img = imagecreatefromjpeg("{$origImagePath}{$fname}");
    $width = imagesx($img);
    $height = imagesy($img);
    // 4. calculate thumbnail size
    $new_width = $thumbWidth;
    $new_height = floor($height * ($thumbWidth / $width));
    // 5. create a new temporary image
    $tmp_img = imagecreatetruecolor($new_width, $new_height);
    // 6. copy and resize old image into new image
    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    // 7. save thumbnail into a file
    imagejpeg($tmp_img, "{$tnImagePath}{$fname}");
    // 8. close the directory
    closedir($dir);
}
} else {
	
	function createthumbs2($origImagePath, $tnImagePath, $fname, $thumbWidth)
{
    // 1. open the originals directory
    $dir = opendir($origImagePath);
    // 2. Find the original imaeg file
    // 3. load image and get image size
    $img = imagecreatefrompng("{$origImagePath}{$fname}");
    $width = imagesx($img);
    $height = imagesy($img);
    // 4. calculate thumbnail size
    $new_width = $thumbWidth;
    $new_height = floor($height * ($thumbWidth / $width));
    // 5. create a new temporary image
    $tmp_img = imagecreatetruecolor($new_width, $new_height);
    // 6. copy and resize old image into new image
    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    // 7. save thumbnail into a file
    imagepng($tmp_img, "{$tnImagePath}{$fname}");
    // 8. close the directory
    closedir($dir);
}
}	
createthumbs2("files/berkas/temp/", "files/berkas/", "$foto2", 1024);
		
		







	if($image_type3=='image/jpeg')
{
	function createthumbs3($origImagePath, $tnImagePath, $fname, $thumbWidth)
{
    // 1. open the originals directory
    $dir = opendir($origImagePath);
    // 2. Find the original imaeg file
    // 3. load image and get image size
    $img = imagecreatefromjpeg("{$origImagePath}{$fname}");
    $width = imagesx($img);
    $height = imagesy($img);
    // 4. calculate thumbnail size
    $new_width = $thumbWidth;
    $new_height = floor($height * ($thumbWidth / $width));
    // 5. create a new temporary image
    $tmp_img = imagecreatetruecolor($new_width, $new_height);
    // 6. copy and resize old image into new image
    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    // 7. save thumbnail into a file
    imagejpeg($tmp_img, "{$tnImagePath}{$fname}");
    // 8. close the directory
    closedir($dir);
}
} else {
	
	function createthumbs3($origImagePath, $tnImagePath, $fname, $thumbWidth)
{
    // 1. open the originals directory
    $dir = opendir($origImagePath);
    // 2. Find the original imaeg file
    // 3. load image and get image size
    $img = imagecreatefrompng("{$origImagePath}{$fname}");
    $width = imagesx($img);
    $height = imagesy($img);
    // 4. calculate thumbnail size
    $new_width = $thumbWidth;
    $new_height = floor($height * ($thumbWidth / $width));
    // 5. create a new temporary image
    $tmp_img = imagecreatetruecolor($new_width, $new_height);
    // 6. copy and resize old image into new image
    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    // 7. save thumbnail into a file
    imagepng($tmp_img, "{$tnImagePath}{$fname}");
    // 8. close the directory
    closedir($dir);
}
}	
createthumbs3("files/berkas/temp/", "files/berkas/", "$foto3", 1024);
		






	if($image_type4=='image/jpeg')
{
	function createthumbs4($origImagePath, $tnImagePath, $fname, $thumbWidth)
{
    // 1. open the originals directory
    $dir = opendir($origImagePath);
    // 2. Find the original imaeg file
    // 3. load image and get image size
    $img = imagecreatefromjpeg("{$origImagePath}{$fname}");
    $width = imagesx($img);
    $height = imagesy($img);
    // 4. calculate thumbnail size
    $new_width = $thumbWidth;
    $new_height = floor($height * ($thumbWidth / $width));
    // 5. create a new temporary image
    $tmp_img = imagecreatetruecolor($new_width, $new_height);
    // 6. copy and resize old image into new image
    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    // 7. save thumbnail into a file
    imagejpeg($tmp_img, "{$tnImagePath}{$fname}");
    // 8. close the directory
    closedir($dir);
}
} else {
	
	function createthumbs4($origImagePath, $tnImagePath, $fname, $thumbWidth)
{
    // 1. open the originals directory
    $dir = opendir($origImagePath);
    // 2. Find the original imaeg file
    // 3. load image and get image size
    $img = imagecreatefrompng("{$origImagePath}{$fname}");
    $width = imagesx($img);
    $height = imagesy($img);
    // 4. calculate thumbnail size
    $new_width = $thumbWidth;
    $new_height = floor($height * ($thumbWidth / $width));
    // 5. create a new temporary image
    $tmp_img = imagecreatetruecolor($new_width, $new_height);
    // 6. copy and resize old image into new image
    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    // 7. save thumbnail into a file
    imagepng($tmp_img, "{$tnImagePath}{$fname}");
    // 8. close the directory
    closedir($dir);
}
}	
createthumbs4("files/berkas/temp/", "files/berkas/", "$foto4", 1024);
		



	if($image_type5=='image/jpeg')
{
	function createthumbs5($origImagePath, $tnImagePath, $fname, $thumbWidth)
{
    // 1. open the originals directory
    $dir = opendir($origImagePath);
    // 2. Find the original imaeg file
    // 3. load image and get image size
    $img = imagecreatefromjpeg("{$origImagePath}{$fname}");
    $width = imagesx($img);
    $height = imagesy($img);
    // 4. calculate thumbnail size
    $new_width = $thumbWidth;
    $new_height = floor($height * ($thumbWidth / $width));
    // 5. create a new temporary image
    $tmp_img = imagecreatetruecolor($new_width, $new_height);
    // 6. copy and resize old image into new image
    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    // 7. save thumbnail into a file
    imagejpeg($tmp_img, "{$tnImagePath}{$fname}");
    // 8. close the directory
    closedir($dir);
}
} else {
	
	function createthumbs5($origImagePath, $tnImagePath, $fname, $thumbWidth)
{
    // 1. open the originals directory
    $dir = opendir($origImagePath);
    // 2. Find the original imaeg file
    // 3. load image and get image size
    $img = imagecreatefrompng("{$origImagePath}{$fname}");
    $width = imagesx($img);
    $height = imagesy($img);
    // 4. calculate thumbnail size
    $new_width = $thumbWidth;
    $new_height = floor($height * ($thumbWidth / $width));
    // 5. create a new temporary image
    $tmp_img = imagecreatetruecolor($new_width, $new_height);
    // 6. copy and resize old image into new image
    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    // 7. save thumbnail into a file
    imagepng($tmp_img, "{$tnImagePath}{$fname}");
    // 8. close the directory
    closedir($dir);
}
}	
createthumbs5("files/berkas/temp/", "files/berkas/", "$foto5", 1024);
	
} else {
	
	$content .= '
	<div class="error">
	Silahkan upload file gambar/foto (JPG).  
	</div>
	
	'; 
}
	
	
}









$propinsi12xx2 = $koneksi_db->sql_query("SELECT * FROM mod_data_periode WHERE id='1'");
while($p11xx2=$koneksi_db->sql_fetchrow($propinsi12xx2)){
	$berkas = $p11xx2['berkas'];
$reg = $p11xx2['reg'];
}		

if($statusx=='Lulus')
{
	$content .= '<div class="sukses">Selamat anda sudah di nyatakan lulus.</div>
	
	
	Silahkan lakukan registrasi pada tanggal '.datetimess($reg).'.<br/> Berikut daftar tagihan yang harus dibayar :
<ul>';
	$query2 = $koneksi_db->sql_query ("SELECT * FROM `mod_data_bayar` ORDER By `id` ASC");
while ($data2 = $koneksi_db->sql_fetchrow($query2)){
$datab = $data2['nama'];
$content .= '<li>'.$data2['nama'].', Rp. '.matauang($data2['total']).'</li>';

}
	
	
	
	
	
	$content .= '</ul> ';

if($statusberkas==1){

	$content .= '<div class="sukses">Anda sudah melakukan upload berkas.</div>';

} else {




	
	$content .= '<br/><h5 style="color:red;">Silahkan upload berkas berikut :</h5>




<form method="POST" action="" enctype="multipart/form-data" name="input_jabatan">
<table width=100%>


<tr>
<td>Foto (JPG)</td>
<td>:</td>
<td><input name="image2" type="file" required></td>
</tr>
<tr>
<td>Ijazah (JPG)</td>
<td>:</td>
<td><input name="image3" type="file"  required></td>
</tr>
<tr>
<td>KTP (JPG)</td>
<td>:</td>
<td><input name="image4" type="file" required></td>
</tr>
<tr>
<td>KK (JPG)</td>
<td>:</td>
<td><input name="image5" type="file" required></td>
</tr>

<tr>
<td></td>
<td></td>
<td><input type="submit" name="submit" value="Upload"></td>
</tr>

</table>
</form>

	

';
}
	
} 
elseif($statusx=='Tidak Lulus')
{
	$content .= '<div class="error">Maaf data anda tidak lulus.</div>';
}
else {
	
	$content .= '<div class="error">Maaf belum ada informasi terkait status USM.</div>';

}

break;	
	
	


}














/////////////
echo $content;

?> 