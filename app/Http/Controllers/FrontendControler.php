<?php

namespace App\Http\Controllers;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Partner;
use App\Models\ClubIntro;

use App\Models\FeatureCard;
use App\Models\HeroSection;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\PresidentMessage;

class FrontendControler extends Controller
{
    //

    public function frontend(){
         $slides = HeroSection::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

              $items = FeatureCard::active()->ordered()->take(4)->get();

      $club = ClubIntro::active()->latest()->first();

    $pres = PresidentMessage::active()->latest()->first();

     $faqs = Faq::active()->ordered()->get();

      $partners = Partner::active()->ordered()->get();

      // post


       $posts = Post::published()
        ->with(['categories:id,name,slug'])
        ->latest('published_at')
        ->take(3)
        ->get();
        $testimonials = Testimonial::active()->get();

        return view("welcome",compact('slides','items','club','pres','faqs','partners','posts','testimonials'));
    }
}
