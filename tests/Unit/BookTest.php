<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
class BookTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * */
    public function a_book_has_a_path()
    {
        $book = Book::factory()->create();
        $this->assertEquals($book->path(),'/books/'.$book->id);
    }

  

}
