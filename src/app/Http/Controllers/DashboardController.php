<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomEntries;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // userに一致するRoomを検索
        $roomEntries = RoomEntries::where('user_id', $user->id)->get();
        
        // ルームIDの配列を取得
        $roomIds = $roomEntries->pluck('room_id')->toArray();
        
        // ルームIDに一致するルーム情報を取得
        $rooms = Room::whereIn('id', $roomIds)->get();

        return view('dashboard', compact('rooms'));
    }
}
