<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sensor;
use Yajra\DataTables\Facades\DataTables;
use Validator;
class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sensorType = $request->input('sensor_type');
        if ($sensorType) {
            $sensors = Sensor::where('sensor_type', $sensorType)->get();
        } else {
            $sensors = Sensor::all();
        }

        $message = 'Get all sensors success';
        $success = true;
        $data = getResponseData($sensors, $message, $success);
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'code' => 'required|unique:sensors',
                'name' => 'required|unique:sensors',
                'device_id' => 'required',
                'sensor_type' => 'required',
                'pin' => 'required',
                'input_mode' => 'in:digital,analog'
            ]);
            $sensor = Sensor::create([
                'code' => $request->code,
                'name' => $request->name,
                'sensor_type' => $request->sensor_type,
                'pin' => $request->pin,
                'input_mode' => $request->input_mode,
                'device_id' => $request->device_id
            ]);

            $message = 'Add new sensor success';
            $success = true;
            $data = addResponseData($sensor, $message, $success);
            return response()->json($data, 201);
        } catch (\Exception $e) {
            $result = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            return response()->json($result, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $code)
    {
        try {
            $sensor = Sensor::where('code', $code)->first();
            if ($sensor) {
                $message = 'Get sensor details success';
                $success = true;
                $data = getResponseData($sensor, $message, $success);
                return response()->json($data, 200);
            } else {
                $message = 'Get sensor details success';
                $success = false;
                $data = getResponseData($sensor, $message, $success);
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code)
    {
        try {
            $sensor = Sensor::where('code', $code)->first();

            $validator = Validator::make($request->all(), [
                'code' => 'required|unique:sensors,code,' . $sensor->id,
                'name' => 'required',
                'sensor_type' => 'required|in:HUMIDITY,RAIN,TEMPERATURE,LIGHT',
                'pin' => 'required',
                'input_mode' => 'in:digital,analog'
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                $message = $errors->first();
                $success = false;
                $data = updateResponseData($sensor, $message, $success);
                return response()->json($data, 422);
            }

            if ($sensor) {
                $sensor->update([
                    'code' => $request->code,
                    'name' => $request->name,
                    'sensor_type' => $request->sensor_type,
                    'pin' => $request->pin,
                    'input_mode' => $request->input_mode,
                ]);
                $message = 'Update sensor success';
                $success = true;
                $data = updateResponseData($sensor, $message, $success);
                return response()->json($data, 200);
            } else {
                $message = 'Sensor not found';
                $success = false;
                $data = updateResponseData($sensor, $message, $success);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code)
    {
        try {
            $sensor = Sensor::where('code', $code)->first();
            if ($sensor) {
                $sensor->delete();
                $message = 'Delete sensor success';
                $success = true;
                $data = deleteResponseData($message, $success);
                return response()->json($data, 200);
            } else {
                $message = 'Sensor not found';
                $success = false;
                $data = deleteResponseData($message, $success);
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
