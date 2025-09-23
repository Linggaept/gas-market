<?php require "header.php";

if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Silahkan Login Dulu');</script>";
    echo "<script>location='login.php';</script>";
    exit;
}

if (!isset($_GET['id_order']) || !isset($_GET['id_produk'])) {
    echo "<script>alert('Link tidak valid.');</script>";
    echo "<script>location='orderan.php';</script>";
    exit;
}

$id_order = $_GET['id_order'];
$id_produk = $_GET['id_produk'];
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

// Fetch product details
$produk_query = mysqli_query($db, "SELECT * FROM tbl_produk WHERE id_produk = '$id_produk'");
$produk = mysqli_fetch_assoc($produk_query);

// Check if review already exists
$ulasan_query = mysqli_query($db, "SELECT id_ulasan FROM tbl_ulasan WHERE id_order='$id_order' AND id_produk='$id_produk' AND id_pelanggan='$id_pelanggan'");
if (mysqli_num_rows($ulasan_query) > 0) {
    echo "<script>alert('Anda sudah memberikan ulasan untuk produk ini.');</script>";
    echo "<script>location='rincian-produk.php?id=$id_order';</script>";
    exit;
}

if (isset($_POST['kirim_ulasan'])) {
    $rating = $_POST['rating'];
    $ulasan = mysqli_real_escape_string($db, $_POST['ulasan']);

    $insert_query = "INSERT INTO tbl_ulasan (id_produk, id_pelanggan, id_order, rating, ulasan) VALUES ('$id_produk', '$id_pelanggan', '$id_order', '$rating', '$ulasan')";
    
    if (mysqli_query($db, $insert_query)) {
        echo "<script type='text/javascript'>
                swal({
                    title: 'Ulasan Terkirim',
                    text: 'Terima kasih atas ulasan Anda!',
                    icon: 'success',
                    button: false
                });
                </script>";
        echo "<meta http-equiv='refresh' content='1;url=rincian-produk.php?id=$id_order'>";
    } else {
        echo "<script>alert('Gagal mengirim ulasan.');</script>";
    }
}
?>

<style>
.rating {
    display: inline-block;
    unicode-bidi: bidi-override;
    direction: rtl;
}
.rating > span {
    display: inline-block;
    position: relative;
    width: 1.1em;
    font-size: 30px;
    color: #D3D3D3;
}
.rating > span:hover:before,
.rating > span:hover ~ span:before {
   content: "\2605";
   position: absolute;
   color: gold;
}
.rating > input { display: none; }
.rating > label { 
    color: #D3D3D3; 
    float: right; 
    font-size: 30px;
    padding: 0 .1em;
    margin: 0;
    cursor: pointer;
}
.rating > input:checked ~ label, 
.rating:not(:checked) > label:hover, 
.rating:not(:checked) > label:hover ~ label { color: gold; }
.rating > input:checked + label:hover,
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label,
.rating > input:checked ~ label:hover ~ label { color: gold; }

</style>

<div class="container bg-white rounded pt-4 pb-4 mt-5 mb-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Beri Ulasan</h3>
            <hr>
            <div class="media">
                <img src="admin/assets/images/foto_produk/<?php echo $produk['gambar']; ?>" class="mr-3" width="100" alt="...">
                <div class="media-body">
                    <h5 class="mt-0"><?php echo $produk['nm_produk']; ?></h5>
                    Beri penilaian Anda untuk produk ini.
                </div>
            </div>
            <hr>
            <form method="post">
                <div class="form-group">
                    <label for="rating"><b>Rating Anda</b></label>
                    <div class="rating">
                        <input type="radio" id="star5" name="rating" value="5" required/><label for="star5" title="5 stars">&#9733;</label>
                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">&#9733;</label>
                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">&#9733;</label>
                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">&#9733;</label>
                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">&#9733;</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ulasan"><b>Ulasan Anda</b></label>
                    <textarea name="ulasan" id="ulasan" rows="5" class="form-control" placeholder="Tuliskan pengalaman Anda mengenai produk ini..." required></textarea>
                </div>
                <button type="submit" name="kirim_ulasan" class="btn btn-primary">Kirim Ulasan</button>
            </form>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>