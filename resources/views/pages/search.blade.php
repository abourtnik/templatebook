@extends('layouts.app')

@section('title', 'Votre recherche' )

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"> Les templates correspondant a votre recherche : <strong> {{$q}} </strong> </div>

                    <div class="panel-body">

                        @forelse ($templates as $template)
                            @include('elements.template', ['template' => $template , 'author' => true , 'options' => false])
                        @empty
                            <p class="text-center">Aucun template trouvé</p>
                        @endforelse

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"> Les utilisateurs correspondant a votre recherche : <strong> {{$q}} </strong> </div>

                    <div class="panel-body">

                        @forelse($users as $user)

                            <div class="row">

                                <div class="col-md-5">
                                    <div class="thumbnail">
                                        <a href="{{route('user-show' , ['id' => $user->id])}}" title="Voir le profil de {{$user->name}} ">
                                            <img class="img-responsive" src="{{asset('storage/avatars/'.$user->avatar)}}" alt="Avatar user {{ $user->name }}" onError="this.onerror=null;this.src='/img/default-image.png';">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <h3><a href="{{route('user-show' , ['id' => $user->id])}}">{{ $user->name }}</a> </h3>
                                    <p class="small">
                                        <strong>{{ $user->followers()->count() }} follower(s)</strong> - <strong>{{ $user->templates()->count() }} template(s)</strong>
                                    </p>

                                    @include('elements.follow-button', ['user' => $user])

                                </div>

                            </div>

                        @empty
                            <p class="text-center">Aucun utilisateur trouvé</p>
                        @endforelse



                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection