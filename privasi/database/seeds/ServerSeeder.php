<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\server;
class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create('id_ID');
    	for($i = 1; $i <= 1000; $i++){
    		$barang = new Barang;
    		$barang->kode = "BRG_".$i;
    		$barang->nama = $faker->nama;
    		$barang->stock = $faker->numberBetween(5,50);
    		$barang->harga_jual = $this->getFakerHarga(0);
            $barang->harga_beli = $this->getFakerHarga(rand(50000,500000));
    		$barang->save();
    	}
    }
    private function getFakeBarang(){
        $arrayMerk = array("Samsung", "Xiaomi", "Realme", "iPhone", "Asus", "Sony");
        $arrayType = array("J", "S", "A", "Z");
        $arrayYear = array("2017", "2018", "2019", "2020");
        $merk = array_rand($arrayMerk,1);
        $type = array_rand($arrayType,1);
        $year = array_rand($arrayYear,1);
        $nama = $merk." ".$type."".rand(1,100)." (".$year.")"; //Samsung A100 (2019), Xiaomi J50 (2020)
        return $nama;
    }
    private function getFakerHarga($plus_jual){
        $harga_jual = 1000000;
        $juta = rand(1,10); 
        $ratus = rand(1,9);
        $juta = $juta*1000000; //1jt - 10jt
        $ratus = $ratus*100000; //100rb - 900rb
        $harga_beli = $juta+$ratus;
        $harga_beli = $harga_jual+$plus_jual; //harga beli = $harga_jual + $plus_jual
        return $harga_beli; 
    }
    private function getKodeNew(){
        $kdBrg = "BRG_1";
        $barangnew = Barang::orderBy('kode', 'desc')->first();
        if($barangnew != null){
            $kd_string = explode("_",$barangnew->kode);
            $kd_int = (int) $kd_string[1];
            $kd_int++;
            $kdBrg = "BRG_".$kd_int;
        }
        return $kdBrg;
    }
}
