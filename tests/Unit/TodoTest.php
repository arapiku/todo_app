<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TodoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFormCheck() {
      $this->visit('/')
      ->type('タイトル１', 'title')
      ->press('リストの作成');
    }

}
