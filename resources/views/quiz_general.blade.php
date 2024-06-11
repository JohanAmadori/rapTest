<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/lib.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quiz_general.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Quiz General</title>
</head>
<body>
<div class="container">
    <input type="radio" name="slider" id="item-1" checked>
    <input type="radio" name="slider" id="item-2">
    <input type="radio" name="slider" id="item-3">
    <div class="cards">
        <label class="card" for="item-1" id="song-1">
            <img src="pictures/easy.webp" alt="easy">
        </label>
        <label class="card" for="item-2" id="song-2">
            <img src="pictures/moyen.webp" alt="medium">
        </label>
        <label class="card" for="item-3" id="song-3">
            <img src="pictures/hard.webp" alt="hard">
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
                        <a href="#" class="subtitle" data-difficulty="easy">MODE FACILE</a>
                    </div>
                </label>
                <label class="song-info" id="moyen">
                    <div class="title">Accès au Quiz</div>
                    <div class="sub-line">
                        <a href="#" class="subtitle" data-difficulty="medium">MODE INTERMEDIAIRE</a>
                    </div>
                </label>
                <label class="song-info" id="hard">
                    <div class="title">Accès au Quiz</div>
                    <div class="sub-line">
                        <a href="#" class="subtitle" data-difficulty="hard">MODE DIFFICILE</a>
                    </div>
                </label>
            </div>
        </div>
    </div>

    <div class="quiz">
    @if(isset($questions) && $questions->isNotEmpty())
    @foreach($questions as $quiz)
        <div class="quiz-question" data-question-id="{{ $quiz->id }}" data-difficulty="{{ $quiz->difficulty }}">
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
</div>

<script>
        $(document).ready(function() {
            $('#difficulty').change(function() {
                var difficulty = $(this).val();

                $.ajax({
                    url: '{{ route("quiz.getQuestionsByDifficulty") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        difficulty: difficulty
                    },
                    success: function(response) {
                        var questions = response.questions;
                        var questionsHtml = '';

                        if (questions.length > 0) {
                            questions.forEach(function(question) {
                                questionsHtml += '<div class="quiz-question" data-question-id="' + question.id + '" data-difficulty="' + question.difficulty + '">';
                                questionsHtml += '<p>' + question.question + '</p>';
                                questionsHtml += '<ul class="answers">';
                                questionsHtml += '<li><button class="reponse" data-question-id="' + question.id + '" data-answer-index="1">' + question.reponse1 + '</button></li>';
                                questionsHtml += '<li><button class="reponse" data-question-id="' + question.id + '" data-answer-index="2">' + question.reponse2 + '</button></li>';
                                questionsHtml += '<li><button class="reponse" data-question-id="' + question.id + '" data-answer-index="3">' + question.reponse3 + '</button></li>';
                                questionsHtml += '<li><button class="reponse" data-question-id="' + question.id + '" data-answer-index="4">' + question.reponse4 + '</button></li>';
                                questionsHtml += '</ul>';
                                questionsHtml += '</div>';
                            });
                        } else {
                            questionsHtml = '<p>Aucune question trouvée pour la difficulté sélectionnée.</p>';
                        }

                        $('#questions').html(questionsHtml);
                    },
                    error: function(xhr, status, error) {
                        console.error('Erreur lors de la récupération des questions :', error);
                    }
                });
            });
        });
    </script>

<script>

    $(document).on('click', '.reponse', function() {
        var button = $(this);
        var questionId = button.data('question-id');
        var answerIndex = button.data('answer-index');
        var scoreContainer = $('#scoreContainer');

        button.prop('disabled', true);

        var allButtons = $('button[data-question-id="' + questionId + '"]');
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
                    button.css({'background-color': 'red', 'color': 'white', 'border-color': 'red'});
                }
                allButtons.prop('disabled', true);
            },
            error: function(xhr, status, error) {
                console.error('Erreur lors de la soumission de la réponse');
            }
        });
    });

    $(document).ready(function() {
        fetch('/user/score')
            .then(response => response.json())
            .then(data => {
                if (data.score !== undefined) {
                    document.getElementById('score').textContent = data.score;
                }
            })
            .catch(error => console.error('Erreur lors de la récupération du score:', error));
    });

    $('input').on('change', function() {
        $('body').toggleClass('blue');
    });

    
</script>

</body>
</html>
