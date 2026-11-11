<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Security\ContentSecurityPolicy\Directive;
use TYPO3\CMS\Core\Security\ContentSecurityPolicy\Mutation;
use TYPO3\CMS\Core\Security\ContentSecurityPolicy\MutationCollection;
use TYPO3\CMS\Core\Security\ContentSecurityPolicy\MutationMode;
use TYPO3\CMS\Core\Security\ContentSecurityPolicy\Scope;
use TYPO3\CMS\Core\Security\ContentSecurityPolicy\UriValue;
use TYPO3\CMS\Core\Type\Map;

return Map::fromEntries([
    Scope::frontend(),
    new MutationCollection(

        // Facebook JavaScript SDK
        new Mutation(
            MutationMode::Extend,
            Directive::ScriptSrcElem,
            new UriValue('https://connect.facebook.net')
        ),

        // App configuration request of the Facebook JavaScript SDK
        new Mutation(
            MutationMode::Extend,
            Directive::ConnectSrc,
            new UriValue('https://connect.facebook.net')
        ),

        // Iframes of the Facebook Social Plugins
        new Mutation(
            MutationMode::Extend,
            Directive::FrameSrc,
            new UriValue('https://*.facebook.com')
        ),
    ),
]);
