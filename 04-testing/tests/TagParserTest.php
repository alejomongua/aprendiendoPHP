<?php

namespace Tests;

use App\TagParser;
use PHPUnit\Framework\TestCase;

class TagParserTest extends TestCase
{
    protected TagParser $parser;
    public function setUp(): void
    {
        // Given (or arrange)
        $this->parser = new TagParser();
    }
    
    public function test_it_converts_a_string_into_array()
    {
        // when
        $result = $this->parser->parse('personal');
        $expected = ['personal'];

        // then
        $this->assertSame($expected, $result);
    }

    public function test_it_parses_a_comma_separated_list_of_tags()
    {
        // act
        $result = $this->parser->parse('personal, money, family');
        $expected = ['personal', 'money', 'family'];

        // assert
        $this->assertSame($expected, $result);
    }

    public function test_spaces_are_optional()
    {

        $result = $this->parser->parse('personal,money,family');
        $expected = ['personal', 'money', 'family'];

        $this->assertSame($expected, $result);
    }

    public function test_it_parses_a_pipe_separated_list_of_tags()
    {
        $result = $this->parser->parse('personal|money|family');
        $expected = ['personal', 'money', 'family'];

        $this->assertSame($expected, $result);

        $this->assertSame($expected, $result);
    }

    public function test_spaces_are_optional_2()
    {

        $result = $this->parser->parse('personal | money | family');
        $expected = ['personal', 'money', 'family'];

        $this->assertSame($expected, $result);
    }

}
