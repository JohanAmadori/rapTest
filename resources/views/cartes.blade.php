<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/carte.css')}}">
    <title>Votre collection</title>
</head>
<body>
    
@include('layouts.navigation')

@if(isset($paniers) && $paniers->isNotEmpty())
    <?php $sortedPaniers = $paniers->sortBy(function ($panier) {
        return $panier->article->prix_public;
    }); ?>
    <div class="cards-container">
        @foreach($sortedPaniers as $panier)
            <div class="card">
                <img src="{{ asset($panier->article->img) }}" height="311px" width="228px">
            </div>
        @endforeach
    </div>
@else
    <p>Vous ne possédez aucune carte.</p>
@endif

</body>
</html>
