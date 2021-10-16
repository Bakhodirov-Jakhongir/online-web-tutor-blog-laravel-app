<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();

        return response()->json([
            'status' => true,
            'data' => $devices
        ], 200);
        // return view('device.index', compact('devices'));
    }

    public function create()
    {
        return view('device.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()
            ]);
        }

        $device = new Device();
        $device->name = $request->name;
        if ($request->device)
            $device->status = $request->status;

        $device->save();

        // $request->session()->flash("success", 'Device created successfully!');

        return response()->json([
            'status' => true,
            'data' => $device
        ], 201);

        // return redirect('device');
    }

    public function edit(Device $device)
    {
        return view('device.edit', [
            'device' => $device
        ]);
    }

    public function update(Request $request, $id)
    {
        $device = Device::find($id);

        $device->name = $request->name;

        $device->status = $request->status;

        $device->save();

        $request->session()->flash("success", "Data updated successfully");

        return response()->json([
            'status' => true,
            'data' => $device
        ], 200);
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return response()->json([
            'status' => true,
            'data' => $device
        ], 200);

        // return redirect()->route("device.index")->with("success", "Device deleted successfuly");
    }
}
