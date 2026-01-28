<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CheckoutPage;

use SprykerShop\Yves\CheckoutPage\CheckoutPageConfig as SprykerCheckoutPageConfig;

class CheckoutPageConfig extends SprykerCheckoutPageConfig
{
    /**
     * @return array<string>
     */
    public function getLocalizedTermsAndConditionsPageLinks(): array
    {
        return [
            'en_US' => '/en/gtc',
            'de_DE' => '/de/agb',
        ];
    }
    /**
     * Specification:
     * - Returns keys that are used to filter out payment methods during the checkout process on the Payment step.
     *
     * @api
     *
     * @return list<string>
     */
    public function getExcludedPaymentMethodKeys(): array
    {
        return [
            'payone-paypal-express',
        ];
    }
}
