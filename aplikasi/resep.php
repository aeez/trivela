
<?php include 'template/header.php';?>

<?php
if($_SESSION['level'] == "petugas" || $_SESSION['level'] == "pemilik" || $_SESSION['level'] == "admin"){
    echo '<script>alert("Maaf Pengguna Yang Terhormat \nRequest yang kamu inginkan tidak dapat kami kabulkan \nKarena masih dalam tahap pengembangan");window.location="login.php"</script>';
}
?>
<div class="row mt-3 mb-4">
<div class="col-lg-12" id="print">
    <form id="myCartNew" method="post">
    <div class="row print-none">
        <div class="col-12 col-lg-3 m-pr-0">
        <?php 
            $barang=mysqli_query($conn, "SELECT * FROM produk ORDER BY idproduk ASC");
            // $jsArray = "var harga_jual = new Array();";
            $jsArray1 = "var nama_produk = new Array();";
            $jsArray3 = "var idproduk = new Array();";
            // $jsArray4 = "var stock = new Array();";
            ?>
            <label class="mb-1">Kode Produk</label>
            <div class="input-group">
                <input type="text" class="form-control form-control-sm border-right-0" list="datalist1"
                 onchange="changeValue(this.value)"  aria-describedby="basic-addon2" required>
                <datalist id="datalist1">
                <?php  
                if(mysqli_num_rows($barang)) {
                 while($row_brg= mysqli_fetch_array($barang)) {?>
                        <option value="<?php echo $row_brg["kode_produk"]?>"> <?php echo $row_brg["kode_produk"]?> 
                        <?php //$jsArray .= "harga_jual['" . $row_brg['kode_produk'] . "'] = {harga_jual:'" . addslashes($row_brg['harga_jual']) . "'};";
                                $jsArray1 .= "nama_produk['" . $row_brg['kode_produk'] . "'] = {nama_produk:'" . addslashes($row_brg['nama_produk']) . "'};";
                                $jsArray3 .= "idproduk['" . $row_brg['kode_produk'] . "'] = {idproduk:'" . addslashes($row_brg['idproduk']) . "'};"; } ?>
                <?php } ?>
                    </datalist>
                    <div class="input-group-append">
                        <span class="input-group-text bg-white border-left-0 pr-1" id="basic-addon2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                            <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
                            </svg></span>
                    </div>
                </div>
        </div>
        <div class="col-12 col-lg-3 m-pr-0">
            <label class="mb-1">Nama Produk</label>
            <input type="hidden" class="form-control form-control-sm bg-white" name="idproduk" id="idproduk" readonly>
            <input type="text" class="form-control form-control-sm bg-white" id="nama_produk" readonly>
        </div>
        <!-- <div class="col-6 col-lg-2 m-pr-0">
            <label class="mb-1">Harga</label>
            <input type="text" class="form-control form-control-sm bg-white" id="harga_jual"
             onchange="total()">
        </div> -->
        <div class="col-12 col-lg-3 m-pr-0">
            <?php 
            $barang=mysqli_query($conn, "SELECT * FROM produk ORDER BY idproduk ASC");
            $jsArray = "var harga_jual = new Array();";
            $jsArray1 = "var nama_produk = new Array();";
            $jsArray3 = "var idproduk = new Array();";
            $jsArray4 = "var stock = new Array();";
            ?>
            <label class="mb-1">Bahan Baku</label>
            <div class="input-group">
                <input type="text" class="form-control form-control-sm border-right-0" list="datalist1"
                 onchange="changeValue(this.value)"  aria-describedby="basic-addon2" required>
                <datalist id="datalist1">
                <?php  
                if(mysqli_num_rows($barang)) {
                 while($row_brg= mysqli_fetch_array($barang)) {?>
                        <option value="<?php echo $row_brg["kode_produk"]?>"> <?php echo $row_brg["kode_produk"]?> 
                        <?php $jsArray .= "harga_jual['" . $row_brg['kode_produk'] . "'] = {harga_jual:'" . addslashes($row_brg['harga_jual']) . "'};";
                                $jsArray1 .= "nama_produk['" . $row_brg['kode_produk'] . "'] = {nama_produk:'" . addslashes($row_brg['nama_produk']) . "'};";
                                $jsArray3 .= "idproduk['" . $row_brg['kode_produk'] . "'] = {idproduk:'" . addslashes($row_brg['idproduk']) . "'};";
                                $jsArray4 .= "stock['" . $row_brg['kode_produk'] . "'] = {stock:'" . addslashes($row_brg['stock']) . "'};"; } ?>
                <?php } ?>
                    </datalist>
                    <div class="input-group-append">
                        <span class="input-group-text bg-white border-left-0 pr-1" id="basic-addon2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                            <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
                            </svg></span>
                    </div>
                </div>
        
        </div>
        <div class="col-12 col-lg-3 m-pr-0">
            <label class="mb-1">Kuantitas (Gram)</label>
            <div class="input-group">
            <input type="number" class="form-control form-control-sm" id="quantity"
            name="quantity" placeholder="0" required>
            <div class="input-group-append">
                <button class="btn btn-danger btn-sm border-0" type="reset">
                    <i class="fa fa-trash-restore-alt"></i> Reset</button>
            </div>
            </div>
        </div>
    </div><!-- end row -->
