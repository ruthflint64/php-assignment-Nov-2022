<?php

declare(strict_types = 1);

namespace Tests\unit;

use DateTime;
use PHPUnit\Framework\TestCase;
use SocialPost\Hydrator\fictionalPostHydrator;
use SocialPost\Dto\SocialPostTo;

/**
 * Class AHydratorTest
 *
 * @package Tests\unit
 */
class fictionalPostHydratorTest extends TestCase
{
    private const POST_CREATED_DATE_FORMAT = DateTime::ATOM;

    public function setUp(): void {
        $this->fictionalPostHydrator = new fictionalPostHydrator();
    }

    public function tearDown(): void {
        unset($this->FictionalPostHydrator);
    }

    /**
     * @test
     */
    public function testHydrator(): void
    {
        $date  = "2018-08-11T06:38:54+00:00";

        $datetime = DateTime::createFromFormat(
            self::POST_CREATED_DATE_FORMAT,
            $date
        );

        $expected = (new SocialPostTo())
            ->setId('123')
            ->setAuthorName('from name')
            ->setAuthorId('from id')
            ->setText('hello world')
            ->setType('type')
            ->setDate($datetime);

        $output = $this->fictionalPostHydrator->hydrate([
            'id'           => '123',
            'from_name'    => 'from name',
            'from_id'      => 'from id',
            'message'      => 'hello world',
            'type'         => 'type',
            'created_time' => $date,
        ]);
    
        $this->assertEquals(
             $expected,
             $output,
        );
    }

}
