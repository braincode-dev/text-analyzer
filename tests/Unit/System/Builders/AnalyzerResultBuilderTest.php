<?php

namespace Tests\Unit\System\Builders;

use App\Models\AnalyzerResults;
use App\System\Builders\AnalyzerResultBuilder;
use Carbon\Carbon;
use Tests\TestCase;

class AnalyzerResultBuilderTest extends TestCase
{
    public function test_we_can_check_return_arr()
    {
        $builder = AnalyzerResultBuilder::builder(1);

        $model = new AnalyzerResults([
            'id' => 11,
            'hash' => md5('test'),
            'time' => Carbon::now(),
            'number_characters' => 3,
            'number_words' => 3,
            'number_sentences' => 33,
            'average_word_length' => 'sadasd',
            'average_number_words' => 'sadasd',
            'palindrome_words' => 'sadasd',
            'top_palindrome_words' => [],
            'is_palindrome_string' => 'sadasd',
            'reversed_text' => 2,
            'reversed_word' => 'asdasd',
            ]);
        $arr = (array) $model;

        \Mockery::mock(AnalyzerResults::class)
            ->shouldReceive('findOrFail')
            ->once()
            ->andReturn($arr);

        $this->assertIsArray($builder);
    }
}
