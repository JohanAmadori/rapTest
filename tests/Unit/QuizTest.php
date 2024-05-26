<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Quiz;
use App\Models\UserReponse;

class QuizTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_answer_a_question()
    {
        $user = User::factory()->create();
        $quiz = Quiz::factory()->create(['reponse' => 1]);

        $response = $this->actingAs($user)
            ->post(route('quiz.verifyAnswer'), [
                'question_id' => $quiz->id,
                'answer_index' => 1,
            ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('user_reponses', [
            'user_id' => $user->id,
            'question_id' => $quiz->id,
        ]);

        // Rechargez l'utilisateur pour obtenir les points mis à jour
        $user->refresh();

        $this->assertEquals(10, $user->points);
    }
}
