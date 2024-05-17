<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/classement.css') }}">
    <title>Classement</title>
</head>
<body>

@include('layouts.navigation')

<br></br>

<h1>USERS RANKING</h1>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Valeur Collection</th>
                <th>Points</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr style="opacity: 0; transform: translateX(-100px); transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->paniers->sum('valeur') }}</td>
                    <td>{{ $user->points }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


    <script>
document.addEventListener("DOMContentLoaded", function() {
    const rows = document.querySelectorAll("tr");
    let delay = 0;
    rows.forEach(row => {
        setTimeout(() => {
            row.style.opacity = 1;
            row.style.transform = "translateX(0)";
        }, delay);
        delay += 100;
    });
});
</script>

</body>
</html>
