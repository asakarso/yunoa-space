<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payments')->insert([
            'user_id'     => 2,
            'doctor_id'   => 4,
            'amount'      => 250000.00,
            'method'      => 'Midtrans',
            'status'      => 'success',
            'order_id'    => 'ORDER-' . time(),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
