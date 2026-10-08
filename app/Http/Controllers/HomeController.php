<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $company = CompanyProfile::first() ?? new CompanyProfile();
        $contact = Contact::first() ?? new Contact();
        
        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->take(6)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::with('category')
                ->where('is_active', true)
                ->take(6)
                ->get();
        }

        $categories = Category::withCount(['products' => function ($q) {
            $q->where('is_active', true);
        }])->where('is_active', true)->get();

        $promos = Promo::where('is_active', true)->latest()->get();

        return view('home', compact('company', 'contact', 'featuredProducts', 'categories', 'promos'));
    }
}
