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
                                    <textarea class="form-control" name="description" id="" cols="30" rows="10">{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
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

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Media-->
                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="media1" class="col-md-4 control-label">Image</label>

                                <div class="col-md-6">
                                    <input id="media1" type="file" class="form-control" name="media1" value="{{ old('media1') }}"  accept="image/*">

                                    @if ($errors->has('media1'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('media1') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Media-->
                            <div class="form-group{{ $errors->has('media2') ? ' has-error' : '' }}">
                                <label for="media2" class="col-md-4 control-label">Image</label>

                                <div class="col-md-6">
                                    <input id="media2" type="file" class="form-control" name="media2" value="{{ old('media2') }}"  accept="image/*">

                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Media-->
                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="media3" class="col-md-4 control-label">Image</label>

                                <div class="col-md-6">
                                    <input id="media3" type="file" class="form-control" name="media3" value="{{ old('media3') }}"  accept="image/*">

                                    @if ($errors->has('media3'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('media3') }}</strong>
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