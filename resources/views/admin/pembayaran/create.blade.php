@extends('layouts.admin') 
 
@section('content') 
 
<div class="container-fluid"> 
 
{{-- HEADER --}} 
<div class="mb-4"> 
 
    <h1 class="fw-bold mb-1"> 
        Tambah Pembayaran 
    </h1> 
 
    <p class="text-muted mb-0"> 
        Tambahkan data pembayaran pemesanan kamar. 
    </p> 
 
</div> 
 
 
{{-- ERROR --}} 
@if($errors->any()) 
 
    <div class="alert alert-danger"> 
 
        <ul class="mb-0"> 
 
            @foreach($errors->all() as $error) 
 
                <li>{{ $error }}</li> 
 
            @endforeach 
 
        </ul> 
 
    </div> 
 
@endif 
 
 
<div class="card border-0 shadow-sm"> 
 
    <div class="card-body"> 
 
        <form action="{{ route('admin.pembayaran.store') }}" 
              method="POST"> 
 
            @csrf 
 
 
            {{-- PEMESANAN --}} 
            <div class="mb-3"> 
 
                <label class="form-label fw-semibold"> 
                    Pemesanan 
                </label> 
 
                <select name="pemesanan_id" 
                        class="form-select" 
                        required> 
 
                    <option value=""> 
                        -- Pilih Pemesanan -- 
                    </option> 
 
                    @foreach($pemesanans as $pemesanan) 
 
                        <option value="{{ $pemesanan->id }}" 
                            {{ old('pemesanan_id') == $pemesanan->id ? 'selected' : '' }}> 
 
                            {{ $pemesanan->user->name ?? '-' }} 
 
                            - 
                            Kamar 
                            {{ $pemesanan->kamar->nomor_kamar 
                                ?? $pemesanan->kamar->nama 
                                ?? '-' }} 
 
                            - 
                            Rp {{ number_format( 
                                $pemesanan->total_harga ?? 0, 
                                0, 
                                ',', 
                                '.' 
                            ) }} 
 
                        </option> 
 
                    @endforeach 
 
                </select> 
 
            </div> 
 
 
            {{-- JUMLAH --}} 
            <div class="mb-3"> 
 
                <label class="form-label fw-semibold"> 
                    Jumlah Pembayaran 
                </label> 
 
                <input type="number" 
                       name="jumlah" 
                       class="form-control" 
                       value="{{ old('jumlah') }}" 
                       min="0" 
                       placeholder="Masukkan jumlah pembayaran" 
                       required> 
 
            </div> 
 
 
            {{-- METODE --}} 
            <div class="mb-3"> 
 
                <label class="form-label fw-semibold"> 
                    Metode Pembayaran 
                </label> 
 
                <select name="metode_pembayaran" 
                        class="form-select" 
                        required> 
 
                    <option value=""> 
                        -- Pilih Metode -- 
                    </option> 
 
                    <option value="Transfer" 
                        {{ old('metode_pembayaran') == 'Transfer' ? 'selected' : '' }}> 
                        Transfer 
                    </option> 
 
                    <option value="Tunai" 
                        {{ old('metode_pembayaran') == 'Tunai' ? 'selected' : '' }}> 
                        Tunai 
                    </option> 
 
                    <option value="E-Wallet" 
                        {{ old('metode_pembayaran') == 'E-Wallet' ? 'selected' : '' }}> 
                        E-Wallet 
                    </option> 
 
                </select> 
 
            </div> 
 
 
            {{-- TANGGAL --}} 
            <div class="mb-3"> 
 
                <label class="form-label fw-semibold"> 
                    Tanggal Pembayaran 
                </label> 
 
                <input type="date" 
                       name="tanggal_pembayaran" 
                       class="form-control" 
                       value="{{ old('tanggal_pembayaran', date('Y-m-d')) }}" 
                       required> 
 
            </div> 
 
 
            {{-- STATUS --}} 
            <div class="mb-3"> 
 
                <label class="form-label fw-semibold"> 
                    Status 
                </label> 
 
                <select name="status" 
                        class="form-select" 
                        required> 
 
                    <option value="menunggu" 
                        {{ old('status', 'menunggu') == 'menunggu' ? 'selected' : '' }}> 
                        Menunggu 
                    </option> 
 
                    <option value="berhasil" 
                        {{ old('status') == 'berhasil' ? 'selected' : '' }}> 
                        Berhasil 
                    </option> 
 
                    <option value="ditolak" 
                        {{ old('status') == 'ditolak' ? 'selected' : '' }}> 
                        Ditolak 
                    </option> 
 
                </select> 
 
            </div> 
 
 
            {{-- CATATAN --}} 
            <div class="mb-4"> 
 
                <label class="form-label fw-semibold"> 
                    Catatan 
                </label> 
 
                <textarea name="catatan" 
                          class="form-control" 
                          rows="3" 
                          placeholder="Masukkan catatan jika ada">{{ old('catatan') }}</textarea> 
 
            </div> 
 
 
            {{-- BUTTON --}} 
            <div class="d-flex gap-2"> 
 
                <a href="{{ route('admin.pembayaran') }}" 
                   class="btn btn-secondary"> 
 
                    <i class="bi bi-arrow-left"></i> 
                    Kembali 
 
                </a> 
 
                <button type="submit" 
                        class="btn btn-simpan-pembayaran"> 
 
                    <i class="bi bi-save"></i> 
                    Simpan Pembayaran 
 
                </button> 
 
            </div> 
 
        </form> 
 
    </div> 
 
</div> 
 
</div>


<style>

/* =========================================================
   BUTTON SIMPAN PEMBAYARAN
========================================================= */

.btn-simpan-pembayaran {

    background: #0f172a;

    border: 1px solid #0f172a;

    color: #ffffff;

    font-weight: 600;

    padding: 9px 16px;

    border-radius: 8px;

    transition: all .2s ease;

}


.btn-simpan-pembayaran:hover {

    background: #1e293b;

    border-color: #1e293b;

    color: #ffffff;

    transform: translateY(-1px);

}


.btn-simpan-pembayaran:focus {

    background: #0f172a;

    border-color: #0f172a;

    color: #ffffff;

    box-shadow:
        0 0 0 .2rem rgba(15, 23, 42, .15);

}

</style>
 
@endsection