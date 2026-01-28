<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Checkout;

use Spryker\Zed\Availability\Communication\Plugin\ProductsAvailableCheckoutPreConditionPlugin;
use Spryker\Zed\CartNote\Communication\Plugin\Checkout\CartNoteSaverPlugin;
use Spryker\Zed\Checkout\CheckoutDependencyProvider as SprykerCheckoutDependencyProvider;
use Spryker\Zed\Customer\Communication\Plugin\Checkout\CustomerAddressSalutationCheckoutPreConditionPlugin;
use Spryker\Zed\Customer\Communication\Plugin\Checkout\CustomerOrderSavePlugin;
use Spryker\Zed\Customer\Communication\Plugin\CustomerPreConditionCheckerPlugin;
use Spryker\Zed\Discount\Communication\Plugin\Checkout\DiscountOrderSavePlugin;
use Spryker\Zed\Discount\Communication\Plugin\Checkout\VoucherDiscountMaxUsageCheckoutPreConditionPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Payment\Communication\Plugin\Checkout\PaymentAuthorizationCheckoutPostSavePlugin;
use Spryker\Zed\Payment\Communication\Plugin\Checkout\PaymentMethodValidityCheckoutPreConditionPlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\Checkout\ProductBundleAvailabilityCheckoutPreConditionPlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\Checkout\ProductBundleOrderSaverPlugin;
use Spryker\Zed\ProductCartConnector\Communication\Plugin\Checkout\ProductExistsCheckoutPreConditionPlugin;
use Spryker\Zed\ProductConfigurationCart\Communication\Plugin\Checkout\ProductConfigurationCheckoutPreConditionPlugin;
use Spryker\Zed\ProductDiscontinued\Communication\Plugin\Checkout\ProductDiscontinuedCheckoutPreConditionPlugin;
use Spryker\Zed\ProductOption\Communication\Plugin\Checkout\ProductOptionOrderSaverPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\Checkout\AmountAvailabilityCheckoutPreConditionPlugin;
use Spryker\Zed\ProductQuantity\Communication\Plugin\Checkout\ProductQuantityRestrictionCheckoutPreConditionPlugin;
use Spryker\Zed\QuoteApproval\Communication\Plugin\Checkout\QuoteApprovalCheckoutPreConditionPlugin;
use Spryker\Zed\QuoteRequest\Communication\Plugin\Checkout\CloseQuoteRequestCheckoutPostSaveHookPlugin;
use Spryker\Zed\QuoteRequest\Communication\Plugin\Checkout\QuoteRequestPreCheckPlugin;
use Spryker\Zed\Sales\Communication\Plugin\Checkout\DuplicateOrderCheckoutPreConditionPlugin;
use Spryker\Zed\Sales\Communication\Plugin\Checkout\OrderItemsSaverPlugin;
use Spryker\Zed\Sales\Communication\Plugin\Checkout\OrderSaverPlugin;
use Spryker\Zed\Sales\Communication\Plugin\Checkout\OrderTotalsSaverPlugin;
use Spryker\Zed\Sales\Communication\Plugin\SalesOrderExpanderPlugin;
use Spryker\Zed\SalesOrderThreshold\Communication\Plugin\Checkout\SalesOrderThresholdCheckoutPreConditionPlugin;
use Spryker\Zed\SalesOrderThreshold\Communication\Plugin\Checkout\SalesOrderThresholdExpenseSavePlugin;
use Spryker\Zed\SalesPayment\Communication\Plugin\Checkout\SalesPaymentCheckoutDoSaveOrderPlugin;
use Spryker\Zed\Shipment\Communication\Plugin\Checkout\SalesOrderShipmentSavePlugin;
use Spryker\Zed\ShipmentCheckoutConnector\Communication\Plugin\Checkout\ShipmentCheckoutPreCheckPlugin;

