@extends('layouts.homeLayout')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <input type="search" name="busca" id="busca" class="form-control" placeholder="Pesquisar por nome, cpf, email...">
            <table class="table table-hover table-bordered" style="margin-top:1vh">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cpf</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @foreach ($contacts as $contact)
                    <tr>
                        <td>{{$contact->name}}</td>
                        <td>{{$contact->cpf}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->phone}}</td>
                        <td><a href="{{route("contact.edit", $contact)}}" class="btn btn-warning">Editar</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($contacts->hasPages())
                <div>
                    {{$contacts->links()}}
                </div>
            @endif
        </div>
    </div>
</div>
<script>

let contacts = @json($contacts);
let tbody = document.querySelector('#tbody');

function renderTable(filteredContacts) {

    tbody.innerHTML = '';
    filteredContacts.forEach(contact => {
        let tr = document.createElement('tr');
        tr.innerHTML = `<td>${contact.name}</td>
                        <td>${contact.cpf}</td>
                        <td>${contact.email}</td>
                        <td>${contact.phone}</td>
                        <td><a href="/contact/${contact.id}/edit" class="btn btn-warning">Editar</a></td>

                        `;
        tbody.appendChild(tr);
    });
}

function filterContacts(query) {
    return contacts.filter(contact => {
        return contact.name.toLowerCase().includes(query.toLowerCase()) ||
               contact.cpf.toLowerCase().includes(query.toLowerCase()) ||
               contact.email.toLowerCase().includes(query.toLowerCase());
    });
}
document.getElementById('busca').addEventListener('input', function() {
    let query = this.value;
    let filteredContacts = filterContacts(query);
    renderTable(filteredContacts);
}); 
</script>
@endsection
