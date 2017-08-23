<?php

namespace Tests;

// use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // 環境により要変更
    public $baseUrl = 'http://192.168.35.10';
}
