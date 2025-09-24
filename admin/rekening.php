<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $nm_bank = $_POST['nm_bank'];
    $no_rekening = $_POST['no_rekening'];
    $nm_pemilik = $_POST['nm_pemilik'];
    if (isset($_GET['aksi']) && $_GET['aksi'] == 'ubah') {
        $id_rekening = $_GET['id'];
        $db->query("UPDATE tbl_rekening SET nm_bank='$nm_bank', no_rekening='$no_rekening', nm_pemilik='$nm_pemilik' WHERE id_rekening='$id_rekening'");
    } else {
        $db->query("INSERT INTO tbl_rekening (nm_bank, no_rekening, nm_pemilik) VALUES ('$nm_bank', '$no_rekening', '$nm_pemilik')");
    }
    echo "<script>alert('Data rekening berhasil disimpan');</script>";
    echo "<script>location='index.php?pages=rekening';</script>";
}

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id_rekening = $_GET['id'];
    $db->query("DELETE FROM tbl_rekening WHERE id_rekening='$id_rekening'");
    echo "<script>alert('Data rekening berhasil dihapus');</script>";
    echo "<script>location='index.php?pages=rekening';</script>";
}

$nm_bank = '';
$no_rekening = '';
$nm_pemilik = '';
$form_action = 'simpan';
$title = 'Tambah';

if (isset($_GET['aksi']) && $_GET['aksi'] == 'ubah') {
    $id_rekening = $_GET['id'];
    $ambil = $db->query("SELECT * FROM tbl_rekening WHERE id_rekening='$id_rekening'");
    $pecah = $ambil->fetch_assoc();
    $nm_bank = $pecah['nm_bank'];
    $no_rekening = $pecah['no_rekening'];
    $nm_pemilik = $pecah['nm_pemilik'];
    $title = 'Ubah';
}
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Rekening</h4>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bank</th>
                            <th>No Rekening</th>
                            <th>Nama Pemilik</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $ambil = $db->query("SELECT * FROM tbl_rekening");
                        while($pecah = $ambil->fetch_assoc()){ 
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $pecah['nm_bank']; ?></td>
                            <td><?php echo $pecah['no_rekening']; ?></td>
                            <td><?php echo $pecah['nm_pemilik']; ?></td>
                            <td>
                                <a href="index.php?pages=rekening&aksi=ubah&id=<?php echo $pecah['id_rekening']; ?>" class="btn btn-warning btn-sm">Ubah</a>
                                <a href="index.php?pages=rekening&aksi=hapus&id=<?php echo $pecah['id_rekening']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $title; ?> Rekening</h4>
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Nama Bank</label>
                        <input type="text" class="form-control" name="nm_bank" value="<?php echo $nm_bank; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <input type="text" class="form-control" name="no_rekening" value="<?php echo $no_rekening; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Pemilik</label>
                        <input type="text" class="form-control" name="nm_pemilik" value="<?php echo $nm_pemilik; ?>" required>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    <a href="index.php?pages=rekening" class="btn btn-secondary waves-effect waves-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
