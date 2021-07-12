<?php

namespace Tests;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,DatabaseTransactions;

    protected $faker;

    /**
     * @return void
     */
    public function setUp():void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        $this->faker = Factory::create();
    }
}
