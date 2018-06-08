<div class="modal fade in" id="download-templates-modale" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center text-danger">Merci d'avoir acheté chez <strong>{{ route('index') }} !!</strong></h4>
            </div>
            <div class="modal-body text-center">

                <div class="well">
                    <p>Commande n° {{ $order->id }}  </p>
                    <p>Effectué le : {{ formatDatabaseDate($order->date , true) }} </p>
                    <p>Coût total : <strong>{{ number_format((float)$order->ammount, 2, '.', '') }} &euro;</strong> </p>
                </div>

                <p>Voici votre facture pour cette commande : <a target="_blank" href="{{route('facture-show' , ['id' => $order->id] )}}">Voir la facture</a> </p>

                <p>Un email vous a egalement été envoyé a l'adresse <strong>{{ $order->user->email }}</strong> avec la facture en pièce jointe.</p>

                <h3> Télécharger vos templates achetés : </h3>

                <div class="well">

                    @foreach($order->templates as $template)
                        <a href="{{route('template-download' , ['id' => $template->id] )}}" class="btn btn-success">
                            <i class="fa fa-download"> </i>
                            Télécharger le template <strong>{{ $template->name }} </strong>
                        </a>
                        <hr>
                    @endforeach

                </div>


                <p style="margin-top: 30px;" class="text-success"> A bientôt et merci pour votre confiance. </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>