<?php

namespace Tests\Unit\System\Builders;

use App\System\Builders\XMLFileBuilder;
use Tests\TestCase;

class XMLFileBuilderTest extends TestCase
{
    public function test_we_can_check_build()
    {
        $builder = new XMLFileBuilder();
        \Mockery::mock(XMLFileBuilder::class)
            ->shouldReceive('build')
            ->once()
            ->andReturn('name');

        $expectedString = $builder->build([]);
        $this->assertIsString($expectedString);
    }
}
