<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/lib.css')}}">
    <link rel="stylesheet" href="{{ asset('css/quiz_general.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <title>Quiz_general</title>

</head>
<body>


<div class="container">
    <input type="radio" name="slider" id="item-1" checked>
    <input type="radio" name="slider" id="item-2">
    <input type="radio" name="slider" id="item-3">
  <div class="cards">
    <label class="card" for="item-1" id="song-1">
      <img src="pictures/easy.webp" alt="song">
    </label>
    <label class="card" for="item-2" id="song-2">
      <img src="pictures/moyen.webp" alt="song">
    </label>
    <label class="card" for="item-3" id="song-3">
      <img src="pictures/hard.webp" alt="song">
    </label>
  </div>
  <div class="player">
    <div class="upper-part">
      <div class="play-icon">
        <svg width="20" height="20" fill="#2992dc" stroke="#2992dc" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="feather feather-play" viewBox="0 0 24 24">
          <defs/>
          <path d="M5 3l14 9-14 9V3z"/>
        </svg>
      </div>
      <div class="info-area" id="test">
    <label class="song-info" id="facile">
        <div class="title">Accès au Quiz</div>
        <div class="sub-line">
            <a href="{{ route('quiz.getQuestionsByDifficulty') }}" class="subtitle" data-difficulty="facile">MODE FACILE</a>
        </div>
    </label>
    <label class="song-info" id="moyen">
        <div class="title">Accès au Quiz</div>
        <div class="sub-line">
            <a href="{{ route('quiz.getQuestionsByDifficulty') }}" class="subtitle" data-difficulty="moyen">MODE INTERMEDIAIRE</a>
        </div>
    </label>
    <label class="song-info" id="hard">
        <div class="title">Accès au Quiz</div>
        <div class="sub-line">
            <a href="{{ route('quiz.getQuestionsByDifficulty') }}" class="subtitle" data-difficulty="difficile">MODE DIFFICILE</a>
        </div>
    </label>
</div>

  


  <div class="quiz">
  @if(isset($questions) && $questions->isNotEmpty())
    @foreach($questions as $quiz)
        <div class="quiz-question" data-question-id="{{ $quiz->id }}" data-difficulty="{{ $quiz->difficulte }}">
            <p>{{ $quiz->question }}</p>
            <ul class="answers">
                <li><button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="1">{{ $quiz->reponse1 }}</button></li>
                <li><button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="2">{{ $quiz->reponse2 }}</button></li>
                <li><button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="3">{{ $quiz->reponse3 }}</button></li>
                <li><button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="4">{{ $quiz->reponse4 }}</button></li>
            </ul>
        </div>
    @endforeach
@else
    <p>Aucune question trouvée pour la difficulté sélectionnée.</p>
@endif


</div>





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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Attach click event listeners to all links with the class 'subtitle'
    document.querySelectorAll('.subtitle').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent the default link behavior
            var difficulty = this.dataset.difficulty; // Get the difficulty level from the data attribute

            // Make an AJAX call to the server
            $.ajax({
                url: "{{ route('quiz.getQuestionsByDifficulty') }}", // Use Laravel's route helper to generate the URL
                type: 'GET', // HTTP method
                data: { difficulty: difficulty }, // Data sent to the server
                success: function(response) {
                    // On success, update the HTML of the quiz container
                    document.querySelector('.quiz').innerHTML = response;
                },
                error: function(xhr, status, error) {
                    // On error, alert the user
                    alert('Erreur lors de la récupération des questions: ' + error);
                }
            });
        });
    });
});
</script>


<script>

$('input').on('change', function() {
  $('body').toggleClass('blue');
});

</script>








</body>
</html>