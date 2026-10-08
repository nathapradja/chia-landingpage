<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Contact;

class AboutController extends Controller
{
    public function index()
    {
        $company = CompanyProfile::first() ?? new CompanyProfile();
        $contact = Contact::first() ?? new Contact();

        return view('about', compact('company', 'contact'));
    }
}
