<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\ProductImage;

use Spryker\Shared\ProductImage\ProductImageConfig as SprykerProductImageConfig;

class ProductImageConfig extends SprykerProductImageConfig
{
    /**
     * @api
     *
     * @deprecated This method will be removed in the next major version. Product image alternative text will be enabled by default.
     *
     * Specification:
     * - Enable or disable product image alternative text feature.
     *
     * @return bool
     */
    public function isProductImageAlternativeTextEnabled(): bool
    {
        return true;
    }
}