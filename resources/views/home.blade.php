@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row">

        @if (session('template-message'))
            <div class="alert alert-success">
                {{ session('template-message') }}
            </div>
        @endif

        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Mes templates</div>

                <div class="panel-body">

                    @forelse ($templates as $template)

                        @include('elements.template', ['template' => $template , 'author' => false , 'options' => true])

                    @empty
                        <p>Vous n'avez aucun template</p>
                    @endforelse

                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Votre compte</div>

                <div class="panel-body">

                    <p> {{ Auth::user()->name }} </p>
                    <p> {{ Auth::user()->email }} </p>
                    <p> Membre depuis le {{ Auth::user()->created_at }} </p>
                    <p> Nombre de templates upoades : {{ $templates->count() }}  </p>

                    <a class="btn btn-default" href="{{ route('template-add') }}">Uploader un template</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Mes templates achetees</div>

                <div class="panel-body">
                    <p>Vous n'avez pas encore de template achetees</p>
                </div>
            </div>
        </div>

    </div>



    @include('templates.remove')

</div>

@endsection