<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Waste;

class WastesController extends Controller
{
    private $waste;
    
    public function __construct(Waste $waste)
    {
        $this->waste = $waste;
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

        return $this->waste->with(['category','subCategory','unit'])->paginate(10);
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
        return $this->waste
                    ->orderBy($columnContents[0], $columnContents[1])
                    ->with(['category','subCategory','unit'])
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
        return $this->waste
                    ->where('name','like',"%$columnToBeFiltered%")
                    ->with(['category','subCategory','unit'])
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
        return $this->waste
                    ->where('name','like',"%$columnToBeFiltered%")
                    ->orderBy($filterColumnContents[0], $filterColumnContents[1])
                    ->with(['category','subCategory','unit'])
                    ->paginate(10);
    }

    public function destroy($id)
    {
        $waste = $this->waste->find($id)->delete();
        return response()->json(['msg' => 'Waste has been deleted!'],200);
    }
}
