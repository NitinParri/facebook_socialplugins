<?php

declare(strict_types=1);

namespace Refresj\FacebookSocialplugins\ViewHelpers;

use TYPO3\CMS\Core\Page\AssetCollector;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 *   Use as <fb:sdk appId="{settings.appId}" locale="{settings.locale}" />
 */
class SdkViewHelper extends AbstractViewHelper
{

    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        $this->registerArgument('appId', 'string', 'Facebook App ID', true);
        $this->registerArgument('locale', 'string', 'SDK locale, bijv. nl_NL', false, 'nl_NL');
    }

    public function render(): string
    {
        $appId  = htmlspecialchars((string)$this->arguments['appId'], ENT_QUOTES, 'UTF-8');
        $locale = htmlspecialchars((string)$this->arguments['locale'], ENT_QUOTES, 'UTF-8');

        $assetCollector = GeneralUtility::makeInstance(AssetCollector::class);

        $initScript = "
window.fbAsyncInit = function() {
    FB.init({
        appId   : '" . $appId . "',
        xfbml   : true,
        version : 'v25.0'
    });
};
        ";

        $assetCollector->addInlineJavaScript(
            'facebook-jssdk-init',
            $initScript,
            [],
            ['priority' => true]
        );

        $assetCollector->addJavaScript(
            'facebook-jssdk',
            'https://connect.facebook.net/' . $locale . '/sdk.js',
            [
                'async'       => 'async',
                'defer'       => 'defer',
                'crossorigin' => 'anonymous',
            ],
            ['priority' => false]
        );

        return '';
    }
}
