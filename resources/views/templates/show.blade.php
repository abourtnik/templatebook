@extends('layouts.app')

@section('title', $template->name )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">{{ $template->name }}</div>

                    <div class="panel-body">

                        <div class="owl-carousel owl-theme">

                            @forelse ($template->medias as $medias)
                                <div class="item">
                                    <img class="img-responsive" src="{{asset('storage/medias/'.$medias->file)}}" alt="">
                                </div>
                            @empty
                                <img class="item img-responsive" src="{{asset('img/default-image.png')}}" alt="">
                            @endforelse
                        </div>

                        <p>Cree le : {{ formatDatabaseDate($template->created_at) }}</p>

                        <p>Derniére modification le : {{ formatDatabaseDate($template->updated_at) }}</p>

                        <p>Auteur : <a href={{route('user-show' , ['id' => $template->user->id])}}>{{ $template->user->name }}</a> </p>

                        <p> Nombre de telechargements : {{ $template->downloads }} </p>

                        <p> Nombre de vues : {{ $template->views }} </p>

                        @if($template->price == 0 || $template->user->id === Auth::user()->id )
                            <a class="btn btn-primary"  href="{{route('template-download' , ['id' => $template->id] )}}">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                Télécharger
                            </a>
                        @else
                            <button type="button" template_id="{{ $template->id }}" class="btn btn-success add-basket">
                                Ajouter au panier
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                            </button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection