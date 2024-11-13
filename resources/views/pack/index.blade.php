<!-- resources/views/packs/index.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Packs</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Inclure SweetAlert2 pour la confirmation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>

@include('layouts.navigation')

    <h1 class="title animate__animated animate__fadeInDown">Liste des Packs Disponibles</h1>
    <div class="packs-container">
        @foreach($packs as $pack)
            <div class="pack-item animate__animated animate__zoomIn">
                <!-- Image du pack avec onclick pour confirmer l'achat -->
                <img 
                    src="{{ asset('pictures/pack_simple.png') }}" 
                    alt="Image du {{ $pack->name }}" 
                    style="cursor:pointer; width: 200px; height: 200px;"
                    onclick="acheterPack({{ $pack->id }}, '{{ $pack->name }}', {{ $pack->price }})"
                >
                <div class="pack-info">
                    <strong>{{ $pack->name }}</strong> - <span class="pack-price">{{ $pack->price }} crédits</span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Script SweetAlert2 pour confirmer l'achat -->
    <script>
        function acheterPack(packId, packName, packPrice) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: `Voulez-vous acheter le ${packName} pour ${packPrice} crédits ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, acheter',
                cancelButtonText: 'Non, annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.createElement('form');
                    form.action = `/packs/${packId}/open`;
                    form.method = 'POST';

                    let csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);

                    document.body.appendChild(form);
                    form.submit();
                } else {
                    Swal.fire('Achat annulé', '', 'info');
                }
            });
        }
    </script>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <style>
        body {
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
        }

        .title {
            text-align: center;
            margin-top: 20px;
            font-size: 2em;
            color: #333;
        }

        .packs-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        .pack-item {
            border: 2px solid #ccc;
            border-radius: 15px;
            padding: 15px;
            text-align: center;
            width: 220px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .pack-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .pack-item img {
            transition: transform 0.2s;
            width: 100%;
            border-radius: 10px;
        }

        .pack-info {
            margin-top: 10px;
            font-size: 1.1em;
        }

        .pack-price {
            color: #28a745;
            font-weight: bold;
        }

        .pack-item img:hover {
            transform: scale(1.05);
        }
    </style>
</body>
</html>
