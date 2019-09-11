<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Interfaces\SortAndFilterInterface;

class EmployeesController extends Controller implements SortAndFilterInterface
{
    private $employee;
    
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public $withs = ['processingCentre','area'];

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

        return $this->employee->with(['area','processingCentre'])->paginate(10);
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
        return $this->employee
                    ->with(['area','processingCentre'])
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
        return $this->employee
                    ->where('fname','like',"%$columnToBeFiltered%")
                    ->orWhere('lname','like',"%$columnToBeFiltered%")
                    ->with(['area','processingCentre'])
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
        return $this->employee
                    ->where('fname','like',"%$columnToBeFiltered%")
                    ->orWhere('lname','like',"%$columnToBeFiltered%")
                    ->orderBy($filterColumnContents[0], $filterColumnContents[1])
                    ->with(['area','processingCentre'])
                    ->paginate(10);
    }

    public function fetchAssignedJobs($id, Request $request)
    {
        $employee = $this->employee->find($id);
        $today = \Carbon\Carbon::now()->startOfDay()->toDateTimeString();
        $currentJob = $employee->jobs()
                        ->where('collection_date','=', $today)
                        ->where('status','Assigned')
                        ->first();
        $upcomingJobs = $employee->jobs()
                        ->where('collection_date','>', $today)
                        ->where('status','Assigned')
                        ->get();
        $previousJobs = $employee->jobs()
                        ->where('collection_date','<', $today)
                        ->orWhere('collection_date', $today)
                        ->where('status','Completed')
                        ->orWhere('status','Verified')
                        ->get();
        return response()->json(['current_job' => $currentJob, 
                                'upcoming_jobs' => $upcomingJobs,'previous_jobs' => $previousJobs], 200);
    }

    public function destroy($id)
    {
        $employee = $this->employee->find($id)->delete();
        return response()->json(['msg' => 'Employee has been deleted!'],200);
    }
}
