@extends('layouts.app')

@section('title', $order->id )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Commande numero {{ $order->id }}</strong></div>

                    <div class="panel-body text-center">

                        <div class="well">

                            <p> Date de la commande : {{ formatDatabaseDate($order->date , true) }}  </p>

                            <p> Coût total : <strong>{{ $order->ammount }} &euro; </strong></p>

                            <p> Identifiant Paypal : {{ $order->paypal_id }}  </p>

                        </div>

                        <h3>Liste des templates achetes :</h3>

                        <hr>

                        @foreach($order->templates as $template)
                            @include('elements.template', ['template' => $template , 'author' => true , 'options' => false])
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection