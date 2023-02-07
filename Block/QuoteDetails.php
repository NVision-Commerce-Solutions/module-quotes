<?php

namespace Commerce365\Quotes\Block;

use Commerce365\Core\Service\GetSalesDocument;
use Commerce365\Core\Service\SalesDocumentInterface;
use Commerce365\Quotes\Service\GetQuoteStatus;
use Magento\Framework\Phrase;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class QuoteDetails extends Template
{
    private GetSalesDocument $getSalesDocument;
    private GetQuoteStatus $getQuoteStatus;

    /**
     * @param Context $context
     * @param GetSalesDocument $getSalesDocuments
     * @param GetQuoteStatus $getQuoteStatus
     * @param array $data
     */
    public function __construct(
        Context $context,
        GetSalesDocument $getSalesDocuments,
        GetQuoteStatus $getQuoteStatus,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->getSalesDocument = $getSalesDocuments;
        $this->getQuoteStatus = $getQuoteStatus;
    }

    public function getQuote()
    {
        $query = [
            'tableNo' => SalesDocumentInterface::QUOTE_ORDER_TABLE_NO,
            'documentType' => 0,
            'id' => $this->getRequest()->getParam('id')
        ];

        return $this->getSalesDocument->execute($query);
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
