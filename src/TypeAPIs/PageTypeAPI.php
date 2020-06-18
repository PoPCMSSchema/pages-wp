<?php

declare(strict_types=1);

namespace PoP\PagesWP\TypeAPIs;

use function get_post;
use WP_Post;
use PoP\Pages\TypeAPIs\PageTypeAPIInterface;
use PoP\CustomPostsWP\TypeAPIs\CustomPostTypeAPI;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
class PageTypeAPI extends CustomPostTypeAPI implements PageTypeAPIInterface
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

    /**
     * Get the page with provided ID or, if it doesn't exist, null
     *
     * @param int $id
     * @return void
     */
    public function getPage($id): ?object
    {
        $page = get_post($id);
        if (!$page || $page->post_type != 'page') {
            return null;
        }
        return $page;
    }

    /**
     * Indicate if an page with provided ID exists
     *
     * @param int $id
     * @return void
     */
    public function pageExists($id): bool
    {
        return $this->getPage($id) != null;
    }

    public function getPages(array $query, array $options = []): array
    {
        $query['post-types'] = ['page'];
        return $this->getCustomPosts($query, $options);
    }
    public function getPageCount(array $query = [], array $options = []): int
    {
        $query['post-types'] = ['page'];
        return $this->getCustomPostCount($query, $options);
    }
    public function getPageCustomPostType(): string
    {
        return 'page';
    }
}
