<?php

namespace App\Console\Commands;

use App\Address;
use App\Center;
use App\City;
use App\Map;
use App\Region;
use Illuminate\Console\Command;
use Intervention\Image\Exception\NotFoundException;
use PhpOffice\PhpSpreadsheet\IOFactory;

class FileLoad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:load {file}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load file to bd';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $file = $this->argument('file');
        
        if (!file_exists($file)) throw new NotFoundException('File not found');
        
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
        $type = ucfirst($fileExtension);
        $reader = IOFactory::createReader($type);
        $reader->setReadDataOnly(true);
        
        $spreadsheet = $reader->load($file);
        
        $items = $spreadsheet->getActiveSheet()->toArray();
        
        $titles = array_flip(array_shift($items));
        //        d($titles);
        foreach ($items as $item) {
            $this->makeItemFromData($titles, $item);
        }
        
    }
    
    private function makeItemFromData(?array $titles, $item)
    {
        $item = array_map('trim', $item);
        
        $center_name = $item[2];
        $phone = $item[3];
        $address_1 = $item[4];
        $address_2 = $item[5];
        $region = $item[6];
        $city = $item[7];
        $on_map = $item[8];
        $capacity = $item[9];
        $okrug = $item[10];
        $big = $item[11];
        //        $oms = $item[12];
        $email = $item[13];
        $devices = $item[14];
        $shifts = $item[15];
    
        preg_match_all('/([0-9]*[.][0-9]*)/', $on_map, $matches);
        
        if (empty($on_map) || empty($matches[0][0]))
            return;
        
        // map

        
        
        $region = Region::firstOrCreate(['name' => $region]);
        $city = City::firstOrCreate(['name' => $city, 'region_id' => $region->id]);
        
        // center
        $center = Center::firstOrCreate([
            'center_name' => $center_name,
            'phone'       => $phone,
            'region_id'   => $region->id,
            'city_id'     => $city->id,
            'okrug'       => $okrug,
            'big'         => $big,
            'email'       => $email,
            'devices'     => $devices,
            'shifts'      => $shifts,
        ]);
        $center->save();
        
        // map
        $map = new Map();
        $map->latitude = $matches[0][0];
        $map->longitude = $matches[0][1];
        $map->capacity = $capacity;
        $map->zoom = explode(":", $on_map)[1] ?? 15;
        $map->center_id = $center->id;
        $map->save();
        
        // address
        Address::firstOrCreate(['name' => $address_1, 'center_id' => $center->id]);
        Address::firstOrCreate(['name' => $address_2, 'center_id' => $center->id]);
        
    }
}
