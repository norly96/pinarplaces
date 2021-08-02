@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <!-- Esri Leaflet Geocoder -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"/>
@endsection

@section('content')

<div class="container">
    <h1 class="text-center mt-4">Registrar Lugares</h1>
</div class="mt-5 row justify-content-center">
<form class="col-md-9 col-xs-12 card card-body">
    <fieldset class="border p-4">
        <legend class="text-primary">Nombre, Categoria e Imagen Principal</legend>
        <div class="form-group">
            <label for="nombre">Nombre Lugar</label>
            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre del Lugar" name="nombre" value="{{old('nombre')}}">
            @error('nombre')
            <div class="invalid-feedback">{{message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <select class="form-control @error('categoria_id') is-invalid @enderror" name="categoria_id" id="categoria">
                <option value="" select disabled>-- Seleccione --</option>
                @foreach($categorias as $categoria)
                <option value="{{$categoria->id}}" {{old('categoria_id')==$categoria->id ? 'selected' : '' }}>{{$categoria->nombre}}</option>

                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="imagen_principal">Imagen Principal</label>
            <input id="imagen_principal" type="file" class="form-control @error('imagen_principal') is-invalid @enderror" name="imagen_principal" value="{{old('imagen_principal')}}">
            @error('imagen_principal')
            <div class="invalid-feedback">{{message}}</div>
            @enderror
        </div>
    </fieldset>
    <fieldset class="border p-4">
        <legend class="text-primary">Ubicacion:</legend>
        <div class="form-group">
            <label for="formbuscador">Coloca la Direccion del Lugar</label>
            <input id="formbuscador" type="text" class="form-control" placeholder="Direccion del Lugar">
            <p class="text-secondary mt-5 mb-3 text-center">El asistente colocara una direccion estimada, mueve el Pin hacia el lugar correcto</p>
        </div>
        <div class="form-group">
            <div id="mapa" style="height: 400px;"></div>
        </div>
        <p class="informacion">Confirma que los suiguinets campos son correctos</p>
        <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" id="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="Direccion" value="{{old('direccion')}}">
        @error('direccion')
        <div class="invalid-feedback">{{message}}</div>
        @enderror    
        
        </div>
             <input type="hidden" id="lat" name="lat" value="{{old('lat')}}">
             <input type="hidden" id="lng" name="lng" value="{{old('lng')}}">
    </fieldset>
</form>
</div>
</div>


@endsection

@section('scripts')

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet" defer></script>
    <!-- Esri Leaflet Geocoder -->
    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const lat = 22.4165191;
        const lng = -83.6985334;

        const mapa = L.map('mapa').setView([lat, lng], 24);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;

        // agregar el pin
        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true
        }).addTo(mapa);

        //Geocode Sefvice
        const geocodeService = L.esri.Geocoding.geocodeService();

        //Detectar movimineto del marker
        marker.on('moveend', function(e) {
           marker = e.target;

           const position = marker.getLatLng();
           console.log(position);
           //Centrar automaticamente
           mapa.panTo(new L.LatLng(position.lat, position.lng));

           //Reverse Geocoding, cunado el usuario reubica el pin
           geocodeService.reverse().latlng(position, 16).run(function(error,resultado){
               console.log(error);
               console.log(resultado.address);
           })

        });
    });

</script>



@endsection
