<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingsController extends Controller
{
    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = $this->setting->all()->first();
        return view('settings.index',compact('settings'));
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
        $settings = $this->setting->all()->first();
        if($request->hasFile('logo')) {
           // get the ext
            $extension = $request->logo->extension();
            // store as
            $fileNameToStore = str_random(20).'_'.time().'.'.$extension;                      
            // upload the file to the storage folder
            $request->logo->storeAs('public/images', $fileNameToStore);

        } else {
            $fileNameToStore = $settings->logo;
        }
        $settingsData = [
            'logo'              =>  $fileNameToStore,
            'application_name'  =>  $request->application_name
        ];

        if ($this->setting->where('id', 1)->update($settingsData)) {
            // update the session data of the settings
            session()->put('settings', $this->setting->all()->first());
        }
       
        return redirect()->route('settings')
                ->with('success', 'Settings has been saved!');
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
        //
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
}
