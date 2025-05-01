@extends('layout.app')

@section('title', 'Tambah Pemeriksaan')

@section('nav-item')
@include('dokter.components.nav_item')
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Pemeriksaan untuk {{ $periksa->pasien->nama }}</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('dokter.periksa.update', $periksa->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="biaya_periksa">Biaya Pemeriksaan</label>
                <input type="number" name="biaya_periksa" class="form-control" value="{{ old('biaya_periksa', $periksa->biaya_periksa) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="obats">Obat yang Diberikan</label>
                <select name="obats[]" class="form-control" multiple required>
                    @foreach($obats as $obat)
                        <option value="{{ $obat->id }}">{{ $obat->nama_obat }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Gunakan Ctrl (atau Cmd di Mac) untuk pilih lebih dari satu</small>
            </div>

            <button type="submit" class="btn btn-success">Simpan Pemeriksaan</button>
        </form>
    </div>
</div>
@endsection
