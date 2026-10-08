<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Promo;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'total_categories' => Category::count(),
            'active_promos' => Promo::where('is_active', true)->count(),
            'total_admins' => User::count(),
        ];

        $recentProducts = Product::with('category')->latest()->take(5)->get();
        $recentCategories = Category::withCount('products')->latest()->take(5)->get();
        $activePromos = Promo::where('is_active', true)->latest()->take(3)->get();
        $company = CompanyProfile::first();
        $contact = Contact::first();

        return view('admin.dashboard', compact('stats', 'recentProducts', 'recentCategories', 'activePromos', 'company', 'contact'));
    }
}
