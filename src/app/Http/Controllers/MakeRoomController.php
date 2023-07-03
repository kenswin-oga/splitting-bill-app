<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\RoomEntries;
use Illuminate\Support\Facades\Auth;

class MakeRoomController extends Controller
{
    public function make_room() {
        return view('make_room');
    }

    public function store(Request $request) {
        $room = Room::create([
            'room_name' => $request->room_name,
            'password' => $request->password,
            'attend_num' => 1
        ]);

        // RoomEntriesテーブルに関連データを保存
        $user = Auth::user();  // 現在のログインユーザーを取得
        $roomEntries = new RoomEntries;
        $roomEntries->room_id = $room->id;  // Roomテーブルのidを設定
        $roomEntries->user_id = $user->id;  // Userテーブルのidを設定
        $roomEntries->save();

        $request->session()->flash('message', '作成しました');

        return back();
    }
}
