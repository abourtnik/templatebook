@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Les templates les plus populaire</div>

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

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Categories</div>

                    <div class="panel-body">
                        <div class="row">
                        @foreach($categories as $categorie)
                            <div class="col-lg-12" style="margin-bottom: 15px;">
                                <img width="100" src="{{asset('img/categories/'.$categorie->image)}}" alt="{{ $categorie->name }} image">
                                <span style="margin-left: 30px;">
                                    <a href="{{route('category-show' , ['id' => $categorie->id])}}">{{ $categorie->name }}</a>
                                </span>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection