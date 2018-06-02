@extends('layouts.facture')

@section('title', $order->id)

@section('content')

<section>

    <div class="row">


        <!-- logo -->


        <h1 class="text-center">Facture pour la commande n° {{ $order->id }}</h1>

        <p>Pour la commande passé le {{ $order->created_at }} </p>

        <p> <span style="color: #6697EA;">Identifiant Paypal</span> : {{ $order->paypal_id }} </p>

        <hr>

        <div class="col-xs-6">

            <div class="address address-from">

                <div class="address_label">
                    De
                </div>

                <div class="address_content">
                    <strong>Anton Bourtnik</strong><br>
                    Paris , France <br>
                    contact@antonbourtnik.fr
                </div>
            </div>

        </div>

        <div class="col-xs-6">

            <div class="address address-to">

                <div class="address_label">
                    Pour
                </div>

                <div class="address_content">
                    <strong>{{ $payer['firstname'] }}</strong><br>
                    {{ $payer['address'] }} <br>
                    {{ $payer['zip'] }} {{ $payer['city'] }} <br>
                    {{ $payer['country'] }}
                    {{ $payer['email'] }}
                </div>
            </div>

        </div>

    </div>

    <h2 class="text-center">Liste de produits commandés : </h2>

    <hr>

    <table class="table table-bordered table-striped table-hover table-condensed">

        <thead>
        <tr>
            <th class="text-center">Template</th>
            <th class="text-center">Prix</th>
            <th class="text-center">Quantité</th>
            <th class="text-center">Total</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($order->templates() as $template)

            <tr template-id="{{ $template->id }}">
                <td>
                    <a href="{{route('template-show' , ['id' => $template->id])}}">{{ $template->name }}</a>
                </td>
                <td>
                    <strong style="font-size: 1.1em">
                        {{ number_format($template->price , 2) }} &euro;
                    </strong>
                </td>
                <td>
                    <strong>{{ Session::get('Basket.'.$template->id) }}</strong>
                </td>
                <td>
                    <span style="font-weight: bold;font-size: 1.1em">
                        <span id="basket-subtotal" template-id="{{ $template->id }}"> {{ number_format($template->price * Session::get('Basket.'.$template->id) , 2)   }} </span>
                        &euro;
                    </span>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>

    <div class="row text-right">
        <span class="total">
            Total : <span id="basket-total"> {{ $total }} </span> &euro;
        </span>
    </div>

    <p style="margin-top: 80px;" class="text-center">Merci pour votre confiance et à bientôt chez {{ route('index') }}.</p>

</section>

@endsection