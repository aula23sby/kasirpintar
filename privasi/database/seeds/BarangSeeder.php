<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Barang;
class BarangSeeder extends Seeder
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
    		$barang->nama = $this->getFakeBarang();
    		$barang->stock = $faker->numberBetween(5,50);
    		$hargaBeli = $this->getFakerHarga();
    		$hargaJual = rand(5,50); 
    		$hargaJual = $hargaJual*10000;
    		$barang->harga_beli = $hargaBeli;
            $barang->harga_jual = $hargaBeli + $hargaJual;
    		$barang->save();
    	}
    }
    private function getFakeBarang(){
        $arrayMerk = array("Samsung", "Xiaomi", "Realme", "iPhone", "Asus", "Sony");
        $arrayType = array("J", "S", "A", "Z");
        $arrayYear = array("2017", "2018", "2019", "2020");
        $merk = $arrayMerk[rand(0,count($arrayMerk)-1)];
        $type = $arrayType[rand(0,count($arrayType)-1)];
        $year =	$arrayYear[rand(0,count($arrayYear)-1)];
        $nama = $merk." ".$type."".rand(1,100)." (".$year.")"; //Samsung A100 (2019), Xiaomi J50 (2020)
        return $nama;
    }
    private function getFakerHarga(){
        $harga_beli = 1000000;
        $juta = rand(1,10); 
        $ratus = rand(1,9);
        $juta = $juta*1000000; //1jt - 10jt
        $ratus = $ratus*100000; //100rb - 900rb
        $harga_beli = $juta+$ratus;
        return $harga_beli; 
    }
}

