<div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('me.destroy', $user->id) }}">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apagar meu perfil</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Você tem certeza que deseja excluir seu perfil?
                <hr>
                <input type="password" name="password" type="password" id="" class="form-control" placeholder="Confirme sua senha">

            </div>
            <div class="modal-footer">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Apagar</button>
            </div>
        </form>
        </div>
    </div>
</div>