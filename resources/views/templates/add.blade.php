@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Uploader votre nouveau template</div>

                    <div class="panel-body">

                        @if (session('template-message'))
                            <div class="alert alert-success">
                                {{ session('template-message') }}
                            </div>
                        @endif


                        <form class="form-horizontal" method="POST" action="{{ route('template-add') }}" enctype="multipart/form-data">

                            <!-- CRSF-->
                            {{ csrf_field() }}

                            <!-- Name-->
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nom du template</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required >

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Description-->
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea maxlength="2000" class="form-control" name="description" id="" cols="30" rows="10">{{ old('description') }}</textarea>
                                    <span class="help-block">
                                        <strong> {{ $errors->has('description') ? $errors->first('description') : '2000 caracteres max' }}</strong>
                                    </span>
                                </div>
                            </div>

                            <!-- Prix-->
                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Prix template</label>

                                <div class="col-md-6">

                                    <div class="input-group">
                                        <input id="price" type="number" class="form-control" name="price" value="{{ old('price') ? old('price') : 0.0 }}" required >
                                        <div class="input-group-addon">&euro;</div>
                                    </div>

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- File-->
                            <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                <label for="file" class="col-md-4 control-label">Fichier ZIP</label>

                                <div class="col-md-6">
                                    <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}"  required accept=".zip">
                                    <span class="help-block">
                                        <strong> {{ $errors->has('file') ? $errors->first('file') : 'Un fichier ZIP ou TAR , taille maximale 5 Mo' }}</strong>
                                    </span>
                                </div>
                            </div>

                            @for($i = 1 ; $i <= 3 ; $i ++)

                            <!-- Media {{ $i }}-->
                            <div class="form-group{{ $errors->has('media'.$i) ? ' has-error' : '' }}">
                                <label for="media{{ $i }}" class="col-md-4 control-label">Image {{ $i }}</label>

                                <div class="col-md-6">
                                    <input id="media{{ $i }}" type="file" class="form-control" name="media{{ $i }}" value="{{ old('media'.$i) }}"  accept="image/*">

                                    <span class="help-block">
                                        <strong> {{ $errors->has('media'.$i) ? $errors->first('media'.$i) : 'Une image au format PNG, JPEG , JPG ou GIF , taille maximale 5 Mo' }}</strong>
                                    </span>

                                </div>
                            </div>

                            @endfor


                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label">Category</label>

                                <div class="col-md-6">

                                    <select class="form-control" name="category" id="category">
                                        <option value="null">Aucune categorie</option>
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

                            <button class="btn btn-default" type="submit">Ajouter votre template</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection