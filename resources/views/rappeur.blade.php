<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link rel="stylesheet" href="{{ asset('css/carte.css')}}">
    <link rel="stylesheet" href="{{ asset('css/lib.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $rappeur['nom'] ?? 'Nom du rappeur' }}</title>


<body>

@include('layouts.navigation')

    <div class='photo_zeu'>
        <div style="text-align:center;">
            <a href="{{ asset('pictures/'.$rappeur['picture'])}}" download>
                <img src="{{ asset('pictures/'.$rappeur['picture'])}}" class="carte">
            </a>
        </div>
    </div>

    <br></br>

        <!-- Ajout Musique -->

        <audio id="qp" src="{{ asset('song/'.$rappeur['musique'])}}"></audio>
    <div>
    <a href="javascript:void(0)" onclick="changeState(0, 'Quincy Promes')" class="btn">Play</a>
        <a href="javascript:void(0)" onclick="changeState(1)" class="btn">Pause</a>
        <a href="javascript:void(0)" onclick="changeState(2)" class="btn">Stop</a>
        <a href="{{ asset('song/'.$rappeur['musique'])}}" class="btn" download>Download</a>
    </div>

    <br></br>

    
    <div class="reseaux">
    <a onclick="window.open('{{ $rappeur['spotify'] }}');" style="cursor: pointer; margin-right: 15px;">
        <img src="{{ asset('pictures/spotify.png') }}" alt="Spotify" class="logo-animation" height="50px" width="50px"/>
    </a>
    <a onclick="window.open('{{ $rappeur['insta'] }}');" style="cursor: pointer; margin-right: 15px;">
        <img src="{{ asset('pictures/insta.png') }}" alt="Instagram" class="logo-animation" height="50px" width="50px"/>
    </a>
    <a onclick="window.open('{{ $rappeur['youtube'] }}');" style="cursor: pointer;">
        <img src="{{ asset('pictures/youtube.png') }}" alt="Youtube" class="logo-animation" height="50px" width="70px"/>
    </a>
</div>

<br></br>


<div class="quiz">
    @foreach($rappeur->quizs as $quiz)
    <div class="quiz-question" data-question-id="{{ $quiz->id }}">
        <p>{{ $quiz->question }}</p>
        <ul class="answers">
            <li><button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="1">{{ $quiz->reponse1 }}</button></li>
            <li><button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="2">{{ $quiz->reponse2 }}</button></li>
            <li><button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="3">{{ $quiz->reponse3 }}</button></li>
            <li><button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="4">{{ $quiz->reponse4 }}</button></li>
        </ul>
    </div>
    @endforeach
</div>







<script>

    document.addEventListener('DOMContentLoaded', function() {
  var quizQuestions = document.querySelectorAll('.quiz-question');

  quizQuestions.forEach(function(question) {
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          question.classList.add('show');
          observer.unobserve(question);
        }
      });
    }, { threshold: 0.5 });

    observer.observe(question);
  });
});

</script>


<div id="scoreContainer">
  Score: <span id="score"> {{ session('score', 0) }}</span>
</div>


<!-- Remettre a 0 -->
<form action="{{ route('quiz.resetScore') }}" method="GET">
        @csrf
        <button type="submit" class="finir btn btn-primary">Finir le quizz</button>
</form>

<br></br>


<div class="rappeur-biographie" data-rappeur-id="{{ $rappeur->id }}">
            <h2>Qui est {{ $rappeur->nom }} ?</h2>
            <p>{{ $rappeur->biographie }}</p>
        </div>

        <style>
        .rappeur-biographie {
            background-size: cover;
            background-color: white;
            padding: 20px;
            margin: 10px;
            border: 2px solid #8b4513; /* Dark brown border */
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 600px;
            text-align: center;
            color: #333; /* Dark text color */
            font-size: 1.1em;
            line-height: 1.6;
        }
        h2 {
            text-align: center;
            color: #8b0000;
        }
    </style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('.reponse').click(function() {
        var button = $(this);
        var questionId = button.data('question-id');
        var answerIndex = button.data('answer-index');
        var scoreContainer = $('#scoreContainer');
        var allButtons = $('button[data-question-id="' + questionId + '"]');
        var responseMessage = button.closest('.quiz-question').find('.response-message');

        // Désactiver tous les boutons et les griser
        allButtons.prop('disabled', true).addClass('grise');

        $.ajax({
            url: '{{ route("quiz.verifyAnswer") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                question_id: questionId,
                answer_index: answerIndex
            },
            success: function(response) {
                if (response.error) {
                    // Afficher l'erreur si l'utilisateur a déjà répondu
                    responseMessage.text(response.error).addClass('text-danger');
                } else {
                    if (response.correct) {
                        // Mettre à jour le score 
                        $('#score').text(response.score);
                        scoreContainer.css('transform', 'scale(1.3)');
                        setTimeout(function() {
                            scoreContainer.css('transform', '');
                        }, 1000);
                        button.css({'background-color': 'green', 'color': 'white', 'border-color': 'lime'});
                    } else {
                        scoreContainer.css('background-color', 'red');
                        setTimeout(function() {
                            scoreContainer.css('background-color', '');
                        }, 1000);
                        button.css({'background-color': 'red', 'color': 'white', 'border-color': 'red'});
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Erreur lors de la soumission de la réponse');
            }
        });
    });
});
</script>
 
