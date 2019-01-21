<?php

/**
 * Part of the CommonRegexPHP package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the MIT License.
 *
 * @package    CommonRegexPHP
 * @version    1.0.0
 * @author     james2doyle
 * @license    MIT
 */

namespace james2doyle\CommonRegexPHP\Tests;

use james2doyle\CommonRegexPHP;
use PHPUnit\Framework\TestCase;

class CommonRegexPHPTest extends TestCase
{
    /**
     * The default test text
     *
     * @var string
     */
    protected $text = 'John, please get that article on www.linkedin.com to me by 5:00PM on Jan 9th 2012 no later than December 21st 1998. 4:00 would be ideal, actually. Use #333 or #212121 for the header. If you have any questions, you can reach my associate at (012)-345-6789 or associative@mail.com. I\'ll be on UK during the whole week on a J.R.R. Tolkien convention. They said the price was US$5,000.90, actually it is US$3,900.5. It\'s $1100.4 less, can you imagine this? I\'m 99.9999999% sure that I\'ll get a raise of 5%. The IPv6 address for localhost is 0.0.0.0, 0:0:0:0:0:0:0:1, or alternatively, ::1. Use the credit card number is 5555555555554444. The address is 123 fake street.';

    /**
     * @var array
     */
    protected $expected = [
        'dates' => [
            'Jan 9th 2012',
            'December 21st 1998'
        ],
        'times' => [
            '5:00PM',
            '4:00',
        ],
        'phones' => [
            '(012)-345-6789',
            '9.9999999',
            '55555555555',
        ],
        'links' => [
            'www.linkedin.com',
        ],
        'emails' => [
            'associative@mail.com',
        ],
        'IPv4' => [
            '0.0.0.0',
        ],
        'IPv6' => [
            '0:0:0:0:0:0:0:1',
            '::1',
        ],
        'hexColors' => [
            '#333',
            '#212121',
        ],
        'acronyms' => [
            'UK',
            'J.R.R.',
            'US',
            'US',
            'IP',
        ],
        'money' => [
            'US$5,000.90',
            'US$3,900.5',
            '$1100.4',
        ],
        'percentages' => [
            '99.9999999%',
            '5%',
        ],
        'creditCards' => [
            '5555555555554444',
        ],
        'addresses' => [
            '123 fake street',
        ],
    ];

    /** @test */
    public function itCanParseTextToAnArrayOfResultsWithNoEmpties()
    {
        $results = (new CommonRegexPHP)($this->text);

        $this->assertEquals($this->expected, $results);
    }

    /** @test */
    public function itCanParseTextToAnArrayOfResultsWithNoEmpties2()
    {
        $results = (new CommonRegexPHP)('See you at 12:00AM on March 22nd 2018');

        $this->assertEquals([
            'dates' => [
                'March 22nd 2018',
            ],
            'times' => [
                '12:00AM',
            ],
        ], $results);
    }

    /** @test */
    public function itCanParseTextWithNoResults()
    {
        $results = (new CommonRegexPHP)('Nothing to see here');

        $this->assertEquals([], $results);
    }
}
