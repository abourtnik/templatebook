@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row">

        @if (session('template-message'))
            <div class="alert alert-success">
                {{ session('template-message') }}
            </div>
        @endif

        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading text-center">Mes templates</div>

                <div class="panel-body">

                    @forelse ($templates as $template)
                        @include('elements.template', ['template' => $template , 'author' => false , 'options' => true])
                    @empty
                        <p>Vous n'avez aucun template</p>
                    @endforelse

                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading text-center">Votre compte</div>

                <div class="panel-body text-center">

                    <div class="image-upload">
                        <div>
                            <span class="title">Modifier votre photo de profil </span>
                            <span class="bg"></span>
                            <img class="img-responsive" src="{{asset('storage/avatars/'.Auth::user()->avatar)}}" alt="avatar user {{ Auth::user()->name }} ">
                            <span class="input-file-container">
                                <form id="form-avatar" method="POST" action="{{ route('user-avatar') }}" enctype="multipart/form-data">
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
                        <p> Nombre de templates upoades : {{ $templates->count() }}  </p>
                    </div>

                    <a class="btn btn-default" href="{{route('user-show' , ['id' => Auth::user()->id])}}">Voir mon profil</a>

                    <a class="btn btn-success" href="{{ route('template-add') }}"> <i class="fa fa-plus"></i> Ajouter un template</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading text-center">Vos commandes</div>

                <div class="panel-body">
                    @forelse ($orders as $order)

                        <div class="well">

                            <p>Commande n° {{ $order->id }} </p>
                            <p>Effectué le : {{ formatDatabaseDate($order->date , true) }} </p>
                            <p>Coût total : {{ $order->ammount }} &euro; </p>
                            <p> Identifiant Paypal : {{ $order->paypal_id }}  </p>

                            <a target="_blank" href="{{route('facture-show' , ['id' => $order->id] )}}">Voir la facture</a>

                            <a href="{{route('order-show' , ['id' => $order->id])}}">Voir le detail</a>

                        </div>

                    @empty
                        <p class="text-center">Vous n'avez effectué aucune commande</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading text-center">Mes commentaires</div>

                <div class="panel-body">
                    @forelse ($comments as $comment)

                        <div class="well">

                            <p>Template : <a href="{{route('template-show' , ['id' => $comment->template->id])}}"><strong> {{ $comment->template->name }}</strong></a> </p>
                            <p>Date : {{ formatDatabaseDate($comment->created_at , true) }} </p>
                            <p>Commentaire: {{ $comment->content }} </p>

                            <a class="text-danger" href="{{ route('comments-remove' , ['id' => $comment->id , 'crsf_token' => csrf_token()]) }}">Supprimer</a>

                        </div>

                    @empty
                        <p class="text-center">Vous n'avez écrit aucune commeantaire pour l'instant</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    @if ($templates->count() > 0)
        @include('templates.remove')
    @endif

    @if(session('buy_order'))
        @include('elements.download' , ['order' => session('buy_order') ])
    @endif


</div>

@endsection