<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Twig;

use Spryker\Service\UtilDateTime\Plugin\Twig\DateTimeFormatterTwigPlugin;
use Spryker\Shared\Twig\Plugin\DebugTwigPlugin;
use Spryker\Shared\Twig\Plugin\FormTwigPlugin;
use Spryker\Shared\Twig\Plugin\RoutingTwigPlugin;
use Spryker\Shared\Twig\Plugin\SecurityTwigPlugin;
use Spryker\Zed\Application\Communication\Plugin\Twig\ApplicationTwigPlugin;
use Spryker\Zed\Barcode\Plugin\Twig\BarcodeTwigPlugin;
use Spryker\Zed\ChartGui\Communication\Plugin\Twig\Chart\ChartGuiTwigPlugin;
use Spryker\Zed\CmsBlock\Communication\Plugin\Twig\CmsBlockTemplateTwigLoaderPlugin;
use Spryker\Zed\CmsBlock\Communication\Plugin\Twig\CmsBlockTwigExtensionPlugin;
use Spryker\Zed\Currency\Communication\Plugin\Twig\CurrencyTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\AssetsPathTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Action\BackActionButtonTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Action\CreateActionButtonTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Action\EditActionButtonTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Action\RemoveActionButtonTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Action\ViewActionButtonTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\ButtonGroupTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Form\SubmitButtonTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Table\BackTableButtonTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Table\CreateTableButtonTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Table\EditTableButtonTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Table\RemoveTableButtonTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Table\ViewTableButtonTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\FormRuntimeLoaderTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\GuiFilterTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\GuiTwigLoaderPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\NumberFormatterTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\TabsTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\UrlDecodeTwigPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Twig\UrlTwigPlugin;
use Spryker\Zed\Http\Communication\Plugin\Twig\HttpKernelTwigPlugin;
use Spryker\Zed\Http\Communication\Plugin\Twig\RuntimeLoaderTwigPlugin;
use Spryker\Zed\Money\Communication\Plugin\Twig\MoneyTwigPlugin;
use Spryker\Zed\Scheduler\Communication\Plugin\Twig\SchedulerTwigPlugin;
use Spryker\Zed\Translator\Communication\Plugin\Twig\TranslatorTwigPlugin;
use Spryker\Zed\Twig\Communication\Plugin\FilesystemTwigLoaderPlugin;
use Spryker\Zed\Twig\Communication\Plugin\FormFilesystemTwigLoaderPlugin;
use Spryker\Zed\Twig\TwigDependencyProvider as SprykerTwigDependencyProvider;
use Spryker\Zed\User\Communication\Plugin\Twig\UserTwigPlugin;
use Spryker\Zed\WebProfiler\Communication\Plugin\Twig\WebProfilerTwigLoaderPlugin;
use Spryker\Zed\ZedNavigation\Communication\Plugin\Twig\ZedNavigationTwigPlugin;

