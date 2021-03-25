@extends('layouts.dashboard')

@section('header')
    <div class="flex-grow">
        <h1>{{$page->title}}</h1>
        <x-breadcrumbs :path="\App\BreadcrumbsHelper::getPagePath($page)"></x-breadcrumbs>
    </div>
    <button
        class="w-12 h-12 inline-block text-center text-white transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
        <span class="fas fa-plus fa-lg" aria-label="Add new website"></span>
    </button>
@endsection

@section('content')
    Work in progress
@endsection
