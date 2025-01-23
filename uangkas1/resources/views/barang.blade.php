<form action="" method="GET">
    <input type="text" name="cari">
    <button type="cari">Cari</button>
</form>

@foreach ($T as $b)
    {{ $b->nama_toko }} <br>
    {{ $b->status }}
    Jumlah Barang: {{ $b->barang_count }}<br>

    @if ($b->barang_count > 0)
        @foreach ($b->barang as $C)
            {{ $C->nama_barang }}
            {{ $C->harga }} <br>
        @endforeach
    @endif
@endforeach



