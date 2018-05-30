@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $template->name }}</div>

                    <div class="panel-body">

                        <p>Cree le {{ $template->created_at }}</p>

                        <p>Modifié le {{ $template->updated_at }}</p>

                        <p>Auteur : <a href={{route('user-show' , ['id' => $template->user->id])}}>{{ $template->user->name }}</a> </p>

                        <a href="{{asset('storage/template/'.$template->file)}}">Telecharger</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection