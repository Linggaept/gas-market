<?php require "header.php"; ?>

<style>
    .row {
        margin-left: 0;
        margin-right: 0;
    }

    .row>[class^="col-"] {
        padding-left: 0;
        padding-right: 0;
    }

    #containt {
        margin-top: 80px;
    }

    .itemBig,
    .item1,
    .item2,
    .item3 {
        border: none;
        background-color: silver;
    }

    .itemBig:hover,
    .item1:hover,
    .item2:hover,
    .item3:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.2);
        border: none;
    }

    .star-rating li {
        padding: 0;
        margin: 0;
    }

    .star-rating i {
        font-size: 17px;
        color: #ffc000;
    }

    #btnDesc1, #btnDesc2 {
        padding: 12px 10px;
        width: 100%;
        border-radius: 0;
        color: white;
        border: none;
    }

    #btnDesc1 {
        background-color: #3498db;
    }

    #btnDesc2 {
        background-color: silver;
    }

    .dec {
        width: 100%;
        height: auto;
        border: 2px solid #3498db;
        padding-bottom: 20px;
    }
</style>
<?php
    $id=$_GET['id'];
    $query="SELECT * FROM tbl_produk WHERE id_produk='$id'";
    $result=mysqli_query($db,$query);
    $produk = mysqli_fetch_assoc($result);

    // --- START: Fetch Reviews ---
    $ulasan_query = mysqli_query($db, "SELECT u.*, pl.nm_pelanggan FROM tbl_ulasan u JOIN tbl_pelanggan pl ON u.id_pelanggan = pl.id_pelanggan WHERE u.id_produk = '$id' ORDER BY u.tgl_ulasan DESC");
    $reviews = [];
    $total_rating = 0;
    $review_count = 0;
    if ($ulasan_query) {
        while ($row = mysqli_fetch_assoc($ulasan_query)) {
            $reviews[] = $row;
            $total_rating += $row['rating'];
            $review_count++;
        }
    }
    $average_rating = ($review_count > 0) ? $total_rating / $review_count : 0;
    // --- END: Fetch Reviews ---
