@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1>Data Pembayaran</h1>
        <a href="{{ route('pembayaran.create') }}" class="btn btn-primary mb-3">Tambah Pembayaran</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Siswa</th>
                    <th>No Absen</th> <!-- Menambahkan kolom No Absen -->
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayarans as $pembayaran)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pembayaran->siswa->nama }}</td>
                        <td>{{ $pembayaran->siswa->no_absen }}</td> <!-- Menampilkan No Absen -->
                        <td>{{ $pembayaran->tanggal }}</td>
                        <td>Rp {{ number_format($pembayaran->jumlah, 2, ',', '.') }}</td>
                        {{-- <td>
                            <a href="{{ route('pembayaran.edit', $pembayaran) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pembayaran.destroy', $pembayaran) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data pembayaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
