<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Shipping Dashboard - Frontend Developer Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Roboto', sans-serif;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 15px 15px 0 0;
            font-weight: 700;
            text-align: center;
            padding: 1rem;
        }

        .form-control {
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .spinner-border {
            width: 1.5rem;
            height: 1.5rem;
            margin: 0 auto;
            display: block;
        }

        .card-body {
            padding: 2rem;
        }

        .footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 14px;
            color: #777;
        }

    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3>Global Shipping</h3>
                    </div>
                    <div class="card-body">
                        <!-- Negara -->
                        <div class="mb-3">
                            <label for="negara" class="form-label">Negara</label>
                            <select id="negara" class="form-control">
                                <option value="">-- Pilih Negara --</option>
                            </select>
                        </div>

                        <!-- Pelabuhan -->
                        <div class="mb-3">
                            <label for="pelabuhan" class="form-label">Pelabuhan</label>
                            <select id="pelabuhan" class="form-control" disabled>
                                <option value="">Pilih negara dulu</option>
                            </select>
                        </div>

                        <!-- Barang -->
                        <div class="mb-3">
                            <label for="barang" class="form-label">Barang</label>
                            <select id="barang" class="form-control" disabled>
                                <option value="">Pilih pelabuhan dulu</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" class="form-control" readonly rows="3"></textarea>
                        </div>

                        <!-- Harga & Discount -->
                        <div class="row mb-3">
                            <div class="col">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" id="harga" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="discount" class="form-label">Discount</label>
                                <input type="text" id="discount" class="form-control" readonly>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="text" id="total" class="form-control" readonly>
                        </div>

                        <!-- Loading Spinner -->
                        <div id="loading" class="text-center" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 Nirmala Agatha Santoso - All Rights Reserved</p>
    </div>

<script>
$(document).ready(function () {
    // 1️⃣ Load Negara
    $.getJSON('http://202.157.176.100:3001/negaras', function (data) {
        console.log('Data Negara:', data);
        const filteredData = data.filter(item => {
            return item.id_negara !== 19 && item.id_negara !== 20 && item.id_negara !== 5;
        });

        if (filteredData && filteredData.length > 0) {
            $.each(filteredData, function (i, item) {
                $('#negara').append($('<option>', {
                    value: item.id_negara,
                    text: item.nama_negara
                }));
            });
        }
    });

    // 2️⃣ Kalau Negara dipilih → load Pelabuhan
    $('#negara').on('change', function () {
        let idNegara = $(this).val();
        $('#pelabuhan').prop('disabled', true).html('<option value="">Loading...</option>');
        $('#barang').prop('disabled', true).html('<option value="">Pilih pelabuhan dulu</option>');
        $('#loading').show();

        if (idNegara) {
            $.getJSON(`http://202.157.176.100:3001/pelabuhans?filter={"where":{"id_negara":${idNegara}}}`, function (data) {
                let filtered = data.filter(x => x.id_negara == idNegara);
                $('#pelabuhan').prop('disabled', false).html('<option value="">-- Pilih Pelabuhan --</option>');
                $.each(filtered, function (i, item) {
                    $('#pelabuhan').append($('<option>', {
                        value: item.id_pelabuhan,
                        text: item.nama_pelabuhan
                    }));
                });
                $('#loading').hide();
            });
        } else {
            $('#loading').hide();
        }
    });

    // 3️⃣ Kalau Pelabuhan dipilih → load Barang
    $('#pelabuhan').on('change', function () {
        let idPelabuhan = $(this).val();
        $('#barang').prop('disabled', true).html('<option value="">Loading...</option>');
        $('#loading').show();

        if (idPelabuhan) {
            $.getJSON(`http://202.157.176.100:3001/barangs?filter={"where":{"id_pelabuhan":${idPelabuhan}}}`, function (data) {
                let filtered = data.filter(x => x.id_pelabuhan == idPelabuhan);
                $('#barang').prop('disabled', false).html('<option value="">-- Pilih Barang --</option>');
                $.each(filtered, function (i, item) {
                    $('#barang').append($('<option>', {
                        value: item.id_barang,
                        text: `${item.id_barang} - ${item.nama_barang}`,
                        'data-description': item.description,
                        'data-harga': item.harga,
                        'data-diskon': item.diskon
                    }));
                });
                $('#loading').hide();
            });
        }
    });

    // 4️⃣ Kalau Barang dipilih → isi description, harga, diskon, total
    $('#barang').on('change', function () {
        let selected = $(this).find(':selected');
        let desc = selected.data('description') || '';
        let harga = selected.data('harga') || 0;
        let diskon = selected.data('diskon') || 0;

        $('#description').val(desc);
        $('#harga').val(formatRupiah(harga));
        $('#discount').val(diskon + ' %');

        // Hitung total
        let total = harga - (harga * diskon / 100);
        $('#total').val(formatRupiah(total));
    });

    // 🔄 Fungsi format ke Rupiah
    function formatRupiah(angka) {
        angka = parseInt(angka) || 0;
        return 'Rp. ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
});
</script>
</body>
</html>
