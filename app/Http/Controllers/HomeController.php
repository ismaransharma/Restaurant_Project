<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\AboutUs;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // Hero Section ko Logic Starts Here

    // Get Hero 
    public function getHeroManage()
    {
        
        $data = [
            'heroes' => Hero::where('deleted_at', null)->orderby('id', 'asc')->get(),
        ];

        return view('admin.hero.manage', $data);
    }

    // Add Hero
    public function postaddHero(Request $request){
        // dd($request->all());

        $request->validate([
            'hero_title' => 'required',
            'status' => 'required|in:active,inactive',
            'hero_image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'hero_description' => 'required',
            
        ]);
        
        $hero_title = $request->input('hero_title');
        $hero_description = $request->input('hero_description');
        $status = $request->input('status');
        $slug = Str::slug($hero_title);
        $image = $request->file('hero_image');

        if($image){
            $unique_name = sha1(time());
            $extension = $image->getClientOriginalExtension();
            $hero_image = $unique_name . '.' . $extension;
            $image->move('uploads/hero/', $hero_image);
        };



        $hero = new Hero;
        $hero->hero_title=$hero_title;
        $hero->status=$status;
        $hero->slug=$slug;
        $hero->hero_description=$hero_description;
        $hero->hero_image=$hero_image;

        // dd($request->all());
        
        $hero->save();
        return redirect()->back()->with('success', 'Hero Section Added Successfully...');
    }

    // Get Hero Edit
    public function getEditHero($slug)
    {
        $heroes = Hero::where('slug', $slug)->where('deleted_at', null)->limit(1)->first();
        $data = [
            'heroes' => $heroes,
        ];

        return view('admin.hero.edit', $data);
    }

    // Post Edit Hero
    public function postEditHero(Request $request, $slug){
        
        $hero = Hero::where('slug', $slug)->where('deleted_at', null)->limit(1)->first();

        if (is_null ($hero)) {
            return redirect()->back()->with('error', 'Hero Section not found');
        }

        // dd($request->all());

        $request->validate([
            'hero_title' => 'required',
            'status' => 'required|in:active,inactive',
            'hero_image' => 'image|mimes:jpeg,jpg,png,gif',
            'hero_description' => 'required',
            
        ]);

        $hero_title = $request->input('hero_title');
        $hero_description = $request->input('hero_description');
        $status = $request->input('status');
        $slug = Str::slug($hero_title);
        $image = $request->file('hero_image');

        if($image){
            $unique_name = sha1(time());
            $extension = $image->getClientOriginalExtension();
            $hero_image = $unique_name . '.' . $extension;
            $image->move('uploads/hero/', $hero_image);

            if ($hero->hero_image != null){
                unlink('uploads/hero/' . $heroes->hero_image);
            }
        };

        // dd($heroes->hero_title);

        $hero->hero_title=$hero_title;
        $hero->status=$status;
        $hero->slug=$slug;
        $hero->hero_description=$hero_description;
        
        if($image){
            $hero->hero_image=$hero_image;
            
        }

        // dd($request->all());
        
        $hero->save();
        return redirect()->route('getHeroManage')->with('success', 'Hero Section Edited Successfully...');

        

    }

    // Get Delete Hero
    public function getDeleteHero($slug)
    {
        $hero = Hero::where('slug', $slug)->where('deleted_at', null)->limit(1)->first();
        if(is_null($hero)){
            return redirect()->back()->with('error', 'Hero not found');
        }
        
        $hero->deleted_at = Carbon::now();
        $hero->save();
        
        return redirect()->back()->with('success', 'Hero Section deleted successfully');
        
    }
    // Hero Section ko Logic Ends Here


    // About Us Section ko Logic Starts Here

    public function getAboutUsManage()
    {
        $data = [
            'AboutUs' => AboutUs::where('deleted_at', null)->get()
        ];
        return view('admin.about_us.manage', $data);
        
    }
    
    // AboutUs Sectin lai add garneko logic
    public function postaddAboutUs(Request $request)
    {
        $request->validate([
            'first_description' => 'required',
            'first_point' => 'required',
            'second_point' => 'required',
            'third_point' => 'required',
            'last_description' => 'required',
            'about_us_image' => 'required|image|mimes:png,jpeg,jpg,gif',
            'contact_us_number' => 'required',
        ]);

        $first_description = $request->input('first_description');
        $first_point = $request->input('first_point');
        $second_point = $request->input('second_point');
        $third_point = $request->input('third_point');
        $last_description = $request->input('last_description');
        $slug = Str::slug($first_description);
        $status = $request->input('status');
        $contact_us_number = $request->input('contact_us_number');
        $image = $request->file('about_us_image');

        if ($image) {
            $unique_name = sha1(time());
            $extension = $image->getClientOriginalExtension();
            $about_us_image = $unique_name . '.' . $extension;
            $image->move('uploads/AboutUs/', $about_us_image);
        }

        // dd($request->all());

        $AboutUs = new AboutUs;
        $AboutUs->first_description = $first_description;
        $AboutUs->first_point = $first_point;
        $AboutUs->second_point = $second_point;
        $AboutUs->third_point = $third_point;
        $AboutUs->last_description = $last_description;
        $AboutUs->slug = $slug;
        $AboutUs->status = $status;
        $AboutUs->contact_us_number = $contact_us_number;
        $AboutUs->about_us_image = $about_us_image;

        $AboutUs->save();

        return redirect()->back()->with('success', 'About Us Section Added Successfully');
    }

    // AboutUs section edit garne
    public function getEditAboutUs($slug)
    {
        $AboutUs = AboutUs::where('slug', $slug)->where('deleted_at', null)->limit(1)->first();

        $data = [
            'AboutUs' => $AboutUs,
        ];
        return view('admin.about_us.edit', $data);
    }

    // AboutUs section edit garne logic
    public function postEditAboutUs(Request $request, $slug)
    {
        $AboutUs = AboutUs::where('slug', $slug)->where('deleted_at', null)->limit(1)->first();

        if (is_null ($AboutUs)) {
            return redirect()->back()->with('error', 'Hero Section not found');
        }

        // dd($request->all());
        $request->validate([
            'first_description' => 'required',
            'first_point' => 'required',
            'second_point' => 'required',
            'third_point' => 'required',
            'last_description' => 'required',
            'about_us_image' => 'image|mimes:png,jpeg,jpg,gif',
        ]);

        
        $first_description = $request->input('first_description');
        $first_point = $request->input('first_point');
        $second_point = $request->input('second_point');
        $third_point = $request->input('third_point');
        $last_description = $request->input('last_description');
        $slug = Str::slug($first_description);
        $status = $request->input('status');
        $image = $request->file('about_us_image');

        if ($image) {
            $unique_name = sha1(time());
            $extension = $image->getClientOriginalExtension();
            $about_us_image = $unique_name . '.' . $extension;
            $image->move('uploads/AboutUs/', $about_us_image);

            if ($AboutUs->about_us_image != null){
                unlink('uploads/AboutUs/' . $AboutUs->about_us_image);
            }
        }

        
        $AboutUs->first_description = $first_description;
        $AboutUs->first_point = $first_point;
        $AboutUs->second_point = $second_point;
        $AboutUs->third_point = $third_point;
        $AboutUs->last_description = $last_description;
        $AboutUs->slug = $slug;
        $AboutUs->status = $status;

        if($image){
            $AboutUs->about_us_image=$about_us_image;  
        }

        $AboutUs->save();

        return redirect()->route('getAboutUsManage')->with('success', 'About Us Section Added Successfully');

    }

    // AboutUs section delete garne logic
    public function getDeleteAboutUs($slug)
    {
        $AboutUs = AboutUs::where('slug', $slug)->where('deleted_at', null)->limit(1)->first();
        if(is_null($AboutUs)){
            return redirect()->back()->with('error', 'Hero not found');
        }
        
        $AboutUs->deleted_at = Carbon::now();
        $AboutUs->save();
        
        return redirect()->back()->with('success', 'AboutUs Section deleted successfully');
        
    }

}