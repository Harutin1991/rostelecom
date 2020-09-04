<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service;
use App\ConnectedServices;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $services = Service::all();
        return view('home',compact('services'));
    }

    /*
     *
     */
    public function getConnectedService(Request $request) {
        if($request->ajax()) {
            $connectedServices = ConnectedServices::where('service_id',$request->get('serviceId'))->get();
            $availableServices = [];
            foreach ($connectedServices as $serviceId) {
                $availableServices[] = $serviceId->connected_service_id;
            }
            return response()->json($availableServices);
        }
    }
}
