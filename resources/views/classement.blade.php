<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/classement.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Classement</title>
</head>
<body>

@include('layouts.navigation')

<br><br>

<h1>USERS RANKING</h1>

<table>
    <thead>
        <tr>
            <th class="triépar {{ $triépar == 'name' ? $ordre : '' }}" data-column="name">
                <a href="{{ route('classement.show', ['triépar' => 'name', 'ordre' => $ordre === 'asc' ? 'desc' : 'asc']) }}">
                    Name
                </a>
            </th>
            <th class="triépar {{ $triépar == 'valeur_collection' ? $ordre : '' }}" data-column="valeur_collection">
                <a href="{{ route('classement.show', ['triépar' => 'valeur_collection', 'ordre' => $ordre === 'asc' ? 'desc' : 'asc']) }}">
                    Valeur Collection
                </a>
            </th>
            <th class="triépar {{ $triépar == 'points' ? $ordre : '' }}" data-column="points">
                <a href="{{ route('classement.show', ['triépar' => 'points', 'ordre' => $ordre === 'asc' ? 'desc' : 'asc']) }}">
                    Points
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->paniers->sum('valeur') }}</td>
                <td>{{ $user->points }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@if (session('success_with_bonus'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Achievement débloqué !',
                html: `{!! session('success_with_bonus') !!}`,
                showConfirmButton: false,
                timer: 3000
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
                timer: 3000
            });
        });
    </script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach((row, index) => {
            setTimeout(() => {
                row.classList.add('show');
            }, index * 100);
        });
    });
</script>

</body>
</html>