?>
<div class="container bg-white rounded pt-4 pb-4" id="containt">
    <div class="row">
        <div class="col-md-5 col-sm-12">
            <div class="itemBig">
                <a href="admin/assets/images/foto_produk/<?php echo $produk['gambar'];?>">
                    <img src="admin/assets/images/foto_produk/<?php echo $produk['gambar'];?>" height="400px"
                        width="100%">
                </a>
            </div>
        </div>
        <div class="col-md-7 col-sm-12 pt-3 pl-5">
            <h3><?php echo $produk['nm_produk']; ?></h3>
            <div class="star-rating">
                <ul class="list-inline">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <li class="list-inline-item m-0"><i class="fa <?php echo ($i <= $average_rating) ? 'fa-star' : 'fa-star-o'; ?>"></i></li>
                    <?php endfor; ?>
                    <li class="list-inline-item m-0 text-muted">(<?php echo $review_count; ?> ulasan)</li>
                </ul>
            </div>
            <hr>
            <h3 class="text-danger"><span class="text-secondary" style="font-size: 15px">Harga :
                </span>Rp. <?php echo number_format($produk['harga']); ?></h3>
            <br>
            <p class="text-secondary font-weight-bold"><i class="fa fa-stop-circle-o text-success"
                    aria-hidden="true"></i>
                Stok Tersedia</p>
            <p class="text-danger">Tersisa <?php echo number_format($produk['stok']); ?> Unit (segera lakukan
                pembelian)</p>

            <form method="post">
                <div class="row">
                    <div class="col-3">
                        <h3><span class="text-secondary" style="font-size: 15px">Jumlah : </span></h3>
                        <div class="input-group spinner">
                            <button type="button" class="btn btn-primary btn-number pl-2 pr-2"
                                style="border-radius: 5px 0 0 5px;" id="minus-btn">
                                <i class="fa fa-minus"></i>
                            </button>
                            <input type="text" name="stok" id="qty_input" class="form-control input-number text-center"
                                value="1" min="1" max="<?php echo $produk['stok']; ?>">
                            <button type="button" class="btn btn-primary btn-number pl-2 pr-2"
                                style="border-radius: 0 5px 5px 0;" id="plus-btn"><i class="fa fa-plus"></i>
                            </button>
                            <script>
                                $(function () {
                                    $('.spinner #plus-btn').on('click', function () {
                                        var btn = $(this);
                                        var input = btn.closest('.spinner').find('input');
                                        if (input.attr('max') == undefined || parseInt(input
                                                .val()) <
                                            parseInt(input.attr('max'))) {
                                            input.val(parseInt(input.val(), 10) + 1);
                                        }
                                    });
                                    $('.spinner #minus-btn').on('click',
                                        function () {
                                            var btn = $(this);
                                            var input = btn.closest('.spinner').find('input');
                                            if (input.attr('min') == undefined || parseInt(input
                                                    .val()) >
                                                parseInt(input.attr('min'))) {
                                                input.val(parseInt(input.val(), 10) - 1);
                                            }
                                        });
                                })
                            </script>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-5">
                        <button class="btn btn-primary btn-block" name="beli">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i> Masukkan Keranjang
                        </button>
                    </div>
                    <div class="col-md-5">
                        <button class="btn btn-primary btn-block ml-3" name="beli2">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Beli Sekarang
                        </button>
                    </div>
                </div>
        </div>
        </form>
        <?php
                if (isset($_POST['beli'])) {
                    $jumlah =$_POST['stok'];

                    if (isset($_SESSION['cart'][$id])) {
                        $_SESSION['cart'][$id]+=$jumlah;
                    }
                    else {
                        $_SESSION['cart'][$id] = $jumlah;
                    }
                    echo "<script type='text/javascript'>swal('','Produk Sudah Masuk Ke Keranjang Belanja', 'success');</script>";
                }
                elseif (isset($_POST['beli2'])) {
                    $jumlah =$_POST['stok'];

                    if (isset($_SESSION['cart'][$id])) {
                        $_SESSION['cart'][$id]+=$jumlah;
                    }
                    else {
                        $_SESSION['cart'][$id] = $jumlah;
                    }
                    echo "<script>location='cart.php';</script>";
                }
            ?>
    </div>
    <br>
    <hr>
    <div class="ProdukDesc">
        <div class="row">
            <div class="col-md-2">
                <button class="btn" id="btnDesc1">DESCRIPTIONS</button>
            </div>
            <div class="col-md-2">
                <button class="btn" id="btnDesc2">FEEDBACKS (<?php echo $review_count; ?>)</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 bg-light">
                <div id="descriptionContent" class="dec pt-5 pl-5 pr-5 text-justify">
                    <h5>Spesifikasi Dan Deskripsi Produk :</h5>
                    <?php echo $produk['deskripsi']; ?>
                </div>
                <div id="feedbackContent" class="dec pt-5 pl-5 pr-5" style="display: none;">
                    <h5>Ulasan Produk :</h5>
                    <?php if ($review_count > 0): ?>
                        <?php foreach ($reviews as $review): ?>
                            <div class="media mt-4">
                                <div class="media-body">
                                    <h6 class="mt-0"><?php echo htmlspecialchars($review['nm_pelanggan']); ?></h6>
                                    <div class="star-rating">
                                        <ul class="list-inline">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <li class="list-inline-item m-0"><i class="fa <?php echo ($i <= $review['rating']) ? 'fa-star' : 'fa-star-o'; ?>"></i></li>
                                            <?php endfor; ?>
                                        </ul>
                                    </div>
                                    <small class="text-muted"><?php echo date("d F Y", strtotime($review['tgl_ulasan'])); ?></small>
                                    <p><?php echo nl2br(htmlspecialchars($review['ulasan'])); ?></p>
                                </div>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Belum ada ulasan untuk produk ini.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#btnDesc1").click(function(){
            $("#feedbackContent").hide();
            $("#descriptionContent").show();
            $("#btnDesc1").css("background-color", "#3498db");
            $("#btnDesc2").css("background-color", "silver");
        });
        $("#btnDesc2").click(function(){
            $("#descriptionContent").hide();
            $("#feedbackContent").show();
            $("#btnDesc2").css("background-color", "#3498db");
            $("#btnDesc1").css("background-color", "silver");
        });
    });
</script>

<?php require "footer.php"; ?>