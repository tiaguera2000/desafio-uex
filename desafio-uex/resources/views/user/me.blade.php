@extends('layouts.homeLayout')

@section('content')

<div class="row">
    <div class="col"></div>
    <div class="col-12 col-sm-10">
        <form action="{{route("me.update", $user->id)}}" method="post">
            @method("PATCH")
            @csrf
            <div class="form-group">
                <label for="">Nome</label>
                <input type="text" class="form-control" value="{{old("name", $user->name)}}" name="name">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" value="{{old("email", $user->email)}}" name="email">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </form>
        <a href="#" data-toggle="modal" data-target="#deleteModal{{$user->id}}" class="btn btn-danger">Excluir minha conta</a>
    </div>
    <div class="col"></div>
</div>
@include('user.delete')

@endsection