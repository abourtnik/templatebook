<div class="modal" id="download-templates-modale" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center text-danger">Merci d'avoir acheté chez {{ route('index') }}</h4>
            </div>
            <div class="modal-body">

                <h2> Telecharger vos templates : </h2>

                    @foreach($templates as $template)
                    <a href="{{route('template-download' , ['id' => $template->id] )}}" class="btn btn-success">
                        <i class="fa fa-download"> </i>
                        Télécharger le template <strong>{{ $template->name }} </strong>
                    </a>
                    @endforeach


                <p> A bientot et merci pour votre confiance </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>