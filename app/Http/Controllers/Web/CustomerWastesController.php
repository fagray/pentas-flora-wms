<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Waste;
use App\Models\CustomerWaste;

class CustomerWastesController extends Controller
{
    private $customer;
    private $waste;
    private $customerWaste;

    public function __construct(Customer $customer, Waste $waste, CustomerWaste $customerWaste)
    {
        $this->customer = $customer;
        $this->waste = $waste;
        $this->customerWaste = $customerWaste;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($customerId)
    {
        $wasteItems = $this->waste->all();
        $customer = $this->customer->whereId($customerId)->with('wastes')->first();
        return view('settings.customers.wastes.create',compact('wasteItems','customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($customerId, Request $request)
    {
        if (!$request->has('wastes')) {
            return redirect()->route('settings.customers.wastes.create')
                ->with('error', 'Customer must have atleast 1 waste item!');
        }
        
        // wipe the customer waste
        $this->customerWaste->whereCustomerId($customerId)->delete();

        // and attached the customers waste items
        $wasteItemsData = [];
        foreach ($request->wastes as $waste) {
            array_push($wasteItemsData, [
                'customer_id'   =>  $request->customer_id,
                'waste_id'      =>  $waste
            ]);
        }
        $this->customerWaste->insert($wasteItemsData);

        return redirect()->route('settings.customers')
                ->with('success', 'Customer waste items has been stored!');
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
