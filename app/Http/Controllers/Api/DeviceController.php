<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Device;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        $message = 'Get all devices success';
        $success = true;
        $data = getResponseData($devices, $message, $success);
        return response()->json($data, 200);
    }

    public function getJSON()
    {
        $devices = Device::all();
        return DataTables::of($devices)
        ->addColumn('action', function ($item) {
            return '<a class="btn btn btn-sm bg-warning" data-toggle="modal" data-target="#editDevice'.$item->code.'".><i class="far fa-edit p-1" style="color: white"></i></a>
                    <a class="btn btn btn-sm bg-danger" data-toggle="modal" data-target="#deleteDevice'.$item->id.'".><i class="fas fa-trash p-1" style="color: white"></i></a>';
        })
        ->addColumn('created_at', function ($item) {
            return Carbon::parse($item->created_at)->format('Y-m-d H:i:s');
        })
        ->addColumn('updated_at', function ($item) {
            return Carbon::parse($item->updated_at)->format('Y-m-d H:i:s');
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function ping(Request $request, $code)
    {
        $device = Device::where('code', $code)->first();
        if (!$device) {
            $message = 'Device not found';
            $success = false;
            $data = updateResponseData($device, $message, $success);
            return response()->json($data, 404);
        }

        $device->last_ping = now();
        $device->save();
        $message = 'Device updated';
        $success = true;
        $data = updateResponseData($device, $message, $success);
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        try {
            $ping = now();
            $request->validate([
                'name' => 'required|unique:devices',
                'code' => 'required',
            ]);
            $device = Device::create([
                'name' => $request->name,
                'code' => $request->code,
                'last_ping' => $request->last_ping ?? $ping
            ]);

            $message = 'Add new device success';
            $success = true;
            $data = addResponseData($device, $message, $success);
            return response()->json($data, 201);
        } catch (\Exception $e) {
            $result = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            return response()->json($result, 500);
        }
    }

    public function update(Request $request, string $code)
    {
        try {
            $device = Device::where('code', $code)->first();

            $request->validate([
                'name' => 'required',
                'code' => 'required',
            ]);

            if ($device) {
                $device->update([
                    'name' => $request->name,
                    'code' => $request->code,
                    'last_ping' => $request->last_ping ?? $device->last_ping,
                ]);

                $message = 'Update device success';
                $success = true;
                $data = updateResponseData($device, $message, $success);
                return response()->json($data, 200);
            } else {
                $message = 'Device not found';
                $success = false;
                $data = updateResponseData($device, $message, $success);
                return response()->json($data, 404);
            }
        } catch (\Exception $e) {
            $result = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            return response()->json($result, 500);
        }
    }


    public function destroy(string $code)
    {
        try {
            $device = Device::where('code', $code)->first();
            if($device)
            {
                $device->delete();
                $message = 'Delete device success';
                $success = true;
                $data = deleteResponseData($device, $message, $success);
                return response()->json($data, 200);
            } else {
                $message = 'Device not found';
                $success = false;
                $data = deleteResponseData($device, $message, $success);
                return response()->json($data, 404);
            }
        } catch (\Exception $e) {
            $result = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            return response()->json($result, 500);
        }
    }
}
