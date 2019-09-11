<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Waste;
use App\Models\Unit;

class PricelistsController extends Controller
{
    private $pricelist;
    private $waste;
    private $unit;
    private $pricelistItem;

    public function __construct(PriceList $pricelist, Waste $waste, Unit $unit, PriceListItem $pricelistItem)
    {
        $this->pricelist = $pricelist;
        $this->waste = $waste;
        $this->unit = $unit;
        $this->pricelistItem = $pricelistItem;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.pricelists.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wastes = $this->waste->with('unit')->get();
        $units = $this->unit->all();
        return view('settings.pricelists.create', compact('wastes','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return json_decode($request->pricelist_items);
        $pricelist = $this->pricelist->create($request->except('pricelist_items'));
        $priceListItems = [];
        $requestPricelistItems = json_decode($request->pricelist_items);
        foreach ( $requestPricelistItems as $pricelistItem) {
            array_push($priceListItems, [
                'price_list_id' =>  $pricelist->id,
                'waste_id'      =>  $pricelistItem->waste_id,
                'unit_id'       =>  $pricelistItem->unit_id,
                'unit_price'    =>  $pricelistItem->unit_price
            ]);
        }
        $pricelist->wastes()->attach($priceListItems);
        return redirect()->route('settings.pricelists')
                ->with('success', 'Pricelist has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pricelist = $this->pricelist->find($id);
        return view('settings.pricelists.show', compact('pricelist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pricelist = $this->pricelist->find($id);
        $units = $this->unit->all();
        $wastes = $this->waste->with('unit')->get();
        return view('settings.pricelists.edit',compact('pricelist','units','wastes'));
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
        $pricelist = $this->pricelist->find($id);
        $pricelist->fill($request->except('pricelist_items'));
        $pricelist->save();

        $priceListItem = [];
        $requestPricelistItems = json_decode($request->pricelist_items);

        foreach ( $requestPricelistItems as $pricelistItem) {
            $priceListItem = [
                'price_list_id' =>  $id,
                'waste_id'      =>  $pricelistItem->pivot->waste_id,
                'unit_id'       =>  $pricelistItem->unit_id,
                'unit_price'    =>  (double)$pricelistItem->pivot->unit_price
            ];
            $priceListItemToBeUpdated = $this->pricelistItem->where('waste_id',$pricelistItem->pivot->waste_id)
                                            ->where('price_list_id',$id)->first();
            if ($priceListItemToBeUpdated->count() > 0) {
                
                $priceListItemToBeUpdated->unit_price = (double)$pricelistItem->pivot->unit_price;
                $priceListItemToBeUpdated->unit_id = $pricelistItem->unit_id;
                $priceListItemToBeUpdated->save();

            } else {
                $pricelist->wastes()->attach($priceListItem);
            }
        }

        return redirect()->route('settings.pricelists')
                ->with('success', 'Pricelist has been updated!');
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
