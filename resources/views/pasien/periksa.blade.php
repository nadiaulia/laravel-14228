@extends('layout.app')

@section('title', 'Buat Janji Pemeriksaan')

@section('nav-item')
@include('pasien.components.nav_item')
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            <div class="card border-primary shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Form Buat Janji Pemeriksaan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('pasien.periksa.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="tgl_periksa">Tanggal & Waktu Periksa</label>
                            <input type="datetime-local" name="tgl_periksa" class="form-control @error('tgl_periksa') is-invalid @enderror" required>
                            @error('tgl_periksa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="catatan">Keluhan / Catatan</label>
                            <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="3"></textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="id_dokter">Pilih Dokter</label>
                            <select name="id_dokter" class="form-control @error('id_dokter') is-invalid @enderror" required>
                                <option value="">-- Pilih Dokter --</option>
                                @foreach ($dokters as $dokter)
                                <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_dokter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-calendar-check"></i> Buat Janji
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('pasien.riwayat') }}" class="btn btn-outline-primary">
                    <i class="fas fa-history"></i> Lihat Riwayat Janji
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
