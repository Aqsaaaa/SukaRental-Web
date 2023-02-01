<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css">
  <title>Data Motor</title>
</head>

<body>

  <nav>
    <div class="logo">
      <i class="bx bx-menu menu-icon"></i>
      <span class="logo-name">CodingLab</span>
    </div>
    <div class="sidebar">
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <span class="logo-name">CodingLab</span>
      </div>

      <div class="sidebar-content">
        <ul class="lists">
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-home-alt icon"></i>
              <span class="link">Dashboard</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-bar-chart-alt-2 icon"></i>
              <span class="link">Revenue</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-bell icon"></i>
              <span class="link">Notifications</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-message-rounded icon"></i>
              <span class="link">Messages</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-pie-chart-alt-2 icon"></i>
              <span class="link">Analytics</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-heart icon"></i>
              <span class="link">Likes</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-folder-open icon"></i>
              <span class="link">Files</span>
            </a>
          </li>
        </ul>

        <div class="bottom-cotent">
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-cog icon"></i>
              <span class="link">Settings</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-log-out icon"></i>
              <span class="link">Logout</span>
            </a>
          </li>
        </div>
      </div>
    </div>
  </nav>

  <section class="overlay"></section>

  <script>
    const navBar = document.querySelector("nav"),
      menuBtns = document.querySelectorAll(".menu-icon"),
      overlay = document.querySelector(".overlay");

    menuBtns.forEach((menuBtn) => {
      menuBtn.addEventListener("click", () => {
        navBar.classList.toggle("open");
      });
    });

    overlay.addEventListener("click", () => {
      navBar.classList.remove("open");
    });
  </script>


  <div class="container mb-5 " style="padding-top:3rem;">
    <center class="mt-5">
      <h2>Data Motor</h2>
    </center>
    <?php if (isset($_GET['pesan'])) { ?>
    <?php if ($_GET['pesan'] == "berhasil") { ?>
    <div class="alert alert-primary" role="alert">
      Berhasil Mengubah Data Motor
    </div>
    <?php }elseif ($_GET['pesan'] == "gagal") { ?>
    <div class="alert alert-danger" role="alert">
      Gagal Mengubah Data Motor
    </div>
    <?php }elseif ($_GET['pesan'] == "ekstensi") { ?>
    <div class="alert alert-warning" role="alert">
      Ekstensi File Harus PNG Dan JPG
    </div>
    <?php }elseif ($_GET['pesan'] == "size") { ?>
    <div class="alert alert-warning" role="alert">
      Size File Tidak Boleh Lebih Dari 2 MB
    </div>
    <?php }elseif ($_GET['pesan'] == "hapus") { ?>
    <div class="alert alert-primary" role="alert">
      Berhasil Menghapus Data Motor
    </div>
    <?php }elseif ($_GET['pesan'] == "gagalhapus") { ?>
    <div class="alert alert-danger" role="alert">
      Gagal Menghapus Data Motor
    </div>
    <?php } ?>
    <?php } ?>
    <br>
    <a href="insert.php" class="btn btn-primary mb-1">Tambah Data</a>
  

    <table class="table table-bordered 3 mt-3" id="myTable">
      <thead>
        <tr>
          <th scope="col" width="4%">#</th>
          <th scope="col" width="10%">Nama</th>
          <th scope="col" width="10%">Jenis Motor</th>
          <th scope="col" width="10%">No Plat</th>
          <th scope="col" width="20%">Alamat</th>
          <th scope="col" width="10%">No Hp</th>
          <th scope="col" width="10%">Harga</th>
          <th scope="col" width="20%">Foto</th>
          <th scope="col" width="12%">Opsi</th>
        </tr>
      </thead>

      <form method="GET" action="index.php" >
  <label>Kata Pencarian : </label>
  <input type="text" name="kata_cari" value="<?php if(isset($_GET['kata_cari'])) { echo $_GET['kata_cari']; } ?>"  />
  <button type="submit">Cari</button>
 </form>

      <tbody>
      
<?php
   include('koneksi.php');
   $no = 1;
    if(isset($_GET['kata_cari'])) {
     $kata_cari = $_GET['kata_cari'];
     $query = "SELECT * FROM motor WHERE harga like '%".$kata_cari."%' ORDER BY id ASC";
    } else {
     $query = "SELECT * FROM motor ORDER BY id ASC";
    }
    $result = mysqli_query($koneksi, $query);
    if(!$result) {
     die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
    }
    while ($row = mysqli_fetch_assoc($result)) {
   ?>

        <tr>
          
          <td><?php echo $no++; ?></td>
          <td><?php echo $row["nama"]; ?></td>
          <td><?php echo $row["jenis_mtr"]; ?></td>
          <td><?php echo $row["no_plat"]; ?></td>
          <td><?php echo $row["alamat"]; ?></td>
          <td><?php echo $row["no_telp"]; ?></td>
          <td><?php echo $row["harga"]; ?></td>
          <td>
            <?php 
							if ($row["image"] == "") { ?>
            <img src="https://via.placeholder.com/500x500.png?text=PAS+FOTO+SISWA" style="width:100px;height:100px;">
            <?php }else{ ?>
            <img src="foto/<?php echo $row["image"]; ?>" style="width:65%;height:50%;">
            <?php } ?>
          </td>
          <td>
            <a href="edit.php?id=<?php echo $row["id"] ?>" class="btn btn-warning text-white">Edit</a>
            <a href="delete.php?id=<?php echo $row["id"] ?>" class="btn btn-danger">Hapus</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php 
    
?>
  </div>
</body>

</html>