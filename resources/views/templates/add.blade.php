@extends('layouts.app')

@section('title', 'Ajouter un template')

@section('scripts')
    <script src="{{ asset('js/template.js') }}"></script>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Ajouter votre nouveau template</div>

                    <div class="panel-body text-center">

                        <form class="form-horizontal" method="POST" action="{{ route('template-add') }}" enctype="multipart/form-data">

                            <!-- CRSF-->
                            {{ csrf_field() }}

                            <!-- Name-->
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nom du template</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required >

                                    <span class="help-block">
                                        <strong> {{ $errors->has('name') ? $errors->first('name') : '255 caracteres max et caracteres alphanumerique' }}</strong>
                                    </span>
                                </div>
                            </div>

                            <!-- Description-->
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-8">
                                    <textarea maxlength="2000" class="form-control" name="description" id="" cols="30" rows="10">{{ old('description') }}</textarea>
                                    <span class="help-block">
                                        <strong> {{ $errors->has('description') ? $errors->first('description') : '2000 caracteres max' }}</strong>
                                    </span>
                                </div>
                            </div>

                            <!-- Prix-->
                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Prix du template</label>

                                <div class="col-md-8">

                                    <div class="input-group">
                                        <input id="price" type="number" class="form-control" name="price" value="{{ old('price') ? old('price') : 0.0 }}" step="0.01" required >
                                        <div class="input-group-addon">&euro;</div>
                                    </div>

                                    <span class="help-block">
                                        <strong> {{ $errors->has('price') ? $errors->first('price') : 'Le prix de votre template en euros' }}</strong>
                                    </span>
                                </div>
                            </div>

                            <!-- Source-->
                            <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                <label for="file" class="col-md-4 control-label">Sources</label>

                                <div class="col-md-8">
                                    <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}"  required accept=".zip,.rar">
                                    <span class="help-block">
                                        <strong> {{ $errors->has('file') ? $errors->first('file') : 'Un fichier ZIP ou RAR , taille maximale 5 Mo' }}</strong>
                                    </span>
                                </div>
                            </div>


                            <div class="row">

                                <h4> Ajouter vos images ou une video YouTube</h4>

                                <hr>

                                @for($i = 1 ; $i <= 3 ; $i ++)

                                    <!-- Media {{$i}}-->

                                    <div class="col-md-4">

                                        <div class="image-upload">
                                            <div>
                                                <span class="title">Ajouter une photo </span>
                                                <span class="youtube-link"><a data-toggle="modal" data-target="#youtube-modale" type="button" data-media="{{$i}}" > Video YouTube</a> </span>
                                                <span class="bg"></span>
                                                <img id="img-media-{{$i}}" class="img-responsive" src="{{asset('img/default-image.png')}}" alt="Image par default">
                                                <span class="input-file-container">
                                                    <input id="image-file-media-{{$i}}" media-id="{{$i}}" class="image-upload-file" type="file" name="media{{$i}}" title="Ajouter une image ou une video YouTube" accept="image/*">
                                                    <input id="youtube-link-media-{{$i}}" media-id="{{$i}}" type="hidden" name="media{{$i}}">
                                                </span>
                                            </div>
                                        </div>

                                        <p id="text-media-{{$i}}" class="text-danger hidden"> Video YouTube </p>

                                    </div>

                                @endfor

                            </div>

                            <br>
                            <br>

                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label">Categorie</label>

                                <div class="col-md-8">

                                    <select class="form-control" name="category" id="category">
                                        <option value="">Aucune categorie</option>
                                        @foreach($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Ajouter votre template</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('templates.youtube-modale')
@endsection