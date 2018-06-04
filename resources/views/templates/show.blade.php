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

                            @forelse ($template->medias as $media)

                                @if($media->type == 'image')
                                    <img class="item" class="img-responsive item" src="{{asset('storage/medias/'.$media->file)}}" alt="Image template {{$template->name}}">
                                @elseif($media->type == 'image_url')
                                    <img class="item" class="img-responsive item" src="{{$media->file}}" alt="Image template {{$template->name}}" onError="this.onerror=null;this.src='img/default-image.png';">
                                @elseif($media->type == 'video')
                                    <div align="center" class="embed-responsive embed-responsive-16by9">
                                        <video controls autoplay loop class="embed-responsive-item">
                                            <source src="{{asset('storage/medias/'.$media->file)}}">
                                        </video>
                                    </div>
                                @elseif($media->type == 'video_url')
                                    <div class="embed-responsive embed-responsive-4by3">
                                        <iframe src="{{$media->file}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    </div>
                                @endif
                            @empty
                                <img class="item img-responsive" src="{{asset('img/default-image.png')}}" alt="Image par default">
                            @endforelse
                        </div>

                        <hr>

                        <div class="text-center">

                            <i> {{ $template->description }}</i>

                            <hr>

                            <p>Créé le : {{ formatDatabaseDate($template->created_at) }}</p>

                            <p>Derniére modification le : {{ formatDatabaseDate($template->updated_at) }}</p>

                            <p>Prix :
                                @if($template->price == 0)
                                    <strong class="text-success"> Gratuit </strong>
                                @else
                                    <strong> {{ $template->price}} &euro; </strong>
                                @endif
                            </p>

                            <p>Category :

                                @if($template->category != NULL)
                                    <a href="{{route('category-show' , ['id' => $template->category->id])}}">{{ $template->category->name  }}</a>
                                @else
                                    <span>aucune categorie</span>
                                @endif

                            </p>

                            <p>Auteur : <a href={{route('user-show' , ['id' => $template->user->id])}}>{{ $template->user->name }}</a> </p>

                            <p> Nombre de telechargements : {{ $template->downloads }} </p>

                            <p> Nombre de vues : {{ $template->views }} </p>

                            <hr>

                            @if($template->price == 0 || (Auth::check() && $template->user->id === Auth::user()->id) || userBuyTemplate($template) )
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
    </div>
@endsection