class CheckoutDependencyProvider extends SprykerCheckoutDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\CheckoutExtension\Dependency\Plugin\CheckoutPreConditionPluginInterface>
     */
    protected function getCheckoutPreConditions(Container $container): array
    {
        return [
            new CustomerPreConditionCheckerPlugin(),
            new CustomerAddressSalutationCheckoutPreConditionPlugin(),
            new ProductsAvailableCheckoutPreConditionPlugin(),
            new ProductBundleAvailabilityCheckoutPreConditionPlugin(),
            new ShipmentCheckoutPreCheckPlugin(),
            new ProductDiscontinuedCheckoutPreConditionPlugin(), #ProductDiscontinuedFeature
            new AmountAvailabilityCheckoutPreConditionPlugin(),
            new SalesOrderThresholdCheckoutPreConditionPlugin(), #SalesOrderThresholdFeature
            new VoucherDiscountMaxUsageCheckoutPreConditionPlugin(),
            new QuoteRequestPreCheckPlugin(),
            new QuoteApprovalCheckoutPreConditionPlugin(),
            new PaymentMethodValidityCheckoutPreConditionPlugin(),
            new DuplicateOrderCheckoutPreConditionPlugin(),
            new ProductExistsCheckoutPreConditionPlugin(),
            new ProductConfigurationCheckoutPreConditionPlugin(),
            new ProductQuantityRestrictionCheckoutPreConditionPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\CheckoutExtension\Dependency\Plugin\CheckoutDoSaveOrderInterface>|array<\Spryker\Zed\Checkout\Dependency\Plugin\CheckoutSaveOrderInterface>
     */
    protected function getCheckoutOrderSavers(Container $container): array
    {
        return [
            new CustomerOrderSavePlugin(),
            /*
             * Plugins
             * `OrderSaverPlugin`,
             * `OrderTotalsSaverPlugin`,
             * `SalesOrderShipmentSavePlugin`,
             * `OrderItemsSaverPlugin`,
             * must be enabled in the strict order.
             */
            new OrderSaverPlugin(),
            new OrderTotalsSaverPlugin(),
            new SalesOrderShipmentSavePlugin(),
            new OrderItemsSaverPlugin(),
            new CartNoteSaverPlugin(),
            new DiscountOrderSavePlugin(),
            new ProductBundleOrderSaverPlugin(),
            new SalesPaymentCheckoutDoSaveOrderPlugin(),
            new SalesOrderThresholdExpenseSavePlugin(), #SalesOrderThresholdFeature
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\CheckoutExtension\Dependency\Plugin\CheckoutPostSaveInterface>
     */
    protected function getCheckoutPostHooks(Container $container): array
    {
        return [
            new CloseQuoteRequestCheckoutPostSaveHookPlugin(),
            new PaymentAuthorizationCheckoutPostSavePlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\Checkout\Dependency\Plugin\CheckoutPreSaveInterface>|array<\Spryker\Zed\Checkout\Dependency\Plugin\CheckoutPreSaveHookInterface>
     */
    protected function getCheckoutPreSaveHooks(Container $container): array
    {
        return [
            new SalesOrderExpanderPlugin(),
        ];
    }
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return list<\Spryker\Zed\CheckoutExtension\Dependency\Plugin\CheckoutPreConditionPluginInterface>
     */
    protected function getCheckoutPreConditionsForOrderAmendment(\Spryker\Zed\Kernel\Container $container)
    {
        return [
            new Spryker\Zed\QuoteCheckoutConnector\Communication\Plugin\Checkout\DisallowedQuoteCheckoutPreConditionPlugin(),
            new Spryker\Zed\Customer\Communication\Plugin\CustomerPreConditionCheckerPlugin(),
            new Spryker\Zed\Customer\Communication\Plugin\Checkout\CustomerSalutationCheckoutPreConditionPlugin(),
            new Spryker\Zed\Customer\Communication\Plugin\Checkout\CustomerAddressSalutationCheckoutPreConditionPlugin(),
            new Spryker\Zed\Availability\Communication\Plugin\ProductsAvailableCheckoutPreConditionPlugin(),
            new Spryker\Zed\DummyPayment\Communication\Plugin\Checkout\DummyPaymentCheckoutPreConditionPlugin(),
            new Spryker\Zed\ShipmentCheckoutConnector\Communication\Plugin\Checkout\ShipmentCheckoutPreCheckPlugin(),
            new Spryker\Zed\ProductDiscontinued\Communication\Plugin\Checkout\ProductDiscontinuedCheckoutPreConditionPlugin(),
            new Spryker\Zed\ProductPackagingUnit\Communication\Plugin\Checkout\AmountAvailabilityCheckoutPreConditionPlugin(),
            new Spryker\Zed\QuoteRequest\Communication\Plugin\Checkout\QuoteRequestPreCheckPlugin(),
            new Spryker\Zed\QuoteApproval\Communication\Plugin\Checkout\QuoteApprovalCheckoutPreConditionPlugin(),
            new Spryker\Zed\Merchant\Communication\Plugin\Checkout\MerchantCheckoutPreConditionPlugin(),
            new Spryker\Zed\MerchantSwitcher\Communication\Plugin\Checkout\SingleMerchantCheckoutPreConditionPlugin(),
            new Spryker\Zed\Payment\Communication\Plugin\Checkout\PaymentMethodValidityCheckoutPreConditionPlugin(),
            new Spryker\Zed\ProductConfigurationCart\Communication\Plugin\Checkout\ProductConfigurationCheckoutPreConditionPlugin(),
            new Spryker\Zed\MerchantProductOption\Communication\Plugin\Checkout\MerchantProductOptionCheckoutPreConditionPlugin(),
            new Spryker\Zed\ProductCartConnector\Communication\Plugin\Checkout\ProductExistsCheckoutPreConditionPlugin(),
            new Spryker\Zed\ProductApproval\Communication\Plugin\Checkout\ProductApprovalCheckoutPreConditionPlugin(),
            new Spryker\Zed\ShipmentTypeCart\Communication\Plugin\Checkout\ShipmentTypeCheckoutPreConditionPlugin(),
            new Spryker\Zed\ServicePointCart\Communication\Plugin\Checkout\ServicePointCheckoutPreConditionPlugin(),
            new Spryker\Zed\ProductQuantity\Communication\Plugin\Checkout\ProductQuantityRestrictionCheckoutPreConditionPlugin(),
            new Spryker\Zed\ProductBundle\Communication\Plugin\Checkout\ProductBundleAvailabilityCheckoutPreConditionPlugin(),
            new Spryker\Zed\Sales\Communication\Plugin\Checkout\DuplicateOrderCheckoutPreConditionPlugin(),
        ];
    }
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return list<\Spryker\Zed\Checkout\Dependency\Plugin\CheckoutSaveOrderInterface|\Spryker\Zed\CheckoutExtension\Dependency\Plugin\CheckoutDoSaveOrderInterface>
     */
    protected function getCheckoutOrderSaversForOrderAmendment(\Spryker\Zed\Kernel\Container $container)
    {
        return [
            new Spryker\Zed\Customer\Communication\Plugin\Checkout\CustomerOrderSavePlugin(),
            new Spryker\Zed\SalesShipmentType\Communication\Plugin\Checkout\ShipmentTypeCheckoutDoSaveOrderPlugin(),
            new Spryker\Zed\ProductBundle\Communication\Plugin\Checkout\ProductBundleOrderSaverPlugin(),
            new Spryker\Zed\Sales\Communication\Plugin\Checkout\UpdateOrderByQuoteCheckoutDoSaveOrderPlugin(),
            new Spryker\Zed\Sales\Communication\Plugin\Checkout\OrderTotalsSaverPlugin(),
            new Spryker\Zed\Shipment\Communication\Plugin\Checkout\ReplaceSalesOrderShipmentCheckoutDoSaveOrderPlugin(),
        ];
    }
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return list<\Spryker\Zed\CheckoutExtension\Dependency\Plugin\CheckoutPostSaveInterface>
     */
    protected function getCheckoutPostHooksForOrderAmendment(\Spryker\Zed\Kernel\Container $container)
    {
        return [
            new Spryker\Zed\DummyPayment\Communication\Plugin\Checkout\DummyPaymentCheckoutPostSavePlugin(),
            new Spryker\Zed\QuoteRequest\Communication\Plugin\Checkout\CloseQuoteRequestCheckoutPostSaveHookPlugin(),
            new Spryker\Zed\GiftCardMailConnector\Communication\Plugin\Checkout\SendEmailToGiftCardUser(),
            new Spryker\Zed\Payment\Communication\Plugin\Checkout\PaymentAuthorizationCheckoutPostSavePlugin(),
            new Spryker\Zed\Payment\Communication\Plugin\Checkout\PaymentConfirmPreOrderPaymentCheckoutPostSavePlugin(),
        ];
    }
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return list<\Spryker\Zed\Checkout\Dependency\Plugin\CheckoutPreSaveHookInterface|\Spryker\Zed\Checkout\Dependency\Plugin\CheckoutPreSaveInterface|\Spryker\Zed\CheckoutExtension\Dependency\Plugin\CheckoutPreSavePluginInterface>
     */
    protected function getCheckoutPreSaveHooksForOrderAmendment(\Spryker\Zed\Kernel\Container $container)
    {
        return [
            new Spryker\Zed\QuoteCheckoutConnector\Communication\Plugin\Checkout\DisallowQuoteCheckoutPreSavePlugin(),
            new Spryker\Zed\Sales\Communication\Plugin\SalesOrderExpanderPlugin(),
        ];
    }
}
