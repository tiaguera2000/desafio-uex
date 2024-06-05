@extends('layouts.homeLayout')

@section('content')
<link rel="stylesheet" href="{{asset("css/googleMaps.css")}}">

<div class="container-fluid">

    <div class="row">
        <form action="{{route("contact.store")}}" method="post">
            @csrf
        <div class="col"></div>
        <div class="col-sm-10 col-12">

            {{-- Dados pessoais --}}
            <h3>Dados do contato</h3>
            <hr>
            <div class="row">
                <div class="col-12">

                    <div class="form-group">
                        <label for="">Nome</label>
                        <input type="text" class="form-control" name="name" value="{{old("name")}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Cpf</label>
                        <input type="number" minlength="11" maxlength="11" class="form-control" name="cpf" value="{{old("cpf")}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" value="{{old("email")}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Telefone</label>
                        <input type="number" class="form-control" name="phone" value="{{old("phone")}}" required>
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
                <input type="text" class="form-control" id="state" placeholder="Sigla do estado" minlength="2" maxlength="2">
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
                        <input type="text" class="form-control" id="stateAddress" name="state" value="{{old("state")}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Cidade</label>
                        <input type="text" class="form-control" id="cityAddress" name="city" value="{{old("city")}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Cep</label>
                        <input type="text" class="form-control" id="zipAddress" name="zip_code" value="{{old("zip_code")}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Complemento</label>
                        <textarea cols="30" rows="2" class="form-control" name="complement">{{old("complement")}}</textarea>                    
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="form-group">
                        <label for="">Bairro</label>
                        <input type="text" class="form-control" id="districtAddress" name="district" value="{{old("district")}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Rua</label>
                        <input type="text" class="form-control" id="streetAddress" name="street" value="{{old("street")}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Número</label>
                        <input type="text" class="form-control" id="numberAddress" name="number" value="{{old("number")}}">
                    </div>
                    <input type="hidden" name="lat" id="lat" value="{{old("lat")}}">
                    <input type="hidden" name="lon" id="lon" value="{{old("lon")}}">
                </div>
            </div>
            <div id="map" style="height: 60vh; width:80vh"></div>
        </div>
        <div class="col"></div>
        <hr>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Salvar Contato</button>
        </div>
    </form>
    </div>
</div>

<script src="{{asset("js/contact/create.js")}}"></script>

@endsection