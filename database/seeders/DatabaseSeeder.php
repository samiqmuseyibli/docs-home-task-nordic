<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\Loan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $dataCustomers = json_decode('[
                                    {
                                        "id": "c539792e-7773-4a39-9cf6-f273b2581438",
                                        "firstname": "Pupa",
                                        "lastname": "Lupa",
                                        "ssn": "0987654321",
                                        "email": "pupa.lupa@example.com"
                                    },
                                    {
                                        "id": "d275ce5e-91c8-49fe-9407-1700b59efe80",
                                        "firstname": "John",
                                        "lastname": "Doe",
                                        "ssn": "1234509876",
                                        "phone": "+44123456789"
                                    },
                                    {
                                        "id": "a5c50ea9-9a24-4c8b-b4ae-c47ee007081e",
                                        "firstname": "Biba",
                                        "lastname": "Boba",
                                        "ssn": "1234567890",
                                        "phone": "+44123456780",
                                        "email": "biba@example.com"
                                    },
                                    {
                                        "id": "c5c05eeb-ff02-4de6-b92e-a1b7f02320df",
                                        "firstname": "Lorem",
                                        "lastname": "Ipsum",
                                        "ssn": "6789054321",
                                        "phone": "+481230943320",
                                        "email": "lorem@ipsum"
                                    }
                                ]');
        Customer::create($dataCustomers);

        $dataLoans = json_decode('[
                                        {
                                            "id": "51ed9314-955c-4014-8be2-b0e2b13588a5",
                                            "customerId": "c539792e-7773-4a39-9cf6-f273b2581438",
                                            "reference": "LN12345678",
                                            "state": "ACTIVE",
                                            "amount_issued": "100.00",
                                            "amount_to_pay": "120.00"
                                        },
                                        {
                                            "id": "a54b0796-2fcb-4547-b23d-125786600ec3",
                                            "customerId": "c539792e-7773-4a39-9cf6-f273b2581438",
                                            "reference": "LN22345678",
                                            "state": "ACTIVE",
                                            "amount_issued": "200.00",
                                            "amount_to_pay": "250.00"
                                        },
                                        {
                                            "id": "f7f81281-64a9-47a7-af60-5c6896896d1f",
                                            "customerId": "d275ce5e-91c8-49fe-9407-1700b59efe80",
                                            "reference": "LN55522533",
                                            "state": "ACTIVE",
                                            "amount_issued": "50.00",
                                            "amount_to_pay": "70.00"
                                        },
                                        {
                                            "id": "b8d26e7b-1607-441d-8bb0-87517a874572",
                                            "customerId": "c5c05eeb-ff02-4de6-b92e-a1b7f02320df",
                                            "reference": "LN20221212",
                                            "state": "ACTIVE",
                                            "amount_issued": "66.00",
                                            "amount_to_pay": "100.00"
                                        }
                                    ]');
        Loan::create($dataLoans);
    }
}
