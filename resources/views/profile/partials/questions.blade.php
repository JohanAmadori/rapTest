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