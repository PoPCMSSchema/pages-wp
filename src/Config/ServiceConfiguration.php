<?php

declare(strict_types=1);

namespace PoPSchema\PagesWP\Config;

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
            \PoPSchema\Pages\TypeResolverPickers\Optional\PageCustomPostTypeResolverPicker::class,
            \PoPSchema\PagesWP\TypeResolverPickers\Overrides\PageCustomPostTypeResolverPicker::class
        );
    }
}
