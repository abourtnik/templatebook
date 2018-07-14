<div class="modal fade" id="delete-template-modale" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center text-danger">Etes vous certain de supprimer ce template : <strong>{{ $template->name }}</strong> ?</h4>
            </div>
            <div class="modal-body">
                <h3 class="text-danger text-center">
                    Attention la suppression d'un template est définitive et irréversible.
                </h3>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger" href="{{route('template-remove' , ['id' => $template->id , 'crsf_token' => csrf_token() ])}}">
                    <i class="fa fa-trash"></i> Supprimmer
                </a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>