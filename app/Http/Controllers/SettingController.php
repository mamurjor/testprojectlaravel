<?php

namespace App\Http\Controllers;
use App\Models\Setting;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    //

    public function SettingUpdate(Request $request){



        foreach($request->except('_token') as $key => $value){
            Setting::updateOrCreate(

                ['key' => $key ],
                ['value' => $value ],

            );


        }


         // ABOUT_IMAGE handle
   if($request->hasFile('ABOUT_IMAGE')){
    $aboutus = $request->file('ABOUT_IMAGE');
    $aboutusName = 'banner_'.time().'.'.$aboutus->getClientOriginalExtension();
    $aboutus->move(public_path('uploads'), $aboutusName);

    Setting::updateOrCreate(
        ['key' => 'ABOUT_IMAGE'],
        ['value' => $aboutusName] // শুধু ফাইলনেম
    );
}

   if($request->hasFile('BANNER')){
    $banner = $request->file('BANNER');
    $bannerName = 'banner_'.time().'.'.$banner->getClientOriginalExtension();
    $banner->move(public_path('uploads'), $bannerName);

    Setting::updateOrCreate(
        ['key' => 'BANNER'],
        ['value' => $bannerName] // শুধু ফাইলনেম
    );
}

   if($request->hasFile('LOGO')){
    $logo = $request->file('LOGO');
    $logoName = 'logo_'.time().'.'.$logo->getClientOriginalExtension();
    $logo->move(public_path('uploads'), $logoName);

    Setting::updateOrCreate(
        ['key' => 'LOGO'],
        ['value' => $logoName] // শুধু ফাইলনেম
    );
}


    // Favicon handle
    if($request->hasFile('FAVICON')){
        $favicon = $request->file('FAVICON');
        $faviconName = 'favicon_'.time().'.'.$favicon->getClientOriginalExtension();
        $favicon->move(public_path('uploads'), $faviconName);
        Setting::updateOrCreate(
            ['key' => 'FAVICON'],
            ['value' => $faviconName]
        );
    }



     // 2. যেগুলো .env ফাইলে লাগবে শুধু সেগুলো সিলেক্ট করুন
    $envData = [
        'APP_NAME'        => $request->APPTITLE,
        'APP_URL'           => $request->APP_URL,
        'APP_DEBUG'         => $request->APP_DEBUG,
        'MAIL_HOST'       => $request->MAIL_HOST,
        'MAIL_PORT'       => $request->MAIL_PORT,
        'MAIL_USERNAME'   => $request->MAIL_USERNAME,
        'MAIL_PASSWORD'   => $request->MAIL_PASSWORD,
        'RECAPTCHA_SITE_KEY' => $request->RECAPTCHA_SITE_KEY,
        'RECAPTCHA_SECRET_KEY' => $request->RECAPTCHA_SECRET_KEY,
        'RECAPTCHA_VERSION' => $request->RECAPTCHA_VERSION,
        'MAIL_ENCRYPTION' => $request->mail_encryption,
        'MAIL_FROM_ADDRESS' => $request->mail_from,
        'PUSHER_APP_ID'     => $request->PUSHER_APP_ID,
        'ADMIN_EMAIL'       => $request->ADMIN_MAIL,
        'MAIL_ENCRYPTION'   => $request->MAIL_ENCRYPTION,
        'MAIL_MAILER'       => $request->MAIL_MAILER


    ];

    // null বা খালি হলে বাদ দিন
    $envData = array_filter($envData);

    // 3. .env ফাইল আপডেট
    setEnvValue($envData);



    return back()->with('success', 'Settings updated successfully!');



    }

  protected function setEnvValue($key, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $oldValue = env($key);
            $content = file_get_contents($path);

            // যদি key আগে থেকে থাকে → replace
            if (preg_match("/^{$key}=.*/m", $content)) {
                $content = preg_replace(
                    "/^{$key}=.*/m",
                    "{$key}=\"{$value}\"",
                    $content
                );
            } else {
                // না থাকলে ফাইলের শেষে যোগ করো
                $content .= "\n{$key}=\"{$value}\"";
            }

            file_put_contents($path, $content);
        }
    }

    public function settingform(){


         $settings = Setting::all();
        $setting = $settings->pluck('value', 'key');
        return view("admin.settingform", compact('setting'));
    }
}
