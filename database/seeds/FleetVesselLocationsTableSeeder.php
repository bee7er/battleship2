<?php

use Illuminate\Database\Seeder;
use App\FleetVesselLocation;
use App\FleetVessel;
use App\Fleet;
use App\Vessel;
use Illuminate\Support\Facades\DB;

class FleetVesselLocationsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('fleet_vessel_locations')->delete();

        $dreadNought = Fleet::where('id', 1)->firstOrFail();
        $cruiser = Vessel::where('name', Vessel::VESSEL_TYPE_CRUISER)->firstOrFail();
        $fleetVessel = FleetVessel::where('fleet_id', $dreadNought->id)
            ->where('vessel_id', $cruiser->id)
            ->firstOrFail();

        $fleetVesselLocation = new FleetVesselLocation();
        $fleetVesselLocation->fleet_vessel_id = $fleetVessel->id;
        $fleetVesselLocation->row = 4;
        $fleetVesselLocation->col = 5;
        $fleetVesselLocation->save();

        $fleetVessel->status = FleetVessel::FLEET_VESSEL_STARTED;
        $fleetVessel->save();
    }
}
