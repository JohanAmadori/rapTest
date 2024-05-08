<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/accueil.css')}}">    

    <title>Accueil</title>
</head>
<body>


@include('layouts.navigation')
    

    <div class="R">
        <a href="{{ url('rappeur/1') }}">
            <img src="{{ asset('vignettes/houdi.jpg')}}" class="vignettes">
        </a>
    </div>

    <div class="R">    
        <a href="{{ url('rappeur/2') }}">
            <img src="{{ asset('vignettes/i300.jpg')}}" class="vignettes">
        </a>
    </div>

    <div class="R">    
        <a href="{{ url('rappeur/3') }}">
            <img src="{{ asset('vignettes/roro.jpg')}}" class="vignettes">
        </a>
    </div>

    <div class="R">
        <a href="{{ url('rappeur/4')}}">
            <img src="{{ asset('vignettes/lesram.jpg')}}" class="vignettes">
    </div>

    <div class="R">        
        <a href="{{ url('rappeur/5')}}">
            <img src="{{ asset('vignettes/zeu.jpg')}}" class="vignettes">
    </div> 

    <div class="R">
    <a href="{{ url('rappeur/6')}}">
        <img src="{{ asset('vignettes/laylow.jpg')}}" class="vignettes">
    </div>

    <div class="R">
    <a href="{{ url('rappeur/7')}}">
        <img src="{{ asset('vignettes/freeze.webp')}}" class="vignettes">
    </div>

    <div class="R"> 
        <a href="{{ url('rappeur/8')}}">
            <img src="{{ asset('vignettes/tif.jpg')}}" class="vignettes">
        </a>
    </div>

    <br></br>
       
    

</body>


</html>