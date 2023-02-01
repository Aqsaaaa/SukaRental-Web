<?php 

include 'koneksi.php';
if (isset($_POST['id'])) {
    if ($_POST['id'] != "") {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $jenis_mtr = $_POST['jenis_mtr'];
        $no_plat = $_POST['no_plat'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $harga = $_POST['harga'];
        $foto_nama = $_FILES['image']['name'];
        $foto_size = $_FILES['image']['size'];

    }else{
        header("location:index.php");
    }

    if ($foto_size > 2097152) {
       header("location:index.php?pesan=size");

    }else{

       if ($foto_nama != "") {

          $ekstensi_izin = array('png','jpg','jepg');
          $pisahkan_ekstensi = explode('.', $foto_nama); 
          $ekstensi = strtolower(end($pisahkan_ekstensi));
          $file_tmp = $_FILES['image']['tmp_name'];   
          $tanggal = md5(date('Y-m-d h:i:s'));
          $foto_nama_new = $tanggal.'-'.$foto_nama; 
          if(in_array($ekstensi, $ekstensi_izin) === true)  {

            $get_foto = "SELECT image FROM motor WHERE id='$id'";
            $data_foto = mysqli_query($koneksi, $get_foto); 
            $foto_lama = mysqli_fetch_array($data_foto);
            unlink("foto/".$foto_lama['image']);    
            move_uploaded_file($file_tmp, 'foto/'.$foto_nama_new);
            
            $query = mysqli_query($koneksi, "UPDATE motor SET nama='$nama', jenis_mtr='$jenis_mtr', no_plat='$no_plat', alamat='$alamat', no_telp='$no_telp', harga='$harga', image='$foto_nama_new' WHERE id='$id'");

            if($query){
            	header("location:index.php?pesan=berhasil");
            } else {
                header("location:index.php?pesan=gagal");
            }

        } else { 
        	header("location:index.php?pesan=ekstensi");        }

        }else{
          $query = mysqli_query($koneksi, "UPDATE motor SET nama='$nama', jenis_mtr='$jenis_mtr', alamat='$alamat', image='$foto_nama_new' WHERE id='$id'");
            if($query){
                header("location:index.php?pesan=berhasil");
            }else {
                header("location:index.php?pesan=gagal");
            }
        }

    }
}else{
    header("location:index.php");
}
?>