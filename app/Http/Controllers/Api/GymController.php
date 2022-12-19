<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gym;
use App\Models\GymEquipment;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class GymController extends Controller
{
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile("gym_image") ){
            $request->file("gym_image")->store("public/gym");
            return Gym::create([                    
                'gym_name'=> $request->gym_name,
                'gym_image'=> $request->file("gym_image")->hashName(),
                'gym_description'=> $request->gym_description,
                'gym_floor'=> $request->gym_floor,
                'gym_term_of_use'=> $request->gym_term_of_use,
                'gym_timing'=> $request->gym_timing,
            ]);

            
        }
    }

    /**
     * Display the specified resource.
     *
     
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       return Gym::with('equipments')->find(1);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->hasFile("gym_image") ){
            $request->file("gym_image")->store("public/gym");
            return Gym::finf(1)->update([                    
                'gym_name'=> $request->gym_name,
                'gym_image'=> $request->file("gym_image")->hashName(),
                'gym_description'=> $request->gym_description,
                'gym_floor'=> $request->gym_floor,
                'gym_term_of_use'=> $request->gym_term_of_use,
                'gym_timing'=> $request->gym_timing,
            ]);
        }else{
            return Gym::finf(1)->update([                    
                'gym_name'=> $request->gym_name,
                'gym_description'=> $request->gym_description,
                'gym_floor'=> $request->gym_floor,
                'gym_term_of_use'=> $request->gym_term_of_use,
                'gym_timing'=> $request->gym_timing,
            ]);
        }

       
    }

    /**
     * Remove the specified resource from storage.
     *
    
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        return Gym::destroy(1);
     
    }

    public function gymEquipment()
    {
        return GymEquipment::all();
     
    }

    public function add_gym_equipment(Request $request)
    {

        if ($request->hasFile("gym_equipment_image") ){
            $request->file("gym_equipment_image")->store("public/gym");
            return GymEquipment::create([                    
                'gym_equipement_name'=> $request->gym_equipement_name,
                'gym_equipment_image'=> $request->file("gym_equipment_image")->hashName(),
                'gym_id'=>1,
               
            ]);

            
        }
     
    }

    public function update_gym_equipment(Request $request,$id)
    {
        if ($request->hasFile("gym_equipment_image") ){
            $request->file("gym_equipment_image")->store("public/gym");
            return GymEquipment::find($id)->update([                    
                'gym_equipement_name'=> $request->gym_equipement_name,
                'gym_equipment_image'=> $request->file("gym_equipment_image")->hashName(),
              ]);
        }
    }
    public function show_gym_equipment($id)
    {
       return GymEquipment::find($id);
    }

    public function destroy_gym_equipment($id)
    {
        return GymEquipment::destroy($id);
     
    }


}
