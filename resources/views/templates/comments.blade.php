<div class="modal fade" id="comments-template-modale-{{$template->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center text-danger">Les commentaires du template : <strong>{{ $template->name }}</strong></h4>
            </div>
            <div class="modal-body text-center">

                @if(Auth::check() && $template->comments->filter(function ($comment) {return $comment->user_id == Auth::user()->id;})->count() == 0)

                    <form class="form-horizontal" method="POST" action="{{ route('comments-add') }}">

                        <!-- CRSF-->
                    {{ csrf_field() }}

                    <!-- Content-->
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label for="content" class="control-label">Votre commentaire : </label>
                                <hr>
                            </div>

                            <input type="hidden" name="template_id" value="{{ $template->id }}">

                            <div class="col-md-12">
                                <textarea maxlength="1000" class="form-control" name="content" id="" rows="8">{{ old('content') }}</textarea>
                            </div>

                            <span class="help-block text-center">
                            <strong> {{ $errors->has('content') ? $errors->first('content') : '1000 caracteres max' }}</strong>
                        </span>

                        </div>

                        <button class="btn btn-success"> <i class="fa fa-comment"></i> Commenter </button>

                    </form>

                    <hr>

                @endif

                @forelse($template->comments as $comment)

                    <div class="row">

                        <div class="col-md-2">
                            <div class="thumbnail">
                                <a href="{{route('user-show' , ['id' => $comment->user->id])}}" title="Voir le profil de {{$comment->user->name}} ">
                                    <img class="img-responsive" src="{{asset('storage/avatars/'.$comment->user->avatar)}}" alt="Avatar user {{ $comment->user->name }}" onError="this.onerror=null;this.src='/img/default-image.png';">
                                </a>
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>{{ $comment->user->name }}</strong> <span class="text-muted">a commenté le <i>{{ formatDatabaseDate($comment->created_at , true) }}</i></span>
                                </div>
                                <div class="panel-body">
                                    {!! nl2br(e($comment->content)) !!}
                                </div>
                         </div>

                        @if (Auth::check() && $comment->user_id === Auth::user()->id)
                            <div class="text-right">
                                <a class="text-right text-danger" href="{{ route('comments-remove' , ['id' => $comment->id , 'crsf_token' => csrf_token()]) }}">Supprimer</a>
                            </div>
                        @endif

                        </div>

                    </div>

                @empty
                    <i class="text-center">Aucun commentaire pour ce template</i>
                @endforelse

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>