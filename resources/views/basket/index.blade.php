@extends('layouts.app')

@section('title', 'Votre panier')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Votre panier</div>

                    <div class="panel-body">

                        @if (!empty($templates))

                        <div class="table-responsive">

                            <table class="table table-bordered table-striped table-hover table-condensed">

                                <thead>
                                <tr>
                                    <th class="text-center">Template</th>
                                    <th class="text-center">Prix</th>
                                    <th class="text-center">Quantité</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Actions</th>
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
                                        <div class="input-group" style="width: 150px;margin: 0 auto;">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="{{ $template->id }}"><i class="fa fa-minus"></i></button>
                                            </span>
                                            <input template-id="{{ $template->id }}" type="text" name="quantity" class="form-control input-number" value="{{ Session::get('Basket.'.$template->id) }}" disabled="disabled">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="{{ $template->id }}"><i class="fa fa-plus"></i></button>
                                            </span>
                                        </div>

                                    </td>

                                    <td>
                                        <span style="font-weight: bold;font-size: 1.1em">
                                            <span id="basket-subtotal" template-id="{{ $template->id }}"> {{ number_format($template->price * Session::get('Basket.'.$template->id) , 2)   }} </span>
                                            &euro;
                                        </span>
                                     </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm remove-basket" template-id="{{ $template->id }}" title="Supprimmer le produit du panier">
                                            <i class="fa fa-trash-o"></i>
                                            <span class="hidden-xs"> Supprimmer</span>
                                        </button>
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
                                <a class="btn btn-info btn-lg btn-block" href="{{route('order')}}" style="margin-top: 10%;">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    <span> <strong> Procéder au paiement </strong></span>
                                </a>
                            </div>
                        </div>

                        @else

                            <p>Votre panier ne contient actuellement aucun article</p>

                        @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection