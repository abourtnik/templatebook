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

                <hr>

                <h4> <strong>Télécharger vos templates achetés :</strong>  </h4>

                <div class="well">

                    @foreach($order->templates as $template)
                        <a style="margin-bottom: 5px" href="{{route('template-download' , ['id' => $template->id] )}}" class="btn btn-success">
                            <i class="fa fa-download"> </i>
                            Télécharger le template : <strong>{{ $template->name }} </strong>
                        </a>
                    @endforeach

                </div>


                <h5 style="margin-top: 30px;" class="text-success"> <strong> A bientôt et merci pour votre confiance. </strong>  </h5>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>