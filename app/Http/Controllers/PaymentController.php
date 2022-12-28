<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentStoreRequest;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\PaymentOrder;

class PaymentController extends Controller
{
    public function store(PaymentStoreRequest $request)
    {

        $loan = Loan::query()->where(['reference' => $request->description])->firstOrFail();
        $payment = Payment::create([
            'firstname' => $request->post('firstname'),
            'lastname' => $request->post('lastname'),
            'amount' => $request->post('amount'),
            'description' => $request->post('description'),
            'ref_id' => $request->post('refId'),
            'payment_date' => $request->post('paymentDate'),
        ]);

        if ((float)$request->post('amount') == $loan->amount_to_pay) {
//            Mark loan as paid
//            Mark payment as assigned
        } else if ((float)$request->amount > $loan->amount_to_pay) {
            PaymentOrder::create([
                'payment_id' => $payment->id,
                'refund_amount' => (float)$request->post('amount') - $loan->amount_to_pay,
                'status' => false
            ]);

//            Mark loan as paid
//            Mark payment as partially assigned
//            Create refund payment as separate entity called "Payment Order" with all necessary information
        } else {
//            $loan->amount_to_pay -= $request->amount;
//            Mark payment as assigned
        }

//        Payment received: communication sent to email and|or phone if defined
//        Failed payments report: support@example.com
//        Loan fully paid: communication sent to email and|or phone if defined
        return response()->json(['data' => 'Operation was successful!']);
    }
}
