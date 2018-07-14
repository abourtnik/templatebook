@extends('layouts.app')

@section('title', 'A propos de nous' )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">A propos de nous</div>
                    
                    <div class="panel-body text-center">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-reponsive" src="{{asset('img/laravel.png')}}">
                            </div>
                            <div class="col-md-4">
                                <img class="img-reponsive" src="{{asset('img/Templatebook_3.png')}}">
                            </div>  
                            <div class="col-md-4">
                                <img class="img-reponsive" src="{{asset('img/GES_logo.png')}}">
                            </div>      
                        </div>
                        <hr>
                        <p>TemplateBook est une application web qui permet aux designers ainsi qu'aux graphistes de se mettre en avant en uploadant leurs créations : des templates HTML/CSS/Javascript.<p>
 
                        <p>
                            Fondée en 2018 par un groupe de deux étudiants de l’ESGI pour leur projet annuel de fin d'année.</p>
                        <p>
                            TemplateBook a pour but de réunir une communauté de designers/graphistes mais aussi une communtauté plus technique pour nous permettre de faire grandir l'application.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection