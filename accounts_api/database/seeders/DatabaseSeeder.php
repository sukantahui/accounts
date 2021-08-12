<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Assets;
use App\Models\Ledger;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;
use App\Models\State;
use App\Models\LedgerType;
use App\Models\Voucher;
use Illuminate\Support\Str;

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
        //person_types table data
        UserType::create(['user_type_name' => 'Owner']);            #1
        UserType::create(['user_type_name' => 'Developer']);        #2
        UserType::create(['user_type_name' => 'Admin']);            #3
        UserType::create(['user_type_name' => 'Manager']);          #4
        UserType::create(['user_type_name' => 'Worker']);           #5
        UserType::create(['user_type_name' => 'Accountant']);       #6
        UserType::create(['user_type_name' => 'Office Staff']);     #7


        //owner
        User::create(['user_name'=>'Avik','mobile1'=>'9836444999','mobile2'=>'100'
        ,'email'=>'avik','password'=>"81dc9bdb52d04dc20036dbd8313ed055",'user_type_id'=>1]);

        //developer
        User::create(['user_name'=>'Sukanta Hui','mobile1'=>'9836444999','mobile2'=>'101'
            ,'email'=>'developer','password'=>"81dc9bdb52d04dc20036dbd8313ed055",'user_type_id'=>2]);

        //admin
        User::create(['user_name'=>'SD','mobile1'=>'9836444999','mobile2'=>'102'
            ,'email'=>'admin','password'=>"81dc9bdb52d04dc20036dbd8313ed055",'user_type_id'=>3]);


        //storing state
        State::insert([
            ['state_code'=>0,'state_name'=>'Not applicable'],
            ['state_code'=>1,'state_name'=>'Jammu & Kashmir'],
            ['state_code'=>2,'state_name'=>'Himachal Pradesh'],
            ['state_code'=>3,'state_name'=>'Punjab'],
            ['state_code'=>4,'state_name'=>'Chandigarh'],
            ['state_code'=>5,'state_name'=>'Uttranchal'],
            ['state_code'=>6,'state_name'=>'Haryana'],
            ['state_code'=>7,'state_name'=>'Delhi'],
            ['state_code'=>8,'state_name'=>'Rajasthan'],
            ['state_code'=>9,'state_name'=>'Uttar Pradesh'],
            ['state_code'=>10,'state_name'=>'Bihar'],
            ['state_code'=>11,'state_name'=>'Sikkim'],
            ['state_code'=>12,'state_name'=>'Arunachal Pradesh'],
            ['state_code'=>13,'state_name'=>'Nagaland'],
            ['state_code'=>14,'state_name'=>'Manipur'],
            ['state_code'=>15,'state_name'=>'Mizoram'],
            ['state_code'=>16,'state_name'=>'Tripura'],
            ['state_code'=>17,'state_name'=>'Meghalaya'],
            ['state_code'=>18,'state_name'=>'Assam'],
            ['state_code'=>19,'state_name'=>'West Bengal'],
            ['state_code'=>20,'state_name'=>'Jharkhand'],
            ['state_code'=>21,'state_name'=>'Odisha (Formerly Orissa'],
            ['state_code'=>22,'state_name'=>'Chhattisgarh'],
            ['state_code'=>23,'state_name'=>'Madhya Pradesh'],
            ['state_code'=>24,'state_name'=>'Gujarat'],
            ['state_code'=>25,'state_name'=>'Daman & Diu'],
            ['state_code'=>26,'state_name'=>'Dadra & Nagar Haveli'],
            ['state_code'=>27,'state_name'=>'Maharashtra'],
            ['state_code'=>28,'state_name'=>'Andhra Pradesh'],
            ['state_code'=>29,'state_name'=>'Karnataka'],
            ['state_code'=>30,'state_name'=>'Goa'],
            ['state_code'=>31,'state_name'=>'Lakshdweep'],
            ['state_code'=>32,'state_name'=>'Kerala'],
            ['state_code'=>33,'state_name'=>'Tamil Nadu'],
            ['state_code'=>34,'state_name'=>'Pondicherry'],
            ['state_code'=>35,'state_name'=>'Andaman & Nicobar Islands'],
            ['state_code'=>36,'state_name'=>'Telangana']
        ]);

        LedgerType::create(['ledger_type_name' => 'Income','value'=>1]);
        LedgerType::create(['ledger_type_name' => 'Expenditure','value'=>-1]);

        Ledger::create(['ledger_name'=>'Received from Owner','ledger_type_id'=>1]);
        Ledger::create(['ledger_name'=>'Received LC','ledger_type_id'=>1]);
        Ledger::create(['ledger_name'=>'Refinish income','ledger_type_id'=>1]);
        Ledger::create(['ledger_name'=>'Misc. Received','ledger_type_id'=>1]);

        Ledger::create(['ledger_name'=>'Withdraw by Owner','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Electricity Bill Paid','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Municipal Tax','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Saraswati Puja Expenditure','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Biswakarma Puja Expenditure','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Daily Puja Expenditure','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Daily Tiffin Expenditure','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Muchi','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Sweeper','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Van Rent','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Car Rent','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'TA for Salesman','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Gas Equipment purchase','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Donation Paid','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Market Expenditure for owner','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Gas Expenditure','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Salary paid','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Misc. Expenditure','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Cleaning Material Purchase','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Bala Making Charge Paid','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Dice Charge paid','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Color Purchase','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Electric worker paid ','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Electric Equipment Purchase','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Costic Purchase','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Acid Purchase','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Sohaga Purchase','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Bronze Purchase','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Copper Purchase','ledger_type_id'=>2]);
        Ledger::create(['ledger_name'=>'Phone Bill Paid','ledger_type_id'=>2]);


        //Assets
        Asset::create(['assets_name'=>'Cash','opening_balance'=>0]);
        Asset::create(['assets_name'=>'Bank','opening_balance'=>0]);

        //Voucher
        Voucher::create(['voucher_name'=>'Receipt']);
        Voucher::create(['voucher_name'=>'Payment']);


        $this->command->info('All States are added');
    }
}
