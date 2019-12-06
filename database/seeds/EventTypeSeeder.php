<?php

use Illuminate\Database\Seeder;

use App\EventType;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Workshop','Seminar','Info Session','Sun Eng Event','Sun Eng Class','Partner Event','School Expo'];
        
        foreach ($types as $type) {
            $eventType = new EventType();
            $eventType->event_type_name = $type;
            $eventType->save();
        }
    }
}