</form>
<?php
if(isset($_POST['tambahcuy'])){
    $idproduk  = $_POST['idproduk'];
    $quantity  = $_POST['quantity'];
    $cekBarang = mysqli_query($conn, "SELECT * FROM produk WHERE idproduk='$idproduk'");
    $stocknya  = mysqli_fetch_array($cekBarang);
    $stock     = $stocknya['stock'];
    $sisa      = $stock-$quantity;
    
    if ($stock < $quantity) {
    echo '<script>alert("Oops! Jumlah pengeluaran lebih besar dari stok ...");window.location="index.php"</script>';
    }   
    else{
     $insert = mysqli_query($conn, "INSERT INTO keranjang (idproduk,quantity) VALUES ('$idproduk','$quantity')");
      if($insert){
        $upstok = mysqli_query($conn, "UPDATE produk SET stock='$sisa' WHERE idproduk='$idproduk'");
        echo '<script>window.location="index.php"</script>';
     }
    else { echo '<script>alert("ERROR.");history.go(-1);</script>';}
    }
    }
?>
</div>
</div>





<!-- ======================= sesi 1========================== -->
<table class="table table-striped table-sm table-bordered dt-responsive nowrap print-none" id="cart" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $subtotalcart1= 0;
                                $no=1;
                                $data_produk=mysqli_query($conn,"SELECT * FROM keranjang c, produk p
                                WHERE p.idproduk=c.idproduk ORDER BY idcart ASC");
                                while ($d = $data_produk->fetch_assoc()) {
                                    $idcart = $d['idcart'];
                                    $subtotalcart = $d['harga_jual'] * $d['quantity'];
                                    $subtotalcart1 += $subtotalcart;
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $d['kode_produk'] ?></td>
                                        <td><?php echo $d['nama_produk'] ?></td>
                                        <td>Rp.<?php echo ribuan($d['harga_jual']) ?></td>
                                        <td><?php echo $d['quantity'] ?></td>
                                        <td>Rp.<?php echo ribuan($subtotalcart) ?></td>
                                        <td>
                                            <form method="post" class="d-inline-block">
                                            <input type="hidden" name="idpr" value="<?php echo $d['idproduk'] ?>">
                                            <input type="hidden" name="idcc" value="<?php echo $d['idcart'] ?>">
                                                <input type="hidden" name="jml" value="<?php echo $d['quantity'] ?>">
                                                <button type="submit" name="upone" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-xs mr-1"></i>Hapus</a></button>
                                            </form>
                                        </td>
                                    </tr>		
                        <?php 
                        if(isset($_POST['upone'])){
                            $idcartt = $_POST['idcc'];
                            $idproduk = $_POST['idpr'];
                            $jml = $_POST['jml'];
                        
                            $cekBarang1 = mysqli_query($conn, "SELECT * FROM produk WHERE idproduk='$idproduk'");
                            $stocknya1  = mysqli_fetch_array($cekBarang1);
                            $stockk     = $stocknya1['stock'];
                            //menghitung sisa stok
                            $sisa1    =$stockk+$jml;
                            
                            if ($stockk < $jml) {
                        
                            }
                            //proses    
                            else{
                                $insert1 = mysqli_query($conn, "UPDATE produk SET stock='$sisa1' WHERE idproduk='$idproduk'");
                                    if($insert1){
                                        //update stok
                                        $hapus_data = mysqli_query($conn, "DELETE FROM keranjang WHERE idcart ='$idcartt'");
                                        echo '<script>alert("Data Berhasil Di Hapus");window.location="index.php"</script>';
                                    } else {
                                        echo '<script>alert("ERROR.");history.go(-1);</script>';
                                    }
                            }
                            }
                    }?>
					</tbody>
                </table>
                <!-- ========simpan reset  ===============-->
        <div class="col-12 text-right pr-0 mt-4 mb-4">
                                <button type="reset" class="btn btn-danger btn-sm px-3">
                                    <i class="fa fa-trash-restore-alt mr-1"></i> Reset
                                </button>
                                <button type="submit" name="save" class="btn btn-primary btn-sm px-3">
                                    <i class="far fa-file mr-1"></i> Simpan
                                </button>
                            </div>

<!-- ========data resep========================== -->
<div class="card">
    <div class="card-header">
        <div class="card-tittle"><i class="fa fa-table me-2 d-none d-sm-inline-block d-md-inline-block"></i> Data Resep
        <form method="POST" class="float-right">
                <div class="input-group">
                    <!-- <input type="text" name="nama_kategori" class="form-control form-control-sm bg-white"
                    style="border-radius:0.428rem 0px 0px 0.428rem;"
                    placeholder="Masukan Kategori" required> -->

                    <input type="text" class="form-control form-control-sm" list="datalist1"
                 onchange="changeValue(this.value)"  aria-describedby="basic-addon2" style="border-radius:0.428rem 0px 0px 0.428rem;"
                    placeholder="Masukan Kategori" required>
                <datalist id="datalist1">
                <?php  
                if(mysqli_num_rows($barang)) {
                 while($row_brg= mysqli_fetch_array($barang)) {?>
                        <option value="<?php echo $row_brg["kode_produk"]?>"> <?php echo $row_brg["kode_produk"]?> 
                        <?php //$jsArray .= "harga_jual['" . $row_brg['kode_produk'] . "'] = {harga_jual:'" . addslashes($row_brg['harga_jual']) . "'};";
                                $jsArray1 .= "nama_produk['" . $row_brg['kode_produk'] . "'] = {nama_produk:'" . addslashes($row_brg['nama_produk']) . "'};";
                                $jsArray3 .= "idproduk['" . $row_brg['kode_produk'] . "'] = {idproduk:'" . addslashes($row_brg['idproduk']) . "'};"; } ?>
                <?php } ?>
                 </datalist>
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-xs p-1" name="addkategori"
                        style="border-radius: 0px 0.428rem 0.428rem 0px;" type="submit">
                            <i class="fa fa-plus"></i><span class="d-none d-sm-inline-block d-md-inline-block ml-1">Tambah</span>
                        </button>
                    </div>
                </div>
            </form>
            </div>
    </div>
        <div class="card-body">
            <table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Jumlah Bahan Baku</th>
                            <th>Tanggal</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $data_produk=mysqli_query($conn,"SELECT * FROM kategori ORDER BY idkategori ASC");
                                while($d=mysqli_fetch_array($data_produk)){
                                    $idkategori = $d['idkategori'];
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $d['nama_kategori'] ?></td>
                                        <td><?php 
                                            $result1 = mysqli_query($conn,"SELECT Count(idproduk) AS count FROM produk p, kategori k WHERE p.idkategori=k.idkategori and k.idkategori='$idkategori' ORDER BY idproduk ASC");
                                            $cekrow = mysqli_num_rows($result1);
                                            $row1 = mysqli_fetch_assoc($result1);
                                            $count = $row1['count'];
                                            if($cekrow > 0){
                                            echo ribuan($count);
                                            }
                                        ?></td>
                                        <td><?php echo $d['tgl_dibuat'] ?></td>
                                        <td>
                                        <a href="?edit=<?php echo $idkategori ?>" class="btn btn-primary btn-xs">
                                            <i class="fa fa-pen fa-xs mr-1"></i>Edit
                                        </a>
                                            <a class="btn btn-danger btn-xs" href="?hapus=<?php echo $idkategori ?>" 
                                            onclick="javascript:return confirm('Hapus Data produk - <?php echo $d['nama_kategori'] ?> ?');">
                                            <i class="fa fa-trash fa-xs mr-1"></i>Hapus</a>
                                        </td>
                                    </tr>		
                        <?php }?>
					</tbody>
                </table>
        </div>
    </div>
</div>