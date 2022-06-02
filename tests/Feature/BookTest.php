<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    /** @test */
    public function a_book_can_be_created()
    {
        $this->withoutExceptionHandling();
        $attributes = [
            "name"=>"Titanic",
            "author_id"=>1,
            "published_at"=>"20/05/1999"
            ];

        $this->post('/books',$attributes);
        $this->assertDatabaseHas('books',$attributes);
        $this->get('/books')->assertSee($attributes['name'])
                            ->assertSee($attributes['published_at']);
    }
}
