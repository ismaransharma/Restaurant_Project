<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
}