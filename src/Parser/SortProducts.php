<?php

namespace Scrapper\Cli\Parser;

class SortProducts
{
    public function sort(array &$products, int $priceBy = SORT_DESC, int $sortSubscriptionBy = SORT_ASC): void
    {
        $subscription = array_column($products, 'subscription');
        $price = array_column($products, 'price');
        array_multisort(
            $subscription,
            SORT_ASC,
            $price,
            SORT_DESC,
            $products
        );
    }
}