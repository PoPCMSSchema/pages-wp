<?php

declare(strict_types=1);

namespace PoP\PagesWP\TypeResolverPickers\Overrides;

use PoP\Pages\Facades\PageTypeAPIFacade;
use PoP\CustomPostsWP\TypeResolverPickers\CustomPostTypeResolverPickerInterface;
use PoP\CustomPostsWP\TypeResolverPickers\NoCastCustomPostTypeResolverPickerTrait;

class PageCustomPostTypeResolverPicker extends \PoP\Pages\TypeResolverPickers\Optional\PageCustomPostTypeResolverPicker implements CustomPostTypeResolverPickerInterface
{
    use NoCastCustomPostTypeResolverPickerTrait;

    public function getCustomPostType(): string
    {
        $pageTypeAPI = PageTypeAPIFacade::getInstance();
        return $pageTypeAPI->getPageCustomPostType();
    }
}
