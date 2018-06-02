@extends('layouts.app')

@section('title', $order->id )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Commande numero {{ $order->id }}</div>

                    <div class="panel-body">

                        <p> Date de la commande : {{ $order->created_at }}  </p>

                        <p> Coût total : {{ $order->ammount }} </p>

                        <h2>Liste des templates achetes :</h2>

                        @foreach($order->templates as $template)
                            @include('elements.template', ['template' => $template , 'author' => true , 'options' => false])
                        @endforeach;

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection