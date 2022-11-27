<?php

declare(strict_types = 1);

namespace Tests\unit;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
//use GuzzleHttp\Exception\GuzzleException;
//use GuzzleHttp\Exception\ServerException;
//use GuzzleHttp\Psr7\Request;

use SocialPost\Client\FictionalClient;

/**
 * Class ATestTest
 *
 * @package Tests\unit
 */
class FictionalClientTest extends TestCase
{
       /**
     * @var string
     */
    private $clientId;

    /**
     * @var Client
     */
    private $client;

    public function setUp(): void {
        $this->client = new Client(
            [
                'base_uri' => 'https://api.supermetrics.com',
            ]
        );
        $this->clientId = 'ju16a6m81mhid5ue1z3v2g0uh';
        $this->fictionalClient = new FictionalClient($this->client, $this->clientId);
    }

    public function tearDown(): void {
        unset($this->fictionalClient);
    }

    /**
     * @test
     */
    public function testRegisterAPI(): void
    {
    $url = '/assignment/register';
    $body = ['email' => 'your@email.address', 'name' => 'YourName', 'client_id' => 'ju16a6m81mhid5ue1z3v2g0uh'];

    $output = $this->fictionalClient->post($url, $body);
    $expected ='{"meta":{"request_id":"_2oJbTECcW0Jk8feofV6nWWNrvP308L1"},"data":{"client_id":"ju16a6m81mhid5ue1z3v2g0uh","email":"your@email.address","sl_token":"smslt_6db89021475_4fe4a2a98c8a83"}}';
 
    $this->assertEquals(
        $expected,
        $output,
    );    

    }
}
