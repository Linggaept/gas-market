<?php require "header.php";

if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Silahkan Login Dulu');</script>";
    echo "<script>location='login.php';</script>";
}

$id = $_GET['id'];
// Get order status
$order_query = mysqli_query($db, "SELECT status FROM tbl_order WHERE id_order = '$id'");
$order_data = mysqli_fetch_assoc($order_query);
$order_status = $order_data['status'];
?>


<style>
    .banner .img {
        width: 100%;
        height: 250px;
        background-image: url('assets/img/4.jpg');
        padding: 0px;
        margin: 0px;
    }

    .img .box {
        height: 250px;
        background-color: rgb(41, 41, 41, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        color: white;
        padding-top: 70px;
    }

    .box a {
        color: #0066FF;
    }

    .box a:hover {
        text-decoration: none;
        color: rgb(6, 87, 209);
    }
</style>
<div class="banner mb-3">
    <div class="container-fluid img">
        <div class="container-fluid box">
            <h3>RINCIAN PRODUK</h3>
            <p>Home > <a href="orderan.php">Orderan</a> > <a href="#">Rincian Produk</a></p>
        </div>
    </div>
</div>

<div class="container bg-white rounded pt-4">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $id_pelanggan_current = $_SESSION['pelanggan']['id_pelanggan'];
                        $sql="SELECT * FROM tbl_detail_order d JOIN tbl_produk p ON d.id_produk=p.id_produk WHERE id_order = '$id'";
                        $query=mysqli_query($db,$sql);
                        while ($produk = mysqli_fetch_assoc($query)) {
                            $id_produk_current = $produk['id_produk'];
                            
                            // Check if review exists
                            $ulasan_query = mysqli_query($db, "SELECT id_ulasan FROM tbl_ulasan WHERE id_order='$id' AND id_produk='$id_produk_current' AND id_pelanggan='$id_pelanggan_current'");
                            $ulasan_exists = mysqli_num_rows($ulasan_query) > 0;
                    ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td class="product-list-img">
                                <?php if($produk['gambar']!=null):?>
                                <img width="40" src="admin/assets/images/foto_produk/<?php echo $produk['gambar']?>" class="img-fluid" alt="tbl">
                                <?php endif;?>
                            </td>
                            <td><?php echo $produk['nm_produk']; ?></td>
                            <td class="text-center"><?php echo $produk['jml_order'];?> </td>
                            <td class="text-center">
                                <?php if ($order_status == 'Produk Diterima' && !$ulasan_exists): ?>
                                    <a href="beri-ulasan.php?id_order=<?php echo $id; ?>&id_produk=<?php echo $produk['id_produk']; ?>" class="btn btn-primary btn-sm">Beri Ulasan</a>
                                <?php elseif ($ulasan_exists): ?>
                                    <span class="badge badge-success">Sudah Diulas</span>
                                <?php endif; ?>
                            </td>
                        </tr>
        
                    <?php
                        $no++;       
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>