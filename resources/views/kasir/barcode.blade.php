@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Buat Barcode</h1>

        <!-- Form to Add New Item -->
        <form action="{{ route('store_item') }}" method="POST">
            @csrf
            <!-- Form inputs for adding item -->
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Barang</button>
        </form>

        <hr>

        <!-- Form to Edit Stok and Harga -->
        <h2>Edit Stok atau Harga</h2>
        <form action="{{ route('update_item') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="edit_item_id">Pilih Barang</label>
                <select name="item_id" id="edit_item_id" class="form-control">
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="edit_harga">Harga Baru</label>
                <input type="number" name="harga" id="edit_harga" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_stok">Stok Baru</label>
                <input type="number" name="stok" id="edit_stok" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Update Barang</button>
        </form>

        <hr>

        <!-- Form to Generate Barcode -->
        <h2>Generate Barcode</h2>
        <form action="{{ route('generate_barcode') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="item_id">Pilih Barang</label>
                <select name="item_id" id="item_id" class="form-control">
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Buat Barcode</button>
        </form>

        @if(isset($barcode))
            <h3>Barcode untuk Barang: {{ $barcode->nama_barang }}</h3>
            <svg id="barcode"></svg> <!-- Barcode as SVG -->
        @else
            <h3>Silakan pilih barang untuk membuat barcode.</h3>
        @endif
    </div>

    <!-- Load JsBarcode -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.0/JsBarcode.all.min.js"></script>

    <script>
        @if(isset($barcode))
            JsBarcode("#barcode", "{{ $barcode->id }}", {
                format: "CODE128",
                displayValue: true
            });
        @endif
    </script>
@endsection
