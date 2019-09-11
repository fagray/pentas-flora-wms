<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoicePayment;

class InvoicePaymentsController extends Controller
{
    private $invoice;
    private $invoicePayment;
    
    public function __construct(Invoice $invoice,InvoicePayment $invoicePayment)
    {
        $this->invoice = $invoice;
        $this->invoicePayment = $invoicePayment;
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

        return $this->invoicePayment->paginate(10);
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
        return $this->invoicePayment
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
        return $this->invoicePayment
                    ->where('mode','like',"%$columnToBeFiltered%")
                    ->where('amount_paid','like',"%$columnToBeFiltered%")
                    ->where('cheque_no','like',"%$columnToBeFiltered%")
                    ->where('bank_name','like',"%$columnToBeFiltered%")
                    ->where('deposit_slip_no','like',"%$columnToBeFiltered%")
                    ->where('payment_date','like',"%$columnToBeFiltered%")
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
        return $this->invoicePayment
                    ->where('mode','like',"%$columnToBeFiltered%")
                    ->where('amount_paid','like',"%$columnToBeFiltered%")
                    ->where('cheque_no','like',"%$columnToBeFiltered%")
                    ->where('bank_name','like',"%$columnToBeFiltered%")
                    ->where('deposit_slip_no','like',"%$columnToBeFiltered%")
                    ->where('payment_date','like',"%$columnToBeFiltered%")
                    ->orderBy($filterColumnContents[0], $filterColumnContents[1])
                    ->paginate(10);
    }

    /**
     * Store the invoice payment
     *
     * @param Request $request
     * @return å
     */
    public function store(Request $request, $invoiceId)
    {
       $invoice = $this->invoice->find($invoiceId);
       // recoed rhe payment
       $invoice->payments()->create($request->all());
        
       // deduct the amount paid to the invoice balance
        $balance =  $invoice->balance_amount - $request->amount_paid;
       // update the invoice status
       if ($balance > $request->amount_paid ) {
           $invoice->status = 'Partially Paid';
       }
       if ($balance == $request->amount_paid ) {
           $invoice->status = 'Paid';
       }
       if ($request->amount_paid > $invoice->total_amount ) {
           $invoice->status = 'Overpaid';
       }
       $invoice->balance_amount = $balance;

       if ($invoice->save()) {
            return response()->json(['msg' => 'Invoice payment has been processed sucessfully!'], 200);
        }
        return response()->json(['msg' => 'An error occured while processing payment!'], 500);

    }
}
