<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('home', [
            'type' => \App\BreadcrumbsHelper::DASHBOARD_ALL,
            'websites' => [...Auth::user()->websites, ...Auth::user()->shared_with]
        ]);
    }

    public function indexOnlyOfProperty()
    {
        return view('home', [
            'type' => \App\BreadcrumbsHelper::DASHBOARD_MINE,
            'websites' => Auth::user()->websites
        ]);
    }

    public function indexOnlyShared()
    {
        return view('home', [
            'type' => \App\BreadcrumbsHelper::DASHBOARD_SHARED,
            'websites' => Auth::user()->shared_with
        ]);
    }

    public function show(int $id)
    {
        return view('website', [
            'website' => Website::findOrFail($id)
        ]);
    }
}
