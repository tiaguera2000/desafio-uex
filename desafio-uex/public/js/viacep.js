let cepInput = document.querySelector('#cep');
let bairroInput = document.querySelector('#bairro');
let municipioInput = document.querySelector('#municipio');
let estadoInput = document.querySelector('#estado');
let logradouroInput = document.querySelector("#logradouro");
cep.addEventListener('blur', async ()=>{
    let numeroCep = cep.value;
    let response = await axios.get(`https://viacep.com.br/ws/${numeroCep}/json`);
    console.log(response.data);
    bairroInput.value = response.data.bairro;
    municipioInput.value = response.data.localidade;
    estadoInput.value = response.data.uf;
    logradouroInput.value = response.data.logradouro;
});