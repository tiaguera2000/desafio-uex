<div class="modal fade" id="deleteModal{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apagar contato</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Você tem certeza que deseja excluir este contato?</div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('contact.destroy', $contact->id) }}">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Apagar</button>
                </form>
            </div>
        </div>
    </div>
</div>