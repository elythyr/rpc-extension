<?php

namespace Phpactor\Extension\Rpc\Tests\Unit;

use PHPUnit\Framework\TestCase;

use Phpactor\Extension\Rpc\HandlerRegistry;
use Phpactor\Extension\Rpc\Handler;

class HandlerRegistryTest extends TestCase
{
    public function testExceptionForUnkown()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('No handler "aaa"');

        $action = $this->prophesize(Handler::class);
        $action->name()->willReturn('one');
        $registry = $this->create([ $action->reveal() ]);

        $registry->get('aaa');
    }

    public function testGetAction()
    {
        $action = $this->prophesize(Handler::class);
        $action->name()->willReturn('one');
        $registry = $this->create([ $action->reveal() ]);

        $this->assertSame($action->reveal(), $registry->get('one'));
    }

    public function create(array $actions = [])
    {
        return new HandlerRegistry($actions);
    }
}
