@include('layouts.navigation')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/lib.css')}}">


    <title>Document</title>
</head>
<body>

<div id="scoreContainer">
  Score: <span id="score"> {{ session('score', 0) }}</span>
</div>


<div class="quiz">
    @foreach($quizs as $quiz)
        @if(is_null($quiz->rappeur_id))
            <div class="quiz-question" data-question-id="{{ $quiz->id }}">
                <p>{{ $quiz->question }}</p>
                <ul class="answers">
            <li action="{{ route('quiz.enregistrerReponse', $quiz->id) }}" method="POST">@csrf<button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="1">{{ $quiz->reponse1 }}</button></li>
            <li action="{{ route('quiz.enregistrerReponse', $quiz->id) }}" method="POST">@csrf<button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="2">{{ $quiz->reponse2 }}</button></li>
            <li action="{{ route('quiz.enregistrerReponse', $quiz->id) }}" method="POST">@csrf<button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="3">{{ $quiz->reponse3 }}</button></li>
            <li action="{{ route('quiz.enregistrerReponse', $quiz->id) }}" method="POST">@csrf<button class="reponse" data-question-id="{{ $quiz->id }}" data-answer-index="4">{{ $quiz->reponse4 }}</button></li>
                </ul>
            </div>
        @endif
    @endforeach
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




</body>
</html>