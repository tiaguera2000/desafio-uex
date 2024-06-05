@extends('layouts.homeLayout')

@section('content')
<link rel="stylesheet" href="{{asset("css/googleMaps.css")}}">

<div class="container-fluid">

    <div class="row">
        <form action="{{route("contact.update", $contact)}}" method="post">
            @csrf
            @method("PATCH")
        <div class="col"></div>
        <div class="col-sm-10 col-12">
            <h1>Editar Contato</h1>
            {{-- Dados pessoais --}}
            <h3>Dados do contato</h3>
            <hr>
            <div class="row">
                <div class="col-12">

                    <div class="form-group">
                        <label for="">Nome</label>
                        <input type="text" class="form-control" name="name" value="{{old("name", $contact->name)}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Cpf</label>
                        <input type="text" class="form-control" name="cpf" value="{{old("cpf", $contact->cpf)}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" value="{{old("email", $contact->email)}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Telefone</label>
                        <input type="text" class="form-control" name="phone" value="{{old("phone", $contact->phone)}}">
                    </div>
                </div>
            </div>
            <h3>Busca do endereço</h3>
            <hr>
            {{-- Endereço --}}
            <div class="row">
                <div class="col-10">
                    <div class="form-group">
                        <label for="">Rua</label>
                        <input type="text" class="form-control" id="street" value="{{old("street")}}"> 
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="">n°</label>
                        <input type="text" class="form-control" id="number" >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Cidade</label>
                <input type="text" class="form-control" id="city">
            </div>
            <div class="form-group">
                <label for="">Estado</label>
                <input type="text" class="form-control" id="state" minlength="2" maxlength="2" placeholder="Sigla do estado">
            </div>
            <div class="btn btn-primary" onclick="consultar()">Pesquisar</div>
            <br>
            <div id="addresses"></div>
            <br>
            <h3>Dados do endereço</h3>
            <hr>
            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="form-group">
                        <label for="">Estado</label>
                        <input type="text" class="form-control" id="stateAddress" name="state" value="{{old("state",$contact->address->state)}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Cidade</label>
                        <input type="text" class="form-control" id="cityAddress" name="city" value="{{old("city", $contact->address->city)}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Cep</label>
                        <input type="text" class="form-control" id="zipAddress" name="zip_code" value="{{old("zip_code", $contact->address->zip_code)}}" required>
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="form-group">
                        <label for="">Bairro</label>
                        <input type="text" class="form-control" id="districtAddress" name="district" value="{{old("district", $contact->address->district)}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Rua</label>
                        <input type="text" class="form-control" id="streetAddress" name="street" value="{{old("street", $contact->address->street)}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Número</label>
                        <input type="text" class="form-control" id="numberAddress" name="number" value="{{old("number", $contact->address->number)}}">
                    </div>
                    <input type="hidden" name="lat" id="lat" value="{{old("lat", $contact->address->lat)}}">
                    <input type="hidden" name="lon" id="lon" value="{{old("lon", $contact->address->lon)}}">
                </div>
            </div>
            <div id="map" style="height: 60vh; width:80vh"></div>
        </div>
        <div class="col"></div>
        <hr>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Salvar Contato</button>
            <a style="margin-left: 1vh" href="#" data-toggle="modal" data-target="#deleteModal{{$contact->id}}" class="btn btn-danger">Excluir</a>
        </div>
    </form>
    </div>
</div>
@include('contact.delete')

<script>
(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyDaV8eu_kzISsEoieFsIbUObfa3bpVSWmI", v: "weekly"});
let map;
async function initMap(lat, lon) {
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

  map = new Map(document.getElementById("map"), {
    center: { lat: lat, lng: lon },
    zoom: 15,
    mapId:"876db5025fc99f07"
  });
  const marker = new AdvancedMarkerElement({
    map,
    position: { lat: lat, lng: lon },
  });
}
initMap({{$contact->address->lat}}, {{$contact->address->lon}});
let addresses = [];
async function consultar(){

    let street = document.querySelector("#street").value;
    let city = document.querySelector("#city").value;
    let state = document.querySelector("#state").value;
    let number = document.querySelector("#number").value;
    
    let body = {
        "street":street, "city":city, "state":state, "number":number
    };
    let addressesDiv = document.querySelector("#addresses");
    addressesDiv.innerHTML = '';
    let response = await axios.post("/address/search", body);
    addresses = response.data.data;
    let i = 0;
    addresses.forEach((address) => {
        console.log(address);
        address.id = i;
        let p = document.createElement("p");
        p.innerHTML = `<div class="btn btn-primary" onclick="escolher(${address.id})">Selecionar este endereco</div> 
        Cidade: ${address.city} Bairro: ${address.district}, CEP: ${address.zip_code} Rua: ${address.street} Nº${address.number}`;
        addressesDiv.appendChild(p);
        i++;
    });
    //this.initMap();
}

function escolher(id){

    let address = addresses.find(address => address.id === id);
    let stateHtml = document.querySelector("#stateAddress");
    let cityHtml = document.querySelector("#cityAddress");
    let streetHtml = document.querySelector("#streetAddress");
    let zipHtml = document.querySelector("#zipAddress");
    let numberHtml = document.querySelector("#numberAddress");
    let districtHtml = document.querySelector("#districtAddress");
    let latHtml = document.querySelector("#lat");
    let lonHtml = document.querySelector("#lon");

    stateHtml.value = address.state;
    cityHtml.value = address.city;
    districtHtml.value = address.district;
    zipHtml.value = address.zip_code;
    numberHtml.value = address.number;
    streetHtml.value = address.street;
    latHtml.value = address.lat;
    lonHtml.value = address.lng;

    if(address.lat && address.lng){
        this.initMap(address.lat, address.lng);
    }
}
</script>

@endsection