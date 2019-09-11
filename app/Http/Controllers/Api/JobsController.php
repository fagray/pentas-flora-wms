<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Employee;

class JobsController extends Controller
{
    private $job;
    private $employee;
    
    public function __construct(Job $job, Employee $employee)
    {
        $this->job = $job;
        $this->employee = $employee;
    }

    public function index(Request $request)
    {
        if ($request->has('filter') && $request->filter != '') {
            return $this->filter($request->filter);
        }

        if ($request->has('sort') && $request->sort != '') {
            return $this->sort($request->sort);
        }

        if ($request->has('filter') && $request->filter != '' && $request->has('sort') && $request->sort != '') {
            return $this->sortAndFilter($request->filter, $request->sort);
        }

        return $this->job->paginate(10);
    }
    

    /**
     * Find available drivers based on collection date
     *
     * @param Request $request
     * @return void
     */
    public function findAvailableDriversBasedOnCollectionDate(Request $request)
    {
        $startOfCollectionDate = \Carbon\Carbon::parse($request->collection_date)->startOfDay()->toDateTimeString();
        $enfOfCollectionDate = \Carbon\Carbon::parse($request->collection_date)->endOfDay()->toDateTimeString();
      
        $drivers = $this->employee
            ->where('role','driver')
            ->with('jobs')
            ->get();

        $availableDrivers = [];

        foreach ($drivers as $driver) {
            if ($driver->jobs()->count() < 1 ) {
                array_push($availableDrivers,[
                        'id'            =>  $driver->id,
                        'name'          =>  $driver->fname . ' ' . $driver->lname,
                        'license_no'    =>  $driver->license_no
                ]);
            }
            foreach ($driver->jobs as $job) {
                if (substr($job->collection_date,0,10) != substr($request->collection_date,0,10)) {
                    array_push($availableDrivers,[
                        'id'            =>  $driver->id,
                        'name'          =>  $driver->fname . ' ' . $driver->lname,
                        'license_no'    =>  $driver->license_no
                    ]);
                }
            }
        }
        return $availableDrivers;
    }

     /**
     * Complete the job assignment
     *
     * @param int $id
     * @param Request $request
     * @return void
     */
    public function completeAssignment($id, Request $request)
    {
        $job = $this->job->find($id);
        $job->collection_date = $request->collection_date;
        $job->employee_id = $request->employee_id;
        $job->vehicle_id = $request->vehicle_id;
        $job->status = 'Assigned';
        
        if ($job->save()) {
            return response()->json(['msg' => 'Job assignment completed!'], 200);
        }
        return response()->json(['msg' => 'An error occured while assigning job!'], 500);
    }

    public function verifyCollection($id, Request $request)
    {
        $job = $this->job->find($id);
        $job->status = 'Verified';
        if ($job->save()) {
            return response()->json(['msg' => 'Job has been verified!'], 200);
        }
        return response()->json(['msg' => 'An error occured while verifying the job!'], 500);
    }

    /**
     * Sort data
     *
     * @param string $columnToBeSorted
     * @return array
     */
    public function sort($columnToBeSorted)
    {
        $columnContents = explode('|', $columnToBeSorted);
        // index 0 for column to be sorted
        // index 1 for ordering asc|desc
        return $this->job
                    ->orderBy($columnContents[0], $columnContents[1])
                    ->paginate(10);
    }

    /**
     * Filter data.
     *
     * @param string $columnToBeFiltered
     * @return array
     */
    public function filter($columnToBeFiltered)
    {
        return $this->job
                    ->where('id','like',"%$columnToBeFiltered%")
                    ->orWhere('status','like',"%$columnToBeFiltered%")
                    ->paginate(10);
    }

    /**
     * Sort and filter data
     *
     * @param string $columnToBeFiltered
     * @param string $columnToBeSorted
     * @return array
     */
    public function sortAndFilter($columnToBeFiltered, $columnToBeSorted)
    {
        $filterColumnContents = explode('|', $columnToBeSorted);
        // index 0 for column to be sorted
        // index 1 for ordering asc|desc
        return $this->job
                    ->where('id','like',"%$columnToBeFiltered%")
                    ->orWhere('status','like',"%$columnToBeFiltered%")
                    ->orderBy($filterColumnContents[0], $filterColumnContents[1])
                    ->paginate(10);
    }
}
