<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Articles;
use App\Models\Panier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoutiqueTest extends TestCase
{
    use RefreshDatabase;

    public function test_article_can_be_created()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/boutique/articles', [
            'nom' => 'Sample Article',
            'description' => 'This is a sample article.',
            'prix_public' => 100,
            'img' => 'http://example.com/sample.jpg',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('articles', ['nom' => 'Sample Article']);
    }

    public function test_article_can_be_updated()
    {
        $user = User::factory()->create();
        $article = Articles::factory()->create(['nom' => 'Old Article']);

        $response = $this->actingAs($user)->put("/boutique/articles/{$article->id}", [
            'nom' => 'Updated Article',
            'description' => 'This is an updated article.',
            'prix_public' => 150,
            'img' => 'http://example.com/updated.jpg',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('articles', ['nom' => 'Updated Article']);
    }

    public function test_article_can_be_deleted()
    {
        $user = User::factory()->create();
        $article = Articles::factory()->create(['nom' => 'Article to be deleted']);

        $response = $this->actingAs($user)->delete("/boutique/articles/{$article->id}");

        $response->assertStatus(200);
        $this->assertModelMissing($article);
    }

    public function test_user_can_purchase_article()
    {
        $user = User::factory()->create(['points' => 200]);
        $article = Articles::factory()->create(['prix_public' => 100]);

        $response = $this->actingAs($user)->post("/boutique/acheter/{$article->id}");

        $response->assertRedirect('/boutique');
        $this->assertDatabaseHas('paniers', [
            'user_id' => $user->id,
            'article_id' => $article->id,
        ]);

        $this->assertEquals(100, $user->fresh()->points);
    }

    public function test_guest_cannot_purchase_article()
    {
        $article = Articles::factory()->create(['prix_public' => 100]);

        $response = $this->post("/boutique/acheter/{$article->id}");

        $response->assertRedirect('/login');
    }

    public function test_insufficient_points_prevents_purchase()
    {
        $user = User::factory()->create(['points' => 50]);
        $article = Articles::factory()->create(['prix_public' => 100]);

        $response = $this->actingAs($user)->post("/boutique/acheter/{$article->id}");

        $response->assertRedirect('/boutique');
        $response->assertSessionHas('error', 'Vous être trop pauvre ! Ouvrez un OF.');
    }
}
