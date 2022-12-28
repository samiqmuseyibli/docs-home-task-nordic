<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentStoreRequest;
use App\Models\Loan;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(PaymentStoreRequest $request)
    {

        $loan = Loan::query()->where(['reference' => $request->description])->firstOrFail();
//        dd($loan, $request->amount);
        if((float)$request->amount == $loan->amount_to_pay){
//            Mark loan as paid
//            Mark payment as assigned
        }else if((float)$request->amount > $loan->amount_to_pay){
//            Mark loan as paid
//            Mark payment as partially assigned
//            Create refund payment as separate entity called "Payment Order" with all necessary information
        }else{
//            Mark payment as assigned
        }

//        Payment received: communication sent to email and|or phone if defined
//        Failed payments report: support@example.com
        if(1){
//            Loan fully paid: communication sent to email and|or phone if defined
        }


//        Payment::create([
//            'firstname' => $request->firstname,
//            'lastname' => $request->lastname,
//            'amount' => $request->amount,
//            'description' => $request->description,
//            'ref_id' => $request->refId,
//            'payment_date' => $request->paymentDate,
//        ]);
        return response()->json(['data' => $request->all()]);
    }
}
