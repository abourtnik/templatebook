@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Les templates les plus populaire</div>

                    <div class="panel-body">

                        <div class="row">

                            @forelse ($templates as $template)

                                <div href="{{route('template-show' , ['id' => $template->id])}}" class="col-sm-12">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <img class="img-responsive" src="{{asset('storage/medias/'.$template->medias->first()['file'])}}" alt="">
                                        </div>

                                        <div class="col-sm-4">
                                            <h2>{{ $template->name }}</h2>

                                            <span> Realisé par : </span>
                                            <a href={{route('user-show' , ['id' => $template->user->id])}}>{{ $template->user->name }}</a>
                                            <br>
                                            <a href="{{asset('storage/template/'.$template->file)}}">Telecharger</a>
                                            <p>Prix : {{ $template->price }} </p>
                                        </div>

                                    </div>

                                </div>

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