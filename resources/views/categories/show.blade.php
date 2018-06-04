@extends('layouts.app')

@section('title', $category->name )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"> Categorie <strong>{{ $category->name }}</strong></div>

                    <div class="panel-body text-center">

                            <img style="margin-left: auto;margin-right: auto;margin-bottom: 45px;" class="img-responsive" width="300" src="{{asset('img/categories/'.$category->image)}}" alt="{{ $category->name }} image">

                            <i class="text-center">{{ $category->description }}</i>

                            <h3 style="margin-top: 60px;" class="text-center"> Les templates de cette categorie :</h3>

                            <hr>

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