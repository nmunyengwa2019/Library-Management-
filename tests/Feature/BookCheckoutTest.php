<?php

namespace Tests\Feature;
use App\Models\Book;
use App\Models\User;
use App\Models\Reservations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookCheckoutTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * */
    public function a_book_can_be_checked_out_by_signedin_user()
    {
        $this->withoutExceptionHandling();

        $book = Book::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->post('/checkout/'.$book->id);
        $this->assertCount(1,Reservations::all());

        $this->assertEquals($user->id,Reservations::first()->user_id);
        $this->assertEquals($book->id,Reservations::first()->book_id);
        $this->assertEquals(now(), Reservations::first()->checked_out_at);

    }

    /**
     * @test
     * */
    public function only_a_signedin_user_can_checkin_a_book()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $book=Book::factory()->create();
        $this->actingAs($user);

        $this->post('/checkout/'.$book->id);
        $this->assertCount(1,Reservations::all());

        $this->assertEquals($user->id,Reservations::first()->user_id);
        $this->assertEquals($book->id,Reservations::first()->book_id);
        $this->assertEquals(now(), Reservations::first()->checked_out_at);

        $this->post('/checkin/'.$book->id);
        $this->assertCount(1,Reservations::all());

        $this->assertEquals($user->id,Reservations::first()->user_id);
        $this->assertEquals($book->id,Reservations::first()->book_id);
        $this->assertEquals(now(), Reservations::first()->checked_in_at);


    }


    public function test_guests_cannot_checkout_a_book()
    {
        //$this->withoutExceptionHandling();

        $book = Book::factory()->create();
        $user = User::factory()->create();
        

        $this->post('/checkout/'.$book->id)->assertRedirect('login');
        $this->assertCount(0,Reservations::all());


    }

    public function test_guests_cannot_checkin_a_book()
    {
        //$this->withoutExceptionHandling();

        $book = Book::factory()->create();
        $user = User::factory()->create();
        

        $this->post('/checkin/'.$book->id)->assertRedirect('login');
        $this->assertCount(0,Reservations::all());


    }

    // public function test_unknown_book_cannot_be_checked_out()
    // {
    //   $this->withoutExceptionHandling();

        
    //     $user = User::factory()->create();
    //     $this->actingAs($user);

    //     $this->post('/checkout/123')->assertStatus(404);
    //     $this->assertCount(0,Reservations::all());  
    // }
}
