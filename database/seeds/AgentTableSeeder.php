<?php

use Illuminate\Database\Seeder;

class AgentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'              => 'Division Khulna',
                'code'              => 'Agent0001',
                'agentship_plan'    => 'division_level',
                'division_id'       => 3,
                'district_id'       => '',
                'address_type'      => '',
                'municipal_id'      => '',
                'municipal_ward_id' => '',
                'upazila_id'        => '',
                'union_id'          => '',
                'village_id'        => '',
                'user_id'           => 5,
            ],[
                'name'              => 'District Khulna',
                'code'              => 'Agent0002',
                'agentship_plan'    => 'district_level',
                'division_id'       => 2,
                'district_id'       => 27,
                'address_type'      => '',
                'municipal_id'      => '',
                'municipal_ward_id' => '',
                'upazila_id'        => '',
                'union_id'          => '',
                'village_id'        => '',
                'user_id'           => 6,
            ],[
                'name'              => 'KCC Khulna',
                'code'              => 'Agent0003',
                'agentship_plan'    => 'municipal_level',
                'division_id'       => 2, //Khulna
                'district_id'       => 27, //khulna
                'address_type'      => 'Municipal',
                'municipal_id'      => 5,//খুলনা সিটি কর্পোরেশন
                'municipal_ward_id' => '',
                'upazila_id'        => '',
                'union_id'          => '',
                'village_id'        => '',
                'user_id'           => 7,
            ],[
                'name'              => 'KCC Ward 24 Khulna',
                'code'              => 'Agent0004',
                'agentship_plan'    => 'municipal_ward_level',
                'division_id'       => 2, //Khulna
                'district_id'       => 27, //khulna
                'address_type'      => 'Municipal',
                'municipal_id'      => 5,//খুলনা সিটি কর্পোরেশন
                'municipal_ward_id' => 224,//Ward 24
                'upazila_id'        => '',
                'union_id'          => '',
                'village_id'        => '',
                'user_id'           => 8,
            ],[
                'name'              => 'Dumuria Khulna',
                'code'              => 'Agent0005',
                'agentship_plan'    => 'upazila_level',
                'division_id'       => 2, //Khulna
                'district_id'       => 27, //khulna
                'address_type'      => 'Residential',
                'municipal_id'      => '',//খুলনা সিটি কর্পোরেশন
                'municipal_ward_id' => '',
                'upazila_id'        => 211,//ডুমুরিয়া
                'union_id'          => '', //খর্ণিয়া
                'village_id'        => '',//Tipna
                'user_id'           => 9,
            ],[
                'name'              => 'Kharnia Khulna',
                'code'              => 'Agent0006',
                'agentship_plan'    => 'union_level',
                'division_id'       => 2, //Khulna
                'district_id'       => 27, //khulna
                'address_type'      => 'Residential',
                'municipal_id'      => '',//খুলনা সিটি কর্পোরেশন
                'municipal_ward_id' => '',
                'upazila_id'        => 211,//ডুমুরিয়া
                'union_id'          => 1915, //খর্ণিয়া
                'village_id'        => '',//Tipna
                'user_id'           => 10,
            ],[
                'name'              => 'Tipna Khulna',
                'code'              => 'Agent0007',
                'agentship_plan'    => 'village_level',
                'division_id'       => 2, //Khulna
                'district_id'       => 27, //khulna
                'address_type'      => 'Residential',
                'municipal_id'      => '',//খুলনা সিটি কর্পোরেশন
                'municipal_ward_id' => '',
                'upazila_id'        => 211,//ডুমুরিয়া
                'union_id'          => 1915, //খর্ণিয়া
                'village_id'        => 1,//Tipna
                'user_id'           => 11,
            ],
            ['name'=> 'Division Chattagram','code' => 'Agent0008','agentship_plan' => 'division_level','division_id' => 1,'user_id'=> 12,'district_id'=> '','address_type'=> '','municipal_id'=> '','municipal_ward_id'=> '','upazila_id'=> '','union_id'=> '','village_id' => ''],
            ['name'=> 'Division Rajshahi','code' => 'Agent0009','agentship_plan' => 'division_level','division_id' => 2,'user_id'=> 13,'district_id'=> '','address_type' => '','municipal_id' => '','municipal_ward_id' => '','upazila_id' => '','union_id' => '','village_id' => ''],
            ['name'=> 'Division Barisal','code' => 'Agent0010','agentship_plan' => 'division_level','division_id' => 4,'user_id'=> 14,'district_id'=> '','address_type' => '','municipal_id' => '','municipal_ward_id' => '','upazila_id' => '','union_id' => '','village_id' => ''],
            ['name'=> 'Division Sylhet','code' => 'Agent0011','agentship_plan' => 'division_level','division_id' => 5,'user_id'=> 15,'district_id'=> '','address_type' => '','municipal_id' => '','municipal_ward_id' => '','upazila_id' => '','union_id' => '','village_id' => ''],
            ['name'=> 'Division Dhaka','code' => 'Agent0012','agentship_plan' => 'division_level','division_id' => 6,'user_id'=> 16,'district_id'=> '','address_type' => '','municipal_id' => '','municipal_ward_id' => '','upazila_id' => '','union_id' => '','village_id' => ''],
            ['name'=> 'Division Rangpur','code' => 'Agent0013','agentship_plan' => 'division_level','division_id' => 7,'user_id'=> 17,'district_id'=> '','address_type' => '','municipal_id' => '','municipal_ward_id' => '','upazila_id' => '','union_id' => '','village_id' => ''],
            ['name'=> 'Division Mymensingh','code' => 'Agent0014','agentship_plan' => 'division_level','division_id' => 8,'user_id'=> 18,'district_id'=> '','address_type' => '','municipal_id' => '','municipal_ward_id' => '','upazila_id' => '','union_id' => '','village_id' => ''],
        ];

        DB::table('agents')->insert($data);
       }
}
