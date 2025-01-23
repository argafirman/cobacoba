@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Siswa</h1>
        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $siswa->nama }}" >
            </div>
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="kelas" name="kelas" value="{{ $siswa->kelas }}"
                    >
            </div>
            <div class="mb-3">
                <label for="nomor_induk" class="form-label">Nomor Induk</label>
                <input type="text" class="form-control" id="nomor_induk" name="nomor_induk"
                    value="{{ $siswa->nomor_induk }}" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
