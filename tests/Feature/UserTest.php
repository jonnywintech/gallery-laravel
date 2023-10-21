<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    protected $global_user;

    public function setUp(): void
    {

        parent::setUp();
        $this->global_user = new User([
            'first_name' => 'Johnatan',
            'last_name' => 'Malkovic',
            'email' => 'johnmalkovic@example.com',
            'password' => 'password',
            'is_verified' => true,
        ]);

        $this->global_user->save();
    }


    public function testUserCreation()
    {
        $user = new User([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'is_verified' => true,
        ]);

        $this->assertTrue($user->save());
    }

    public function testUserIsSoftDeleted()
    {

        $this->global_user->save();

        $this->global_user->delete();

        $this->assertTrue($this->global_user->trashed());
    }


    public function testVerifyThatUserIsSoftDeleted()
    {

        $user = User::find('id',$this->global_user->id);

        $this->assertNull($user);
    }

    public function testUserIsRestored()
    {
        $this->global_user->delete();
        $this->assertTrue($this->global_user->trashed());
        $this->global_user->restore();
        $restoredUser = User::find($this->global_user->id);
        $this->assertFalse($restoredUser->trashed());
    }
}
