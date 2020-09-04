<?php

namespace App\Http\Controllers;

use App\Service;
use App\ConnectedServices;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::latest()->paginate(5);

        return view('service.index',compact('services'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('service.create',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:services', 'max:255'],
            'description' => ['required'],
        ]);

        try {
            $service =Service::create( ['name' => $request['name'],'description'=>$request['description']] );
            if(!empty($request['connected_services_id'])) {
                foreach ($request['connected_services_id'] as $key => $value) {
                    $data[$key]['service_id'] = $service->id;
                    $data[$key]['connected_service_id'] = $value;
                }
                ConnectedServices::insert($data);
            }

            $message = "Service created successfully !";
            $messageType = 1;
        } catch(\Illuminate\Database\QueryException $ex){
            $messageType = 2;
            $message = "Service creation failed !";
        }

        return redirect(url("/services"))->with(['messageType'=>$messageType,'message'=>$message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        echo "Show";die;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $connectedServicesIds = [];
        $connectedServices = $service->connectedServices;
        foreach ($connectedServices as $serviceId) {
            $connectedServicesIds[] = $serviceId->connected_service_id;
        }

        $services = Service::where('id', '!=' , $service->id)->get();

        return view('service.edit',compact('service','connectedServicesIds','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:services', 'max:255'],
            'description' => ['required'],
        ]);

        try {
            $service->update( ['name' => $request['name'],'description'=>$request['description']] );
            if(!empty($request['connected_services_id'])) {
                ConnectedServices::where('service_id', $service->id)->delete();
                foreach ($request['connected_services_id'] as $key => $value) {
                    $data[$key]['service_id'] = $service->id;
                    $data[$key]['connected_service_id'] = $value;
                }
                ConnectedServices::insert($data);
            }

            $message = "Service created successfully !";
            $messageType = 1;
        } catch(\Illuminate\Database\QueryException $ex){
            $messageType = 2;
            $message = "Service creation failed !";
        }

        return redirect(url("/services"))->with('messageType', $messageType)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
        } catch (\Illuminate\Database\QueryException $ex){}

        return redirect(url("/services"));
    }
}
