@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/template.js') }}"></script>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Uploader votre nouveau template</div>

                    <div class="panel-body">

                        <form class="form-horizontal" method="POST" action="{{ route('template-add') }}" enctype="multipart/form-data">

                            <!-- CRSF-->
                        {{ csrf_field() }}

                        <!-- Name-->
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nom du template</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required >

                                    <span class="help-block">
                                        <strong> {{ $errors->has('name') ? $errors->first('name') : '255 caracteres max et caracteres alphanumerique' }}</strong>
                                    </span>
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
                                <label for="price" class="col-md-4 control-label">Prix du template</label>

                                <div class="col-md-6">

                                    <div class="input-group">
                                        <input id="price" type="number" class="form-control" name="price" value="{{ old('price') ? old('price') : 0.0 }}" step="0.01" required >
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
                                <label for="file" class="col-md-4 control-label">Sources</label>

                                <div class="col-md-6">
                                    <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}"  required accept=".zip">
                                    <span class="help-block">
                                        <strong> {{ $errors->has('file') ? $errors->first('file') : 'Un fichier ZIP ou TAR , taille maximale 5 Mo' }}</strong>
                                    </span>
                                </div>
                            </div>



                            @for($i = 1 ; $i <= 3 ; $i ++)

                                <div class="form-group">
                                    <label for="media {{$i}}" class="col-md-4 control-label">Media {{$i}}</label>

                                    <div class="col-md-6">

                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Image <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" data-input="image-file" data-id="{{$i}}">Image</a></li>
                                                    <li><a href="#" data-input="image-url" data-id="{{$i}}">Lien image</a></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li><a href="#" data-input="video-file" data-id="{{$i}}">Video</a></li>
                                                    <li><a href="#" data-input="video-url" data-id="{{$i}}">Lien YouTube</a></li>
                                                </ul>
                                            </div>
                                            <div class="input-group">
                                                <input placeholder="" id="media{{$i}}" type="file" class="form-control" name="media{{$i}}">
                                                <div class="input-group-btn" id="info-link-video">
                                                    <button target='_blank' href="https://support.google.com/youtube/answer/171780" class="btn btn-warning"><i class="fa fa-info"></i></button>
                                                </div>
                                            </div>
                                            <input id="type{{$i}}" type="hidden" name="type{{$i}}" value="">
                                        </div>
                                    </div>
                                </div>

                            @endfor

                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label">Categorie</label>

                                <div class="col-md-6">

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

                            <button class="btn btn-success" type="submit">Ajouter votre template</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection