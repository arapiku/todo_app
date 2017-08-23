<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     public function testFormCheck() {
       $this->visit('/todos/1')
       ->type('todo1', 'title')
       ->type('2017/09/09', 'deadline')
       ->press('ToDoの追加');
     }
}
