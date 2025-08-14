<?php

namespace App\Http\Controllers;

use App\Http\Requests\VersionControlRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\VersionControl;

class myController extends Controller
{
    public function store(VersionControlRequest $request)
    {
        try {
            $data = $request->all();

            $key = array_key_first($data);
            $value = $data[$key];

            VersionControl::create([
                'v_key' => $key,
                'v_value' => $value,
                'created_at' => Carbon::now(),
            ]);

            return $this->responseData([
                'message' => 'Success.',
                'data' => [
                    'id' => VersionControl::latest()->first()->id
                ]
            ], 201);

        } catch (\Exception $e) {

            return $this->responseData([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function get($key, Request $request)
    {
        try {
            if (!$key) {
                throw new \Exception('Key is required.', 400);
            }

            $timestamp = $request->query('timestamp');
            if ($timestamp) {
                $dmyUTC = Carbon::createFromTimestampUTC($timestamp);
                $version = VersionControl::where('v_key', $key)
                    ->where('created_at', '<=', $dmyUTC)
                    ->orderBy('created_at', 'desc')
                    ->firstOrFail();
                    // dd($version);
            } else {
                $version = VersionControl::where('v_key', $key)->firstOrFail();
            }
            // $version = VersionControl::where('v_key', $key)->firstOrFail();

            return $this->responseData([
                'message' => 'Success.',
                'data' => [
                    'v_key' => $version->v_key,
                    'v_value' => $version->v_value
                ]
            ], 200);

        } catch (\Exception $e) {

            return $this->responseData([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getAll()
    {
        try {
            $versions = VersionControl::all();

            return $this->responseData([
                'message' => 'Success.',
                'data' => $versions
            ], 200);

        } catch (\Exception $e) {

            return $this->responseData([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function responseData($data, $status = 200)
    {
        return response()->json(
            $data
        , $status);
    }
}




