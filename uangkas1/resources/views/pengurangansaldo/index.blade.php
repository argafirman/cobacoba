@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Pengeluaran Saldo</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('pengurangansaldo.create') }}" class="btn btn-primary mb-3">Tambah Pengurangan Saldo</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th> <!-- Menambahkan kolom No -->
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($pengurangansaldo as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                        <td>Rp {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                        <td>{{ $item->keterangan ?? 'N/A' }}</td>
                        <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                        {{-- <td> --}}
                            {{-- <form action="{{ route('pengurangansaldo.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form> --}}
                        {{-- </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
