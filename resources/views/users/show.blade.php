@extends('layouts.app')

@section('title', 'Profil de ' . $user->name )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">{{ $user->name }}</div>

                    <div class="panel-body">

                        <img class="img-responsive" src="{{asset('storage/avatars/'.Auth::user()->avatar)}}" alt="avatat user {{ Auth::user()->name }} ">

                        <p>Membre depuis le :  {{ formatDatabaseDate($user->created_at) }}</p>

                        <h3 class="text-center">Ses templates : </h3>

                            @forelse ($user->templates as $template)
                                @include('elements.template', ['template' => $template , 'author' => false , 'options' => false])
                            @empty
                                <p>{{ $user->name  }} n'a aucun template pour l'instant</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection