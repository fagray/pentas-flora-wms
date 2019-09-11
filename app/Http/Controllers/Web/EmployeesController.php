<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\ProcessingCentre;
use App\Models\Employee;

class EmployeesController extends Controller
{
    private $processingCentre;
    private $area;
    private $employee;

    public function __construct(Area $area, ProcessingCentre $processingCentre, Employee $employee)
    {
        $this->area = $area;
        $this->processingCentre = $processingCentre;    
        $this->employee = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = $this->area->all();
        $processingCentres = $this->processingCentre->all();
        return view('settings.employees.create',compact('areas','processingCentres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->employee->create($request->all());
        return redirect()->route('settings.employees')
                ->with('success', 'Employee has been created!');
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
        $employee = $this->employee->find($id);
        $areas = $this->area->all();
        return view('settings.employees.edit',compact('employee','areas'));
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
        $employee = $this->employee->find($id);
        $employee->fill($request->all());
        $employee->save();
        return redirect()->route('settings.employees')
                ->with('success', 'Employee has been updated!');
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