<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('/user/score')
        .then(response => response.json())
        .then(data => {
            if (data.score !== undefined) {
                document.getElementById('score').textContent = data.score;
            }
        })
        .catch(error => console.error('Erreur lors de la récupération du score:', error));
});
</script>


    <br></br>

       

<script>


document.addEventListener('scroll', function() {
  var quizContainer = document.getElementById('quiz-container');
  var positionFromTop = quizContainer.getBoundingClientRect().top;

  // Si le conteneur du quiz est à plus de 300 pixels du haut de la fenêtre, ajoutez la classe 'show' pour déclencher l'animation
  if (positionFromTop - window.innerHeight < -300) {
    quizContainer.classList.add('show');
  }
});


</script>




<script>
window.onbeforeunload = function() {
    navigator.sendBeacon('/api/reset-score');
};
</script>

 <!-- JAVASCRIPT -->   

 @if (session('login_error'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: "{{ session('login_error') }}",
                footer: '<a href="{{ route("login") }}" class="swal2-confirm swal2-styled" style="display: inline-block;">Se connecter</a>',
                showConfirmButton: false
            });
        });
    </script>
@endif


 <script>
        function changeState(x, songName){
            let btns = document.querySelectorAll(".btn");
            let audio = document.querySelector("#qp");

            for (let i = 0; i < btns.length; i++){
                btns[i].classList.remove("active");
            }
            btns[x].classList.add("active");

            if (x === 0){
                audio.play();
                updateTabTitle(songName);
            }
            if (x === 1){
                audio.pause();
            }
            if (x === 2){
                audio.pause();
                audio.currentTime = 0;
            }
        }

    </script>


@if (session('already_response'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        console.log("SweetAlert script is running");  // Ajoutez ceci pour vérifier le chargement du script
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: "{{ session('already_response') }}",
                showConfirmButton: false
            });
        });
    </script>
@endif


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .rating {
            font-size: 2rem;
            color: gold;
            cursor: pointer;
        }
    </style>

    


    <div class="rating" id="rating">
            <span class="fa fa-star" data-value="1"></span>
            <span class="fa fa-star" data-value="2"></span>
            <span class="fa fa-star" data-value="3"></span>
            <span class="fa fa-star" data-value="4"></span>
            <span class="fa fa-star" data-value="5"></span>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            $('#rating .fa').click(function() {
                var star = $(this);
                var rating = star.data('value');
                var rapperId = '{{ $rappeur->id ?? null }}'; // Assurez-vous que cette variable est définie et accessible
                if (!rapperId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Identifiant du rappeur non trouvé.',
                        showConfirmButton: true
                    });
                    return;
                }
                var allStars = $('#rating .fa');

                // Désactiver toutes les étoiles et les griser
                allStars.prop('disabled', true).addClass('grise');

                $.ajax({
                    url: '{{ route("rate-rapper") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        rapper_id: rapperId,
                        rating: rating
                    },
                    success: function(response) {
                        if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: response.error,
                                footer: '<a href="{{ route("login") }}" class="swal2-confirm swal2-styled" style="display: inline-block;">Se connecter</a>',
                                showConfirmButton: false
                            });
                            allStars.prop('disabled', false).removeClass('grise'); // Réactiver les étoiles si erreur
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Merci',
                                text: response.message,
                                showConfirmButton: true
                            });
                            allStars.prop('disabled', false).removeClass('grise'); // Réactiver les étoiles après succès
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Erreur lors de la soumission de la note');
                        allStars.prop('disabled', false).removeClass('grise'); // Réactiver les étoiles en cas d'erreur
                    }
                });
            });
        });
    </script>

@include('footer')



</body>
</html>
