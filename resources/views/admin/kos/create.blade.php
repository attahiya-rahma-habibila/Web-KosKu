@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">

        <h2 class="fw-bold mb-1">
            Tambah Data Kos
        </h2>

        <p class="text-muted mb-0">
            Tambahkan informasi kos baru.
        </p>

    </div>


    {{-- ERROR --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Ada kesalahan:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form
                action="{{ route('admin.data.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- NAMA KOS --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Kos
                    </label>

                    <input
                        type="text"
                        name="nama_kos"
                        class="form-control"
                        placeholder="Contoh: Kos Mawar"
                        value="{{ old('nama_kos') }}"
                        required
                    >

                </div>


                {{-- PEMILIK --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Pemilik
                    </label>

                    <input
                        type="text"
                        name="pemilik"
                        class="form-control"
                        placeholder="Masukkan nama pemilik"
                        value="{{ old('pemilik') }}"
                        required
                    >

                </div>


                {{-- NO HP --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        No. HP
                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        placeholder="08xxxxxxxxxx"
                        value="{{ old('no_hp') }}"
                        required
                    >

                </div>


                {{-- ALAMAT --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        class="form-control"
                        rows="3"
                        placeholder="Masukkan alamat lengkap kos"
                        required
                    >{{ old('alamat') }}</textarea>

                </div>


                {{-- LOKASI --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Lokasi Kos
                    </label>

                    <p class="text-muted small mb-2">
                        Klik pada peta untuk menentukan lokasi kos.
                    </p>


                    <div
                        id="map"
                        style="
                            width:100%;
                            height:400px;
                            border-radius:12px;
                            border:1px solid #e2e8f0;
                            overflow:hidden;
                        "
                    ></div>


                    <div class="row mt-3">

                        <div class="col-md-6 mb-3 mb-md-0">

                            <label class="form-label">
                                Latitude
                            </label>

                            <input
                                type="text"
                                name="latitude"
                                id="latitude"
                                class="form-control"
                                value="{{ old('latitude') }}"
                                readonly
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Longitude
                            </label>

                            <input
                                type="text"
                                name="longitude"
                                id="longitude"
                                class="form-control"
                                value="{{ old('longitude') }}"
                                readonly
                            >

                        </div>

                    </div>


                    <div class="mt-2">

                        <small class="text-muted">

                            <i class="bi bi-info-circle me-1"></i>

                            Klik titik lokasi kos pada peta.
                            Koordinat akan terisi otomatis.

                        </small>

                    </div>

                </div>


                {{-- HARGA --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Harga / Bulan
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            Rp
                        </span>

                        <input
                            type="number"
                            name="harga"
                            class="form-control"
                            placeholder="Contoh: 750000"
                            value="{{ old('harga') }}"
                            min="0"
                            required
                        >

                    </div>

                </div>


                {{-- DESKRIPSI --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="4"
                        placeholder="Masukkan deskripsi kos..."
                    >{{ old('deskripsi') }}</textarea>

                </div>


                {{-- FOTO --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Foto Kos
                    </label>

                    <input
                        type="file"
                        name="foto[]"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                        multiple
                    >

                    <small class="text-muted">

                        Pilih satu atau beberapa foto sekaligus.
                        Format JPG, JPEG, PNG, WEBP.
                        Maksimal 2 MB per foto.

                    </small>

                </div>


                {{-- BUTTON --}}
                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.data') }}"
                        class="btn btn-secondary"
                    >

                        <i class="bi bi-arrow-left me-1"></i>

                        Kembali

                    </a>


                    <button
                        type="submit"
                        class="btn btn-simpan-data"
                    >

                        <i class="bi bi-save me-1"></i>

                        Simpan Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<style>

.btn-simpan-data {

    background: #0f172a;
    border: 1px solid #0f172a;

    color: #ffffff;

    font-weight: 600;

    padding: 9px 16px;

    border-radius: 8px;

    transition: all .2s ease;

}


.btn-simpan-data:hover {

    background: #1e293b;
    border-color: #1e293b;

    color: #ffffff;

    transform: translateY(-1px);

}


.btn-simpan-data:focus {

    background: #0f172a;
    border-color: #0f172a;

    color: #ffffff;

    box-shadow:
        0 0 0 .2rem rgba(15, 23, 42, .15);

}

</style>


{{-- LEAFLET --}}

<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>

<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
</script>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const defaultLat = -0.2288;

        const defaultLng = 100.6323;


        const map =
            L.map('map').setView(
                [
                    defaultLat,
                    defaultLng
                ],
                13
            );


        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            {

                maxZoom: 19,

                attribution:
                    '&copy; OpenStreetMap contributors'

            }
        ).addTo(map);


        let marker = null;


        const oldLat =
            document.getElementById(
                'latitude'
            ).value;


        const oldLng =
            document.getElementById(
                'longitude'
            ).value;


        if (
            oldLat &&
            oldLng
        ) {

            const lat =
                parseFloat(oldLat);

            const lng =
                parseFloat(oldLng);


            marker =
                L.marker([
                    lat,
                    lng
                ])
                .addTo(map);


            map.setView(
                [
                    lat,
                    lng
                ],
                16
            );

        }


        map.on(
            'click',
            function (e) {

                const lat =
                    e.latlng.lat.toFixed(7);


                const lng =
                    e.latlng.lng.toFixed(7);


                document.getElementById(
                    'latitude'
                ).value = lat;


                document.getElementById(
                    'longitude'
                ).value = lng;


                if (marker) {

                    map.removeLayer(
                        marker
                    );

                }


                marker =
                    L.marker([
                        e.latlng.lat,
                        e.latlng.lng
                    ])
                    .addTo(map);


                marker.bindPopup(

                    '<strong>Lokasi Kos</strong>' +
                    '<br>' +
                    'Latitude: ' + lat +
                    '<br>' +
                    'Longitude: ' + lng

                ).openPopup();

            }
        );

    }
);

</script>

@endsection