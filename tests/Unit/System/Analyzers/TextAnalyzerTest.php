<?php
namespace Tests\Unit\System\Analyzers;

use Tests\TestCase;
use App\System\Analyzers\TextAnalyzer;

class TextAnalyzerTest extends TestCase
{
    public $textAnalyzer;

    public function setUp(): void
    {
        $requestParams = [
            'text' => 'test',
        ];

        $request = $this->getMockBuilder('Illuminate\Http\Request')
            ->disableOriginalConstructor()
            ->setMethods(['getMethod', 'retrieveItem', 'getRealMethod', 'all', 'getInputSource', 'get', 'has'])
            ->getMock();

        $request->expects($this->any())
            ->method('get')
            ->willReturn($requestParams);

        $this->textAnalyzer = new TextAnalyzer($request);
    }

    public function test_we_can_check_number_of_characters()
    {
        $expectRes = 4;
        $this->assertEquals($expectRes, $this->textAnalyzer->numberOfCharacters());
    }

    public function test_we_can_check_frequency_of_characters()
    {
        $this->assertIsArray($this->textAnalyzer->frequencyOfCharacters());
    }

    public function test_we_can_check_distribution_percentage()
    {
        $this->assertIsArray($this->textAnalyzer->distributionPercentage());
    }

    public function test_we_can_check_average_word_length()
    {
        $this->assertEquals(1, $this->textAnalyzer->averageWordLength());
    }

    public function test_we_can_check_is_palindrome_string()
    {
        $this->assertIsString( $this->textAnalyzer->isPalindromeString());
        $this->assertEquals("Text is not a Palindrome string", $this->textAnalyzer->isPalindromeString());
    }

    public function test_we_can_check_reversed_text()
    {
        $this->assertEquals("tset", $this->textAnalyzer->reversedText());
    }


}
