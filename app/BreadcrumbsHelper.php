<?php


namespace App;


use App\Models\Page;
use App\Models\Website;
use Illuminate\Support\Facades\Auth;

class BreadcrumbsHelper
{
    public const DASHBOARD_ALL = 0;
    public const DASHBOARD_MINE = 1;
    public const DASHBOARD_SHARED = 2;

    private static function breadcrumb(string $title, string $route = null)
    {
        return new class($title, $route) {
            public string $title;
            public string $link;

            function __construct($title, $route)
            {
                $this->title = $title;
                $this->link = $route ?? '#';
            }
        };
    }

    public static function getDashboardPath(int $type = self::DASHBOARD_ALL): array
    {
        $to_add = [];
        if ($type == self::DASHBOARD_MINE) {
            $to_add = [self::breadcrumb('My Websites', route('dashboard.mine'))];
        } elseif ($type == self::DASHBOARD_SHARED) {
            $to_add = [self::breadcrumb('Shared with me', route('dashboard.shared'))];
        }

        return [
            self::breadcrumb('Websites', route('dashboard.all')),
            ...$to_add
        ];
    }

    public static function getWebsitePath(Website $website): array
    {
        return [
            ...self::getDashboardPath($website->owner == Auth::user() ? self::DASHBOARD_MINE : self::DASHBOARD_SHARED),
            self::breadcrumb($website->name, route('websites.show', $website->id))
        ];
    }

    public static function getPagePath(Page $page): array
    {
        return [
            ...self::getWebsitePath($page->website),
            self::breadcrumb($page->title)
        ];
    }
}
