@extends('layouts.app')

@section('title', 'Votre recherche' )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
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
        </div>
    </div>
@endsection