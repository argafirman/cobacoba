@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="background-color: #f8f9fa; padding: 100px 0;">
        <div class="row justify-content-center">
            <!-- Kolom Utama -->
            <div class="col-md-10 col-lg-8">
                <!-- Card utama dengan animasi -->
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-gradient-primary text-white text-center">
                        <h2>{{ __('Welcome to Your Dashboard!') }}</h2>
                    </div>

                    <div class="card-body text-center">
                        <!-- Pesan Status -->
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="lead mb-4">You are successfully logged in. Choose an action below to manage your system.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Gradien warna pada card header */
        .bg-gradient-primary {
            background: linear-gradient(90deg, rgba(56, 125, 255, 1) 0%, rgba(48, 121, 255, 1) 100%);
        }

        /* Gaya untuk Card */
        .card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Text warna putih di card header */
        .card-header {
            background-color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Menambahkan padding pada bagian body */
        .card-body {
            padding: 30px;
        }

        /* Menata tombol dengan lebar penuh di setiap kolom */
        .w-100 {
            width: 100%;
        }
    </style>
@endsection
