<?php

namespace App\Console\Commands;

use App\Models\Loan;
use App\Models\Payment;
use App\Models\PaymentOrder;
use Illuminate\Console\Command;
use Illuminate\Http\JsonResponse;

class ImportCsvFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import {--file=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fileUrl = $this->option('file')[0];
        if (!file_exists(public_path($fileUrl))) {
            return $this->error('File not found!');
        }

        $data = $this->csvToJson(public_path($fileUrl));
        $errors = $this->validate($data);
        if($errors == null){
            return $this->store($data);
        }else{
            foreach ($errors as $error) {
                $this->info($error);
            }
        }
        return Command::SUCCESS;
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function store(array $payments)
    {
        foreach ($payments as $data) {
            $loan = Loan::query()->where(['reference' => $data['description']])->firstOrFail();

            $payment = Payment::create([
                'firstname' => $data['payerName'],
                'lastname' => $data['payerSurname'],
                'amount' => $data['amount'],
                'description' => $data['description'],
                'ref_id' => $data['paymentReference'],
                'payment_date' => $data['paymentDate'],
            ]);

            if ((float)$data['amount'] == $loan->amount_to_pay) {
//            Mark loan as paid
//            Mark payment as assigned
            } else if ((float)$data['amount'] > $loan->amount_to_pay) {
                PaymentOrder::create([
                    'payment_id' => $payment->id,
                    'refund_amount' => (float)$data['amount'] - $loan->amount_to_pay,
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
            return $this->info(0);
        }
    }

    /**
     * @param string $filename
     * @param string $delimiter
     * @return array
     */
    function csvToJson(string $filename = '', string $delimiter = ','): array
    {
        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function validate(array $data): array
    {
        $errorCode = [];
        foreach ($data as $key => $_data) {
            $payment = Payment::where(['ref_id' => $_data['paymentReference']])->first();
            $loan = Loan::where(['reference' => $_data['description']])->first();

            if ($payment == null) {
                $errorCode[] = $key . " - " . 1;
            }
            if ($loan == null) {
                $errorCode[] = $key . " - " . 1;
            }
            if ((float)$_data['amount'] < 0) {
                $errorCode[] = $key . " - " . 2;
            }
            //rest of errors should be here...
        }
        return $errorCode;
    }
}
