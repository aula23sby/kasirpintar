<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\server;
class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //	
    	$faker = Faker::create('id_ID');
    	
    	for($i = 1; $i <= 50; $i++){
    		$pegawai = new server;
    	      // insert data ke table pegawai menggunakan Faker
    		$pegawai->nama_pegawai = $faker->name;
    		$pegawai->jabatan_pegawai = $faker->jobTitle;
    		$pegawai->umur_pegawai = $faker->numberBetween(20,30);
    		$pegawai->alamat_pegawai = $faker->address;
    		$pegawai->save();
    		/*
    		DB::table('pegawai')->insert([
    			'pegawai_nama' => $faker->name,
    			'pegawai_jabatan' => $faker->jobTitle,
    			'pegawai_umur' => $faker->numberBetween(25,40),
    			'pegawai_alamat' => $faker->address
    		]);
 			*/
    	}
    }
}
