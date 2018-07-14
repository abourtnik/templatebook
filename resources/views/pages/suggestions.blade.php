@extends('layouts.app')

@section('title', 'Demandes')

@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"> Les demandes de templates les plus populaires </div>

                    <div class="panel-body text-center">

                        <i> Découvrez les templates les plus demandés par la communauté !! </i>

                        <hr>

                        @forelse($suggestions as $suggestion)

                            <div class="row">

                                <div class="col-md-2">
                                    <div class="thumbnail">
                                        <a href="{{route('user-show' , ['id' => $suggestion->user->id])}}" title="Voir le profil de {{$suggestion->user->name}} ">
                                            <img class="img-responsive" src="{{asset('storage/avatars/'.$suggestion->user->avatar)}}" alt="Avatar user {{ $suggestion->user->name }}" onError="this.onerror=null;this.src='/img/default-image.png';">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-10">
                                    <div class="panel panel-default text-center">
                                        <div class="panel-heading">
                                            @if (Auth::check() && $suggestion->user_id === Auth::user()->id)
                                                <strong><a class="text-left text-danger" href="{{ route('suggestions-remove' , ['id' => $suggestion->id , 'crsf_token' => csrf_token()]) }}">Supprimer</a></strong>
                                            @endif

                                            <strong>{{ $suggestion->user->name }}</strong> <span class="text-muted">a demandé le <i>{{ formatDatabaseDate($suggestion->created_at , true) }}</i></span>
                                            <button type="button" suggestion_id="{{ $suggestion->id }}" class="btn btn-success btn-success-demand {{ ( Auth::check() && userLikeSuggestion($suggestion)) ? 'btn-unlike' : 'btn-like'}}  pull-right" {{ (Auth::guest()) ? 'disabled' : '' }}>
                                                <i {{ ( Auth::check() && userLikeSuggestion($suggestion)) ? "style=color:blue" : ''}} class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                <span>{{ $suggestion->likes()->count() }}</span>
                                            </button>
                                        </div>
                                        <div class="panel-body" style="overflow-y: auto;">
                                            {!! nl2br(e($suggestion->content)) !!}
                                        </div>
                                    </div>
                                </div>

                            </div>

                        @empty
                            <p class="text-center">Aucune demande</p>
                        @endforelse

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"> Ecrire une demande </div>

                    <div class="panel-body text-center">

                        @if (Auth::check())

                        <p class="text-danger">Merci de bien vérifier que votre demande n'existe pas déja</p>

                            <hr>

                        <form class="form-horizontal" method="POST" action="{{ route('suggestions-add') }}" >

                            <!-- CRSF-->
                        {{ csrf_field() }}

                        <!-- Content-->
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="description" class="control-label"> Votre demande : </label>
                                <br>
                                <br>

                                <div class="col-md-12">
                                    <textarea maxlength="2000" class="form-control" name="content" id="" cols="30" rows="10">{{ old('content') }}</textarea>
                                    <span class="help-block">
                                        <strong> {{ $errors->has('content') ? $errors->first('content') : '2000 caractères max' }}</strong>
                                    </span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-block"> <i class="fa fa-pencil"></i> Ecrire </button>

                        </form>

                        @else

                        Inscrivez-vous maintenant pour écrire des demandes !

                        <br><br>
                        <a href="{{ route('register') }}" class="btn btn-success btn-block"> <i class="fa fa-pencil"></i> S'inscrire </a>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection