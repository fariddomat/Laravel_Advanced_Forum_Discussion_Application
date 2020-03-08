<?php

use App\Discussion;
use Illuminate\Database\Seeder;

class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t1="First discussion";
        $t2="Second discussion";
        $t3="Third discussion";
        $t4="Fourth discussion";

        $d1=[
            'title'=>$t1,
            'content'=>"test with data",
            'channel_id'=>1,
            'user_id'=>2,
            'slug'=>str_slug($t1),

        ];
        $d2=[
            'title'=>$t2,
            'content'=>"test with data",
            'channel_id'=>2,
            'user_id'=>2,
            'slug'=>str_slug($t2),

        ];
        $d3=[
            'title'=>$t3,
            'content'=>"test with data",
            'channel_id'=>3,
            'user_id'=>2,
            'slug'=>str_slug($t3),

        ];
        $d4=[
            'title'=>$t4,
            'content'=>"test with data",
            'channel_id'=>4,
            'user_id'=>2,
            'slug'=>str_slug($t4),

        ];
        Discussion::create($d1);
        Discussion::create($d2);
        Discussion::create($d3);
        Discussion::create($d4);
        
    }
}
