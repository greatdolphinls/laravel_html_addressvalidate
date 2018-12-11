<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

use App\Models\User;
use App\Models\Profile;
use App\Models\Transaction;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call('UserTableSeeder');
        $this->command->info('User table seeded!');
        $this->call('TransactionTableSeeder');
        $this->command->info('Transaction table seeded!');
        $this->call('ProfileTableSeeder');
        $this->command->info('Profile table seeded!');
    }

}

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->delete();
        $users_password = bcrypt('A1234567');
        User::create([
            'email' => 'test@test.com',
            'password' => $users_password,
            'role' => 'user',
            'block' => true
        ]);
    }
}

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('transactions')->delete();
        Transaction::create([
            'ip' => '192.168.1.3',
            'location' => 'aaa district',
            'pcode_number' => 12345,
            'user_id' => 1
        ]);
    }
}

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('profiles')->delete();
        Profile::create([
            'plan' => 'Free',
            'company_name' => 'QQQQQQQQQQ',
            'website_domain' => 'asd@asd.com',
            'firstname' => 'asd',
            'lastname' => 'asd',
            'phone_number' => 1231231231,
            'user_id' => 1,
            'pay_method' => 'visa'
        ]);
    }
}



