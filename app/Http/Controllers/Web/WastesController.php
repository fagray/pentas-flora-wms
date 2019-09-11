<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Waste;
use App\Models\Category;
use App\Models\Unit;

class WastesController extends Controller
{
    private $waste;
    private $category;
    private $unit;

    public function __construct(Waste $waste, Category $category, Unit $unit)
    {
        $this->waste = $waste;
        $this->category = $category;
        $this->unit = $unit;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.wastes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->with('subCategories')->get();
        $units = $this->unit->all();
        return view('settings.wastes.create',compact('categories','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->waste->create($request->all());
        return redirect()->route('settings.wastes')
                ->with('success', 'Waste has been created!');
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
        $waste = $this->waste->find($id);
        $categories = $this->category->all();
        $units = $this->unit->all();
        return view('settings.wastes.edit', compact('waste','categories','units'));
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
        $waste = $this->waste->find($id);
        $waste->fill($request->except(['_token','_method']));
        $waste->save();

        return redirect()->route('settings.wastes')
                ->with('success', 'Waste has been updated!');
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
