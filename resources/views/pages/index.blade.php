@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Les templates les plus populaire</div>

                    <div class="panel-body">

                        @forelse ($templates as $template)
                            <li>
                                <a href="{{route('template-show' , ['id' => $template->id])}}">{{ $template->name }}</a>
                                <span> realisé par </span>
                                <a href={{route('user-show' , ['id' => $template->user->id])}}>{{ $template->user->name }}</a>
                            </li>
                            <a href="{{asset('storage/template/'.$template->file)}}">Telecharger</a>
                            <span>Prix : {{ $template->price }} </span>
                        @empty
                            <p>Pas de template encore disponible</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection