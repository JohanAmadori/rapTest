<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <title>Boutique</title>

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="{{ asset('css/boutique.css')}}" rel="stylesheet" />
    </head>
    <body>

        <div style=" background: #ff4b1f,background= -webkit-linear-gradient(to right, #1fddff, #ff4b1f),background= linear-gradient(to right, #1fddff, #ff4b1f)" >  



        <!-- Navigation-->
        @include('layouts.navigation')

        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">BOUTIQUE</h1>
                    <p class="lead fw-normal text-white-50 mb-0">ACHETEZ VOS CARTES</p>
                </div>
            </div>
        </header>

         <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            @if (isset($articles) && !$articles->isEmpty())
    @foreach ($articles as $article)
        <div class="col mb-5">
            <div class="card h-100">
                <img class="card-img-top" src="{{ asset($article->img) }}" alt="Image de l'article" />
                <div class="card-body p-4">
                    <div class="text-center">
                        <h5 class="fw-bolder">{{ $article->nom }}</h5>
                        <p class="fw-bolder">Prix: {{ number_format($article->prix_public, 2) }}</p>
                    </div>
                </div>
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                        <form action="{{ route('boutique.acheter', $article->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Acheter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>Aucune carte disponible pour le moment.</p>
@endif

            </div>
        </div>
    </section>
    </div> 

    @include('footer')

    @if(session('boutique'))
    <div class="alert alert-danger">
        {{ session('boutique') }}
    </div>
@endif


</body>
</html>
