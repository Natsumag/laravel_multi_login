<?php

namespace App\Constants;

class Common
{
    const PROUDCT_ADD = '1';
    const PROUDCT_REDUCE = '2';

    const PRODUCT_LIST = [
        'add' => self::PROUDCT_ADD,
        'reduce' => self::PROUDCT_REDUCE,
    ];

    const ORDER_RECOMMEND = '0';
    const ORDER_HIGHER = '1';
    const ORDER_LOWER = '2';
    const ORDER_LATER = '3';
    const ORDER_OLDER = '4';

    const SORT_ORDER = [
        'recommend' => self::ORDER_RECOMMEND,
        'higherPrice' => self::ORDER_HIGHER,
        'lowerPrice' => self::ORDER_LOWER,
        'later' => self::ORDER_LATER,
        'older' => self::ORDER_OLDER,
    ];
}
