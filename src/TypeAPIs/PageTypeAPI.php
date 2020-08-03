<?php

declare(strict_types=1);

namespace PoP\PagesWP\TypeAPIs;

use WP_Post;
use function get_post;
use function get_option;
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\Pages\ComponentConfiguration;
use PoP\Pages\TypeAPIs\PageTypeAPIInterface;
use PoP\CustomPostsWP\TypeAPIs\CustomPostTypeAPI;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
class PageTypeAPI extends CustomPostTypeAPI implements PageTypeAPIInterface
{
    /**
     * Add an extra hook just to modify pages
     *
     * @param [type] $query
     * @param array $options
     * @return array
     */
    protected function convertCustomPostsQuery(array $query, array $options = []): array
    {
        $query = parent::convertCustomPostsQuery($query, $options);
        return HooksAPIFacade::getInstance()->applyFilters(
            'CMSAPI:pages:query',
            $query,
            $options
        );
    }

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
    public function getPage($id)
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

    /**
     * Limit of how many custom posts can be retrieved in the query.
     * Override this value for specific custom post types
     *
     * @return integer
     */
    protected function getCustomPostListMaxLimit(): int
    {
        return ComponentConfiguration::getPageListMaxLimit();
    }

    public function getPages(array $query, array $options = []): array
    {
        $query['custom-post-types'] = ['page'];
        return $this->getCustomPosts($query, $options);
    }
    public function getPageCount(array $query = [], array $options = []): int
    {
        $query['custom-post-types'] = ['page'];
        return $this->getCustomPostCount($query, $options);
    }
    public function getPageCustomPostType(): string
    {
        return 'page';
    }

    /**
     * Get the ID of the static page for the homepage
     * Returns an ID (int? string?) or null
     *
     * @return null|ID
     */
    public function getHomeStaticPageID()
    {
        if (get_option('show_on_front') !== 'page') {
            // Errors go in here
            return null;
        }

        // This is the expected operation
        $static_page_id = (int) get_option('page_on_front');
        return $static_page_id > 0 ? $static_page_id : null;
    }
}
