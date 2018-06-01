@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
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

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Categorie</div>

                    <div class="panel-body">

                        <p>Liste des categories</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection