<?php

namespace Dreamr\OneSignalChannelTests;

use Dreamr\OneSignalChannel\OneSignalMessage;
use PHPUnit\Framework\TestCase;

class OneSignalMessageTest extends TestCase
{
    public function testBody()
    {
        $message = new OneSignalMessage('Test message');
        $this->assertEquals('Test message', $message->getBody());
    }

    public function testChangeBody()
    {
        $message = new OneSignalMessage('Test message');
        $message->body('New message');
        $this->assertEquals('New message', $message->getBody());
    }

    public function testData()
    {
        $message = new OneSignalMessage('');
        $message->data('key1', 'value1');
        $message->data('key2', 'value2');
        $message->data('key1', 'new value');
        $this->assertEquals(['key1' => 'new value', 'key2' => 'value2'], $message->getData());
    }
}