<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SensorLog;
use App\Models\Sensor;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use DateTimeZone;

class SensorLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($code)
    {
        $findId = Sensor::where('code', $code)->first();
        $sensors = SensorLog::where('sensor_id', $findId->id)->get();
        $message = 'Get all log sensors success';
        $success = true;
        $data = getResponseData($sensors, $message, $success);
        return response()->json($data, 200);
    }

     /**
     * Display a listing of the resource.
     */

     public function getValue(Request $request)
     {
         $code = $request->input('code');
         $timeFilter = $request->input('time_filter');
         $sensorType = $request->input('type');
         $sensor = Sensor::where('code', $code)->first();
         if ($sensorType === 'RAIN' || $sensorType === 'LIGHT') {
             $valueSensor = $this->getLatestSensorValue($sensor->id, $sensorType);
         } else {
             if ($timeFilter === 'LIVE') {
                 $startTime = Carbon::now()->subMinutes(30)->toDateTimeString();
             } else {
                 if (empty($timeFilter)) {
                     $timeFilter = '30 minutes';
                 }
                 $startTime = Carbon::now()->sub($timeFilter)->toDateTimeString();
             }


             $valueSensor = $this->getFilteredSensorLogs($sensor->id, $startTime, $sensor->name);
         }

         $formattedData = $valueSensor->map(function ($log) {
             return [
                 'label' => Carbon::parse($log->created_at)->setTimezone(new DateTimeZone('Asia/Jakarta'))->format('H:i'),
                 'value' => $log->value,
                 'date' => Carbon::parse($log->created_at)->setTimezone(new DateTimeZone('Asia/Jakarta'))->format('Y-m-d'),
             ];
         })->toArray();

         return [
             'code' => $sensor->code,
             'name' => $sensor->name,
             'data' => $formattedData,
         ];
     }

     private function getFilteredSensorLogs($sensorId, $startTime, $sensorName)
     {
         $filteredLogs = SensorLog::where('sensor_id', $sensorId)
             ->where('created_at', '>=', $startTime)
             ->where('created_at', '<=', Carbon::now()->toDateTimeString())
             ->get();

         foreach ($filteredLogs as $log) {
             $log->sensor_name = $sensorName;
         }

         return $filteredLogs;
     }

     private function getLatestSensorValue($code, $sensorType)
    {
        return SensorLog::where('sensor_id', $code)
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();
    }

    public function bulkInsert(Request $request)
    {
        $data = $request->all();

        foreach ($data as $item) {
            $sensor = Sensor::where('code', $item['code'])->first();

            if ($sensor) {
                SensorLog::create([
                    'sensor_id' => $sensor->id,
                    'value' => $item['value'],
                ]);

                if ($sensor->min_value === null || $item['value'] < $sensor->min_value) {
                    $sensor->min_value = $item['value'];
                }

                if ($sensor->max_value === null || $item['value'] > $sensor->max_value) {
                    $sensor->max_value = $item['value'];
                }

                $sensor->save();
            } else {
                \Log::warning("Sensor dengan kode {$item['code']} tidak ditemukan.");
                return response()->json(['error' => "Sensor dengan kode {$item['code']} tidak ditemukan."], 404);
            }
        }

        $message = 'Add new value sensor success';
        $success = true;
        $data = getResponseData($data, $message, $success);
        return response()->json($data, 201);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $code)
    {
        try {
            $sensor = Sensor::where('code', $code)->first();

            $request->validate([
                'value' => 'required',
            ]);

            $sensorLog = SensorLog::create([
                'sensor_id' => $sensor->id,
                'value' => $request->value,
            ]);

            // Update min_value and max_value in the Sensor table
            if ($sensor->min_value === null || $request->value < $sensor->min_value) {
                $sensor->min_value = $request->value;
            }

            if ($sensor->max_value === null || $request->value > $sensor->max_value) {
                $sensor->max_value = $request->value;
            }

            $sensor->save();

            $message = 'Add new log sensor success';
            $success = true;
            $data = addResponseData($sensorLog, $message, $success);
            return response()->json($data, 201);

        } catch (\Exception $e) {
            $result = [
                'message' => $e->getMessage(),
                'success' => false,
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
            $sensorLogs = SensorLog::where('sensor_id', $sensor->id)->delete();
            $message= 'Delete sensor logs success';
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
            'message' => $e->getMessage(),
            'success' => false
        ];
        return response()->json($result, 500);
    }
}

}
