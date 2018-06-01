@extends('layouts.app')

@section('title', 'Votre commande')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Votre commande</div>

                    <div class="panel-body">

                        <div class="table-responsive">

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

                                @foreach ($templates as $template)

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

                        </div>

                        <div class="row text-right">

                            <span class="total">
                                Total :
                                <span id="basket-total"> {{ $total }} </span>
                                &euro;
                            </span>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2">
                                <a class="btn btn-info btn-lg btn-block" href="#" style="margin-top: 10%;">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    <span> <strong> Payer </strong></span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection