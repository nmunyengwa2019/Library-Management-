<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\User;
use App\Models\Reservations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_book_can_be_checked_out()
    {
        $book = Book::factory()->create();
        $user = User::factory()->create();

        $book->checkout($user);
        $this->assertCount(1,Reservations::all());
        $this->assertEquals($user->id,Reservations::first()->user_id);
        $this->assertEquals($book->id,Reservations::first()->book_id);
        $this->assertEquals(now(),Reservations::first()->checked_out_at);
    }


    public function test_a_book_can_be_returned()
    {
        $book = Book::factory()->create();
        $user = User::factory()->create();

        $book->checkout($user);

        $book->checkin($user);

        $this->assertCount(1,Reservations::all());
        $this->assertEquals($user->id,Reservations::first()->user_id);
        $this->assertEquals($book->id,Reservations::first()->book_id);
        $this->assertEquals(now(),Reservations::first()->checked_in_at);
    }

    public function test_a_book_can_be_checked_out_twice()
    {
        $book = Book::factory()->create();
        $user = User::factory()->create();

        $book->checkout($user);

        $book->checkin($user);
        $book->checkout($user);

        $this->assertCount(2,Reservations::all());
        $this->assertEquals($user->id,Reservations::find(2)->user_id);
        $this->assertEquals($book->id,Reservations::find(2)->book_id);
        $this->assertEquals(now(),Reservations::find(2)->checked_out_at);

        $book->checkin($user);

        $this->assertCount(2,Reservations::all());
        $this->assertEquals($user->id,Reservations::find(2)->user_id);
        $this->assertEquals($book->id,Reservations::find(2)->book_id);
        $this->assertEquals(now(),Reservations::find(2)->checked_in_at);

    }

    public function test_checkin_a_book_that_wasnot_checkedout_throws_exception()
    {
        $this->expectException(\Exception::class);
        throw new \Exception('Error! book was not checked out');
        $book = Book::factory()->create();
        $user = User::factory()->create();

        $book->checkin($user);
    }
}
