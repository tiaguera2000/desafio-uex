<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchAddressRequest;
use App\Models\Address;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }

    public function searchAddress(SearchAddressRequest $request){

        try{

        
            $apiKey = env("GOOGLE_API_KEY");
            $street = str_replace(" ", "+", $request->street);
            $addressString = $street;
            if($request->number) $addressString .= "+$request->number";
            $addressString .= "+".$request->city."+".$request->state;
            $addressResponse = json_decode(Http::withHeaders(["accept" => "application/json"])->get("https://maps.googleapis.com/maps/api/geocode/json?address=$addressString&key=$apiKey"),true);
            
            if($addressResponse["status"] == "OK"){
                $addresses = [];

                foreach($addressResponse["results"] as $result){
                    
                    $addressObj = [];
                    $addressObj["lat"] = (float) $result["geometry"]["location"]["lat"];
                    $addressObj["lng"] = (float) $result["geometry"]["location"]["lng"];
                    // $addressObj["lat"] = (int) str_replace(".", "", $result["geometry"]["location"]["lat"]);
                    // $addressObj["lng"] = (int) str_replace(".", "", $result["geometry"]["location"]["lng"]);
                    foreach($result['address_components'] as $component){

                        if($component["types"][0] == "street_number"){
                            $addressObj["number"] = $component["long_name"];
                        }
                        else if($component["types"][0] == "route"){
                            $addressObj["street"] = $component["long_name"];
                        }
                        else if(isset($component["types"][2])){
                            if($component["types"][2] == "sublocality_level_1"){
                                $addressObj["district"] = $component["long_name"];
                            }
                        }
                        else if($component["types"][0] == "administrative_area_level_2"){
                            $addressObj["city"] = $component["long_name"];
                        }
                        else if($component["types"][0] == "administrative_area_level_1"){
                            $addressObj["state"] = $component["short_name"];
                        }
                        else if($component["types"][0] == "postal_code"){
                            $addressObj["zip_code"] = str_replace("-", "", $component["short_name"]);
                        }
                    }
                    array_push($addresses, $addressObj);
                }
                
                
            }
            
            return response(["success" => true, "data" => $addresses],200);
        }
        catch(Exception $e){

            return response(["success" => false, "message" => "fail"], 200);
        }
    }
}
