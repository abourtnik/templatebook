@extends('layouts.app')

@section('title', 'Social network for designers')
@section('description', 'Share your creations with other designers')

@section('content')
    <div class="container">
        <div class="row">

            @if (Auth::check())
                <div class="col-md-8">
                    <div class="panel panel-success">
                        <div class="panel-heading text-center"><strong>Bonjour {{ Auth::user()->name }} !</strong></div>

                        <div class="panel-body text-center">

                            <h4>Partagez quelque chose aujourd'hui ... </h4>
                            <hr>
                           <a href="{{route('template-add')}}" class="btn btn-success"> <i class="fa fa-plus"></i> Ajouter un template</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">Modifez votre profil et vos créations</div>

                        <div class="panel-body text-center">

                            <a href="{{route('home')}}" class="btn btn-primary"> <i class="fa fa-user"></i> Accéder a votre compte</a>
                        </div>
                    </div>
                </div>
            @endif


            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"> <strong> {{ Auth::check() ? 'Mon mur' : 'Les templates les plus populaires' }} </strong> </div>

                    <div class="panel-body">

                        <div class="row">

                            @forelse ($templates as $template)
                                @include('elements.template', ['template' => $template , 'author' => true , 'options' => false])
                            @empty
                                <p class="text-center">Pas de template encore disponible</p>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>

            @if (!Auth::check())
            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading text-center"> <strong>Nouveau sur {{ config('app.name', 'Laravel') }} ? </strong> </div>

                    <div class="panel-body text-center">
                        Inscrivez-vous maintenant pour obtenir votre fil d'actualités personnalisé !

                        <br><br>
                        <a href="{{ route('register') }}" class="btn btn-success btn-block"> <i class="fa fa-pencil"></i> S'inscrire </a>
                    </div>
                </div>
            </div>

            @else
            <div class="col-md-4">
                <div class="panel panel-warning">
                    <div class="panel-heading text-center"> <strong> Suggestions </strong> </div>

                    <div class="panel-body">

                        @forelse($users as $user)

                        <div class="row">

                            <div class="col-md-5">
                                <div class="thumbnail">
                                    <a href="{{route('user-show' , ['id' => $user->id])}}" title="Voir le profil de {{$user->name}} ">
                                        <img class="img-responsive" src="{{asset('storage/avatars/'.$user->avatar)}}" alt="Avatar user {{ $user->name }}" onError="this.onerror=null;this.src='/img/default-image.png';">
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <h3><a href="{{route('user-show' , ['id' => $user->id])}}">{{ $user->name }}</a> </h3>
                                <p class="small">
                                    <strong>{{ $user->followers()->count() }} follower(s)</strong> - <strong>{{ $user->templates()->count() }} template(s)</strong>
                                </p>
                                <button class="btn btn-warning follow" user-id="{{ $user->id }}">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                    <span>Suivre</span>
                                </button>
                            </div>

                        </div>

                        @empty
                            <p class="text-center">Aucune suggestion</p>
                        @endforelse

                </div>
            </div>
            @endif

        </div>
    </div>
@endsection