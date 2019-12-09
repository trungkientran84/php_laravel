<?php

namespace App;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Events\MenuDisplay;

class Menu extends \TCG\Voyager\Models\Menu
{

    private static function processItems($items)
    {
        $items = $items->transform(function ($item) {
            // Translate title
            $item->title = $item->getTranslatedAttribute('title');
            // Resolve URL/Route
            $item->href = $item->link(true);

            if ($item->href == url()->current() && $item->href != '') {
                // The current URL is exactly the URL of the menu-item
                $item->active = true;
            } elseif (\Illuminate\Support\Str::startsWith(url()->current(), Str::finish($item->href, '/'))) {
                // The current URL is "below" the menu-item URL. For example "admin/posts/1/edit" => "admin/posts"
                $item->active = true;
            }
            if (($item->href == url('') || $item->href == route('voyager.dashboard')) && $item->children->count() > 0) {
                // Exclude sub-menus
                $item->active = false;
            }
            elseif ($item->href == route('user.dashboard') && url()->current() != route('user.dashboard')) {
                // Exclude dashboard
                $item->active = false;
            }

            if ($item->children->count() > 0) {
                $item->setRelation('children', static::processItems($item->children));

                if (!$item->children->where('active', true)->isEmpty()) {
                    $item->active = true;
                }
            }
            return $item;
        });

        // Filter items by permission
        $items = $items->filter(function ($item) {
            return !$item->children->isEmpty() || Auth::user()->can('browse', $item);
        })->filter(function ($item) {
            // Filter out empty menu-items
            if ($item->url == '' && $item->route == '' && $item->children->count() == 0) {
                return false;
            }

            return true;
        });

        return $items->values();
    }

    /**
     * Display menu.
     *
     * @param string      $menuName
     * @param string|null $type
     * @param array       $options
     *
     * @return string
     */
    public static function display($menuName, $type = null, array $options = [])
    {

        // GET THE MENU - sort collection in blade. Store the menu in cache
        $menu = \Cache::remember('font_site_menu_'.$menuName, \Carbon\Carbon::now()->addDays(30), function () use ($menuName) {
            return static::where('name', '=', $menuName)
                ->with(['parent_items.children' => function ($q) {
                    $q->orderBy('order');
                }])
                ->first();
        });


        // Check for Menu Existence
        if (!isset($menu)) {
            return false;

        }

        event(new MenuDisplay($menu));


        // Convert options array into object
        $options = (object) $options;



        $items = $menu->parent_items->sortBy('order');



        if ($type == '_json') {

            $items = static::processItems($items);

        }

        return $items;


        if (!isset($options->locale)) {
            $options->locale = app()->getLocale();
        }

        if ($type === '_json') {
            return $items;
        }
    }


}
