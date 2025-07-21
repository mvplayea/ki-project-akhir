<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {

        $karyawan = $request->get('authenticated_karyawan');
        $responseData = [
            'message' => 'Success',
            'data' => $karyawan,
        ];

        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }
}
