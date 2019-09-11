<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Waste;
use App\Models\PriceList;
use App\Models\Job;
use App\Models\Setting;
use App\Models\Workshop;
use App\Models\Vehicle;
use Storage;

class JobsController extends Controller
{
    private $customer;
    private $waste;
    private $pricelist;
    private $job;
    private $setting;
    private $workshop;
    private $vehicle;

    public function __construct(Customer $customer,Vehicle $vehicle, Waste $waste, PriceList $pricelist, Job $job, Setting $setting, Workshop $workshop)
    {
        $this->customer = $customer;
        $this->waste =  $waste;
        $this->pricelist = $pricelist;
        $this->job = $job;
        $this->setting = $setting;
        $this->workshop = $workshop;
        $this->vehicle = $vehicle;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jobs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = $this->customer->all();
        $pricelists = $this->pricelist->with('wastes')->get();
        return view('jobs.create',compact('customers','pricelists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $costcenter = null;
        
        if ($request->has('workshop_id') && $request->workshop_id != '') {
            // use the workshop as the cost center
            $costcenter = $this->workshop->find($request->workshop_id);
        }

        if (!$request->has('workshop_id') || $request->workshop_id == "" ) {
            // use the main customer as the cost center
            $costcenter = $this->customer->find($request->customer_id);
        }
        
        $job = $costcenter->jobs()->create($request->except('waste_items'));
        $jobWasteItemsData = [];
        foreach (json_decode($request->waste_items) as $waste) {
            array_push($jobWasteItemsData, [
                'waste_id'      =>  $waste->waste_id,
                'unit_price'    =>  $waste->price,
                'volume'        =>  $waste->volume,
                'unit_id'       =>  $waste->unit_id
            ]);
        }
        $job->wastes()->attach($jobWasteItemsData);
        return redirect()->route('jobs.show',$job->id)
                ->with('sucess', 'Job has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $settings = $this->setting->all()->first();
        $job = $this->job->where('id',$id)->first();
        $vehicles = $this->vehicle->all();
        return view('jobs.show',compact('job','settings','vehicles'));
    }

    /**
     * Show the form for waste collection
     *
     * @return \Illuminate\Http\Response
     */
    public function collect($jobId)
    {
        $job = $this->job->find($jobId);
        return view('jobs.collect',compact('job'));
    }

    /**
     * Store the collection info
     *
     * @param int $jobId
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function recordCollection($jobId, Request $request)
    {
        // return var_dump($request->file('evidence_images')[0]);
        $job = $this->job->find($jobId);
        $index = 0;
        $recordedWasteItems = [];
        $evidenceImgUrl = '';
        $fileNameToStore = '';
        foreach ($request->waste_ids as $wasteId) {
            if ( !empty($request->file('evidence_images')[$index])) {
                // upload the file
                $file = $request->file('evidence_images')[$index];
                $fileNameToStore = str_random(20).'_job_id_'.$job->id.'_'.time().'.'.$file->extension();
                $evidenceImgUrl = $file->storeAs('img/collections', $fileNameToStore,'public_images');
            }
            array_push($recordedWasteItems,
                [
                    'evidence_img_url'  =>  $fileNameToStore,
                    'volume_collected'  =>  $request->volume_collected[$index],
                ]);
            $index+=1;
        }
        $index = 0;
        foreach ($job->wastes as $wasteItem) {
            $wasteItem->pivot->evidence_img_url = $recordedWasteItems[$index]['evidence_img_url'];
            $wasteItem->pivot->volume_collected = $recordedWasteItems[$index]['volume_collected'];
            $wasteItem->pivot->save();
        }

        $job->collected_at = $request->collected_date;
        $job->status = 'Completed';
        $job->save();

        return redirect()->route('home')
                ->with('sucess', 'Collection for this job has been saved!');

        
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
