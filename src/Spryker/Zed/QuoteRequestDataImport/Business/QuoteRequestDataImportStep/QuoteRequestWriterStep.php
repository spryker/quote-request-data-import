<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Zed\QuoteRequestDataImport\Business\QuoteRequestDataImportStep;

use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\QuoteRequestDataImport\Business\DataSet\QuoteRequestDataSetInterface;

class QuoteRequestWriterStep implements DataImportStepInterface
{
    public function execute(DataSetInterface $dataSet): void
    {
        $quoteRequestEntity = $this->createQuoteRequestQuery()
            ->filterByQuoteRequestReference($dataSet[QuoteRequestDataSetInterface::COLUMN_QUOTE_REQUEST_REFERENCE])
            ->findOneOrCreate();

        $quoteRequestEntity
            ->setQuoteRequestReference($dataSet[QuoteRequestDataSetInterface::COLUMN_QUOTE_REQUEST_REFERENCE])
            ->setFkCompanyUser($dataSet[QuoteRequestDataSetInterface::ID_COMPANY_USER])
            ->setStatus($dataSet[QuoteRequestDataSetInterface::COLUMN_QUOTE_REQUEST_STATUS])
            ->save();
    }

    protected function createQuoteRequestQuery(): SpyQuoteRequestQuery
    {
        return SpyQuoteRequestQuery::create();
    }
}
