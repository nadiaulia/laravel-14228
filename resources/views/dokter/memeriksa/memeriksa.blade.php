@extends('layout.app')

@section('title', 'Periksa Pasien')

@section('nav-item')
@include('dokter.components.nav_item')
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Daftar Pemeriksaan Pasien</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="bg-primary text-white">
                <tr>
                    <th>#</th>
                    <th>Nama Pasien</th>
                    <th>Catatan</th>
                    <th>Biaya Periksa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $index => $r)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $r->pasien->nama }}</td>
                        <td>{{ $r->catatan }}</td>
                        <td>Rp {{ number_format($r->biaya_periksa ?? 0, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('dokter.tambah.pemeriksaan', $r->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
