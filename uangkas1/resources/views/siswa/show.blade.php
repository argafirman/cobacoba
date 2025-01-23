@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Siswa</h1>
        <p><strong>Nama:</strong> {{ $siswa->nama }}</p>
        <p><strong>Kelas:</strong> {{ $siswa->kelas }}</p>
        <p><strong>Nomor Induk:</strong> {{ $siswa->nomor_induk }}</p>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
