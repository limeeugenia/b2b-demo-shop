<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\Router;

use Spryker\Client\Kernel\Container;
use Spryker\Yves\Router\RouterConfig as SprykerRouterConfig;

/**
 * @method \Spryker\Shared\Router\RouterConfig getSharedConfig()
 */
class RouterConfig extends SprykerRouterConfig
{
    /**
     * @see \Spryker\Yves\Router\Plugin\RouterEnhancer\LanguagePrefixRouterEnhancerPlugin
     *
     * @return array<string>
     */
    public function getAllowedLanguages(): array
    {
        return (new Container())->getLocator()->locale()->client()->getAllowedLanguages();
    }
    /**
     * Specification:
     * - Returns a list of supported stores for Route manipulation.
     * - Will be used to strip of store information from a route before a route is matched.
     *
     * @api
     *
     * @example Incoming URL `/DE/home` will be manipulated to `/home` because the router only knows URL's without any optional pre/suffix.
     *
     * @see \Spryker\Yves\Router\Plugin\RouterEnhancer\StorePrefixRouterEnhancerPlugin
     *
     * @return array<string>
     */
    public function getAllowedStores(): array
    {
        return (new \Spryker\Client\Kernel\Container())->getLocator()->storeStorage()->client()->getStoreNames();
    }
}
