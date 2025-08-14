<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\myController;
use App\Http\Requests\VersionControlRequest;
use App\Models\VersionControl;
use Carbon\Carbon;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class VersionApiTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_post_object() {

        $requestData = ['my_key' => 'my_value'];

        $request = new VersionControlRequest();
        $request->replace($requestData);
        

        $controller = new myController();
        $response = $controller->store($request);

        $this->assertTrue($response->status() === 201);

        $this->assertTrue(VersionControl::where('v_key', 'my_key')
                        ->where('v_value', 'my_value')->exists());

    }

    public function test_get_object() {
        $key = 'my_key';
        $request = new \Illuminate\Http\Request();
        $request->query->set('timestamp', time());

        $controller = new myController();
        $response = $controller->get($key, $request);

        $this->assertTrue($response->status() === 200);
        $this->assertTrue($response->getData()->data->v_key === 'my_key');
        $this->assertTrue($response->getData()->data->v_value === 'my_value');
        
        $this->assertTrue(VersionControl::where('v_key', 'my_key')
                        ->where('v_value', 'my_value')
                        ->exists());
    }

    public function test_get_all_records() {
        $controller = new myController();
        $response = $controller->getAll();

        $this->assertTrue($response->status() === 200);
        $this->assertTrue(is_array($response->getData()->data));
        $this->assertNotEmpty($response->getData()->data);
    }

    public function test_get_object_with_timestamp(){
        $key = 'my_key_test';
        $timestamp = time();

        // Create First and use that created instance timestamp for happy flow;
        $lastRecord = VersionControl::create([
            'v_key' => $key,
            'v_value' => 'my_value_test',
            'created_at' => Carbon::now()
        ]);
        $request = new \Illuminate\Http\Request();
        $request->query->set('timestamp', $lastRecord->created_at->timestamp);

        $controller = new myController();
        $response = $controller->get($key, $request);

        $this->assertTrue($response->status() === 200);
        $this->assertTrue($response->getData()->data->v_key === 'my_key_test');
        $this->assertTrue($response->getData()->data->v_value === 'my_value_test');
        
        $this->assertTrue(VersionControl::where('v_key', 'my_key_test')
                        ->where('v_value', 'my_value_test')
                        ->exists());
    }
}

