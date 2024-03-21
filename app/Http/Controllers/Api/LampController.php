<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lamp;
class LampController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lamp::query();

        // Order by name
        $order = $request->order ?? 'name';
        $direction = $request->direction ?? 'asc';
        $query->orderBy($order, $direction);

        // Search by name
        $search = $request->search;
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $lamps = $query->get();

        $result = [
            'data' => $lamps->map(function ($lamp) {
                $lamp->makeHidden(['data']);
                return $lamp;
            }),
        ];

        $message = 'Get all data lamps success';
        $success = true;
        $data = getResponseData($result['data'], $message, $success);

        return response()->json($data, 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $waktuMulai = $request->waktuMulai ?? '00:00';
        $waktuSelesai = $request->waktuSelesai ?? '00:00';
        try {
            $data = [
                "mode" => $request->mode,
                "schedule" => [
                    "on" => $waktuMulai,
                    "off" => $waktuSelesai,
                ],
                "brightness" => 0,
                "lamp_type" => $request->lamp_type,
                "color" => [
                    "r" => 0,
                    "g" => 0,
                    "b" => 0
                ],
                "light_sensor" => [
                    "on" => 0,
                    "off" => 0
                ],
                "days" => []
            ];

            if ($request->mode == 'CUSTOM') {
                $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                foreach ($daysOfWeek as $index => $day) {
                    $data['days'][] = [
                        "day" => $index,
                        "mode" => "MANUAL",
                        "name" => $day,
                        "schedule" => [
                            "on" => "00:00",
                            "off" => "00:00"
                        ],
                        "light_sensor" => [
                            "on" => 0,
                            "off" => 0
                        ]
                    ];
                }
            }

            $request->validate([
                'code' => 'required|unique:lamps',
                'name' => 'required',
                'mode' => 'required|in:CUSTOM,MANUAL,SCHEDULE,LIGHT_SENSOR',
                'lamp_type' => 'required|in:RGB,DIMMABLE,SWITCH',
                'status' => 'nullable',
                'data' => 'nullable|array',
                'pin' => 'required'
            ]);

            $jsonData = json_encode($data);

            $lamp = Lamp::create([
                'name' => $request->name,
                'code' => $request->code,
                'mode' => $request->mode,
                'lamp_type' => $request->lamp_type,
                'status' => $request->status ?? '0',
                'pin' => $request->pin,
                'data' => $jsonData
            ]);

            $lamp->makeHidden(['data']);

            $message = 'Add new lamp success';
            $success = true;
            $data = addResponseData($lamp, $message, $success);
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
     * Display the specified resource.
     */
    public function show(string $code)
    {
        try {
            $lamp = Lamp::where('code', $code)->first();
            if ($lamp) {
                $lamp->makeHidden(['data']);
                $message = 'Get lamp details success';
                $success = true;
                $data = getResponseData($lamp, $message, $success);
                return response()->json($data, 200);
            } else {
                $message = 'Lamp not found';
                $success = false;
                $data = getResponseData(null, $message, $success);
                return response()->json($data, 404);
            }
        } catch (\Exception $e) {
            $result = [
                'message' => $e->getMessage(),
                'success' => false,
            ];
            return response()->json($result, 500);
        }
    }

    public function bulkUpdate(Request $request)
    {
        $data = $request->all();

        foreach ($data as $item) {
            $lamp = Lamp::where('code', $item['code'])->first();

            if ($lamp) {
                $lamp->update([
                    'status' => $item['status'],
                ]);
            } else {
                \Log::warning("Saklar tidak ditemukan.");
                return response()->json(['error' => "Saklar tidak ditemukan."], 404);
            }
        }
        $message = 'Data berhasil disimpan';
        $success = true;
        $data = addResponseData(null, $message, $success);
        $result = [
            'message' => 'Data berhasil disimpan.',
            'success' => true,
        ];

        return response()->json($result, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code)
    {
        $lamp = Lamp::where('code', $code)->first();
        $waktuMulai = $request->waktuMulai ?? '00:00';
        $waktuSelesai = $request->waktuSelesai ?? '00:00';
        $mode =  $request->request->get('edit_mode_lampu' . $request->edit_code);

        if ($mode == 'CUSTOM') {
            $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            $data = [
                "days" => []
            ];

            foreach ($daysOfWeek as $index => $day) {
                $data['days'][] = [
                    "day" => $index,
                    "mode" => "MANUAL",
                    "name" => $day,
                    "schedule" => [
                        "on" => "00:00",
                        "off" => "00:00"
                    ],
                    "light_sensor" => [
                        "on" => 0,
                        "off" => 0
                    ]
                ];
            }
        } else {
            $data = [
                "mode" => $request->edit_mode_lampu . $request->code,
                "schedule" => [
                    "on" => $waktuMulai,
                    "off" => $waktuSelesai,
                ],
                "brightness" => 0,
                "lamp_type" => $request->lamp_type,
                "color" => [
                    "r" => 0,
                    "g" => 0,
                    "b" => 0
                ],
                "light_sensor" => [
                    "on" => 0,
                    "off" => 0
                ],
                "days" => [
                    []
                ]
            ];
        }

            $request->validate([
                'name' => 'required',
                'edit_code' => 'required',
                'edit_mode_lampu' . $request->code => 'in:CUSTOM,MANUAL,SCHEDULE,LIGHT_SENSOR',
                'lamp_type' => 'required|in:RGB,DIMMABLE,SWITCH',
                'status' => 'nullable',
                'pin' => 'required',
                'data' => 'nullable|array'
            ]);

        $jsonData = json_encode($data);

        try {
            if ($lamp) {
                $lamp->update([
                    'code' => $request->edit_code,
                    'name' => $request->name,
                    'mode' => $request->request->get('edit_mode_lampu' . $request->edit_code),
                    'lamp_type' => $request->lamp_type,
                    'status' => $request->status ?? '0',
                    'pin' => $request->pin,
                    'data' => $jsonData
                ]);
                $lamp->makeHidden(['data']);
                $message = 'Update lamp success';
                $success = true;
                $data = updateResponseData($lamp, $message, $success);
                return response()->json($data, 200);
            } else {
                $message = 'Lamp not found';
                $success = false;
                $data = updateResponseData($lamp, $message, $success);
                return response()->json($data, 404);
            }
        } catch (\Exception $e) {
            $result = [
                'message' => $e->getMessage(),
                'success' => false,
            ];
            return response()->json($result, 500);
        }
    }


    public function updateCustomize(Request $request, string $code)
    {
        $lamp = Lamp::where('code', $code)->first();

        $request->validate([
            'name' => 'required',
            'lamp_type' => 'required|in:RGB,DIMMABLE,SWITCH',
            'status' => 'nullable',
            'data' => 'nullable|array'
        ]);

        try {
            $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            if ($lamp) {
                $data = [
                    "mode" => $request->mode,
                    "schedule" => [
                        "on" => '00:00',
                        "off" => '00:00'
                    ],
                    "brightness" => $request->brightness ?? 0,
                    "lamp_type" => $lamp->lamp_type,
                    "color" => [
                        "r" => $request->color_r ?? 0,
                        "g" => $request->color_g ?? 0,
                        "b" => $request->color_b ?? 0
                    ],
                    "light_sensor" => [
                        "on" => 0,
                        "off" => 0
                    ],
                    "days" => []
                ];

                $mode = $request->mode;
                $jsonData = [];

                foreach ($daysOfWeek as $key => $day) {
                    $customModeKey = 'custom_mode_lampu' . $key;
                    $waktuMulaiKey = 'waktuMulai' . $key;
                    $waktuSelesaiKey = 'waktuSelesai' . $key;

                    $customMode = $request->$customModeKey;
                    $waktuMulai = $request->$waktuMulaiKey ?? '00:00';
                    $waktuSelesai = $request->$waktuSelesaiKey ?? '00:00';

                    $data["days"][] = [
                        "day" => $key,
                        "mode" => $customMode,
                        "name" => $day,
                        "schedule" => [
                            "on" => $waktuMulai,
                            "off" => $waktuSelesai,
                        ],
                        "light_sensor" => [
                            "on" => 0,
                            "off" => 0
                        ]
                    ];
                }

                $jsonData = json_encode($data);

                $lamp->update([
                    'code' => $request->edit_code ?? $code,
                    'name' => $request->name,
                    'mode' => $mode,
                    'lamp_type' => $request->lamp_type,
                    'status' => $request->status ?? '0',
                    'data' => $jsonData
                ]);

                $lamp->makeHidden(['data']);
                $message = 'Update lamp success';
                $success = true;
                $data = updateResponseData($lamp, $message, $success);
                return response()->json($data, 200);

            } else {
                $message = 'Lamp not found';
                $success = false;
                $data = updateResponseData($lamp, $message, $success);
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code)
    {
        try {
            $lamp = Lamp::where('code', $code)->first();
            if ($lamp) {
                $lamp->delete();
                $message = 'Delete lamp success';
                $success = true;
                $data = deleteResponseData($message, $success);
                return response()->json($data, 200);
            } else {
                $message = 'Lamp not found';
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

    public function toggleStatus(string $code)
    {
        $lamp = Lamp::where('code', $code)->first();

        if ($lamp) {
            $newStatus = !$lamp->status;
            $lamp->update(['status' => $newStatus]);

            $lamp->makeHidden(['data']);
            $message = 'Toggle lamp status success';
            $success = true;
            $data = updateResponseData($lamp, $message, $success);
            return response()->json($data, 200);
        } else {
            $message = 'Lamp not found';
            $success = false;
            $data = updateResponseData($lamp, $message, $success);
            return response()->json($data, 404);
        }
    }


}
