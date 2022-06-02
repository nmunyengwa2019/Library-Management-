<?php

namespace Tests\Feature;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    /** @test */
    public function a_book_can_be_created()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());

        $attributes = [
            "name"=>"Titanic",
            "author_id"=>1,
            "published_at"=>"20-05-1999"
            ];

            $this->get('books/create')->assertStatus(200);

        $this->post('/books',$attributes)->assertRedirect('/books');
        $books=Book::first();
        $this->assertCount(1,Book::all());
        //$this->assertDatabaseHas('books',$attributes); does not work when formating date
        $this->assertInstanceOf(Carbon::class, $books->published_at);
        //line below required when formatting dates
        $this->assertEquals('20-05-1999', $books->published_at->format('d-m-Y'));

        $this->get('/books')->assertSee($attributes['name'])
                            ->assertSee($attributes['published_at']);
    }

    /**
     * @test
     * */
    public function a_book_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $book = Book::factory()->create();
        $my_book = Book::first();

        $this->delete($book->path());
        $this->assertCount(0,Book::all());
         

    }

    /**
     * @test
     * */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $attributes= [
            'name'=>'Titanic',
            'author_id'=>1,
            'published_at'=>'1999-05-20'
        ];
        $this->post('/books',$attributes);
        $this->assertCount(1,Book::all());
        $book = Book::first();
         $this->assertInstanceOf(Carbon::class, $book->published_at);
        //line below required when formatting dates
        $this->assertEquals('1999-05-20', $book->published_at->format('Y-m-d'));
        
        $this->patch($book->path(),['name'=>'nola','author_id'=>2,'published_at'=>'2000-04-01']);
        $books=Book::first();
        $this->assertInstanceOf(Carbon::class, $books->published_at);
        $this->assertEquals('2000-04-01', $books->published_at->format('Y-m-d'));
        //.....
        $this->assertEquals('nola',Book::first()->name);
        $this->assertEquals(2,Book::first()->author_id); 
        $this->assertEquals('2000-04-01',Book::first()->published_at->format('Y-m-d'));

    }


}
