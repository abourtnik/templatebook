@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Changer votre template</div>

                    <div class="panel-body">

                        @if (session('template-message'))
                            <div class="alert alert-success">
                                {{ session('template-message') }}
                            </div>
                        @endif


                        <form class="form-horizontal" method="POST" action="{{ route('template-update' , ['id' =>$template->id]) }}" enctype="multipart/form-data">

                            <!-- CRSF-->
                        {{ csrf_field() }}

                        <!-- Name-->
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nom du template</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $template->name }}" required autofocus>

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
                                    <textarea class="form-control" name="description" id="" cols="30" rows="10">{{ old('description') ? old('price') : $template->description }}</textarea>
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
                                        <input id="price" type="number" class="form-control" name="price" value="{{ old('price') ? old('price') : $template->price }}"  autofocus>
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
                                    <input id="file" type="file" class="form-control" name="file" value="{{ old('file') ? old('file') : $template->file }}"  autofocus required accept=".zip">

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <button class="btn btn-default" type="submit">Modifier votre template</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection