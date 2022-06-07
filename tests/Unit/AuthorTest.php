<?php

namespace Tests\Unit;
use App\Models\Author;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * */
    public function a_dob_is_nullable()
    {
        Author::firstOrCreate([
            'name'=>'Titanic'
        ]);

        $this->assertCount(1,Author::all());
    }
}
