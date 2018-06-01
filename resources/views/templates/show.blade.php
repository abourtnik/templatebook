@extends('layouts.app')

@section('title', $template->name )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $template->name }}</div>

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

                        <p>Cree le {{ $template->created_at }}</p>

                        <p>Modifié le {{ $template->updated_at }}</p>

                        <p>Auteur : <a href={{route('user-show' , ['id' => $template->user->id])}}>{{ $template->user->name }}</a> </p>

                        @if($template->price == 0)
                            <a href="{{asset('storage/template/'.$template->file)}}">Télécharger</a>
                        @else
                            <a href="#">Acheter</a>
                        @endif

                        <p> Nombre de telechargements : {{ $template->downloads }} </p>

                        <p> Nombre de vues : {{ $template->views }} </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection