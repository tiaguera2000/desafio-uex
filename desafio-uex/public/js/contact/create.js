
let map;
async function initMap(lat, lon) {
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

  map = new Map(document.getElementById("map"), {
    center: { lat: lat, lng: lon },
    zoom: 15,
    mapId: "876db5025fc99f07"
  });
  const marker = new AdvancedMarkerElement({
    map,
    position: { lat: lat, lng: lon },
  });
}
initMap(-33, -53);
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