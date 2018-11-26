@extends('layouts.app')

@section('title', 'Nous contacter' )

@section('content')

  @if(session('errors'))
    <div class="container">
      <div class="alert alert-danger alert-dismissable text-center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong>Merci de corriger vos erreurs</strong>
      </div>
    </div>
  @endif


  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading text-center">Contact</div>
          <form class="form-horizontal" action="" method="post">
          <fieldset>

            <!-- CRSF-->
          {{ csrf_field() }}

            <!-- Name input-->
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="col-md-2 control-label" for="name">Nom</label>
              <div class="col-md-9">
                <input id="name" name="name" type="text" placeholder="Votre nom" class="form-control" required="required" value="{{ old('name') }}">
                <span class="help-block">
                  <strong> {{ $errors->has('name') ? $errors->first('name') : '' }}</strong>
                </span>
              </div>
            </div>

            <!-- Subject input-->
            <div class="hidden form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="col-md-2 control-label" for="subject">Sujet</label>
              <div class="col-md-9">
                <input id="subject" name="subject" type="text" placeholder="Votre sujet" class="form-control">
              </div>
            </div>
    
            <!-- Email input-->
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="col-md-2 control-label" for="email">E-mail</label>
              <div class="col-md-9">
                <input id="email" name="email" type="email" placeholder="Votre e-mail" class="form-control" required="required" value="{{ old('email') }}">
                <span class="help-block">
                  <strong> {{ $errors->has('email') ? $errors->first('email') : '' }}</strong>
                </span>
              </div>
            </div>
    
            <!-- Message body -->
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="col-md-2 control-label" for="message">Message</label>
              <div class="col-md-9">
                <textarea class="form-control" id="message" name="message" placeholder="Veuillez ecrire votre message..." rows="5" required="required" maxlength="1000">{{ old('message') }}</textarea>
                <span class="help-block">
                  <strong> {{ $errors->has('message') ? $errors->first('message') : '' }}</strong>
                </span>
              </div>
            </div>
    
            <!-- Form actions -->
            <div class="form-group">
              <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-success btn-lg"> <i class="fa fa-envelope" aria-hidden="true"></i> Envoyer</button>
              </div>
            </div>
          </fieldset>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection