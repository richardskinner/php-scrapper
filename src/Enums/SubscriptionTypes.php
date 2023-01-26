<?php

namespace Scrapper\Cli\Enum;

enum SubscriptionTypes: string
{
    case MONTHLY = 'monthly';
    case ANNUALLY = 'annually';
}