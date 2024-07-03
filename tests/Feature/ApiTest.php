<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function testFlowClearPushPushPullClearPull()
    {
        // Hapus data
        $response = $this->delete('/clear');
        $response->assertStatus(200);

        // Simpan data 1
        $ktp1 = [
            'field1' => 'value1',
            'field2' => 'value2',
            'field3' => 'value3'
        ];
        $response = $this->post('/push', $ktp1);
        $response->assertStatus(200);
        $response->assertJson($ktp1);

        // Simpan data 2
        $ktp2 = [
            'nik' => 'nik2',
            'nama' => 'nama2',
            'tempat_lahir' => 'tempat_lahir2'
        ];
        $response = $this->post('/push', $ktp2);
        $response->assertStatus(200);
        $response->assertJson($ktp2);

        // Ambil data
        $response = $this->get('/pull');
        $response->assertStatus(200);
        $response->assertJson([
            'total' => 2,
            'data' => [$ktp1, $ktp2]
        ]);

        // Hapus data
        $response = $this->delete('/clear');
        $response->assertStatus(200);

        // Ambil data ulang
        $response = $this->get('/pull');
        $response->assertStatus(200);
        $response->assertJson([
            'total' => 0,
            'data' => []
        ]);
    }
}