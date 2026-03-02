<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Zed\QuoteRequestDataImport\Business;

use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\QuoteRequestDataImport\Business\QuoteRequestDataImportStep\CompanyUserKeyToIdCompanyUser;
use Spryker\Zed\QuoteRequestDataImport\Business\QuoteRequestDataImportStep\QuoteRequestReferenceToIdQuoteRequest;
use Spryker\Zed\QuoteRequestDataImport\Business\QuoteRequestDataImportStep\QuoteRequestVersionWriterStep;
use Spryker\Zed\QuoteRequestDataImport\Business\QuoteRequestDataImportStep\QuoteRequestWriterStep;

/**
 * @method \Spryker\Zed\QuoteRequestDataImport\QuoteRequestDataImportConfig getConfig()
 * @method \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetStepBrokerTransactionAware createTransactionAwareDataSetStepBroker($bulkSize = null)
 * @method \Spryker\Zed\DataImport\Business\Model\DataImporter getCsvDataImporterFromConfig(\Generated\Shared\Transfer\DataImporterConfigurationTransfer $dataImporterConfigurationTransfer)
 */
class QuoteRequestDataImportBusinessFactory extends DataImportBusinessFactory
{
    public function getQuoteRequestDataImporter(): DataImporterInterface
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($this->getConfig()->getQuoteRequestDataImporterConfiguration());

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker
            ->addStep($this->createCompanyUserKeyToIdCompanyUserStep())
            ->addStep($this->createQuoteRequestWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    public function getQuoteRequestVersionDataImporter(): DataImporterInterface
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($this->getConfig()->getQuoteRequestVersionDataImporterConfiguration());

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker
            ->addStep($this->createQuoteRequestReferenceToIdQuoteRequestStep())
            ->addStep($this->createQuoteRequestVersionWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    public function createQuoteRequestWriterStep(): DataImportStepInterface
    {
        return new QuoteRequestWriterStep();
    }

    public function createQuoteRequestVersionWriterStep(): DataImportStepInterface
    {
        return new QuoteRequestVersionWriterStep();
    }

    public function createQuoteRequestReferenceToIdQuoteRequestStep(): DataImportStepInterface
    {
        return new QuoteRequestReferenceToIdQuoteRequest();
    }

    public function createCompanyUserKeyToIdCompanyUserStep(): DataImportStepInterface
    {
        return new CompanyUserKeyToIdCompanyUser();
    }
}
