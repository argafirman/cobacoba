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

        <h1>Tambah Pembayaran</h1>
        <form action="{{ route('pembayaran.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="siswa_id">Siswa</label>
                <select name="siswa_id" id="siswa_id" class="form-control" required>
                    <option value="">Pilih Siswa</option>
                    @foreach ($siswas as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama }} - {{ $siswa->no_absen }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Pembayaran</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah Pembayaran</label>
                <input type="number" name="jumlah" id="jumlah" min="1" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
        </form>
    </div>
@endsection
