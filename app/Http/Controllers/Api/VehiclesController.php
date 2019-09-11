<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;

class VehiclesController extends Controller
{
    private $vehicle;
    
    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
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

        return $this->vehicle->paginate(10);
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
        return $this->vehicle
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
        return $this->vehicle
                    ->where('name','like',"%$columnToBeFiltered%")
                    ->orWhere('plate_no','like',"%$columnToBeFiltered%")
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
        return $this->vehicle
                    ->where('name','like',"%$columnToBeFiltered%")
                    ->orWhere('plate_no','like',"%$columnToBeFiltered%")
                    ->orderBy($filterColumnContents[0], $filterColumnContents[1])
                    ->paginate(10);
    }

    public function destroy($id)
    {
        $vehicle = $this->vehicle->find($id)->delete();
        return response()->json(['msg' => 'Vehicle has been deleted!'],200);
    }
}
