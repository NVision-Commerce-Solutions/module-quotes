<?php

declare(strict_types=1);

namespace Commerce365\Quotes\Service;

use Magento\Framework\Phrase;

class GetQuoteStatus
{
    private array $quoteStatusMapping = [
        0 => 'Open',
        1 => 'Released',
        2 => 'Pending Approval',
        3 => 'Pending Prepayment'
    ];

    /**
     * @param array $quote
     * @return Phrase
     */
    public function execute(array $quote): Phrase
    {
        if (empty($quote["Status"])) {
            return __('Not Defined');
        }

        $orderStatus = (int) $quote["Status"];
        return !empty($this->quoteStatusMapping[$orderStatus]) ?
            __($this->quoteStatusMapping[$orderStatus]) : __('Open');
    }
}
