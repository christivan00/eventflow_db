<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    // 1. POST: Tambah Job baru ke dalam Board
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_board' => 'required|exists:tb_board,id_board',
            'deskripsi' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()], 400);
        }

        $job = Job::create([
            'id_board' => $request->id_board,
            'deskripsi' => $request->deskripsi,
            'ck_job' => 0 // Default belum selesai (false)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Job berhasil ditambahkan',
            'data' => $job
        ]);
    }

    // 2. PUT: Update Checklist (Centang / Uncentang)
    public function updateChecklist(Request $request, $id_job)
    {
        $job = Job::find($id_job);

        if (!$job) {
            return response()->json(['status' => false, 'message' => 'Job tidak ditemukan'], 404);
        }

        // Ubah status ck_job (misal dikirim 1 atau 0)
        $job->ck_job = $request->ck_job; 
        $job->save();

        return response()->json([
            'status' => true,
            'message' => 'Status job diupdate',
            'data' => $job
        ]);
    }
    
    // 3. DELETE: Hapus Job
    public function destroy($id_job)
    {
        $job = Job::find($id_job);
        if ($job) {
            $job->delete();
            return response()->json(['status' => true, 'message' => 'Job dihapus']);
        }
        return response()->json(['status' => false, 'message' => 'Job tidak ditemukan'], 404);
    }
}