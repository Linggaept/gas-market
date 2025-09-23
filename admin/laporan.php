<?php 
require "../koneksi.php";

$tgl_mulai = "";
$tgl_selesai = "";
$laporan_data = null;
$laporan_data_for_js = null;

if (!empty($_POST['tgl_mulai']) && !empty($_POST['tgl_selesai'])) {
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];

    // Sanitize inputs
    $tgl_mulai_safe = mysqli_real_escape_string($db, $tgl_mulai);
    $tgl_selesai_safe = mysqli_real_escape_string($db, $tgl_selesai);

    // Fetch report data based on date range for completed orders only
    $status_selesai = 'Produk Diterima';

    // 1. Total Revenue
    $pendapatan_query = mysqli_query($db, "SELECT SUM(total_order) as total FROM tbl_order WHERE status='$status_selesai' AND tgl_order BETWEEN '$tgl_mulai_safe' AND '$tgl_selesai_safe'");
    $total_pendapatan = mysqli_fetch_assoc($pendapatan_query)['total'];

    // 2. Number of Orders
    $pesanan_query = mysqli_query($db, "SELECT COUNT(id_order) as total FROM tbl_order WHERE status='$status_selesai' AND tgl_order BETWEEN '$tgl_mulai_safe' AND '$tgl_selesai_safe'");
    $jumlah_pesanan = mysqli_fetch_assoc($pesanan_query)['total'];

    // 3. Best-Selling Products
    $produk_laris_query = mysqli_query($db, "SELECT p.nm_produk, SUM(d.jml_order) as total_terjual FROM tbl_detail_order d JOIN tbl_order o ON d.id_order = o.id_order JOIN tbl_produk p ON d.id_produk = p.id_produk WHERE o.status='$status_selesai' AND o.tgl_order BETWEEN '$tgl_mulai_safe' AND '$tgl_selesai_safe' GROUP BY d.id_produk ORDER BY total_terjual DESC LIMIT 5");
    
    $produk_laris_array = [];
    if ($produk_laris_query) {
        while($row = mysqli_fetch_assoc($produk_laris_query)) {
            $produk_laris_array[] = $row;
        }
    }

    $laporan_data = [
        'total_pendapatan' => $total_pendapatan ? $total_pendapatan : 0,
        'jumlah_pesanan' => $jumlah_pesanan ? $jumlah_pesanan : 0,
        'produk_laris' => $produk_laris_array
    ];
}

?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Laporan Penjualan</h4>
                <p class="text-muted m-b-30">Filter laporan penjualan berdasarkan rentang tanggal.</p>

                <form method="post" id="laporanForm">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label for="tgl_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control mb-2" id="tgl_mulai" name="tgl_mulai" value="<?php echo $tgl_mulai; ?>" required>
                        </div>
                        <div class="col-auto">
                            <label for="tgl_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control mb-2" id="tgl_selesai" name="tgl_selesai" value="<?php echo $tgl_selesai; ?>" required>
                        </div>
                        <div class="col-auto">
                            <label>&nbsp;</label>
                            <div class="btn-group mb-2">
                                <button type="submit" name="tampilkan" class="btn btn-primary">Tampilkan</button>
                                <button type="button" id="btnHariIni" class="btn btn-secondary">Hari Ini</button>
                                <button type="button" id="btnMingguIni" class="btn btn-secondary">Minggu Ini</button>
                                <button type="button" id="btnBulanIni" class="btn btn-secondary">Bulan Ini</button>
                                <button type="button" id="btnTahunIni" class="btn btn-secondary">Tahun Ini</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if ($laporan_data): ?>
