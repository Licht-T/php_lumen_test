<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

use App\User;

class UsersControllerTest extends TestCase
{
    /**
     * @before
     */
    public function up()
    {
    }

    /**
     * @after
     */
    public function down()
    {
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetUser()
    {
        $this->get('/user');

        $this->assertEquals(
            App\User::all(), $this->response->getContent()
        );
    }
}
