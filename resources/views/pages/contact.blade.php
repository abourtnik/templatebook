@extends('layouts.app')

@section('title', 'Nous contacter' )

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading text-center">Contact</div>
          <form class="form-horizontal" action="" method="post">
          <fieldset>  
            <!-- Name input-->
            <div class="form-group">
              <label class="col-md-2 control-label" for="name">Nom</label>
              <div class="col-md-9">
                <input id="name" name="name" type="text" placeholder="Votre nom" class="form-control">
              </div>
            </div>
    
            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-2 control-label" for="email">E-mail</label>
              <div class="col-md-9">
                <input id="email" name="email" type="text" placeholder="ex : email@live.fr" class="form-control">
              </div>
            </div>
    
            <!-- Message body -->
            <div class="form-group">
              <label class="col-md-2 control-label" for="message">Message</label>
              <div class="col-md-9">
                <textarea class="form-control" id="message" name="message" placeholder="Veuillez ecrire votre message..." rows="5"></textarea>
              </div>
            </div>
    
            <!-- Form actions -->
            <div class="form-group">
              <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-success btn-lg">Envoyer</button>
              </div>
            </div>
          </fieldset>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection