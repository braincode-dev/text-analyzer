<?php

namespace Tests\Unit\System\Builders;

use App\System\Builders\FileBuilderFactory;
use App\System\Builders\XMLFileBuilder;
use Tests\TestCase;

class FileBuilderFactoryTest extends TestCase
{

    public function test_we_can_check_get_builder()
    {
        $expectedValue = 'xml';
        \Mockery::mock(XMLFileBuilder::class)
            ->shouldReceive('build')
            ->once()
            ->andReturn('name');

        $builder = FileBuilderFactory::getBuilder($expectedValue);
        $this->assertInstanceOf(XMLFileBuilder::class, $builder);
    }
}
