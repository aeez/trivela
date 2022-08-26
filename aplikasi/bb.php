
<?php include './template/header.php';?>

<?php
if($_SESSION['level'] == "petugas" || $_SESSION['level'] == "pemilik" || $_SESSION['level'] == "admin"){
    echo '<script>alert("Maaf Pengguna Yang Terhormat \nRequest yang kamu inginkan tidak dapat kami kabulkan \nKarena masih dalam tahap pengembangan");window.location="login.php"</script>';
}
?>

<br>
<?php
            if(isset($_POST['tambahProduk']))
            {
                $bahanbaku = htmlspecialchars($_POST['bahanbaku']);
                $tersedia = htmlspecialchars($_POST['tersedia']);
                $modal = htmlspecialchars($_POST['modal']);

                $tambahbb = mysqli_query($conn,"INSERT INTO bahan_baku (bahanbaku, tersedia, modal)
                values ('$bahanbaku','$tersedia','$modal')");
                if ($tambahbb){
                    echo '<script>alert("Berhasil Menambahkan Data");window.location="bahanBaku.php"</script>';
                } else {
                    echo '<script>alert("Gagal Menambahkan Data");history.go(-1);</script>';
                }
                
            };

            if(isset($_POST['updateProduk'])){
                $bahanbaku = htmlspecialchars($_POST['bahanbaku']);
                $tersedia = htmlspecialchars($_POST['tersedia']);
                $modal = htmlspecialchars($_POST['modal']);

                mysqli_query($conn,"UPDATE bahan_baku SET
                bahanbaku='$bahanbaku',tersedia='$tersedia',modal='$modal'");
                echo '<script>alert("Berhasil Update prdouk");window.location="bahanBaku.php"</script>';
            };
            ?>
<div class="card">
    <div class="card-header">
        <div class="card-tittle"><i class="fa fa-table me-2"></i> Data Bahan Baku
        <button type="button" class="btn btn-primary btn-xs p-2 float-right" data-toggle="modal" data-target="#addproduk">
            <i class="fa fa-plus fa-xs mr-1"></i> Tambah Bahan</button></div>
    </div>
        <div class="card-body">
            <table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Bahan</th>
                            <th>Stock</th>
                            <th>Harga Modal</th>
                            <th>Tanggal Input</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $data_produk=mysqli_query($conn,"SELECT * FROM bahan_baku order by id_bb ASC");
                                while($d=mysqli_fetch_array($data_produk)){
                                    $idproduk = $d['id_bb'];
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $d['bahanbaku'] ?></td>
                                        <td><?php echo $d['tersedia'] ?></td>
                                        <td>Rp.<?php echo ribuan($d['modal']) ?></td>
                                        <td><?php echo $d['tgl_input'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editP<?php echo $id_bb ?>">
                                            <i class="fa fa-pen fa-xs mr-1"></i>Edit</button>
                                            <a class="btn btn-danger btn-xs" href="?hapus=<?php echo $id_bb ?>" 
                                            onclick="javascript:return confirm('Hapus Data produk - <?php echo $d['bahanbaku'] ?> ?');">
                                            <i class="fa fa-trash fa-xs mr-1"></i>Hapus</a>
                                        </td>
                                    </tr>
                                    
                                    <!-- modal edit -->
                                    <div class="modal fade" id="editP<?php echo $id_bb ?>" tabindex="-1" role="dialog" aria-labelledby="ModalTittle2" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <form method="post">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalTittle2"><i class="fa fa-shopping-bag mr-1 text-muted"></i> Edit Produk</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group mb-2">
                                                    <label>Nama Bahan Baku :</label>
                                                    <input type="text" name="bahanbaku" class="form-control" value="<?php echo $d['bahanbaku'] ?>" required>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-2 col-md-2 pr-0">
                                                        <label>Stock :</label>
                                                        <input type="number" name="tersedia" class="form-control" value="<?php echo $d['tersedia'] ?>" required>
                                                    </div>
                                                    <div class="col-5 col-md-5 pr-0">
                                                        <label>Harga Modal :</label>
                                                        <input type="number" name="modal" value="<?php echo $d['modal'] ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light btn-xs p-2" data-dismiss="modal">
                                                    <i class="fa fa-times mr-1"></i> Batal</button>
                                                <button type="submit" class="btn btn-primary btn-xs p-2" name="updateProduk">
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
		$idproduk = $_GET['hapus'];
		$hapus_data = mysqli_query($conn, "DELETE FROM bahan_baku WHERE id_bb='$idproduk'");
        if($hapus_data){
            echo '<script>alert("Berhasil Hapus Data Produk");window.location="bahanBaku.php"</script>';
        } else {
            echo '<script>alert("Gagal Hapus Data Produk");history.go(-1);</script>';
        }
	};
    ?>
<!-- Modal -->
<div class="modal fade" id="addproduk" tabindex="-1" role="dialog" aria-labelledby="ModalTittle" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form method="post">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTittle"><i class="fa fa-shopping-bag mr-1 text-muted"></i> Tambah Bahan Baku</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group mb-2">
                <label>Nama Bahan Baku :</label>
                <input type="text" name="bahanbaku" class="form-control" required>
            </div>
            <div class="row mb-2">
                <div class="col-2 col-md-2 pr-0">
                    <label>Stock :</label>
                    <input type="number" name="tersedia" class="form-control" required>
                </div>
                <div class="col-5 col-md-5 pr-0">
                    <label>Harga Modal :</label>
                    <input type="number" name="modal" class="form-control" required>
                </div>
            </div>
        </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light btn-xs p-2" data-dismiss="modal">
        <i class="fa fa-times mr-1"></i> Batal</button>
        <button type="reset" class="btn btn-danger btn-xs p-2">
        <i class="fa fa-trash-restore-alt mr-1"></i> Reset</button>
        <button type="submit" class="btn btn-primary btn-xs p-2" name="tambahProduk">
        <i class="fa fa-plus-circle mr-1"></i> Simpan</button>
    </div>
    </form>
</div>
</div>
</div>
<?php include './template/footer.php';?>
