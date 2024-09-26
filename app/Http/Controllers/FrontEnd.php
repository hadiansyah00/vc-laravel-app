<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import Model "Post
use App\Models\HeroSection;
use App\Models\CompanyAbout;
use App\Models\CompanyKeypoint;



//return type View
use Illuminate\View\View;

class FrontEnd extends Controller
{
    public function index() //Halaman Frontend nya
    {
        //Tampilkan halaman view nya
        $companyAbout = CompanyAbout::latest()->paginate(5);
        $frontendHero = HeroSection::latest()->paginate(5);
        $keypoints = CompanyKeypoint::all();
        //render view with posts
        return view('frontend-home', compact('frontendHero','companyAbout','keypoints'));
    }
}
