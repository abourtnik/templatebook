@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Les templates les plus populaire</div>

                    <div class="panel-body">

                        <div class="row">

                            @forelse ($templates as $template)
                                @include('elements.template', ['template' => $template , 'author' => true , 'options' => false])
                            @empty
                                <p>Pas de template encore disponible</p>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection