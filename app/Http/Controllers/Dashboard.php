<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyStatistic;
use App\Models\Product;
use App\Models\HeroSection;
use App\Models\OurTeam;
use App\Models\CompanyAbout;
use App\Models\CompanyKeypoint;
use App\Models\ContactPerson;
use App\Models\User;
class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetching data from the database
        $companyStatistics = CompanyStatistic::all();
        $products = Product::all();
        $heroSections = HeroSection::all();
        $ourTeams = OurTeam::all();
        $companyAbouts = CompanyAbout::all();
        $companyKeypoints = CompanyKeypoint::all();
        $contactPeople = ContactPerson::all();
        $users = User::all();

        // Passing data to the view
        return view('dashboard', compact(
            'companyStatistics',
            'products',
            'heroSections',
            'ourTeams',
            'companyAbouts',
            'companyKeypoints',
            'contactPeople',
            'users'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
