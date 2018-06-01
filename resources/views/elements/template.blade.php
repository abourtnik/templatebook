<div href="{{route('template-show' , ['id' => $template->id])}}" class="col-sm-12" style="margin-bottom: 20px;">

    <div class="row">
        <div class="col-sm-6">

            <div class="owl-carousel owl-theme">

                @forelse ($template->medias as $medias)
                    <div class="item">
                        <img class="img-responsive" src="{{asset('storage/medias/'.$medias->file)}}" alt="">
                    </div>
                @empty
                    <img class="item img-responsive" src="{{asset('img/default-image.png')}}" alt="">
                @endforelse
            </div>
        </div>

        <div class="col-sm-4">
            <h2>
                <a href="{{route('template-show' , ['id' => $template->id])}}">{{ $template->name }}</a>
            </h2>

            @if($author)
                <span> Realisé par : </span>
                <a href={{route('user-show' , ['id' => $template->user->id])}}>{{ $template->user->name }}</a>
                <br>
            @endif

            @if($template->price == 0)
                <a href="{{asset('storage/template/'.$template->file)}}">Télécharger</a>
            @else
                <button type="button" template_id="{{ $template->id }}" class="btn btn-success btn-xs add-basket">
                    Ajouter au panier
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </button>
            @endif
            <p>Prix : {{ $template->price }} &euro; </p>

            <p> Nombre de telechargements : {{ $template->downloads }} </p>

            <p> Nombre de vues : {{ $template->views }} </p>

            @if($options)
            <a href="{{route('template-update' , ['id' => $template->id])}}" class="btn btn-primary btn-xs"> <i class="fa fa-pencil"></i> Modifier </a>
            <button type="button" data-toggle="modal" data-target="#delete-template-modale" class="btn btn-danger btn-xs"> <i class="fa fa-trash"></i> Supprimer </button>
            @endif

        </div>

    </div>

</div>