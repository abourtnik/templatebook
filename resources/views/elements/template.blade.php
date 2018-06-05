<div href="{{route('template-show' , ['id' => $template->id])}}" class="col-sm-12" style="margin-bottom: 20px;">

    <div class="row">
        <div class="col-sm-6">

            <div class="owl-carousel owl-theme">

                @forelse ($template->medias as $media)

                    @if($media->type == 'image')
                        <img class="item" class="img-responsive item" src="{{asset('storage/medias/'.$media->file)}}" alt="Image template {{$template->name}}" onError="this.onerror=null;this.src='/img/default-image.png';">
                    @elseif($media->type == 'youtube')
                        <div class="embed-responsive embed-responsive-4by3">
                            <iframe src="{{str_replace("watch?v=" ,  "embed/" , $media->file)}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    @else
                        <img class="item" class="img-responsive item" src="{{asset('img/default-image.png')}}" alt="Image par default">
                    @endif
                @empty
                    <img class="item img-responsive" src="{{asset('img/default-image.png')}}" alt="Image par default">
                @endforelse
            </div>
        </div>

        <div class="col-sm-4">

            <h3> <a href="{{route('template-show' , ['id' => $template->id])}}">{{ $template->name }}</a> </h3>

            @if($author)
                <p> Realisé par : <a href={{route('user-show' , ['id' => $template->user->id])}}>{{ $template->user->name }}</a> </p>
            @endif

            <p>Prix :
                @if($template->price == 0)
                    <strong class="text-success"> Gratuit </strong>
                @else
                    <strong> {{ $template->price}} &euro; </strong>
                @endif
            </p>

            <p>Categorie :

                @if($template->category != NULL)
                    <a href="{{route('category-show' , ['id' => $template->category->id])}}">{{ $template->category->name  }}</a>
                @else
                    <span>aucune categorie</span>
                @endif

            </p>

            <p> Nombre de telechargements : {{ $template->downloads }} </p>

            <p> Nombre de vues : {{ $template->views }} </p>

            @if($template->price == 0 || (Auth::check() && $template->user->id === Auth::user()->id) || userBuyTemplate($template))
                <a class="btn btn-primary"  href="{{route('template-download' , ['id' => $template->id] )}}">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    Télécharger
                </a>
            @else
                <button type="button" template_id="{{ $template->id }}" class="btn btn-success add-basket">
                    Ajouter au panier
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </button>
            @endif

            <br>
            <br>

            <button type="button" template_id="{{ $template->id }}" status="1" class="btn btn-success btn-vote">
                <i {{ ( userVoteUpTemplate($template)) ? "style=color:blue" : ''}} class="fa fa-thumbs-up" aria-hidden="true"></i>
                <span>{{ $template->votes->filter(function ($votes) {return $votes->status == 1;})->count() }}</span>
            </button>

            <button type="button" template_id="{{ $template->id }}"  status="0" class="btn btn-danger btn-vote">
                <i {{ ( userVoteDownTemplate($template , 0)) ? "style=color:blue" : ''}} class="fa fa-thumbs-down" aria-hidden="true"></i>
                <span>{{ $template->votes->filter(function ($votes) {return $votes->status == 0;})->count() }}</span>
            </button>

            <br>
            <br>

            <button class="btn bg-info btn-sm" type="button" data-toggle="modal" data-target="#comments-template-modale"> <i class="fa fa-comments"></i> Voir les commentaires </button>

            <br><br>
            <button class="btn bg-info btn-sm" type="button"> <i class="fa fa-pencil"></i> Ecrire un commentaire </button>


            @if($options)
                <br><br>
                <a href="{{route('template-update' , ['id' => $template->id])}}" class="btn btn-primary btn-xs"> <i class="fa fa-pencil"></i> Modifier </a>
                <button type="button" data-toggle="modal" data-target="#delete-template-modale" class="btn btn-danger btn-xs"> <i class="fa fa-trash"></i> Supprimer </button>
            @endif

        </div>

    </div>

    <hr>

</div>

@include('templates.comments')

