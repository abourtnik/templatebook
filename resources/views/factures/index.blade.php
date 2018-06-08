@extends('layouts.facture')

@section('title', $order->id)

@section('content')

    <section>


        <!-- logo -->


        <h1 class="text-center">Facture pour la commande n° {{ $order->id }}</h1>

        <p>Pour la commande passé le : <strong>{{ formatDatabaseDate($order->date) }}</strong>  </p>

        <p> <span style="color: #6697EA;">Identifiant Paypal</span> : <strong>{{ $order->paypal_id }}</strong> </p>

        <hr>

        <div class="row">

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
                        <strong>{{ $payer['firstname'] }} {{ $payer['lastname'] }}</strong><br>
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

            @foreach ($order->templates()->getResults() as $template)

                <tr>
                    <td>
                        <a style="color: #3097D1;text-decoration: none;" href="{{route('template-show' , ['id' => $template->id])}}">{{ $template->name }}</a>
                    </td>
                    <td>
                        <strong style="font-size: 1.1em">
                            {{ number_format($template->price , 2) }} &euro;
                        </strong>
                    </td>
                    <td>
                        <strong>{{ $template->pivot->quantity }}</strong>
                    </td>
                    <td>
                    <span style="font-weight: bold;font-size: 1.1em">
                        <span id="basket-subtotal"> {{ number_format($template->price * $template->pivot->quantity) }} </span>
                        &euro;
                    </span>
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>

        <div class="text-right">
        <span class="total">
            Total : <strong style="font-size: 1.1em"> {{ $total }} &euro; </strong>
        </span>
        </div>

        <p style="margin-top: 50px;" class="text-center">Merci pour votre confiance et à bientôt chez <strong><a href="{{ route('index') }}">{{ route('index') }}</a></strong>.</p>

    </section>

@endsection
