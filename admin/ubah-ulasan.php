<?php 
require "../koneksi.php";

$id = $_GET['id'];

// Fetch the review details
$query = "SELECT u.*, pr.nm_produk, pl.nm_pelanggan FROM tbl_ulasan u JOIN tbl_produk pr ON u.id_produk = pr.id_produk JOIN tbl_pelanggan pl ON u.id_pelanggan = pl.id_pelanggan WHERE u.id_ulasan = '$id'";
$result = mysqli_query($db, $query);
$ulasan = mysqli_fetch_assoc($result);

if (!$ulasan) {
    echo "<script>alert('Ulasan tidak ditemukan.'); location='index.php?pages=ulasan';</script>";
    exit;
}

// Handle form submission for update
if (isset($_POST['simpan'])) {
    $rating = $_POST['rating'];
    $ulasan_text = mysqli_real_escape_string($db, $_POST['ulasan']);

    $update_query = "UPDATE tbl_ulasan SET rating = '$rating', ulasan = '$ulasan_text' WHERE id_ulasan = '$id'";
    $update_result = mysqli_query($db, $update_query);

    if ($update_result) {
        echo "<script>alert('Ulasan berhasil diperbarui.');</script>";
        echo "<script>location='index.php?pages=ulasan';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui ulasan.');</script>";
    }
}
?>

<style>
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Ubah Ulasan</h4>
                <p class="text-muted m-b-30">Ubah rating atau teks ulasan dari pelanggan.</p>

                <form method="post">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Produk</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($ulasan['nm_produk']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pelanggan</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($ulasan['nm_pelanggan']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Rating</label>
                        <div class="col-sm-10">
                            <div class="rating">
                                <input type="radio" id="star5" name="rating" value="5" <?php echo ($ulasan['rating'] == 5) ? 'checked' : ''; ?> required/><label for="star5" title="5 stars">&#9733;</label>
                                <input type="radio" id="star4" name="rating" value="4" <?php echo ($ulasan['rating'] == 4) ? 'checked' : ''; ?> /><label for="star4" title="4 stars">&#9733;</label>
                                <input type="radio" id="star3" name="rating" value="3" <?php echo ($ulasan['rating'] == 3) ? 'checked' : ''; ?> /><label for="star3" title="3 stars">&#9733;</label>
                                <input type="radio" id="star2" name="rating" value="2" <?php echo ($ulasan['rating'] == 2) ? 'checked' : ''; ?> /><label for="star2" title="2 stars">&#9733;</label>
                                <input type="radio" id="star1" name="rating" value="1" <?php echo ($ulasan['rating'] == 1) ? 'checked' : ''; ?> /><label for="star1" title="1 star">&#9733;</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ulasan_text" class="col-sm-2 col-form-label">Ulasan</label>
                        <div class="col-sm-10">
                            <textarea name="ulasan" id="ulasan_text" class="form-control" rows="5" required><?php echo htmlspecialchars($ulasan['ulasan']); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="index.php?pages=ulasan" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>