<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Waste;
use App\Models\Category;
use App\Models\SubCategory;

class CategoriesController extends Controller
{
    private $category;
    private $subCategory;

    public function __construct(Category $category, SubCategory $subCategory)
    {
        $this->category = $category;
        $this->subCategory = $subCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.wastes.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.wastes.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->has('sub_categories')) {
            return redirect()->route('settings.categories.create')
                ->with('error', 'Category must have atleast 1 sub-category!');
        }
        $category = $this->category->create($request->only('name'));
        
        // create its subcategories
        $subCategoryData = [];
        foreach ($request->sub_categories as $subCategory) {
            array_push($subCategoryData, [
                'name'          =>  $subCategory,
                'category_id'   =>  $category->id
            ]);
        }
        $this->subCategory->insert($subCategoryData);

        return redirect()->route('settings.wastes')
                ->with('success', 'Category has been created!');
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
    public function edit($id, Request $request)
    {
        $category = $this->category->find($id);     
        $subCategories = $this->subCategory->whereCategoryId($id)->get();
        return view('settings.wastes.categories.edit',compact('category','subCategories'));
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
        if (!$request->has('sub_categories')) {
            return redirect()->route('settings.categories.edit')
                ->with('error', 'Category must have atleast 1 sub-category!');
        }
        $category = $this->category->find($id);
        $category->name = $request->name;
        $category->save();
        $this->subCategory->whereCategoryId($id)->delete();
         // create its subcategories
        $subCategoryData = [];
        foreach (json_decode($request->sub_categories) as $subCategory) {
            array_push($subCategoryData, [
                'name'          =>  $subCategory->name,
                'category_id'   =>  $category->id
            ]);
        }
        $this->subCategory->insert($subCategoryData);
        return redirect()->route('settings.wastes')
                ->with('success', 'Category has been updated!');

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
