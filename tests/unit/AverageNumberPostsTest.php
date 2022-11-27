<?php

declare(strict_types = 1);

namespace Tests\unit;

use PHPUnit\Framework\TestCase;
use Statistics\Calculator\AverageNumberPosts;
use Statistics\Dto\StatisticsTo;

/**
 * Class ATestTotalPostsPerWeek
 *
 * @package Tests\unit
 */
class AverageNumberPostsTest extends TestCase
{
    public function setUp(): void {
        $this->AverageNumberPosts = new AverageNumberPosts();
    }

    public function tearDown(): void {
      unset($this->AverageNumberPosts);
    }

    /**
     * @dataProvider provideAverage
     */
    public function testAverage($userCount, $postCount, $expected){
        $stats = (new StatisticsTo())
            ->setValue($expected);
           
        $expected = $stats;

        $this->AverageNumberPosts->setUserCount($userCount);
        $this->AverageNumberPosts->setPostCount($postCount);
        $output = $this->AverageNumberPosts->getCalculate();
        $this->assertEquals(
            $expected,
            $output,
        );
    }

    public function provideAverage() {
        return [
            'returns whole value'                    => [5, 10, 2],
            'returns one decimal place'              => [5, 11, 2.2],
            'returns two decimal places'             => [12, 567, 47.25],
            'Average rounded to 2 decimal places'    => [13, 567, 43.62],
            'zero count          '                   => [5, 0, 0],
            'zero users - handles divisable by zero' => [0, 5, 0],
            'Posts less than users'                  => [10, 5, 0.5],
            'Null user count'                        => [null, 5, 0],
            'Null post count'                        => [5, null, 0],
            'String value user count'                => ['5', 5, 1],
            'String value post count'                => [2, '10', 5],
            'Empty String user count'                => ['', 5, 0],
            'Empty String post count'                => [2, '', 0],
        ];
    }

}
