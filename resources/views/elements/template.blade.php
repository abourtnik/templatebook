<div href="{{route('template-show' , ['id' => $template->id])}}" class="col-sm-12" style="margin-bottom: 20px;">

    <div class="row">
        <div class="col-sm-6">

            <div class="owl-carousel owl-theme">

                @forelse ($template->medias as $media)

                    @if($media->type == 'image')
                        <img class="item" class="img-responsive item" src="{{asset('storage/medias/'.$media->file)}}" alt="Image template {{$template->name}}">
                    @elseif($media->type == 'image_url')
                        <img class="item" class="img-responsive item" src="{{$media->file}}" alt="Image template {{$template->name}}" onError="this.onerror=null;this.src='/img/default-image.png';">
                    @elseif($media->type == 'video')
                        <div align="center" class="embed-responsive embed-responsive-16by9">
                            <video controls autoplay loop class="embed-responsive-item">
                                <source src="{{asset('storage/medias/'.$media->file)}}">
                            </video>
                        </div>
                    @elseif($media->type == 'video_url')
                        <div class="embed-responsive embed-responsive-4by3">
                            <iframe src="{{$media->file}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    @endif
                @empty
                    <img class="item img-responsive" src="{{asset('img/default-image.png')}}" alt="Image par default">
                @endforelse
            </div>
        </div>

        <div class="col-sm-4">

            <h3> <a href="{{route('template-show' , ['id' => $template->id])}}">{{ $template->name }}</a> </h3>

            @if($author)
                <span> Realisé par : </span>
                <a href={{route('user-show' , ['id' => $template->user->id])}}>{{ $template->user->name }}</a>
                <br>
            @endif

            <br>
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

            <!-- Si le template est gratuit -> telecharger  OU
           Si ca appartein a l'user connecte -> telecharger OU
           Si ce template a deja ete achete par l'user connecté -> telecharger
           Sinon Ajouter au panier
       -->


            @php
            /*
                $user_buy_template = false;
                    foreach ($template->orders()->getResults() as $order) {
                        if ($order->user_id == Auth::user()->id ) {
                            $user_buy_template = true;
                            break;
                        }
                    }
            */
            @endphp


            @if($template->price == 0 || (Auth::check() && $template->user->id === Auth::user()->id))
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

            @if($options)
            <a href="{{route('template-update' , ['id' => $template->id])}}" class="btn btn-primary btn-xs"> <i class="fa fa-pencil"></i> Modifier </a>
            <button type="button" data-toggle="modal" data-target="#delete-template-modale" class="btn btn-danger btn-xs"> <i class="fa fa-trash"></i> Supprimer </button>
            @endif

        </div>

    </div>

    <hr>

</div>

