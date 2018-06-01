<div class="modal fade" id="delete-template-modale" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center text-danger">Etes vous certain de supprimer ce template ?</h4>
            </div>
            <div class="modal-body">
                <p class="text-danger">Attention la suppression d'un template est définitive et irréversible.</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger" href="{{route('template-remove' , ['id' => $template->id])}}">
                    <i class="fa fa-trash"></i>
                    Supprimmer
                </a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>