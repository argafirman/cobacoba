@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Menampilkan pesan error jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1>Tambah Siswa</h1>
        <!-- Form untuk menyimpan data siswa -->
        <form action="{{ route('siswa.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" >
            </div>
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" name="kelas" id="kelas" class="form-control" value="{{ old('kelas') }}" >
            </div>
            <div class="form-group">
                <label for="nomor_induk">Nomor Induk</label>
                <input type="text" name="nomor_induk" id="nomor_induk" class="form-control" value="{{ old('nomor_induk') }}" >
            </div>
            <div class="form-group">
                <label for="no_absen">No Absen</label>
                <input type="number" name="no_absen" id="no_absen" min="0"class="form-control" value="{{ old('no_absen') }}" >
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

    </div>
@endsection
