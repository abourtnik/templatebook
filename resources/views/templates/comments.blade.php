<div class="modal fade" id="comments-template-modale" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center text-danger">Les commentaires du template : <strong>{{ $template->name }}</strong></h4>
            </div>
            <div class="modal-body">

                @forelse($template->comments as $comment)

                    <div class="row">

                        <div class="col-md-2">
                            <div class="thumbnail">
                                <img class="img-responsive" src="{{asset('storage/avatars/'.$comment->user->avatar)}}" alt="Avatar user {{ $comment->user->name }}" onError="this.onerror=null;this.src='/img/default-image.png';">
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>{{ $comment->user->name }}</strong> <span class="text-muted">a commenté le <i>{{ formatDatabaseDate($comment->created_at , true) }}</i></span>
                                </div>
                                <div class="panel-body">
                                    {{ $comment->content }}
                                </div>
                            </div>
                        </div>

                    </div>

                @empty
                    <p class="text-center">Aucun commentaire pour ce template</p>
                @endforelse

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>