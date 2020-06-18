<?php

declare(strict_types=1);

namespace PoP\PagesWP\Config;

use PoP\Root\Component\PHPServiceConfigurationTrait;
use PoP\ComponentModel\Container\ContainerBuilderUtils;

class ServiceConfiguration
{
    use PHPServiceConfigurationTrait;

    protected static function configure(): void
    {
        ContainerBuilderUtils::injectValuesIntoService(
            'instance_manager',
            'overrideClass',
            \PoP\Pages\TypeResolverPickers\Optional\PageCustomPostTypeResolverPicker::class,
            \PoP\PagesWP\TypeResolverPickers\Overrides\PageCustomPostTypeResolverPicker::class
        );
    }
}
