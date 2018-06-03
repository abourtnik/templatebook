@extends('layouts.app')

@section('title', $category->name )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $category->name }}</div>

                    <div class="panel-body">

                            <img width="100" src="{{asset('img/categories/'.$category->image)}}" alt="{{ $category->name }} image">

                            <h2> Les templates de cette categorie :</h2>

                            <p>{{ $category->description }}</p>

                            @forelse ($category->templates()->getResults() as $template)
                                @include('elements.template', ['template' => $template , 'author' => true , 'options' => false])
                            @empty
                                <p>Pas encore de templates disponible pour cette categorie</p>
                            @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection