@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Barang yang Dihapus Sementara</h1>

        <!-- Pesan sukses -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel barang yang di-soft delete -->
        @if(count($deletedItems) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deletedItems as $item)
                    <tr>
                        <td>{{ $item->item_id }}</td>
                        <td>{{ $item->item->nama_barang }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->subtotal }}</td>
                        <td>
                            <!-- Tombol untuk menghapus item secara permanen -->
                            <form action="{{ route('kasir.forceDelete', $item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini secara permanen?');">Hapus Permanen</button>
                            </form>

                            <!-- Tombol untuk mengembalikan item dari soft delete -->
                            <form action="{{ route('kasir.restore', $item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Kembalikan</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada item yang dihapus sementara.</p>
        @endif
    </div>
@endsection
