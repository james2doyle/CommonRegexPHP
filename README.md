CommonRegexPHP
===============

> Migrated from [talyssonoc/CommonRegexJS](https://github.com/talyssonoc/CommonRegexJS)

[CommonRegex](https://github.com/madisonmay/CommonRegex/ "CommonRegex") port for PHP

Find a lot of kinds of common information in a string.

Pull requests welcome!

Please note that this is currently English/US specific.

Usage
======

```
composer require james2doyle/common-regex-php
```

Then somewhere in the code:

```php
$parser = new CommonRegexPHP;
$results = $parse('See you at 12:00AM on March 22nd 2018');
// returns [
//     'dates' => [
//         'March 22nd 2018',
//     ],
//     'times' => [
//         '12:00AM',
//     ],
// ]

// shorthand
$results = (new CommonRegexPHP)('See you at 12:00AM on March 22nd 2018');
```

Running Tests
===============

```
composer install
composer run test
```

CommonRegex Ports
==================
There are CommonRegex ports for other languages, see [here](https://github.com/madisonmay/CommonRegex/#commonregex-ports "CommonRegex ports")
