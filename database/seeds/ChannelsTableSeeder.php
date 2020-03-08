<?php

use App\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1=['title'=>'Laravel','slug'=>str_slug('Laravel')];
        $channel2=['title'=>'Asp.net','slug'=>str_slug('Asp.net')];
        $channel3=['title'=>'Vue.js','slug'=>str_slug('Vue.js')];
        $channel4=['title'=>'React','slug'=>str_slug('React')];
        $channel5=['title'=>'Angular','slug'=>str_slug('Angular')];

        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
    }
}
