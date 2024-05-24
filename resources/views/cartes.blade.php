<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/carte.css') }}">
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

    <div id="compteur">Taille collection : {{ $paniers->count() }} / {{ $articles->count() }}</div>
@else
    <p>Vous ne possédez aucune carte.</p>
@endif

@if (session('success_with_bonus'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Achievement débloqué !',
                html: `{!! session('success_with_bonus') !!}`,
                showConfirmButton: false,
                timer: 6000
            });
        });
    </script>
@endif

@if (session('success_no_bonus'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: "{{ session('success_no_bonus') }}",
                showConfirmButton: false,
                timer: 4000
            });
        });
    </script>
@endif



</body>
</html>