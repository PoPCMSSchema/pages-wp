<?php

declare(strict_types=1);

namespace PoP\PagesWP\TypeAPIs;

use WP_Post;
use PoP\Pages\TypeAPIs\PageTypeAPIInterface;
/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
class PageTypeAPI implements PageTypeAPIInterface
{
    /**
     * Indicates if the passed object is of type Page
     *
     * @param [type] $object
     * @return boolean
     */
    public function isInstanceOfPageType($object): bool
    {
        return ($object instanceof WP_Post) && $object->post_type == 'page';
    }
}
