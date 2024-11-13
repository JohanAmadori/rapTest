<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pack Ouvert</title>

</head>
<body>

@include('layouts.navigation')
    
    <div class="pack-content">
        @if(count($drawnCards) > 0)
            <div class="cards">
                @foreach($drawnCards as $card)
                    <div class="card">
                        <img src="{{ asset($card->img) }}" alt="{{ $card->nom }}" class="card-image" style="width:200px;">
                    </div>
                @endforeach
            </div>
        @else
            <p>Aucune carte obtenue dans ce pack. Réessayez pour plus de chance !</p>
        @endif
    </div>

    <!-- Message de succès après ouverture du pack -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif



    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .title {
            text-align: center;
            margin-top: 20px;
            font-size: 2em;
            color: #333;
        }

        .cards-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 200px;
            opacity: 0; /* Commencez par masquer les cartes */
        }

        .card-image {
            width: 100%;
            border-radius: 10px;
        }
    </style>

    <script>
        // Attendre que le DOM soit complètement chargé
        document.addEventListener('DOMContentLoaded', function () {
            // Sélectionner toutes les cartes et les animer progressivement
            let cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                // Utiliser setTimeout pour créer un effet d'apparition échelonnée
                setTimeout(() => {
                    card.style.opacity = 1; // Rendre la carte visible
                    card.classList.add('animate__animated', 'animate__flipInY'); // Ajouter l'animation
                }, index * 300); // Différer chaque animation de 300ms
            });
        });
    </script>



</body>
</html>