<div id="reportContent">
    <div class="row">
        <div class="col-12 mb-2">
            <button id="exportPdfBtn" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export PDF</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Total Pendapatan</h4>
                    <p>dari <?php echo $laporan_data['jumlah_pesanan']; ?> pesanan selesai</p>
                    <h2 class="text-success">Rp. <?php echo number_format($laporan_data['total_pendapatan']); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Produk Terlaris</h4>
                    <p>5 produk paling laku pada periode ini.</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            if (count($laporan_data['produk_laris']) > 0) {
                                foreach($laporan_data['produk_laris'] as $produk):
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $produk['nm_produk']; ?></td>
                                <td><?php echo $produk['total_terjual']; ?></td>
                            </tr>
                            <?php 
                                endforeach;
                            } else {
                                echo "<tr><td colspan='3' class='text-center'>Tidak ada produk yang terjual pada periode ini.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PDFMake Scripts -->
<script src="../plugins/datatables/pdfmake.min.js"></script>
<script src="../plugins/datatables/vfs_fonts.js"></script>

<script>
    // Pass data to JS for PDF export
    const reportDataForPdf = {
        tgl_mulai: '<?php echo $tgl_mulai; ?>',
        tgl_selesai: '<?php echo $tgl_selesai; ?>',
        total_pendapatan: '<?php echo number_format($laporan_data["total_pendapatan"]); ?>',
        jumlah_pesanan: '<?php echo $laporan_data["jumlah_pesanan"]; ?>',
        produk_laris: <?php echo json_encode($laporan_data["produk_laris"]); ?>
    };

    if (document.getElementById('exportPdfBtn')) {
        document.getElementById('exportPdfBtn').addEventListener('click', function() {
            const { tgl_mulai, tgl_selesai, total_pendapatan, jumlah_pesanan, produk_laris } = reportDataForPdf;

            const tableBody = [
                [{text: 'No', bold: true}, {text: 'Nama Produk', bold: true}, {text: 'Jumlah Terjual', bold: true}]
            ];
            produk_laris.forEach((p, index) => {
                tableBody.push([index + 1, p.nm_produk, p.total_terjual]);
            });

            const docDefinition = {
                content: [
                    { text: 'Laporan Penjualan', style: 'header' },
                    { text: `Periode: ${tgl_mulai} - ${tgl_selesai}`, style: 'subheader' },
                    '\n',
                    { text: `Total Pendapatan: Rp. ${total_pendapatan}` },
                    { text: `Jumlah Pesanan Selesai: ${jumlah_pesanan}` },
                    '\n\n',
                    { text: 'Produk Terlaris', style: 'subheader' },
                    {
                        style: 'tableExample',
                        table: {
                            headerRows: 1,
                            widths: ['auto', '*', 'auto'],
                            body: tableBody
                        }
                    }
                ],
                styles: {
                    header: {
                        fontSize: 18,
                        bold: true,
                        margin: [0, 0, 0, 10]
                    },
                    subheader: {
                        fontSize: 14,
                        bold: true,
                        margin: [0, 10, 0, 5]
                    },
                    tableExample: {
                        margin: [0, 5, 0, 15]
                    }
                }
            };

            pdfMake.createPdf(docDefinition).download(`laporan-penjualan-${tgl_mulai}-sd-${tgl_selesai}.pdf`);
        });
    }
</script>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    }

    document.getElementById('btnHariIni').addEventListener('click', function(){
        var today = new Date();
        document.getElementById('tgl_mulai').value = formatDate(today);
        document.getElementById('tgl_selesai').value = formatDate(today);
        document.getElementById('laporanForm').submit();
    });

    document.getElementById('btnMingguIni').addEventListener('click', function(){
        var today = new Date();
        var firstDayOfWeek = new Date(new Date().setDate(today.getDate() - today.getDay()));
        document.getElementById('tgl_mulai').value = formatDate(firstDayOfWeek);
        document.getElementById('tgl_selesai').value = formatDate(today);
        document.getElementById('laporanForm').submit();
    });

    document.getElementById('btnBulanIni').addEventListener('click', function() {
        var date = new Date();
        var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        document.getElementById('tgl_mulai').value = formatDate(firstDay);
        document.getElementById('tgl_selesai').value = formatDate(lastDay);
        document.getElementById('laporanForm').submit();
    });

    document.getElementById('btnTahunIni').addEventListener('click', function() {
        var date = new Date();
        var firstDay = new Date(date.getFullYear(), 0, 1);
        var lastDay = new Date(date.getFullYear(), 11, 31);
        document.getElementById('tgl_mulai').value = formatDate(firstDay);
        document.getElementById('tgl_selesai').value = formatDate(lastDay);
        document.getElementById('laporanForm').submit();
    });
});