class TwigDependencyProvider extends SprykerTwigDependencyProvider
{
    /**
     * @return array<\Spryker\Shared\TwigExtension\Dependency\Plugin\TwigPluginInterface>
     */
    protected function getTwigPlugins(): array
    {
        return [
            new FormTwigPlugin(),
            new HttpKernelTwigPlugin(),
            new RoutingTwigPlugin(),
            new SecurityTwigPlugin(),
            new TranslatorTwigPlugin(),
            new RuntimeLoaderTwigPlugin(),
            new FormRuntimeLoaderTwigPlugin(),
            new ApplicationTwigPlugin(),
            new ChartGuiTwigPlugin(),
            new UserTwigPlugin(),
            new MoneyTwigPlugin(),
            new CurrencyTwigPlugin(),
            new ZedNavigationTwigPlugin(),
            new DateTimeFormatterTwigPlugin(),
            new SchedulerTwigPlugin(),
            new BarcodeTwigPlugin(),
            new CmsBlockTwigExtensionPlugin(),
            new NumberFormatterTwigPlugin(),

            new AssetsPathTwigPlugin(),
            new TabsTwigPlugin(),
            new UrlTwigPlugin(),
            new UrlDecodeTwigPlugin(),
            // navigation buttons
            new ButtonGroupTwigPlugin(),
            new BackActionButtonTwigPlugin(),
            new CreateActionButtonTwigPlugin(),
            new ViewActionButtonTwigPlugin(),
            new EditActionButtonTwigPlugin(),
            new RemoveActionButtonTwigPlugin(),
            // table row buttons
            new EditTableButtonTwigPlugin(),
            new BackTableButtonTwigPlugin(),
            new CreateTableButtonTwigPlugin(),
            new ViewTableButtonTwigPlugin(),
            new RemoveTableButtonTwigPlugin(),
            // Form buttons
            new SubmitButtonTwigPlugin(),
            new GuiFilterTwigPlugin(),
            new Spryker\Shared\Twig\Plugin\VarDumperTwigPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Shared\TwigExtension\Dependency\Plugin\TwigLoaderPluginInterface>
     */
    protected function getTwigLoaderPlugins(): array
    {
        $plugins = [
            new FilesystemTwigLoaderPlugin(),
            new FormFilesystemTwigLoaderPlugin(),
            new GuiTwigLoaderPlugin(),
            new CmsBlockTemplateTwigLoaderPlugin(),
        ];

        if (class_exists(WebProfilerTwigLoaderPlugin::class)) {
            $plugins[] = new WebProfilerTwigLoaderPlugin();
        }

        return $plugins;
    }
    /**
     * @return array<\Spryker\Shared\TwigExtension\Dependency\Plugin\TwigPluginInterface>
     */
    protected function getTwigGatewayPlugins(): array
    {
        return [
            new Spryker\Shared\Twig\Plugin\VarDumperTwigPlugin(),
            new Spryker\Shared\Twig\Plugin\FormTwigPlugin(),
            new Spryker\Zed\Http\Communication\Plugin\Twig\HttpKernelTwigPlugin(),
            new Spryker\Shared\Twig\Plugin\RoutingTwigPlugin(),
            new Spryker\Shared\Twig\Plugin\SecurityTwigPlugin(),
            new Spryker\Zed\Http\Communication\Plugin\Twig\RuntimeLoaderTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\FormRuntimeLoaderTwigPlugin(),
            new Spryker\Zed\Application\Communication\Plugin\Twig\ApplicationTwigPlugin(),
            new Spryker\Zed\ChartGui\Communication\Plugin\Twig\Chart\ChartGuiTwigPlugin(),
            new Spryker\Zed\User\Communication\Plugin\Twig\UserTwigPlugin(),
            new Spryker\Zed\Money\Communication\Plugin\Twig\MoneyTwigPlugin(),
            new Spryker\Zed\Currency\Communication\Plugin\Twig\CurrencyTwigPlugin(),
            new Spryker\Zed\Translator\Communication\Plugin\Twig\TranslatorTwigPlugin(),
            new Spryker\Service\UtilDateTime\Plugin\Twig\DateTimeFormatterTwigPlugin(),
            new Spryker\Zed\ZedUi\Communication\Plugin\ZedUiNavigationTwigPlugin(),
            new Spryker\Zed\Scheduler\Communication\Plugin\Twig\SchedulerTwigPlugin(),
            new Spryker\Zed\Barcode\Plugin\Twig\BarcodeTwigPlugin(),
            new Spryker\Zed\CmsBlock\Communication\Plugin\Twig\CmsBlockTwigExtensionPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\NumberFormatterTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\AssetsPathTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\TabsTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\UrlTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\UrlDecodeTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\ButtonGroupTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Action\BackActionButtonTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Action\CreateActionButtonTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Action\ViewActionButtonTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Action\EditActionButtonTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Action\RemoveActionButtonTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Table\EditTableButtonTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Table\BackTableButtonTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Table\CreateTableButtonTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Table\ViewTableButtonTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Table\RemoveTableButtonTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons\Form\SubmitButtonTwigPlugin(),
            new Spryker\Zed\Gui\Communication\Plugin\Twig\GuiFilterTwigPlugin(),
            new Spryker\Zed\ZedUi\Communication\Plugin\Twig\BooleanToStringTwigPlugin(),
            new Spryker\Zed\GuiTable\Communication\Plugin\Twig\GuiTableConfigurationTwigPlugin(),
            new Spryker\Zed\MerchantUser\Communication\Plugin\Twig\MerchantUserTwigPlugin(),
            new Spryker\Zed\MerchantPortalApplication\Communication\Plugin\Twig\MerchantNavigationTypeTwigPlugin(),
        ];
    }
}
