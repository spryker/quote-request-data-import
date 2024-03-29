<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Zed\QuoteRequestDataImport\Business\DataSet;

interface QuoteRequestDataSetInterface
{
    /**
     * @var string
     */
    public const COLUMN_QUOTE_REQUEST_REFERENCE = 'quote_request_reference';

    /**
     * @var string
     */
    public const COLUMN_COMPANY_USER_KEY = 'company_user_key';

    /**
     * @var string
     */
    public const COLUMN_QUOTE_REQUEST_STATUS = 'quote_request_status';

    /**
     * @var string
     */
    public const ID_QUOTE_REQUEST = 'id_company_user';

    /**
     * @var string
     */
    public const ID_COMPANY_USER = 'id_company_user';
}
