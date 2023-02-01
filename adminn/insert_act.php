<?php 
include 'koneksi.php';

$nama = $_POST['nama'];
$jenis_mtr = $_POST['jenis_mtr'];
$no_plat = $_POST['no_plat'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$harga = $_POST['harga'];
$foto_nama = $_FILES['image']['name'];
$foto_size = $_FILES['image']['size'];

if ($foto_size > 2097152) {
	header("location:insert.php?pesan=size");
}else{

	if ($foto_nama != "") {

		$ekstensi_izin = array('png','jpg','jepg');
		$pisahkan_ekstensi = explode('.', $foto_nama); 
		$ekstensi = strtolower(end($pisahkan_ekstensi));
		$file_tmp = $_FILES['image']['tmp_name'];   
		$tanggal = md5(date('Y-m-d h:i:s'));
		$foto_nama_new = $tanggal.'-'.$foto_nama; 

		if(in_array($ekstensi, $ekstensi_izin) === true)  {
            move_uploaded_file($file_tmp, 'foto/'.$foto_nama_new);

            $query = mysqli_query($koneksi, "INSERT INTO motor VALUES ('','$nama', '$jenis_mtr', '$no_plat', '$alamat', '$no_telp', '$harga', '$foto_nama_new')");

            if($query){
            	header("location:insert.php?pesan=berhasil");
            } else {
                header("location:insert.php?pesan=gagal");
            }

        } else { 
        	header("location:insert.php?pesan=ekstensi");        }

    }else{

    	 $query = mysqli_query($koneksi, "INSERT INTO motor(nama, jenis_mtr, no_plat, alamat, no_telp, harga, image) VALUES ('$nama','$jenis_mtr', '$no_plat', '$alamat','$no_telp', '$harga','$foto_nama_new')");

            if($query){
            	header("location:insert.php?pesan=berhasil");
            } else {
                header("location:insert.php?pesan=gagal");
            }

    }

}
?>