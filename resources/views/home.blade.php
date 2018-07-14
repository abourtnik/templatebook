@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row">

        @if (session('template-message'))
            <div class="alert alert-success text-center">
                <strong>{{ session('template-message') }}</strong>
            </div>
        @endif

        <div class="col-md-7">

            <div class="panel panel-success">
                <div class="panel-heading text-center"> <strong>Mes templates</strong></div>

                <div class="panel-body">

                    @forelse ($templates as $template)
                        @include('elements.template', ['template' => $template , 'author' => false , 'options' => true])
                    @empty
                        <p class="text-center">Vous n'avez ajouté aucun template</p>
                    @endforelse

                </div>
            </div>

            <div class="panel panel-danger">
                <div class="panel-heading text-center"><strong>Mes commandes</strong></div>

                <div class="panel-body text-center">
                    @forelse ($orders as $order)

                        <div class="well">

                            <p> <strong> Commande n° {{ $order->id }} </strong> </p>
                            <p> <strong> Effectué le : </strong> {{ formatDatabaseDate($order->date , true) }} </p>
                            <p> <strong> Coût total : {{ number_format((float)$order->ammount, 2, '.', '') }} &euro; </strong> </p>
                            <p> <strong> Identifiant Paypal : {{ $order->paypal_id }} </strong> </p>

                            <a class="btn btn-success" target="_blank" href="{{route('facture-show' , ['id' => $order->id] )}}">
                                <i class="fa fa-file-pdf-o"></i>
                                Voir la facture
                            </a>

                            <a class="btn btn-primary" href="{{route('order-show' , ['id' => $order->id])}}">
                                <i class="fa fa-info"></i>
                                Voir le detail
                            </a>

                        </div>

                    @empty
                        <p class="text-center">Vous n'avez effectué aucune commande</p>
                    @endforelse
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading text-center"><strong>Mes commentaires</strong></div>

                <div class="panel-body text-center">
                    @forelse ($comments as $comment)

                        <div class="well">

                            <p><strong>Template : </strong> <a href="{{route('template-show' , ['id' => $comment->template->id])}}"><strong> {{ $comment->template->name }}</strong></a> </p>
                            <p><strong> Date : </strong> {{ formatDatabaseDate($comment->created_at , true) }} </p>
                            <p><strong> Commentaire : </strong> {{ $comment->content }} </p>

                            <a class="text-danger" href="{{ route('comments-remove' , ['id' => $comment->id , 'crsf_token' => csrf_token()]) }}"><strong>Supprimer</strong></a>

                        </div>

                    @empty
                        <p class="text-center">Vous n'avez écrit aucun commentaire pour l'instant</p>
                    @endforelse
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading text-center"><strong>Mes réactions</strong></div>

                <div class="panel-body text-center">
                    @forelse ($votes as $vote)

                        <div class="well">

                            <p><strong>Template : </strong> <a href="{{route('template-show' , ['id' => $vote->template->id])}}"><strong> {{ $vote->template->name }}</strong></a> </p>
                            <p><strong>Date : </strong> {{ formatDatabaseDate($vote->created_at , true) }} </p>
                            <p><strong> Vote : </strong>
                                <button disabled type="button" class="btn btn-{{ ($vote->status === 1) ? 'success' : 'danger' }}">
                                    <i class="fa fa-thumbs-{{ ($vote->status === 1) ? 'up' : 'down' }}" aria-hidden="true"></i>
                                </button>
                            </p>
                        </div>

                    @empty
                        <p class="text-center">Vous n'avez aucune réaction pour l'instant</p>
                    @endforelse
                </div>
            </div>

            <div class="panel panel-warning">
                <div class="panel-heading text-center">Mes followers <strong>({{ $followers->count() }})</strong> </div>

                <div class="panel-body">
                    @forelse ($followers as $follower)

                        <div class="row">

                            <div class="col-md-5">
                                <a href="{{route('user-show' , ['id' => $follower->id])}}" title="Voir le profil de {{$follower->name}} ">
                                    <img class="img-responsive" src="{{asset('storage/avatars/'.$follower->avatar)}}" alt="Avatar user {{ $follower->name }}" onError="this.onerror=null;this.src='/img/default-image.png';">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <h3><a href="{{route('user-show' , ['id' => $follower->id])}}">{{ $follower->name }}</a> </h3>
                                <p>
                                    <strong>{{ $follower->followers()->count() }} follower(s)</strong> - <strong>{{ $follower->templates()->count() }} template(s)</strong>
                                </p>
                                @include('elements.follow-button', ['user' => $follower])
                            </div>

                        </div>

                    @empty
                        <p class="text-center">Vous n'avez aucun follower pour l'instant</p>
                    @endforelse
                </div>
            </div>

            <div class="panel panel-warning">
                <div class="panel-heading text-center">Mes abonnements <strong>({{ $followings->count() }})</strong></div>

                <div class="panel-body">
                    @forelse ($followings as $following)

                        <div class="row">

                            <div class="col-md-5">
                                <a href="{{route('user-show' , ['id' => $following->id])}}" title="Voir le profil de {{$following->name}} ">
                                    <img class="img-responsive" src="{{asset('storage/avatars/'.$following->avatar)}}" alt="Avatar user {{ $following->name }}" onError="this.onerror=null;this.src='/img/default-image.png';">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <h3><a href="{{route('user-show' , ['id' => $following->id])}}">{{ $following->name }}</a> </h3>
                                <p>
                                    <strong>{{ $following->followers()->count() }} follower(s)</strong> - <strong>{{ $following->templates()->count() }} template(s)</strong>
                                </p>
                                <button class="btn btn-danger unfollow" user-id="{{ $following->id }}">
                                    <i class="fa fa-user-times" aria-hidden="true"></i>
                                    <span>Ne plus suivre</span>
                                </button>
                            </div>

                        </div>

                    @empty
                        <p class="text-center">Vous n'avez aucun abonnement pour l'instant</p>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="col-md-5">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Mes infos</div>

                <div class="panel-body text-center">

                    <div class="image-upload">
                        <div>
                            <span class="title">Modifier votre photo de profil </span>
                            <span class="bg"></span>
                            <img class="img-responsive" src="{{asset('storage/avatars/'.Auth::user()->avatar)}}" alt="avatar user {{ Auth::user()->name }} ">
                            <p style="padding-top: 10px" class="small">Cliquez sur l'avatar pour le changer</p>
                            <span class="input-file-container">
                                <form style="width: 100%;height: 100%;" id="form-avatar" method="POST" action="{{ route('user-avatar') }}" enctype="multipart/form-data">

                                     <!-- CRSF-->
                                    {{ csrf_field() }}

                                    <input id="avatar-input" class="image-upload-file" type="file" name="avatar" title="Modifier votre photo de profil" accept="image/*">
                                </form>
                            </span>
                        </div>
                    </div>

                    <hr>

                    <div class="well">
                        <p> {{ Auth::user()->name }} </p>
                        <p> {{ Auth::user()->email }} </p>
                        <p> Membre depuis le : {{ formatDatabaseDate(Auth::user()->created_at) }} </p>
                        <p> Nombre de templates upoadés : {{ $templates->count() }}  </p>
                    </div>

                    <a class="btn btn-default" href="{{route('user-show' , ['id' => Auth::user()->id])}}">Voir mon profil</a>

                    <a class="btn btn-success" href="{{ route('template-add') }}"> <i class="fa fa-plus"></i> Ajouter un template</a>
                </div>
            </div>
        </div>
    </div>


    @if ($templates->count() > 0)
        @include('templates.remove')
    @endif

    @if(Session::has('buy_order'))
        @include('elements.download' , ['order' => Session::get('buy_order') ])
    @endif


</div>

@endsection