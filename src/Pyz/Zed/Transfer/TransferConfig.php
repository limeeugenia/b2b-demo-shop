<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Transfer;

use Spryker\Shared\Transfer\TransferConstants;
use Spryker\Zed\Transfer\TransferConfig as SprykerTransferConfig;

class TransferConfig extends SprykerTransferConfig
{
    /**
     * @return array<string>
     */
    public function getEntitiesSourceDirectories(): array
    {
        return [
            APPLICATION_SOURCE_DIR . '/Orm/Propel/*/Schema/',
        ];
    }

    /**
     * @return bool
     */
    public function isTransferXmlValidationEnabled(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getPropertyDescriptionMergeStrategy(): string
    {
        return TransferConstants::PROPERTY_DESCRIPTION_MERGE_STRATEGY_GET_FIRST;
    }
    /**
     * Specification:
     * - Controls whether primitive array validation fails on empty array.
     * - When enabled, `require` methods will fail on empty array.
     * - The change of this config requires transfer regeneration to take effect.
     *
     * @api
     *
     * @return bool
     */
    public function isArrayRequireValidationEnabled(): bool
    {
        return true;
    }
}
