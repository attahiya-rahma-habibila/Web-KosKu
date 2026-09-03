@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">

        <h2 class="fw-bold mb-1">
            Edit Data Kos
        </h2>

        <p class="text-muted mb-0">
            Perbarui informasi kos.
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
                action="{{ route('admin.data.update', $kos->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                {{-- NAMA KOS --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Kos
                    </label>

                    <input
                        type="text"
                        name="nama_kos"
                        class="form-control"
                        value="{{ old('nama_kos', $kos->nama_kos) }}"
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
                        value="{{ old('pemilik', $kos->pemilik) }}"
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
                        value="{{ old('no_hp', $kos->no_hp) }}"
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
                        required
                    >{{ old('alamat', $kos->alamat) }}</textarea>

                </div>


                {{-- LOKASI --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Lokasi Kos
                    </label>

                    <p class="text-muted small mb-2">

                        Klik lokasi baru pada peta
                        jika ingin mengubah lokasi kos.

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
                                value="{{ old('latitude', $kos->latitude) }}"
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
                                value="{{ old('longitude', $kos->longitude) }}"
                                readonly
                            >

                        </div>

                    </div>


                    <div class="mt-2">

                        <small class="text-muted">

                            <i class="bi bi-info-circle me-1"></i>

                            Klik pada peta untuk mengganti
                            lokasi kos.

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
                            value="{{ old('harga', $kos->harga) }}"
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
                    >{{ old('deskripsi', $kos->deskripsi) }}</textarea>

                </div>


                {{-- FOTO LAMA --}}
                @if($kos->fotoKoss->count())

                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Foto Saat Ini
                        </label>


                        <div class="d-flex flex-wrap gap-3 mt-2">

                            @foreach($kos->fotoKoss as $foto)

                                <div>

                                    <img
                                        src="{{ asset('kos/' . $foto->foto) }}"
                                        alt="{{ $kos->nama_kos }}"
                                        width="180"
                                        height="130"
                                        style="
                                            object-fit:cover;
                                            border-radius:10px;
                                            border:1px solid #e2e8f0;
                                        "
                                    >

                                </div>

                            @endforeach

                        </div>

                    </div>

                @elseif($kos->foto)

                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Foto Saat Ini
                        </label>

                        <br>

                        <img
                            src="{{ asset('kos/' . $kos->foto) }}"
                            alt="{{ $kos->nama_kos }}"
                            width="180"
                            height="130"
                            style="
                                object-fit:cover;
                                border-radius:10px;
                                border:1px solid #e2e8f0;
                            "
                        >

                    </div>

                @endif


                {{-- FOTO BARU --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Tambah Foto
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
                        Foto lama tidak akan terhapus.
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
                        class="btn btn-primary"
                    >

                        <i class="bi bi-save me-1"></i>

                        Update Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


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

        const latitudeInput =
            document.getElementById(
                'latitude'
            );


        const longitudeInput =
            document.getElementById(
                'longitude'
            );


        const existingLat =
            parseFloat(
                latitudeInput.value
            );


        const existingLng =
            parseFloat(
                longitudeInput.value
            );


        const defaultLat =
            !isNaN(existingLat)
                ? existingLat
                : -0.2288;


        const defaultLng =
            !isNaN(existingLng)
                ? existingLng
                : 100.6323;


        const zoom =
            !isNaN(existingLat) &&
            !isNaN(existingLng)
                ? 16
                : 13;


        const map =
            L.map('map').setView(
                [
                    defaultLat,
                    defaultLng
                ],
                zoom
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


        if (
            !isNaN(existingLat) &&
            !isNaN(existingLng)
        ) {

            marker =
                L.marker([
                    existingLat,
                    existingLng
                ])
                .addTo(map);


            marker.bindPopup(

                '<strong>{{ $kos->nama_kos }}</strong>' +
                '<br>Lokasi kos saat ini.'

            );

        }


        map.on(
            'click',
            function (e) {

                const lat =
                    e.latlng.lat.toFixed(7);


                const lng =
                    e.latlng.lng.toFixed(7);


                latitudeInput.value =
                    lat;


                longitudeInput.value =
                    lng;


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

                    '<strong>Lokasi Baru</strong>' +
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