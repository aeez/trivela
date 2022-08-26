
<?php include 'template/header.php';?>
<br>
<?php
if($_SESSION['level'] != "admin"){
    echo '<script>alert("Maaf Pengguna Yang Terhormat \nRequest yang kamu inginkan tidak dapat kami kabulkan");window.location="login.php"</script>';
	}
?>
<?php
            if(isset($_POST['tambahUser']))
            {
                $nama_toko= htmlspecialchars($_POST['nama_toko']);
                $username = htmlspecialchars($_POST['username']);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $alamat = htmlspecialchars($_POST['alamat']);
                $telepon = htmlspecialchars($_POST['telepon']);
                $level= htmlspecialchars($_POST['level']);

                $tambahus = mysqli_query($conn,"INSERT INTO login (nama_toko,username, password, alamat, telepon, level)
                values ('$nama_toko','$username','$password','$alamat', '$telepon','$level')");
                if ($tambahus){
                    echo '<script>alert("Berhasil Menambahkan Data");window.location="user.php"</script>';
                } else {
                    echo '<script>alert("Gagal Menambahkan Data");history.go(-1);</script>';
                }
                
            };

            if(isset($_POST['updateUser'])){
                $id_login = htmlspecialchars($_POST['id_login']);
                $nama_toko= htmlspecialchars($_POST['nama_toko']);
                $username = htmlspecialchars($_POST['username']);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $alamat = htmlspecialchars($_POST['alamat']);
                $telepon = htmlspecialchars($_POST['telepon']);
                $level= htmlspecialchars($_POST['level']);

                mysqli_query($conn,"UPDATE login SET
                nama_toko='$nama_toko',username='$username',password='$password',alamat='$alamat',telepon='$telepon',level='$level'
                WHERE id_login='$id_login' ");
                echo '<script>alert("Berhasil Update data pelanggan");window.location="user.php"</script>';
            };
            ?>
<div class="card">
    <div class="card-header">
        <div class="card-tittle"><i class="fa fa-table me-2"></i> Data Pengguna
        <button type="button" class="btn btn-primary btn-xs p-2 float-right" data-toggle="modal" data-target="#addpelanggan">
            <i class="fa fa-plus fa-xs mr-1"></i> Tambah Data</button></div>
    </div>
        <div class="card-body">
            <table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pengguna</th>
                            <th>level</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $data_produk=mysqli_query($conn,"SELECT * FROM login order by id_login ASC");
                                while($d=mysqli_fetch_array($data_produk)){
                                    $id_login = $d['id_login'];
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $d['username'] ?></td>
                                        <td><?php echo $d['level'] ?></td>
                                        <td><?php echo $d['telepon'] ?></td>
                                        <td><?php echo $d['alamat'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs"
                                             data-toggle="modal" data-target="#editP<?php echo $id_login ?>">
                                             <i class="fa fa-pen fa-xs mr-1"></i>Edit</button>
                                            <a class="btn btn-danger btn-xs" href="?hapus=<?php echo $id_login ?>" 
                                            onclick="javascript:return confirm('Hapus Data Pengguna - <?php echo $d['username'] ?> ?');">
                                            <i class="fa fa-trash fa-xs mr-1"></i>Hapus</a>
                                        </td>
                                    </tr>
                                    
                                    <!-- modal edit -->
                                    <div class="modal fade" id="editP<?php echo $id_login ?>" tabindex="-1" role="dialog" aria-labelledby="ModalTittle2" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <form method="post">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalTittle2"><i class="fa fa-user mr-1 text-muted"></i> Edit Pengguna</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group mb-2">
                                                    <label>Nama Pengguna :</label>
                                                    <input type="hidden" name="id_login" class="form-control" value="<?php echo $d['id_login'] ?>">
                                                    <input type="text" name="username" class="form-control" value="<?php echo $d['username'] ?>" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Nama Toko :</label>
                                                    <input type="text" name="nama_toko" class="form-control" value="<?php echo $d['nama_toko'] ?>" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Password :</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Alamat :</label>
                                                    <input type="text" name="alamat" class="form-control" value="<?php echo $d['alamat'] ?>" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Telepon :</label>
                                                    <input type="text" name="telepon" class="form-control" value="<?php echo $d['telepon'] ?>" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Level :</label><br>
                                                    <input type="radio" id="a1" name="level" value="admin" required>
                                                    <label for="a1">Admin</label><br>
                                                    <input type="radio" id="a2" name="level" value="pemilik" required>
                                                    <label for="a2">Pemilik</label><br>
                                                    <input type="radio" id="a3" name="level" value="petugas" required>
                                                    <label for="a3">Petugas</label><br>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light btn-xs p-2" data-dismiss="modal">
                                                    <i class="fa fa-times mr-1"></i> Batal</button>
                                                <button type="submit" class="btn btn-primary btn-xs p-2" name="updateUser">
                                                <i class="fa fa-plus-circle mr-1"></i> Simpan</button>
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    <!-- end modal edit -->
                        <?php }?>
					</tbody>
                </table>
        </div>
</div>
<?php 
	if(!empty($_GET['hapus'])){
		$id_login = $_GET['hapus'];
		$hapus_data = mysqli_query($conn, "DELETE FROM login WHERE id_login='$id_login'");
        if($hapus_data){
            echo '<script>alert("Berhasi Hapus pelanggan");window.location="user.php"</script>';
        } else {
            echo '<script>alert("gagal Hapus pelanggan");history.go(-1);</script>';
        }
	};
    ?>
<!-- Modal -->
<div class="modal fade" id="addpelanggan" tabindex="-1" role="dialog" aria-labelledby="ModalTittle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTittle"><i class="fa fa-shopping-bag mr-1 text-muted"></i> Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group mb-2">
                                                    <label>Nama Pengguna :</label>
                                                    <input type="hidden" name="id_login" class="form-control" value="<?php echo $d['id_login'] ?>">
                                                    <input type="text" name="username" class="form-control" value="<?php echo $d['username'] ?>" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Nama Toko :</label>
                                                    <input type="text" name="nama_toko" class="form-control" value="<?php echo $d['nama_toko'] ?>" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Password :</label>
                                                    <input type="password" name="password" class="form-control" value="<?php echo $d['password'] ?>" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Alamat :</label>
                                                    <input type="text" name="alamat" class="form-control" value="<?php echo $d['alamat'] ?>" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Telepon :</label>
                                                    <input type="text" name="telepon" class="form-control" value="<?php echo $d['telepon'] ?>" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Level :</label><br>
                                                    <input type="radio" id="a11" name="level" value="admin" required>
                                                    <label for="a11">Admin</label><br>
                                                    <input type="radio" id="a22" name="level" value="pemilik" required>
                                                    <label for="a22">Pemilik</label><br>
                                                    <input type="radio" id="a33" name="level" value="petugas" required>
                                                    <label for="a33">Petugas</label><br>
                                                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light btn-xs p-2" data-dismiss="modal">
            <i class="fa fa-times mr-1"></i> Batal</button>
        <button type="reset" class="btn btn-danger btn-xs p-2">
        <i class="fa fa-trash-restore-alt mr-1"></i> Reset</button>
        <button type="submit" class="btn btn-primary btn-xs p-2" name="tambahUser">
        <i class="fa fa-plus-circle mr-1"></i> Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php include 'template/footer.php';?>
