<?php

namespace App\Http\Controllers;

use App\Branch;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Notifications\BranchCreated;
use Illuminate\Support\Facades\Validator;
use App\Notifications\WelcomeNotification;
use App\Restorant;
use Session;

class BranchController extends Controller
{
    protected $imagePath='uploads/restorants/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Branch $branches)
    {
        //  
        if(auth()->user()->hasRole('owner')){
            return view('branch.index', ['branches' => auth()->user()->restorant->branches()->orderBy('id', 'desc')->paginate(10)]);
        }else return redirect()->route('front')->withStatus(__('No Access'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
        if(auth()->user()->hasRole('owner')){
            
            if(auth()->user()->restorant->branchnum <= auth()->user()->restorant->branches()->count())
            {
                return redirect()->route('branch.index')->withStatus(__('Can not creat Branch anymore.'));
            }

            return view('branch.create');

        }else return redirect()->route('orders.index')->withStatus(__('No Access'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate input data
        $request->validate([
            'name' => ['required', 'string', 'unique:branches,name', 'max:255'],
            'description' => ['required', 'string'],
            'name_manager' => ['required', 'string', 'max:255'],
            'email_manager' => ['required', 'string', 'email', 'unique:users,email', 'max:255'],
            'phone_manager' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
        ]);
        
        //Create the new user for manager
        $generatedPassword = Str::random(10); 
        $manager = new User;
        $manager->name = strip_tags($request->name_manager);
        $manager->email = strip_tags($request->email_manager);
        $manager->phone = strip_tags($request->phone_manager)|"";
        $manager->api_token = Str::random(80);

        $manager->password =  Hash::make($generatedPassword);
        $manager->save();

        //Assign role
        $manager->assignRole('manager');
        
        // Create new branch
        $branch = new Branch;
        $branch->name           =   strip_tags($request->name);
        $branch->user_id        =   $manager->id;
        $branch->restorant_id   =   auth()->user()->restorant->id;
        $branch->description    =   strip_tags($request->description);
        $branch->address = "";
        $branch->subdomain= $this->createSubdomainFromName(strip_tags($request->name));
        $branch->save();

        //Send email to the user/owner
        $manager->notify(new BranchCreated($generatedPassword,$branch,$manager));
        
        return redirect()->route('branch.index')->withStatus(__('Branch successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function showList(Restorant $restorant)
    // { 
    //     //     
    //     Session::put('restorant', $restorant);
    //     if(auth()->user()->hasRole('owner') || auth()->user()->hasRole('admin')){
    //         return view('branch.index', ['branches' => $restorant->branches()->orderBy('id', 'desc')->paginate(10)]);
    //     }else return redirect()->route('front')->withStatus(__('No Access'));       
    // }

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
     * @param  App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch  $branch)
    {
        //Days of the week
        $timestamp = strtotime('next Sunday');
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }

        //Generate days columns
        $hoursRange = [];
        for($i=0; $i<7; $i++){
            $from = $i."_from";
            $to = $i."_to";

            array_push($hoursRange, $from);
            array_push($hoursRange, $to);
        }
        // auth check and show the form for editing the $branch
        // echo $branch->restorant->user_id;
        // exit;
        if( auth()->user()->id == $branch->restorant->user_id || auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner') || auth()->user()->hasRole('manager') ){
            return view('branch.edit', [
                'branch' => $branch,
                'days' => $days
                ]);
        }
        return redirect()->route('home')->withStatus(__('No Access'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        // post variable validation and put
        $branch->name = strip_tags($request->name);
        $branch->description = strip_tags($request->description);
        $branch->address = strip_tags($request->address);
        $branch->subdomain=$this->createSubdomainFromName(strip_tags($request->name));
        if(isset($request->city_id)){
            $branch->city_id = $request->city_id;
        }
        
        if($request->hasFile('branch_cover')){
            $branch->cover=$this->saveImageVersions(
                $this->imagePath,
                $request->branch_cover,
                [
                    ['name'=>'cover','w'=>2000,'h'=>1000],
                    ['name'=>'thumbnail','w'=>400,'h'=>200]
                ]
            );
        }
        // update
        $branch->update();
        
        // redirect
        if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner')){
            return redirect()->route('branch.edit',$branch->id)->withStatus(__('Branch successfully updated.'));
        }else{
            return redirect()->route('branch.edit',$branch->id)->withStatus(__('Branch successfully updated.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        // destory branch
        $branch->delete();

        // redirect
        return redirect()->route('branch.index')->withStatus(__('Branch successfully deleted.'));
    }
    
    public function updateLocation(Branch $branch, Request $request)
    {

        $branch->lat = $request->lat;
        $branch->lng = $request->lng;

        $branch->update();

        return response()->json([
            'status' => true,
            'errMsg' => ''
        ]);
    }

    private function createSubdomainFromName($name){
        $cyr = array(
            'ж',  'ч',  'щ',   'ш',  'ю',  'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я',
            'Ж',  'Ч',  'Щ',   'Ш',  'Ю',  'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я');
        $lat = array(
            'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'q',
            'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'Q');
        $name= str_replace( $cyr,$lat, $name);

        return strtolower(preg_replace('/[^A-Za-z0-9]/', '', $name));
    }
}