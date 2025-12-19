<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BoardController extends Controller
{
    // 1. GET: Ambil semua board milik user tertentu
    public function index(Request $request)
    {
        // Kita cari board berdasarkan id_user yang dikirim (misal: ?id_user=1)
        // with('jobs') artinya kita sekalian bawa data job di dalamnya
        $boards = Board::with('jobs')->where('id_user', $request->id_user)->get();

        return response()->json([
            'status' => true,
            'message' => 'List Board User',
            'data' => $boards
        ]);
    }

    // 2. POST: Buat Board Baru
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|exists:tb_user,id_user', // Pastikan user ada
            'board_name' => 'required',
            'dl_start' => 'required|date',
            'dl_finsh' => 'required|date',
            'bg' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()], 400);
        }

        // Simpan ke database
        $board = Board::create([
            'id_user'    => $request->id_user,
            'board_name' => $request->board_name,
            'dl_start'   => $request->dl_start,
            'dl_finsh'   => $request->dl_finsh,
            'bg'         => $request->bg
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Board berhasil dibuat',
            'data' => $board
        ], 201);
    }

    // 3. GET: Lihat Detail 1 Board (misal saat diklik)
    public function show($id_board)
    {
        $board = Board::with('jobs')->find($id_board);

        if (!$board) {
            return response()->json(['status' => false, 'message' => 'Board tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $board
        ]);
    }
}