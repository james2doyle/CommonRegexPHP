<?php

namespace james2doyle;

/**
 * CommonRegexPHP
 */
class CommonRegexPHP
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var array
     */
    private $results;

    /**
     * @var array
     */
    protected $patterns = [
        'dates' => '/(?:[0-3]?\d(?:st|nd|rd|th)?\s+(?:of\s+)?(?:jan\.?|january|feb\.?|february|mar\.?|march|apr\.?|april|may|jun\.?|june|jul\.?|july|aug\.?|august|sep\.?|september|oct\.?|october|nov\.?|november|dec\.?|december)|(?:jan\.?|january|feb\.?|february|mar\.?|march|apr\.?|april|may|jun\.?|june|jul\.?|july|aug\.?|august|sep\.?|september|oct\.?|october|nov\.?|november|dec\.?|december)\s+[0-3]?\d(?:st|nd|rd|th)?)(?:\,)?\s*(?:\d{4})?/i',
        'times' => '/\b((0?[0-9]|1[0-2])(:[0-5][0-9])?(am|pm)|([01]?[0-9]|2[0-3]):[0-5][0-9])/i',
        'phones' => '/(\d?[^\s\w]*(?:\(?\d{3}\)?\W*)?\d{3}\W*\d{4})/i',
        'links' => '/((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\((?:[^\s()<>]+|(?:\([^\s()<>]+\)))*\))+(?:\((?:[^\s()<>]+|(?:\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?\xab\xbb\u201c\u201d\u2018\u2019]))/i',
        'emails' => '/([a-z0-9!#$%&\'*+\/=?\^_`{|}~\-]+@([a-z0-9]+\.)+([a-z0-9]+))/i',
        'IPv4' => '/\b((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b/',
        'IPv6' => '/((([0-9A-Fa-f]{1,4}:){7}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}:[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){5}:([0-9A-Fa-f]{1,4}:)?[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){4}:([0-9A-Fa-f]{1,4}:){0,2}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){3}:([0-9A-Fa-f]{1,4}:){0,3}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){2}:([0-9A-Fa-f]{1,4}:){0,4}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(([0-9A-Fa-f]{1,4}:){0,5}:((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(::([0-9A-Fa-f]{1,4}:){0,5}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|([0-9A-Fa-f]{1,4}::([0-9A-Fa-f]{1,4}:){0,5}[0-9A-Fa-f]{1,4})|(::([0-9A-Fa-f]{1,4}:){0,6}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){1,7}:))\b/i',
        'hexColors' => '/#(?:[0-9a-fA-F]{3}){1,2}\b/i',
        'acronyms' => '/\b(([A-Z]\.)+|([A-Z]){2,})/',
        'money' => '/((^|\b)US?)?\$\s?[0-9]{1,3}((,[0-9]{3})+|([0-9]{3})+)?(\.[0-9]{1,2})?\b/',
        'percentages' => '/(100(\.0+)?|[0-9]{1,2}(\.[0-9]+)?)%/',
        'creditCards' => '/((?:(?:\d{4}[- ]){3}\d{4}|\d{16}))(?![\d])/',
        'addresses' => '/\d{1,4} [\w\s]{1,20}(?:(street|avenue|road|highway|square|trail|drive|court|parkway|boulevard|circle)\b|(st|ave|rd|hwy|sq|trl|dr|ct|pkwy|blvd|cir)\.(?=\b)?)/i',
    ];

    /**
     * Return the parsed text
     *
     * @param string $text the text to parse
     *
     * @return array
     */
    public function __invoke(string $text)
    {
        $this->text = $text;
        return $this->parseText($text);
    }

    /**
     * Parse the text
     *
     * @param string $text
     *
     * @return array
     */
    private function parseText(string $text)
    {
        return \array_filter(\array_map(function (string $pattern) use ($text) {
            try {
                \preg_match_all($pattern, $text, $matches);

                return \array_filter($matches[0]);
            } catch (\Exception $e) {
                return [];
            }
        }, $this->patterns));
    }
}
