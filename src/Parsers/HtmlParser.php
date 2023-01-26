<?php

namespace Scrapper\Cli\Parser;

use DOMDocument;
use DOMElement;
use RuntimeException;
use Scrapper\Cli\Enum\SubscriptionTypes;

class HtmlParser implements ParseProductsInterface
{
    private const SEARCH_STRING_PER_MONTH = 'Per Month';
    private const SEARCH_STRING_PER_YEAR = 'Per Year';

    public function __construct(private ?string $fileLocation)
    {
    }

    private function getContentOrThrowException(string $fileLocation): string
    {
        if (!$content = file_get_contents($fileLocation)) {
            throw new RuntimeException('could not open file');
        }

        return $content;
    }

    public function getProducts(): array
    {
        $content = $this->getContentOrThrowException($this->fileLocation);

        $dom = new DOMDocument();
        $dom->loadHTML($content);

        $xPath = new \DOMXPath($dom);
        $productName = $xPath->evaluate('//div[contains(@class,"header")]//h3');
        $productDescription = $xPath->evaluate('//div[contains(@class,"package-description")]');
        $productPrice = $xPath->evaluate('//span[contains(@class,"price-big")]');
        $packagePrice = $xPath->evaluate('//div[contains(@class,"package-price")]');

        $products = [];

        foreach ($productName->getIterator() as $key => $domElement) {
            /** @var DOMElement $domElement */
            $products[$key]['subscription'] = $this->isAnnualOrMonthlySubscription($packagePrice[$key]->nodeValue);
            $products[$key]['name'] = $domElement->nodeValue;
            $products[$key]['description'] = $productDescription[$key]->nodeValue;
            $products[$key]['price'] = $this->getPrice($productPrice[$key]->nodeValue);

            $discountString = $xPath->query('p', $packagePrice[$key]);
            $discountString = $discountString[0] ? $discountString[0]->nodeValue : null;
            $products[$key]['discount'] = $this->getDiscountPrice($discountString);
        }

        return $products;
    }

    private function getPrice(string $priceString): string
    {
        return filter_var(
            $priceString,
            FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION
        );
    }

    private function getDiscountPrice(?string $priceString): ?string
    {
        if (empty($priceString)) {
            return null;
        }

        /** @var DOMElement $el */
        return filter_var(
            $priceString,
            FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION
        );
    }

    private function isAnnualOrMonthlySubscription(string $price): string
    {

        if (str_contains($price, self::SEARCH_STRING_PER_MONTH)) {
            return SubscriptionTypes::MONTHLY->value;
        }

        if (str_contains($price, self::SEARCH_STRING_PER_YEAR)) {
            return SubscriptionTypes::ANNUALLY->value;
        }

        return '';
    }
}