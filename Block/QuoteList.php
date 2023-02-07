<?php

namespace Commerce365\Quotes\Block;

use Commerce365\Core\Block\AbstractList;
use Commerce365\Core\Service\GetSalesDocuments;
use Commerce365\Core\Service\SalesDocumentInterface;
use Commerce365\Quotes\Service\GetQuoteStatus;
use Magento\Framework\Phrase;
use Magento\Framework\View\Element\Template\Context;

class QuoteList extends AbstractList
{
    protected const URL = 'quotes/quotelist';
    protected const VIEW_URL = 'quotes/quotedetails';

    private GetSalesDocuments $getSalesDocuments;
    private GetQuoteStatus $getQuoteStatus;

    public function __construct(
        Context $context,
        GetSalesDocuments $getSalesDocuments,
        GetQuoteStatus $getQuoteStatus,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->getSalesDocuments = $getSalesDocuments;
        $this->getQuoteStatus = $getQuoteStatus;
    }

    public function getQuotes()
    {
        $query = $this->processQuery([
            'tableNo' => SalesDocumentInterface::QUOTE_ORDER_TABLE_NO,
            'documentType' => 0
        ]);

        return $this->getSalesDocuments->execute($query);
    }

    /**
     * @param array $quote
     * @return Phrase
     */
    public function getQuoteStatus(array $quote): Phrase
    {
        return $this->getQuoteStatus->execute($quote);
    }
}
