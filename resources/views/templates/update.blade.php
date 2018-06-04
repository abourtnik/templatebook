@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Changer votre template</div>

                    <div class="panel-body">

                        <form class="form-horizontal" method="POST" action="{{ route('template-update' , ['id' =>$template->id]) }}" enctype="multipart/form-data">

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
                                    <textarea class="form-control" name="description" id="" cols="30" rows="10">{{ old('description') ? old('price') : $template->description }}</textarea>
                                    <span class="help-block">
                                        <strong> {{ $errors->has('description') ? $errors->first('description') : '2000 caracteres max' }}</strong>
                                    </span>
                                </div>
                            </div>

                            <!-- Prix-->
                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Prix template</label>

                                <div class="col-md-8">

                                    <div class="input-group">
                                        <input id="price" type="number" class="form-control" name="price" value="{{ old('price') ? old('price') : $template->price }}"  step="0.01">
                                        <div class="input-group-addon">&euro;</div>
                                    </div>

                                    <span class="help-block">
                                        <strong> {{ $errors->has('price') ? $errors->first('price') : 'Le prix de votre template en euros' }}</strong>
                                    </span>
                                </div>
                            </div>

                            <!-- Source-->
                            <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                <label for="file" class="col-md-4 control-label">  Sources </label>

                                <div class="col-md-8">
                                    <input id="file" type="file" class="form-control" name="file" value="{{ old('file') ? old('file') : $template->file }}"  required accept=".zip,.rar">

                                    <span class="help-block">
                                        <strong> {{ $errors->has('file') ? $errors->first('file') : 'Un fichier ZIP ou RAR , taille maximale 5 Mo' }}</strong>
                                    </span>
                                </div>
                            </div>



                        @for($i = 1 ; $i <= 3 ; $i ++)

                            <!-- Media {{$i}}-->

                                <div class="form-group">
                                    <label for="media {{$i}}" class="col-md-4 control-label">Media {{$i}}</label>

                                    <div class="col-md-8">

                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ (isset($template->medias[$i-1]) ? $template->medias[$i-1]->type : "Image") }}
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" data-input="image-file" data-id="{{$i}}">Image</a></li>
                                                    <li><a href="#" data-input="image-url" data-id="{{$i}}">Lien image</a></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li><a href="#" data-input="video-file" data-id="{{$i}}">Video</a></li>
                                                    <li><a href="#" data-input="video-url" data-id="{{$i}}">Lien YouTube</a></li>
                                                </ul>
                                            </div>
                                            <div class="input-group">
                                                <input placeholder="" id="media{{$i}}" type="{{ ( isset($template->medias[$i-1]) && ($template->medias[$i-1]->type === 'image_url' || $template->medias[$i-1]->type === 'video_url' ))  ? 'text' : 'file' }}" class="form-control" name="media{{$i}}" value="{{ old('media'.$i) ? old('media'.$i) : (isset($template->medias[$i-1]) ? $template->medias[$i-1]->file : '') }}">
                                                <div class="input-group-btn hidden" id="info-link-video">
                                                    <button target='_blank' href="https://support.google.com/youtube/answer/171780" class="btn btn-warning" type="button"><i class="fa fa-info"></i></button>
                                                </div>
                                            </div>
                                            <input id="type{{$i}}" type="hidden" name="type{{$i}}" value="">
                                        </div>
                                    </div>
                                </div>

                            @endfor


                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label">Categorie</label>

                                <div class="col-md-8">

                                    <select class="form-control" name="category" id="category">
                                        <option value="">Aucune categorie</option>
                                        @foreach($categories as $categorie)
                                            <option {{ ( (!is_null($template->category) && $template->category->id === $categorie->id || old('category') )) ? 'selected' : '' }} value="{{ $categorie->id }}">{{ $categorie->name }}</option>
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
@endsection