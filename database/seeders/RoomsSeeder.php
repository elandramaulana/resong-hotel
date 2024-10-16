<?php

namespace Database\Seeders;

use App\Models\Rooms;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Type\Integer;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $price;
    protected $badtype;
    public function run(): void
    {
        
        $optionType = ['STANDARD SINGLE', 'STANDARD TWIN', 'PREMIUM'];
        $room_status = ['OCCUPIED','BOOKED','VACANT DIRTY','VACANT READY'];
        
        for ($i=0; $i < 100; $i++) { 
            $type = $optionType[array_rand($optionType)];
            if($type=='STANDARD SINGLE'){
                $this->price = 245000;
                $this->badtype= "SINGLE";
            } 
            if($type=='STANDARD TWIN'){
                $this->price = 245000;
                $this->badtype= "TWIN";
            }
            if($type=='PREMIUM'){
                $this->price = 567000;
                $this->badtype= "TWIN";
            }
            $Rooms [] =[
                'room_no'=>'10'.$i,
                'room_name'=>'Room '.$type,
                'room_type'=>$type,
                'room_extrabed'=>rand(0,1),
                'room_price'=>$this->price,
                'room_status'=>$room_status[array_rand($room_status)],
                'room_capacity'=>rand(1,3),
                'bed_type'=> $this->badtype
            ];
        }
        Rooms::insert($Rooms);
    }
}
