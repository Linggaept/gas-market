<?php 
require "../koneksi.php";

// Get current setting
$origin_query = mysqli_query($db, "SELECT nilai_pengaturan FROM tbl_pengaturan WHERE nama_pengaturan = 'origin_district'");
$current_origin_id = "";
if ($origin_query) {
    $origin_row = mysqli_fetch_assoc($origin_query);
    $current_origin_id = $origin_row ? $origin_row['nilai_pengaturan'] : '(Belum diatur)';
}

// Handle form submission
if (isset($_POST['simpan'])) {
    if (!empty($_POST['district_destination'])) {
        $new_origin_id = mysqli_real_escape_string($db, $_POST['district_destination']);
        
        // Check if setting exists
        $check_query = mysqli_query($db, "SELECT id_pengaturan FROM tbl_pengaturan WHERE nama_pengaturan = 'origin_district'");
        if (mysqli_num_rows($check_query) > 0) {
            $update_query = "UPDATE tbl_pengaturan SET nilai_pengaturan = '$new_origin_id' WHERE nama_pengaturan = 'origin_district'";
            $result = mysqli_query($db, $update_query);
        } else {
            $insert_query = "INSERT INTO tbl_pengaturan (nama_pengaturan, nilai_pengaturan) VALUES ('origin_district', '$new_origin_id')";
            $result = mysqli_query($db, $insert_query);
        }

        if ($result) {
            echo "<script>alert('Lokasi asal pengiriman berhasil diperbarui.'); location.href='index.php?pages=pengaturan';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui pengaturan.');</script>";
        }
    } else {
        echo "<script>alert('Silakan pilih lokasi hingga tingkat kecamatan.');</script>";
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Pengaturan Lokasi Asal Pengiriman</h4>
                <p class="text-muted m-b-30">Pilih lokasi (kecamatan) asal dari mana produk akan dikirim. Pengaturan ini akan digunakan untuk menghitung ongkos kirim di halaman checkout pelanggan.</p>

                <div class="alert alert-info">
                    ID Lokasi Asal Saat Ini: <strong><?php echo $current_origin_id; ?></strong>
                </div>

                <hr>

                <h5>Ubah Lokasi Asal</h5>
                <form method="post">
                    <div class="form-group">
                        <label class="font-weight-bold">Provinsi</label>
                        <select id="province_select" class="form-control" required>
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Kota</label>
                        <select id="city_select" class="form-control" required>
                            <option value="">Pilih Kota</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Kecamatan</label>
                        <select name="district_destination" id="district_select" class="form-control" required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Pengaturan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const provinceSelect = document.getElementById('province_select');
    const citySelect = document.getElementById('city_select');
    const districtSelect = document.getElementById('district_select');

    // Populate province
    fetch('../assets/checkout/province.php')
        .then(response => response.json())
        .then(data => {
            if (data && data.rajaongkir && data.rajaongkir.results) {
                provinceSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
                data.rajaongkir.results.forEach(province => {
                    const option = new Option(province.province, province.province_id);
                    provinceSelect.add(option);
                });
            }
        }).catch(error => console.error('Error fetching provinces:', error));

    // Handle province change
    provinceSelect.addEventListener('change', function() {
        const provinceId = this.value;
        citySelect.innerHTML = '<option value="">Pilih Kota</option>';
        districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        if (provinceId) {
            fetch(`../assets/checkout/city.php?id=${provinceId}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.rajaongkir && data.rajaongkir.results) {
                        data.rajaongkir.results.forEach(city => {
                            const cityName = (city.type ? city.type + " - " : "") + city.city_name;
                            const option = new Option(cityName, city.city_id);
                            citySelect.add(option);
                        });
                    }
                }).catch(error => console.error('Error fetching cities:', error));
        }
    });

    // Handle city change
    citySelect.addEventListener('change', function() {
        const cityId = this.value;
        districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        if (cityId) {
            fetch(`../assets/checkout/district.php?id=${cityId}`)
                .then(response => response.json())
                .then(data => {
                     if (data && data.rajaongkir && data.rajaongkir.results) {
                        data.rajaongkir.results.forEach(district => {
                            const option = new Option(district.district_name, district.district_id);
                            districtSelect.add(option);
                        });
                    }
                }).catch(error => console.error('Error fetching districts:', error));
        }
    });
});
</script>