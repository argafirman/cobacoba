@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="text-center">
            <h1 class="mb-4">Saldo Uang Kas</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Panel Card untuk menampilkan saldo uang kas -->
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Saldo Uang Kas</h5>
                </div>
                <div class="card-body">
                    <!-- Periksa apakah $uangKas ada -->
                    @if ($uangKas)
                        <h4 class="card-title">Saldo: Rp. {{ number_format($uangKas->saldo, 2, ',', '.') }}</h4>
                    @else
                        <p class="card-text">Saldo Uang Kas belum tersedia. Harap perbarui saldo terlebih dahulu.</p>
                    @endif
                </div>
            </div>

            <!-- Penjelasan lebih lanjut jika saldo belum tersedia -->
            @if (!$uangKas)
                <div class="mt-3 alert alert-warning">
                    <strong>Perhatian!</strong> Silakan perbarui saldo uang kas terlebih dahulu sebelum melakukan transaksi.
                </div>
            @endif
        </div>
    </div>
@endsection
