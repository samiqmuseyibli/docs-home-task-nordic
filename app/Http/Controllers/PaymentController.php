<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentStoreRequest;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(PaymentStoreRequest $request)
    {


        Payment::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'amount' => $request->amount,
            'description' => $request->description,
            'ref_id' => $request->refId,
            'payment_date' => $request->paymentDate,
        ]);
        return response()->json(['data' => $request->all()]);
    }
}
