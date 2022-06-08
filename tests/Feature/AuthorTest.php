<?php

namespace Tests\Feature;

use Carbon\Carbon;
use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    /** @test */
    public function an_author_can_be_created()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create()); 
        $attributes = [
                'name'=>'Noel',
                'dob'=>'20-05-1999'
        ];

        $this->post('/authors',$attributes)->assertRedirect('/authors');
        $authors=Author::first();
        $this->assertCount(1,Author::all());
        
        //$this->assertDatabaseHas('authors',$attributes); 

        $this->assertInstanceOf(Carbon::class,$authors->first()->dob);
        $this->assertEquals('20-05-1999',$authors->first()->dob->format('d-m-Y'));
        $this->get('/authors')->assertSee($attributes['name'])->assertSee($attributes['dob']);
    }
}
