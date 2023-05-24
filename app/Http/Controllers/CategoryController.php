<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all()->where('parent_id', null);
        return view('categories.index', compact('categories'));
    }

    public function show($slug): View
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category->is_active) {
            abort(400);
        }

        $banners = $category->banners()
            ->where('is_active', true)
            ->orderByDesc('active_from')
            ->take(5)
            ->get();
        
        return view('categories.show', compact('category', 'banners'));
    }
}