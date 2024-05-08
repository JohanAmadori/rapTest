<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link rel="stylesheet" href="{{ asset('css/carte.css')}}">
    <link rel="stylesheet" href="{{ asset('css/lib.css')}}">
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
    <div class="quiz-question" data-question-id="{{ $quiz->id }}"div id="quiz-container">
        <p>{{ $quiz->question }}</p>
        <ul class="answers">
            <li action="{{ route('quiz.enregistrerReponse', $quiz->id) }}" method="POST">@csrf<button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="1">{{ $quiz->reponse1 }}</button></li>
            <li action="{{ route('quiz.enregistrerReponse', $quiz->id) }}" method="POST">@csrf<button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="2">{{ $quiz->reponse2 }}</button></li>
            <li action="{{ route('quiz.enregistrerReponse', $quiz->id) }}" method="POST">@csrf<button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="3">{{ $quiz->reponse3 }}</button></li>
            <li action="{{ route('quiz.enregistrerReponse', $quiz->id) }}" method="POST">@csrf<button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="4">{{ $quiz->reponse4 }}</button></li>
        </ul>
    </div>
</div>    
</div>

@endforeach


<script>

    document.addEventListener('DOMContentLoaded', function() {
  // Sélectionnez tous les conteneurs de questions du quiz
  var quizQuestions = document.querySelectorAll('.quiz-question');

  // Créez une instance de l'Intersection Observer pour chaque question
  quizQuestions.forEach(function(question) {
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        // Si la question devient visible à l'écran
        if (entry.isIntersecting) {
          // Ajoutez la classe 'show' pour déclencher l'animation
          question.classList.add('show');
          // Arrêtez d'observer cette question une fois qu'elle est visible
          observer.unobserve(question);
        }
      });
    }, { threshold: 0.5 }); // Définissez le seuil à 0.5 (50% de visibilité)

    // Observez chaque question du quiz
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

        button.prop('disabled', true);

        var allButtons = $('button[data-question-id="' + questionId + '"]');

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
                if (response.correct) {
                    // Mettre à jour le score 
                    $('#score').text(response.score);
                    scoreContainer.css('transform', 'scale(1.3)');
                    setTimeout(function() {
                        scoreContainer.css('transform', '');
                    }, 1000);
                    button.css({'background-color': 'green', 'color': 'white'});
                    
                } else {
                    scoreContainer.css('background-color', 'red');
                    setTimeout(function() {
                        scoreContainer.css('background-color', '');
                    }, 1000);
                    button.css({'background-color': 'red', 'color': 'white','border-color':'red'});
                }

                // Désactiver les boutons 
                $('button[data-question-id="' + questionId + '"]').prop('disabled', true);
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


    <div class="footer">
    <a href="/legal" class="mentions-legales">Mentions légales</a>
    </div>



</body>
</html>
