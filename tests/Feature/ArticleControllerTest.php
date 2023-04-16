<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
      $response = $this->get(route('articles.index'));

      $response->assertStatus(200)
        ->assertViewIs('articles.index');
    }

    public function testGuestCreate()
    {
      $response = $this->get(route('articles.create'));

      $response->assertRedirect(route('login'));
    }

    public function testAuthCreate()
    {
      $user = factory(User::class)->create(); // 準備

      $response = $this->actingAs($user)
        ->get(route('articles.create')); // 実行

      $response->assertStatus(200)
        ->assertViewIs('articles.create'); // 検証
    }
}
