<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Stock;

use Spryker\Zed\Stock\StockConfig as SprykerStockConfig;

class StockConfig extends SprykerStockConfig
{
    /**
     * @return array<string, list<string>>
     */
    public function getStoreToWarehouseMapping(): array
    {
        return [
            'DE' => [
                'Warehouse1',
                'Warehouse2',
            ],
            'AT' => [
                'Warehouse2',
            ],
            'US' => [
                'Warehouse2',
            ],
        ];
    }
    /**
     * Specification:
     * - For controlling stock related entities update, for example when only name has changed the stock update won't trigger product stock relation update.
     *
     * @api
     *
     * @return bool
     */
    public function isConditionalStockUpdateApplied(): bool
    {
        return true;
    }
    /**
     * Specification:
     * - This event is used for updating stock relations after a stock update.
     *
     * @api
     *
     * @return string|null
     */
    public function getEventQueueName(): ?string
    {
        return Spryker\Shared\Publisher\PublisherConfig::PUBLISH_QUEUE;
    }
}
