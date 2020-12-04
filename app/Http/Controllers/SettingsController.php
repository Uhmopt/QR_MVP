<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;
use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use Image;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Notifications\SystemTest;

class SettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected static $currencies;
    protected static $jsfront;
    protected $imagePath="/uploads/settings/";

    public function systemstatus(){

        $totalTasks=3;
        $percent=100/$totalTasks;
        $taskDone=0;

        //Verify system is setup correctly.
        if(!auth()->user()->hasRole('admin')){
            abort(404);
        }

        $testResutls=[];
        //1. Make sure admin email is not admin@example.com
        if(auth()->user()->email!=="admin@example.com"){
            array_push($testResutls,['settings.default_admin_email','OK',true]);
            $taskDone++;

            
            //Continue to verify smtp setup
            
            try{
                auth()->user()->notify(new SystemTest(auth()->user()));
                array_push($testResutls,['settings.smtp','OK',true]);
                $taskDone++;

                //Now in qr, we need paddle vendor id
                if(env('paddleVendorID',false)&&strlen(env('paddleVendorID',"")>3)){
                    array_push($testResutls,['settings.paddle','OK',true]);
                    $taskDone++;
                }else{
                    array_push($testResutls,['settings.paddle','settings.paddle_error',false,'https://mobidonia.gitbook.io/qr-menu-maker/define-basics/payments']);
                }
            }
            catch(\Exception $e){
                array_push($testResutls,['settings.smtp','settings.smtp_not_ok',false,'https://mobidonia.gitbook.io/qr-menu-maker/define-basics/obtain-smtp']);
            }


        }else{
            array_push($testResutls,['settings.default_admin_email','settings.using_default_admin_solution',false,'https://mobidonia.gitbook.io/qr-menu-maker/usage/getting-started#login-as-admin']);
        }


        return view('settings.status', [
            'progress'=>ceil($taskDone*$percent),
            'testResutls' => $testResutls]);

    }

    public function index(Settings $settings)
    {
        if(auth()->user()->hasRole('admin')){
            $curreciesArr = [];
            static::$currencies = require __DIR__.'/../../../config/money.php';
            foreach(static::$currencies as $key => $value){
                array_push($curreciesArr, $key);
            }

            $jsfront=File::get(base_path('public/byadmin/front.js'));
            $jsback=File::get(base_path('public/byadmin/back.js'));
            $cssfront=File::get(base_path('public/byadmin/front.css'));
            $cssback=File::get(base_path('public/byadmin/back.css'));

           //$jsfront = file_get_contents(__DIR__.'/../../../public/byadmin/front.js');
           //dd($cssfront);

            return view('settings.index', [
                'settings' => $settings->first(), 
                'currencies' => $curreciesArr,
                'jsfront'=>$jsfront,
                'jsback'=>$jsback,
                'cssfront'=>$cssfront,
                'cssback'=>$cssback,
                ]);
        }else return redirect()->route('orders.index')->withStatus(__('No Access'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('settings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //dd($request->all());

        $settings = Settings::find($id);

        $settings->site_name = strip_tags($request->site_name);
        $settings->description = strip_tags($request->site_description);
        $settings->header_title = $request->header_title;
        $settings->header_subtitle = $request->header_subtitle;
        $settings->facebook = strip_tags($request->facebook) ? strip_tags($request->facebook) : "";
        $settings->instagram = strip_tags($request->instagram) ? strip_tags($request->instagram) : "";
        $settings->playstore = strip_tags($request->playstore) ? strip_tags($request->playstore) : "";
        $settings->appstore = strip_tags($request->appstore) ? strip_tags($request->appstore) : "";
        $settings->typeform = strip_tags($request->typeform) ? strip_tags($request->typeform) : "";
        $settings->mobile_info_title = strip_tags($request->mobile_info_title) ? strip_tags($request->mobile_info_title) : "";
        $settings->mobile_info_subtitle = strip_tags($request->mobile_info_subtitle) ? strip_tags($request->mobile_info_subtitle) : "";
        $settings->delivery = (double)$request->delivery;
        //$settings->order_options = $request->order_options;

        fwrite(fopen(__DIR__.'/../../../public/byadmin/front.js', "w"), str_replace("tagscript","script",$request->jsfront));
        fwrite(fopen(__DIR__.'/../../../public/byadmin/back.js', "w"), str_replace("tagscript","script",$request->jsback));
        fwrite(fopen(__DIR__.'/../../../public/byadmin/front.css', "w"), $request->cssfront);
        fwrite(fopen(__DIR__.'/../../../public/byadmin/back.css', "w"), $request->cssback);



        if($request->hasFile('site_logo')){
            $settings->site_logo=$this->saveImageVersions(
                $this->imagePath,
                $request->site_logo,
                [
                    ['name'=>'logo','type'=>"png"],
                ]
            );
        }

        if($request->hasFile('search')){
            $settings->search=$this->saveImageVersions(
                $this->imagePath,
                $request->search,
                [
                    ['name'=>'cover'],
                ]
            );
        }

        if($request->hasFile('restorant_details_image')){
            $settings->restorant_details_image=$this->saveImageVersions(
                $this->imagePath,
                $request->restorant_details_image,
                [
                    ['name'=>'large','w'=>590,'h'=>400],
                    ['name'=>'thumbnail','w'=>200,'h'=>200]
                ]
            );
        }

        //restorant_details_cover_image
        if($request->hasFile('restorant_details_cover_image')){
            $settings->restorant_details_cover_image=$this->saveImageVersions(
                $this->imagePath,
                $request->restorant_details_cover_image,
                [
                    ['name'=>'cover','w'=>2000,'h'=>1000]
                ]
            );
        }

        if($request->hasFile('qrdemo')){
            $imDemo = Image::make( $request->qrdemo->getRealPath())->fit(512, 512);
            $imDemo->save(public_path()."/impactfront/img/qrdemo.jpg");
        }

        if($request->hasFile('favicons')){
            $imAC256 = Image::make( $request->favicons->getRealPath())->fit(256, 256);
            $imgAC192 = Image::make( $request->favicons->getRealPath())->fit(192, 192);
            $imgMS150 = Image::make( $request->favicons->getRealPath())->fit(150, 150);

            $imgApple = Image::make( $request->favicons->getRealPath())->fit(120, 120);
            $img32 = Image::make( $request->favicons->getRealPath())->fit(32, 32);
            $img16 = Image::make( $request->favicons->getRealPath())->fit(16, 16);

            $imAC256->save(public_path()."/android-chrome-256x256.png");
            $imgAC192->save(public_path()."/android-chrome-192x192.png");
            $imgMS150->save(public_path()."/mstile-150x150.png");
           
            $imgApple->save(public_path()."/apple-touch-icon.png");
            $img32->save(public_path()."/favicon-32x32.png");
            $img16->save(public_path()."/favicon-16x16.png");
        }

        

        $settings->update();

        return redirect()->route('settings.index')->withStatus(__('Settings successfully updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getDeliveryFee()
    {
        return response()->json([
            'fee' => Settings::findOrFail(1)->delivery,
            'status' => true,
            'errMsg' => ''
        ]);
    }
}
