# PHP Webpage Scrapper

## Introduction
This is a basic CLI tool to scarp a webpage for products and return as a JSON.

## Notes
Couple of things to point out:

* No libraries were used for this due to the fact the ones needed for this were not compatiable with PHP8+
* No PHP framework was used due to the simplicity of the task at hand, however, Laravel and Symfony both have the ability to create these types of cli tools
* I opted not comment any code as the code should comment itself with good naming convention of classes and methods
* A factory was used to allow multiple parsers in the future

## Summary
This CLI tool was developed using PHP8+. A few features was used from PHP8+ were used in this application e.g. property promotion.

## Setup & Run

* Make sure your machine is running PHP8+
* Check where your php is located using `which php` and replace the first line `command.php` with your php location e.g. `#!/usr/bin/php` is what usually comes up
* Install packages `composer install` (Only PHPUnit)
* Run the application from root dir
  * First param should `html`
  * Second should be `https://wltest.dns-systems.net/`
  * Full command `php ./command.php html https://wltest.dns-systems.net/`

## Improvements

Some of these would have been nice to add but due to time constrains they were left out.

* I have retrieved the data using file_get_contents in the Parser. On hindsight this probably should be moved as this violations th solid principles.
* Having a SortProducts class might be overkill but wanted it to be separate from the Parser
* Allowing different types of responses would be nice - at present we are coupled to JSON
* Moving the parser logic from command.php, where we determine the type of parser to use, would be nice to put behind an interface and use from with Application class, this logic is run too early.
* The provided HTML has 2 ids for section tag, this should be improved by removing ids
* Use better understandable options and validate options.
* Colour the terminal for output

