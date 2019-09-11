<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Customer;
use App\Models\Invoice;

class InvoicesController extends Controller
{
    private $job;
    private $customer;
    private $invoice;

    public function __construct(Job $job, Customer $customer, Invoice $invoice)
    {
        $this->job = $job;
        $this->customer = $customer;
        $this->invoice = $invoice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('billings.invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $job = collect([]);
        $customer = collect([]);
        if ($request->has('ref')) {

            $jobId =  $request->ref;
            $job = $this->job->find($jobId);
            $customer = $this->customer->find($job->costcenter_id);

            // determine the costcenter type if workshop, return the parent company
            if ($job->costcenter_type === 'App\Models\Workshop') {
                $customer = $this->customer->find($job->costcenter->customer_id);
            } else if ($job->costcenter_type === 'App\Models\Customer') {
                $customer = $this->customer->find($job->costcenter_id);
            }
        }

        return view('billings.invoices.create',compact('job','customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoiceData = [
            'job_id'            =>  $request->job_id,
            'customer_id'       =>  $request->customer_id,
            'inv_no'            =>  $request->inv_no,
            'due_date'          =>  $request->due_date,
            'total_amount'      =>  $request->total_amount,
            'balance_amount'    =>  $request->total_amount,
            'notes'             =>  $request->notes,
            'ref_no'            =>  $request->ref_no
        ];
        $invoice = $this->invoice->create($invoiceData);
        $invoiceWasteData = [];
        foreach (json_decode($request->invoice_items) as $waste) {
            array_push($invoiceWasteData, [
                'waste_id'      =>  $waste->pivot->waste_id,
                'price'         =>  $waste->pivot->waste_id,
                'volume'        =>  $waste->pivot->volume,
                'unit_id'       =>  $waste->unit_id
            ]);
        }
        $invoice->items()->attach($invoiceWasteData);
        return redirect()->route('jobs.show',$invoice->job_id)
                ->with('sucess', 'Consignment note has been created!');
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
