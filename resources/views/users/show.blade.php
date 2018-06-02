@extends('layouts.app')

@section('title', 'profil de ' . $user->name )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $user->name }}</div>

                    <div class="panel-body">
                        <p>Membre depuis le {{ $user->created_at }}</p>

                        <h2>Ses templates</h2>

                            @forelse ($user->templates as $template)
                                @include('elements.template', ['template' => $template , 'author' => false , 'options' => false])
                            @empty
                                <p>Pas de template encore disponible</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection