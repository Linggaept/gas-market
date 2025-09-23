    <?php
    require "../koneksi.php";

    $tgl_mulai = "";
    $tgl_selesai = "";
    $laporan_data = null;
    $laporan_data_for_js = null;

    // We check for the submit button's name now, which is more reliable
    if (isset($_POST['tampilkan'])) {
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
            while ($row = mysqli_fetch_assoc($produk_laris_query)) {
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>


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
                                        foreach ($laporan_data['produk_laris'] as $produk):
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


    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            function setDatesAndSubmit(startDate, endDate) {
                // Set nilai pada input date
                document.getElementById('tgl_mulai').value = formatDate(startDate);
                document.getElementById('tgl_selesai').value = formatDate(endDate);

                // Submit form dengan AJAX untuk menghindari reload halaman
                submitFormWithAjax();
            }

            function submitFormWithAjax() {
                var formData = new FormData();
                formData.append('tampilkan', '1');
                formData.append('tgl_mulai', document.getElementById('tgl_mulai').value);
                formData.append('tgl_selesai', document.getElementById('tgl_selesai').value);

                fetch(window.location.href, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(html => {
                        // Parse HTML response
                        var parser = new DOMParser();
                        var doc = parser.parseFromString(html, 'text/html');

                        // Update report content jika ada
                        var newReportContent = doc.getElementById('reportContent');
                        var existingReportContent = document.getElementById('reportContent');

                        if (newReportContent) {
                            if (existingReportContent) {
                                existingReportContent.innerHTML = newReportContent.innerHTML;
                            } else {
                                // Jika belum ada report content, tambahkan setelah form
                                var formContainer = document.querySelector('.row .col-12 .card');
                                formContainer.parentNode.insertAdjacentHTML('afterend', '<div class="col-12">' + newReportContent.outerHTML + '</div>');
                            }

                            // Re-initialize export PDF functionality
                            initializeExportPdf();
                        } else {
                            // Hapus report content jika tidak ada data
                            if (existingReportContent) {
                                existingReportContent.remove();
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memuat laporan');
                    });
            }

            function initializeExportPdf() {
                var exportBtn = document.getElementById('exportPdfBtn');
                if (exportBtn) {
                    // Remove existing event listeners dengan clone
                    var newBtn = exportBtn.cloneNode(true);
                    exportBtn.parentNode.replaceChild(newBtn, exportBtn);

                    newBtn.addEventListener('click', function() {
                        // Check if pdfMake is loaded
                        if (typeof pdfMake === 'undefined') {
                            alert('Library PDF belum terpasang. Silakan refresh halaman dan coba lagi.');
                            return;
                        }

                        var tgl_mulai = document.getElementById('tgl_mulai').value;
                        var tgl_selesai = document.getElementById('tgl_selesai').value;

                        // Validasi tanggal
                        if (!tgl_mulai || !tgl_selesai) {
                            alert('Silakan pilih rentang tanggal terlebih dahulu!');
                            return;
                        }

                        try {
                            // Get current report data from DOM
                            var pendapatanElement = document.querySelector('#reportContent .text-success');
                            var pesananText = document.querySelector('#reportContent h4 + p');

                            var total_pendapatan = '0';
                            var jumlah_pesanan = '0';

                            if (pendapatanElement) {
                                total_pendapatan = pendapatanElement.textContent.replace('Rp. ', '').trim();
                            }

                            if (pesananText) {
                                var match = pesananText.textContent.match(/dari (\d+) pesanan/);
                                if (match) {
                                    jumlah_pesanan = match[1];
                                }
                            }

                            // Get product data from table
                            var produk_laris = [];
                            var tableRows = document.querySelectorAll('#reportContent .table tbody tr');

                            tableRows.forEach(function(row, index) {
                                var cells = row.querySelectorAll('td');
                                if (cells.length >= 3) {
                                    var productName = cells[1].textContent.trim();
                                    var quantity = cells[2].textContent.trim();

                                    // Skip jika baris kosong atau pesan tidak ada data
                                    if (productName !== 'Tidak ada produk yang terjual pada periode ini.' && productName !== '') {
                                        produk_laris.push({
                                            nm_produk: productName,
                                            total_terjual: quantity
                                        });
                                    }
                                }
                            });

                            // Siapkan table body untuk PDF
                            const tableBody = [
                                [{
                                        text: 'No',
                                        bold: true,
                                        alignment: 'center'
                                    },
                                    {
                                        text: 'Nama Produk',
                                        bold: true,
                                        alignment: 'center'
                                    },
                                    {
                                        text: 'Jumlah Terjual',
                                        bold: true,
                                        alignment: 'center'
                                    }
                                ]
                            ];

                            if (produk_laris.length > 0) {
                                produk_laris.forEach((p, index) => {
                                    tableBody.push([{
                                            text: (index + 1).toString(),
                                            alignment: 'center'
                                        },
                                        p.nm_produk,
                                        {
                                            text: p.total_terjual,
                                            alignment: 'center'
                                        }
                                    ]);
                                });
                            } else {
                                tableBody.push([{
                                        text: '-',
                                        alignment: 'center'
                                    },
                                    {
                                        text: 'Tidak ada produk yang terjual pada periode ini',
                                        alignment: 'center',
                                        colSpan: 2
                                    },
                                    {}
                                ]);
                            }

                            // Format tanggal untuk display (simple version)
                            function formatDateForDisplay(dateStr) {
                                if (!dateStr) return '';
                                return dateStr; // Keep it simple for now
                            }

                            const docDefinition = {
                                pageSize: 'A4',
                                pageMargins: [40, 60, 40, 60],
                                content: [{
                                        text: 'LAPORAN PENJUALAN',
                                        fontSize: 18,
                                        bold: true,
                                        alignment: 'center',
                                        margin: [0, 0, 0, 20]
                                    },
                                    {
                                        text: 'Periode: ' + formatDateForDisplay(tgl_mulai) + ' - ' + formatDateForDisplay(tgl_selesai),
                                        fontSize: 12,
                                        alignment: 'center',
                                        margin: [0, 0, 0, 30]
                                    },

                                    // Summary section
                                    {
                                        table: {
                                            widths: ['*', '*'],
                                            body: [
                                                [{
                                                        text: 'Total Pendapatan\nRp ' + total_pendapatan,
                                                        alignment: 'center',
                                                        margin: [0, 10, 0, 10],
                                                        fontSize: 12,
                                                        bold: true
                                                    },
                                                    {
                                                        text: 'Jumlah Pesanan Selesai\n' + jumlah_pesanan + ' pesanan',
                                                        alignment: 'center',
                                                        margin: [0, 10, 0, 10],
                                                        fontSize: 12,
                                                        bold: true
                                                    }
                                                ]
                                            ]
                                        },
                                        layout: 'lightHorizontalLines',
                                        margin: [0, 0, 0, 30]
                                    },

                                    {
                                        text: 'PRODUK TERLARIS',
                                        fontSize: 14,
                                        bold: true,
                                        margin: [0, 0, 0, 10]
                                    },
                                    {
                                        table: {
                                            headerRows: 1,
                                            widths: [40, '*', 80],
                                            body: tableBody
                                        },
                                        layout: 'lightHorizontalLines'
                                    },

                                    // Footer
                                    {
                                        text: 'Dicetak pada: ' + new Date().toLocaleDateString('id-ID'),
                                        fontSize: 8,
                                        italics: true,
                                        alignment: 'right',
                                        margin: [0, 30, 0, 0]
                                    }
                                ]
                            };

                            // Generate filename
                            var filename = 'laporan-penjualan-' + tgl_mulai + '-sd-' + tgl_selesai + '.pdf';

                            // Create and download PDF
                            pdfMake.createPdf(docDefinition).download(filename);

                        } catch (error) {
                            console.error('Error creating PDF:', error);
                            alert('Terjadi kesalahan saat membuat PDF: ' + error.message);
                        }
                    });
                }
            }

            // Event listeners untuk tombol preset
            document.getElementById('btnHariIni').addEventListener('click', function() {
                var today = new Date();
                setDatesAndSubmit(today, today);
            });

            document.getElementById('btnMingguIni').addEventListener('click', function() {
                var today = new Date();
                var day = today.getDay();
                var diff = today.getDate() - day + (day == 0 ? -6 : 1);
                var monday = new Date(today.setDate(diff));
                var todayReset = new Date();
                setDatesAndSubmit(monday, todayReset);
            });

            document.getElementById('btnBulanIni').addEventListener('click', function() {
                var date = new Date();
                var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
                var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
                setDatesAndSubmit(firstDay, lastDay);
            });

            document.getElementById('btnTahunIni').addEventListener('click', function() {
                var date = new Date();
                var firstDay = new Date(date.getFullYear(), 0, 1);
                var lastDay = new Date(date.getFullYear(), 11, 31);
                setDatesAndSubmit(firstDay, lastDay);
            });

            // Event listener untuk tombol Tampilkan biasa
            document.querySelector('button[name="tampilkan"]').addEventListener('click', function(e) {
                e.preventDefault();
                submitFormWithAjax();
            });

            // Initialize PDF export jika sudah ada report content
            initializeExportPdf();
        });
    </script>