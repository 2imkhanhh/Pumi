<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Post;
use App\Models\Contact;
use App\Models\Partner;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'posts' => Post::count(),
            'contacts' => Contact::count(),
            'partners' => Partner::count(),
        ];

        $recentContacts = Contact::orderBy('id', 'desc')->take(5)->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recentContacts' => $recentContacts
        ]);
    }
}
