@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $user->name }}</div>

                    <div class="panel-body">
                        <p>Membre depuis le {{ $user->created_at }}</p>


                        <h2>Ses templates</h2>

                        <ul>

                            @forelse ($user->templates as $template)
                                <li> <a href="{{route('template-show' , ['id' => $template->id])}}">{{ $template->name }}</a></li>
                                <a href="{{asset('storage/template/'.$template->file)}}">Telecharger</a>
                                <span>Prix : {{ $template->price }} </span>
                            @empty
                                <p>Aucun template</p>
                            @endforelse

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection