@extends('layout.app')

@section('title', 'Riwayat Janji')

@section('nav-item')
@include('pasien.components.nav_item')
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <a href="{{ route('pasien.periksa') }}" class="btn btn-light btn-sm text-dark" style="color: #000 !important;">
            <i class="fas fa-calendar-plus"></i> Buat Janji Baru
        </a>
        <h3 class="card-title mb-0">Riwayat Janji Pemeriksaan</h3>
    </div>
    <div class="card-body">
        @if($records->isEmpty())
            <div class="alert alert-info text-center">
                Belum ada janji pemeriksaan. Yuk, <a href="{{ route('pasien.periksa') }}">buat janji baru</a>!
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Dokter</th>
                            <th>Tanggal Periksa</th>
                            <th>Keluhan</th>
                            <th>Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $r)
                            <tr>
                                <td>{{ $r->dokter->nama ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->tgl_periksa)->format('d M Y, H:i') }}</td>
                                <td>{{ $r->catatan }}</td>
                                <td>
                                    @if ($r->biaya_periksa)
                                        Rp {{ number_format($r->biaya_periksa, 0, ',', '.') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
