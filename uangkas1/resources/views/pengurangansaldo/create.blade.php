@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pengurangan Saldo</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengurangansaldo.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="uangkas_id" class="form-label">Pilih Uang Kas</label>
            <select class="form-control" id="uangkas_id" name="uangkas_id" >
                <option value="">Pilih Uang Kas</option>
                @foreach($uangkas as $uang)
                    <option value="{{ $uang->id }}">{{ $uang->id }} - Rp {{ number_format($uang->saldo, 2, ',', '.') }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Pengurangan</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" min="0.01" step="0.01" >
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pengurangansaldo.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
