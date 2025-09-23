<?php require "../koneksi.php" ?>

<!-- Hapus Data Ulasan -->
<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$queryHapus = "DELETE FROM tbl_ulasan WHERE id_ulasan='$id'";
	$execHapus = mysqli_query($db, $queryHapus);

	if ($execHapus) {
		echo "<script>alert('Ulasan sudah dihapus');</script>";
		echo "<script>location='index.php?pages=ulasan';</script>";
	}
}
?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="mt-0 header-title">Data Ulasan Produk</h4>
				<p class="text-muted m-b-30">Kelola semua ulasan yang diberikan oleh pelanggan.</p>
				<table id="datatable" class="table table-striped dt-responsive nowrap table-vertical" width="100%"
					cellspacing="0">
					<thead>
						<tr>
							<th>Produk</th>
							<th>Pelanggan</th>
							<th>Rating</th>
							<th>Ulasan</th>
							<th>Tanggal</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT u.*, pr.nm_produk, pl.nm_pelanggan FROM tbl_ulasan u JOIN tbl_produk pr ON u.id_produk = pr.id_produk JOIN tbl_pelanggan pl ON u.id_pelanggan = pl.id_pelanggan ORDER BY u.tgl_ulasan DESC";
						$result = mysqli_query($db, $query);
						if ($result && mysqli_num_rows($result) > 0) {
    						while ($ulasan = mysqli_fetch_array($result)) :
						?>
							<tr>
								<td><?php echo $ulasan['nm_produk'] ?></td>
								<td><?php echo $ulasan['nm_pelanggan'] ?></td>
								<td>
									<?php for ($i = 1; $i <= 5; $i++): ?>
										<i class="fa <?php echo ($i <= $ulasan['rating']) ? 'fa-star' : 'fa-star-o'; ?>" style="color: #ffc000;"></i>
									<?php endfor; ?>
								</td>
								<td><?php echo htmlspecialchars($ulasan['ulasan']) ?></td>
								<td><?php echo date("d M Y", strtotime($ulasan['tgl_ulasan'])); ?></td>
								<td>
									<a href="index.php?pages=ubah-ulasan&id=<?php echo $ulasan['id_ulasan']; ?>" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-pencil font-18"></i></a>
									<a href="index.php?pages=ulasan&id=<?php echo $ulasan['id_ulasan']; ?>" class="text-muted" data-toggle="tooltip"
										data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')"><i
											class="mdi mdi-close font-18"></i></a>
								</td>
							</tr>
						<?php 
							endwhile;
						} else {
							echo "<tr><td colspan='6' class='text-center'>Tidak ada ulasan yang ditemukan.</td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>