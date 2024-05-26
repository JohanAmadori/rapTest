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

<div class="finir-container text-center mt-4">
    <a href="{{ route('quiz.resetScore') }}" class="finir btn btn-primary">FINIR LE QUIZZ</a> 
</div>


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
document.addEventListener('DOMContentLoaded', function() {
    fetch('/path/to/get/score') 
        .then(response => response.json())
        .then(data => {
            document.getElementById('score').textContent = data.score;
        })
        .catch(error => console.error('Erreur lors de la récupération du score:', error));
});

</script>


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



@include('footer')



</body>
</html>
