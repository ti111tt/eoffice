@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Input Kode Barang</h1>

        <!-- Pesan sukses -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tombol untuk memulai pemindaian barcode -->
        <button id="start-scanner" class="btn btn-success">Mulai Pemindaian Barcode</button>
        <div id="scanner-section" style="display: none;"> <!-- Awalnya disembunyikan -->
            <div id="interactive" class="viewport" style="width: 500%; height: 400px;"></div>
            <div id="result" style="margin-top: 20px;"></div>
        </div>

        <!-- Form untuk input kode barang -->
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Masukkan Kode Barang">
            </div>
            
            <button type="submit" class="btn btn-primary">Tambahkan ke Keranjang</button>
        </form>
        
        <!-- Daftar barang di keranjang -->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>jumlah</th>
                    <th>Harga</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->item->id }}</td>
                    <td>{{ $item->item->nama_barang }}</td>

                    <td>
                        <!-- Form untuk mengedit jumlah produk -->
                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" class="form-control" min="1">
                            <button type="submit" class="btn btn-primary mt-1">Update</button>
                        </form>
                    </td>

                    <td>{{ $item->subtotal }}</td>
                    <td>
                        <!-- Tombol untuk menghapus item dari keranjang -->
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tombol untuk menghapus semua item di keranjang -->
        @if(count($cartItems) > 0)
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-warning">Hapus Semua Item</button>
        </form>
        @endif

        <!-- Form untuk input jumlah uang pelanggan -->
        <form action="{{ route('cart.payment') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="bayar">Jumlah Uang Pelanggan</label>
                <input type="number" class="form-control" id="bayar" name="bayar" placeholder="Masukkan jumlah uang yang diterima">
            </div>
            <button type="submit" class="btn btn-success">Proses Pembayaran</button>
        </form>

        <!-- Jika ada barang di keranjang dan pembayaran telah dilakukan, tampilkan tombol cetak struk PDF -->
        @if(count($cartItems) > 0 && isset($total) && isset($bayar) && isset($kembalian))
            <form action="{{ route('cart.generate_pdf') }}" method="POST">
                @csrf
                <input type="hidden" name="cartItems" value="{{ json_encode($cartItems) }}">
                <input type="hidden" name="total" value="{{ $total }}">
                <input type="hidden" name="bayar" value="{{ $bayar }}">
                <input type="hidden" name="kembalian" value="{{ $kembalian }}">
                <button type="submit" class="btn btn-primary mt-3">Cetak Struk PDF</button>
            </form>
        @endif

    </div>

    <!-- Tambahkan skrip Quagga sebelum penutupan tag body -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script>
        // Inisialisasi Quagga
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#interactive'), // Mengarahkan ke elemen DOM
                constraints: {
                    facingMode: "environment" // Untuk menggunakan kamera belakang
                },
            },
            decoder: {
                readers: ["code_128_reader"] // Jenis barcode yang akan dipindai
            }
        }, function(err) {
            if (err) {
                console.log(err);
                return;
            }
            console.log("Quagga is ready!");
            Quagga.start();
        });

        // Mendapatkan hasil pemindaian
        Quagga.onDetected(function(data) {
            console.log(data);
            var code = data.codeResult.code;
            document.getElementById("kode_barang").value = code; // Masukkan kode ke input
            document.getElementById("result").innerText = "Hasil Pemindaian: " + code; // Tampilkan hasil
            Quagga.stop(); // Hentikan pemindaian setelah mendapatkan hasil
        });

        // Menjalankan pemindaian saat tombol diklik
        document.getElementById("start-scanner").addEventListener("click", function() {
            var scannerSection = document.getElementById("scanner-section");
            if (scannerSection.style.display === "none") {
                scannerSection.style.display = "block"; // Tampilkan pemindaian
                Quagga.start(); // Mulai pemindaian
                this.innerText = "Tutup Pemindaian Barcode"; // Ubah teks tombol
            } else {
                scannerSection.style.display = "none"; // Sembunyikan pemindaian
                Quagga.stop(); // Hentikan pemindaian
                this.innerText = "Mulai Pemindaian Barcode"; // Ubah teks tombol kembali
            }
        });
        
    </script>
@endsection
