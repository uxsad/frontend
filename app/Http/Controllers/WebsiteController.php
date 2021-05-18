<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Http\Response
    {
        return response()->view('home', [
            'type' => \App\BreadcrumbsHelper::DASHBOARD_ALL,
            'websites' => [...Auth::user()->websites, ...Auth::user()->shared_with]
        ]);
    }

    /**
     * Display a listing of the resource owned by the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOnlyOfProperty(): \Illuminate\Http\Response
    {
        return response()->view('home', [
            'type' => \App\BreadcrumbsHelper::DASHBOARD_MINE,
            'websites' => Auth::user()->websites
        ]);
    }

    /**
     * Display a listing of the resource shared with the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOnlyShared(): \Illuminate\Http\Response
    {
        return response()->view('home', [
            'type' => \App\BreadcrumbsHelper::DASHBOARD_SHARED,
            'websites' => Auth::user()->shared_with
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id): \Illuminate\Http\Response
    {
        return response()->view('website', [
            'website' => Website::findOrFail($id)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'base_url' => ['required', 'url'],
        ]);

        $website = new Website();
        $website->name = $request->name;
        $website->base_url = $request->base_url;
        $website->user_id = Auth::id();
        $website->save();

        return redirect()->route('websites.show', $website->id);
    }
}
