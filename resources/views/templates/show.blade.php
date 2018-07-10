@extends('layouts.app')

@section('title', $template->name )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>{{ $template->name }}</strong></div>

                    <div class="panel-body">

                        <div class="owl-carousel owl-theme">

                            @forelse ($template->medias as $media)

                                @if($media->type == 'image')
                                    <img class="item" class="img-responsive item" src="{{asset('storage/medias/'.$media->file)}}" alt="Image template {{$template->name}}" onError="this.onerror=null;this.src='img/default-image.png';">
                                @elseif($media->type == 'youtube')
                                    <div class="embed-responsive embed-responsive-4by3">
                                        <iframe src="{{str_replace("watch?v=" ,  "embed/" , $media->file)}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    </div>
                                @else
                                    <img class="item img-responsive" src="{{asset('img/default-image.png')}}" alt="Image par default">
                                @endif
                            @empty
                                <img class="item img-responsive" src="{{asset('img/default-image.png')}}" alt="Image par default">
                            @endforelse
                        </div>

                        <hr>

                        <div class="text-center">

                            <div class="well" style="overflow-x: auto">
                                <i> {!! nl2br(e($template->description)) !!}</i>
                            </div>

                            <hr>

                            <div class="well">

                                <p>Créé le : {{ formatDatabaseDate($template->created_at) }}</p>

                                <p>Derniére modification le : {{ formatDatabaseDate($template->updated_at) }}</p>

                                <p>Prix :
                                    @if($template->price == 0)
                                        <strong class="text-success"> Gratuit </strong>
                                    @else
                                        <strong> {{ number_format((float)$template->price, 2, '.', '') }} &euro; </strong>
                                    @endif
                                </p>

                                <p>Catégorie :

                                    @if($template->category != NULL)
                                        <a href="{{route('category-show' , ['id' => $template->category->id])}}">{{ $template->category->name  }}</a>
                                    @else
                                        <span>aucune catégorie</span>
                                    @endif

                                </p>

                                <p>Auteur : <a href={{route('user-show' , ['id' => $template->user->id])}}>{{ $template->user->name }}</a> </p>

                                <p> Nombre de téléchargements : {{ $template->downloads }} </p>

                                <p> Nombre de vues : {{ $template->views }} </p>

                            </div>



                            <hr>

                            @if($template->price == 0 || (Auth::check() && $template->user->id === Auth::user()->id) || (Auth::check() && userBuyTemplate($template)) )
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

                            <button type="button" template_id="{{ $template->id }}" status="1" class="btn btn-success btn-vote">
                                <i {{ ( Auth::check() && userVoteUpTemplate($template) ) ? "style=color:blue" : ''}} class="fa fa-thumbs-up" aria-hidden="true"></i>
                                <span>{{ $template->votes->filter(function ($votes) {return $votes->status == 1;})->count() }}</span>
                            </button>

                            <button type="button" template_id="{{ $template->id }}"  status="0" class="btn btn-danger btn-vote">
                                <i {{ ( Auth::check() && userVoteDownTemplate($template , 0) ) ? "style=color:blue" : ''}} class="fa fa-thumbs-down" aria-hidden="true"></i>
                                <span>{{ $template->votes->filter(function ($votes) {return $votes->status == 0;})->count() }}</span>
                            </button>

                            <br>
                            <br>

                            <button class="btn bg-info btn-sm" type="button" data-toggle="modal" data-target="#comments-template-modale-{{$template->id}}"> <i class="fa fa-comments"></i> Voir les commentaires </button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('templates.comments')
@endsection