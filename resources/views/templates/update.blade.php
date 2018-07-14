@extends('layouts.app')

@section('title', 'Modifier le template : ' . $template->name )

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
                    <div class="panel-heading text-center">Modifier votre template <strong> {{$template->name}}</strong></div>

                    <div class="panel-body">

                        <form class="form-horizontal" method="POST" action="{{ route('template-update' , ['id' => $template->id]) }}" enctype="multipart/form-data">

                            <!-- CRSF-->
                            {{ csrf_field() }}

                            <!-- Name-->
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nom du template</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $template->name }}" required autofocus>

                                    <span class="help-block">
                                        <strong> {{ $errors->has('name') ? $errors->first('name') : '255 caracteres max et caracteres alphanumerique' }}</strong>
                                    </span>
                                </div>
                            </div>

                            <!-- Description-->
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-8">
                                    <textarea class="form-control" name="description" id="" cols="30" rows="10" maxlength="1000">{{ old('description') ? old('price') : $template->description }}</textarea>
                                    <span class="help-block">
                                        <strong> {{ $errors->has('description') ? $errors->first('description') : '1000 caracteres max' }}</strong>
                                    </span>
                                </div>
                            </div>

                            <!-- Prix-->
                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Prix template</label>

                                <div class="col-md-8">

                                    <div class="input-group">
                                        <input id="price" type="number" class="form-control" name="price" value="{{ old('price') ? old('price') : $template->price }}"  step="0.01" max="999" min="0">
                                        <div class="input-group-addon">&euro;</div>
                                    </div>

                                    <span class="help-block">
                                        <strong> {{ $errors->has('price') ? $errors->first('price') : 'Le prix de votre template en euros' }}</strong>
                                    </span>
                                </div>
                            </div>

                            <!-- Source-->
                            <div class="form-group{{ $errors->has('source') ? ' has-error' : '' }}">
                                <label for="file" class="col-md-4 control-label">  Sources </label>

                                <div class="col-md-8">
                                    <input id="file" type="file" class="form-control" name="source" accept=".zip,.rar">

                                    <a href="{{route('template-download' , ['id' => $template->id] )}}"> Sources actuelles  </a>
                                    <span class="help-block">
                                        <strong> {{ $errors->has('source') ? $errors->first('source') : 'Un fichier ZIP ou RAR, taille maximale 5 Mo' }}</strong>
                                    </span>
                                </div>
                            </div>

                            <br>

                            <div class="row">

                                <h4 class="text-center"> Modifier vos images ou vos videos YouTube</h4>

                                <hr>

                                @for($i = 1 ; $i <= 3 ; $i ++)

                                    <!-- File {{$i}}-->

                                    <div class="col-md-4">

                                        <div class="image-upload">
                                            <div>
                                                <span class="title">Ajouter une photo </span>
                                                <span class="youtube-link"><a data-toggle="modal" data-target="#youtube-modale" type="button" data-media="{{$i}}" > Video YouTube</a> </span>
                                                <span class="bg"></span>

                                                @if(!isset($template->medias[$i-1]))
                                                    <img id="img-media-{{$i}}" class="img-responsive" src="{{asset('img/default-image.png')}}" alt="Image par default">
                                                @else
                                                    @if($template->medias[$i-1]->type === 'image')
                                                        <img id="img-media-{{$i}}" class="img-responsive" src="{{asset('storage/medias/'.$template->medias[$i-1]->file)}}" alt="Image template {{$template->name}}" onError="this.onerror=null;this.src='/img/default-image.png';">
                                                    @elseif ($template->medias[$i-1]->type === 'youtube')
                                                        <img id="img-media-{{$i}}" class="img-responsive" src="https://img.youtube.com/vi/{{explode('=' , $template->medias[$i-1]->file)[1]}}/0.jpg" alt="Video template {{$template->name}}" >
                                                    @else
                                                        <img id="img-media-{{$i}}" class="img-responsive" src="{{asset('img/default-image.png')}}" alt="Image par default">
                                                    @endif
                                                @endif

                                                <span class="input-file-container">
                                                    <input id="image-file-media-{{$i}}" media-id="{{$i}}" class="image-upload-file" type="file" name="file[{{$i-1}}]" title="Ajouter une image ou une video YouTube" accept="image/*" >
                                                    <input id="youtube-link-media-{{$i}}" media-id="{{$i}}" type="hidden" name="youtube[{{$i-1}}]" value="{{ (isset($template->medias[$i-1]) && $template->medias[$i-1]->type === 'youtube') ? $template->medias[$i-1]->file : '' }}" {{ (isset($template->medias[$i-1]) && $template->medias[$i-1]->type === 'image') ? 'disabled' : ''  }}>
                                                    <input id="type-media-{{$i}}" media-id="{{$i}}" type="hidden" name="type[{{$i-1}}]" value="{{ (isset($template->medias[$i-1])) ? $template->medias[$i-1]->type : '' }}">
                                                </span>
                                            </div>
                                        </div>

                                        <a href="{{ (isset($template->medias[$i-1]) && $template->medias[$i-1]->type === 'youtube') ? $template->medias[$i-1]->file : '' }}" id="text-media-{{$i}}" class="text-danger text-center {{ (isset($template->medias[$i-1]) && $template->medias[$i-1]->type === 'youtube') ? '' : 'hidden' }}"> Video YouTube </a>

                                    </div>

                                @endfor

                                @if ($errors->has('file.*'))
                                    <span class="help-block">
                                        <strong style="color: #a94442;">{{ $errors->first('file.*') }}</strong>
                                    </span>
                                @else
                                    <span class="help-block">
                                        <strong> Une image au format PNG,JPG,JPEG ou GIF, taille maximale 2 Mo </strong>
                                    </span>
                                @endif

                                @if ($errors->has('youtube.*'))
                                    <span class="help-block">
                                        <strong style="color: #a94442;">{{ $errors->first('youtube.*') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <br>
                            <br>

                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label">Categorie</label>

                                <div class="col-md-8">

                                    <select class="form-control" name="category" id="category">
                                        <option value="">Aucune categorie</option>
                                        @foreach($categories as $categorie)
                                            <option {{ ( (!is_null($template->category) && $template->category->id === $categorie->id || old('category') )) ? 'selected' : '' }} value="{{ $categorie->id }}">{{ ucfirst($categorie->name) }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit"> <i class="fa fa-pencil"></i> Modifier votre template</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('templates.youtube-modale')
@endsection