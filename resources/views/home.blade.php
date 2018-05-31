@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Mes templates</div>

                <div class="panel-body">

                    <ul>
                        @forelse ($templates as $template)
                            <li>{{ $template->name }}</li>
                            <a href="{{asset('storage/template/'.$template->file)}}">Telecharger</a>
                            <p>Prix : {{ $template->price }} </p>
                            <a href="{{route('template-show' , ['id' => $template->id])}}">Voir</a>
                            <a href="{{route('template-update' , ['id' => $template->id])}}">Modifier</a>
                            <a href="{{route('template-remove' , ['id' => $template->id])}}">Supprimmer</a>
                        @empty
                            <p>Vous n'avez pas encore de template</p>
                        @endforelse
                    </ul>

                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Votre compte</div>

                <div class="panel-body">

                    <a class="btn btn-default" href="{{ route('template-add') }}">Uploader un template</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">Mes templates achetees</div>

            <div class="panel-body">
                <p>Vous n'avez pas encore de template achetees</p>
            </div>
        </div>
    </div>
</div>
</div>
@endsection