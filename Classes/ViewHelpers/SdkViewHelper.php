<?php

declare(strict_types=1);

namespace Refresj\FacebookSocialplugins\ViewHelpers;

use TYPO3\CMS\Core\Page\AssetCollector;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Loads the Facebook JavaScript SDK once per page via the AssetCollector.
 *
 * Use as <fb:sdk appId="{settings.appId}" locale="{settings.locale}" />
 */
class SdkViewHelper extends AbstractViewHelper
{

    protected const SDK_VERSION = 'v25.0';

    protected const DEFAULT_LOCALE = 'en_US';

    public function initializeArguments(): void
    {
        $this->registerArgument('appId', 'string', 'Facebook App ID (optional)', false, '');
        $this->registerArgument('locale', 'string', 'SDK locale, e.g. nl_NL', false, self::DEFAULT_LOCALE);
    }

    public function render(): string
    {
        $appId  = trim((string)$this->arguments['appId']);
        $locale = (string)$this->arguments['locale'];

        if (preg_match('/^[a-z]{2}_[A-Z]{2}$/', $locale) !== 1) {
            $locale = self::DEFAULT_LOCALE;
        }

        $parameters = [
            'xfbml'   => '1',
            'version' => self::SDK_VERSION,
        ];

        if ($appId !== '') {
            $parameters['appId'] = $appId;
        }

        GeneralUtility::makeInstance(AssetCollector::class)->addJavaScript(
            'facebook-jssdk',
            'https://connect.facebook.net/' . $locale . '/sdk.js#' . http_build_query($parameters, '', '&'),
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
