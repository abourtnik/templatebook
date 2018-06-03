@extends('layouts.app')

@section('title', $category->name )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">{{ $category->name }}</div>

                    <div class="panel-body">

                            <img class="img-responsive" width="100" src="{{asset('img/categories/'.$category->image)}}" alt="{{ $category->name }} image">

                            <p>{{ $category->description }}</p>

                            <h3 class="text-center"> Les templates de cette categorie :</h3>

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