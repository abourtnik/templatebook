@extends('layouts.app')

@section('title', 'Profil de ' . $user->name )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <strong>{{ $user->name }}</strong>
                    </div>

                    <div class="panel-body text-center">

                        <img style="margin-left: auto;margin-right: auto;margin-bottom: 45px;" class="img-responsive" width="300" src="{{asset('storage/avatars/'.$user->avatar)}}" alt="avatar user {{ $user->name }} ">

                        <hr>

                        <div class="well">

                            <p class="text-center">Membre depuis le :  {{ formatDatabaseDate($user->created_at) }}</p>
                            <p class="text-center">Nombre de templates uploadés :  {{ $user->templates->count() }}</p>
                            @include('elements.follow-button', ['user' => $user])

                        </div>

                        <h3 style="margin-top: 60px;" class="text-center">Ses templates : </h3>

                        <hr>

                        @forelse ($user->templates as $template)
                            @include('elements.template', ['template' => $template , 'author' => false , 'options' => false])
                        @empty
                            <p class="text-center">{{ $user->name  }} n'a aucun template pour l'instant</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection