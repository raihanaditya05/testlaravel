@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manajemen Produk</h2>

    <!-- Form Input Produk Baru -->
    <div class="mb-4">
        <h4>Tambah Produk Baru</h4>
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
            </div>
            <div class="mb-3">
                <label for="harga_produk" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga_produk" name="harga_produk" required>
            </div>
            <div class="mb-3">
                <label for="gambar_produk" class="form-label">Gambar Produk</label>
                <input type="file" class="form-control" id="gambar_produk" name="gambar_produk" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="bahan" class="form-label">Bahan Terkait</label>
                <div id="bahan-checkbox-group">
                    @foreach($bahan as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="bahan{{ $item->id }}" name="bahan[]" value="{{ $item->id }}">
                            <label class="form-check-label" for="bahan{{ $item->id }}">{{ $item->nama_bahan }}</label>
                        </div>
                    @endforeach
                </div>
            </div>            
            <div class="mb-3">
                <label for="jumlah_stok" class="form-label">Jumlah Bahan</label>
                <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok[]" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Produk</button>
        </form>
    </div>

    <!-- Tabel Daftar Produk -->
    <h4>Daftar Produk</h4>
    <table class="table table-striped">
        <thead>
            <tr>
              
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>bahan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $produkItem)
            <tr>
                <td>{{ $produkItem->bahan }}</td>
                <td>{{ $produkItem->nama_produk }}</td>
                <td>{{ number_format($produkItem->harga_produk, 2, ',', '.') }}</td>
                <td>
                    @if($produkItem->gambar_produk)
                        <img src="{{ asset('storage/' . $produkItem->gambar_produk) }}" alt="{{ $produkItem->nama_produk }}" style="width: 50px; height: 50px;">
                    @endif
                </td>
                <td>
                    <a href="{{ route('produk.edit', $produkItem->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('produk.destroy', $produkItem->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
