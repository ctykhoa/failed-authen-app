<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // insert account
        // test_account_1@gmail.com/9VRvQfyQ
        // test_account_2@gmail.com/2mHVpWQy

        DB::table('users')->insert([
            [
                'username' => 'test_account_1',
                'email' => 'test_account_1@gmail.com',
                'password' => Hash::make('2mHVpWQy'),
                'phone' => '0901112223',
                'shipping_address' => 'Champ de Mars, 5 Av. Anatole France, 75007 Paris, France',
            ],
            [
                'username' => 'test_account_2',
                'email' => 'test_account_2@gmail.com',
                'password' => Hash::make('kjwhfEWR32'),
                'phone' => '0123444555',
                'shipping_address' => 'San Francisco, CA, USA',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // delete default accounts
        DB::table('users')->where(
            'email', '=', 'test_account_1@gmail.com'
        )
            ->orWhere(
                'email', '=', 'test_account_2@gmail.com'
            )
            ->delete();
    }
};
