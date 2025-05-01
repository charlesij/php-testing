<?php
  
namespace Tests;

use App\TagParser;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class TagParserTest extends TestCase
{
	#[DataProvider('tagsProvider')]
	public function test_it_parses_tags($input, $expected)
	{
		$parser = new TagParser();

		$result = $parser->parse($input);

		$this->assertSame($expected, $result);
	}

	public static function tagsProvider(): array
	{
		return [
			'a_single_tag' => ['personal', ['personal']],
			'a_comma_separated_list_of_tags' => ['personal, money, family', ['personal', 'money', 'family']],
			'a_pipe_separated_list_of_tags' => ['personal | money | family', ['personal', 'money', 'family']],
			'an_exclamation_mark' => ['personal!money!family', ['personal', 'money', 'family']],
			'tags_without_spaces' => ['personal|money|family', ['personal', 'money', 'family']],
		];
	}
}