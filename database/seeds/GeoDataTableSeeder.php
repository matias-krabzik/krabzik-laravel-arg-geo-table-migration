<?php

use Illuminate\Database\Seeder;
use App\Models\Geo\City;
use App\Models\Geo\Country;
use App\Models\Geo\State;

class GeoDataTableSeeder extends Seeder
{
    private $cities_file;
    private $states_file;
    private $countries_file;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->countries_file = explode("\n", file_get_contents(realpath(realpath('.') . '/data/countries.txt')));
        $this->states_file = explode("\n", file_get_contents(realpath(realpath('.') . '/data/states.txt')));
        $this->cities_file = explode("\n", file_get_contents(realpath(realpath('.') . '/data/cities.txt')));

        $countries = Country::count();
        $states = State::count();
        $cities = City::count();
        // dd($cities != $this->COUNT_CITIES);
        if (
            $countries != count($this->countries_file) ||
            $states != count($this->states_file) ||
            $cities != count($this->cities_file)
        ) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('cities')->truncate();
            DB::table('states')->truncate();
            DB::table('countries')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $output = $this->command->getOutput();
            $output->writeln("<comment>Warning:</comment> Geo data will seed again.");
            $this->seedCountries();
            $this->seedStates();
            $this->seedCities();
        } else {
            if (isset($this->command)) {
                $this->command->getOutput()->writeln("<info>GEO DATA:</info> Data is already seeded");
            }
        }
    }

    private function seedCountries() {
        $output = $this->command->getOutput();
        $count = count($this->countries_file);
        $output->writeln("<info>Cargando los paises:</info> $count.");
        $output->progressStart($count);
        foreach ($this->countries_file as $line) {
            $data = explode(",", $line);
            $name = $data[0];
            $full_name = $data[1];
            $phone_code = $data[2];
            $arr_data= [
                "name"      => $name,
                "full_name"  => $full_name,
                "phone_code" => $phone_code
            ];
            // dd($arr_data);
            Country::create($arr_data);
            $output->progressAdvance();
        }
        $output->progressFinish();
    }

    private function seedStates() {
        $argentina = Country::where("name", "Argentina")->first();
        $argentina_id = $argentina->id;
        $output = $this->command->getOutput();
        $count = count($this->states_file);
        $output->writeln("<info>Cargando las provincias:</info> $count.");
        // dd($lines);
        $output->progressStart($count);
        foreach ($this->states_file as $line) {
            $data = explode(",", $line);
            $name = $data[1];
            $arr_data= [
                "name"      => $name,
                "country_id"  => $argentina_id,
            ];
            // dd($arr_data);
            State::create($arr_data);
            $output->progressAdvance();
        }
        $output->progressFinish();
    }

    private function seedCities() {
        $output = $this->command->getOutput();
        $count = count($this->cities_file);
        $output->writeln("<info>Cargando las ciudades:</info> $count.");
        // dd($lines);
        $output->progressStart($count);
        foreach ($this->cities_file as $line) {
            $data = explode(",", $line);
            $name = $data[1];
            $cp = (int) $data[2];
            $state_id = (int) $data[3];
            $arr_data= [
                "name"      => $name,
                "cp"        => $cp,
                "full_name" => NULL,
                "state_id"  => $state_id,
            ];
            // dd($arr_data);
            City::create($arr_data);
            $output->progressAdvance();
        }
        $output->progressFinish();
    }
}
