<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\RoomEntries;

class IntoRoomController extends Controller
{
    public function into_room() {
        return view('into_room');
    }

    public function store(Request $request) {
        $roomName = $request->room_name;
        $password = $request->password;

        // ルーム名に一致するRoomを検索
        $room = Room::where('room_name', $roomName)->first();

        if (!$room) {
            // ルームが存在しない場合の処理
            $request->session()->flash('message', 'ルームが見つかりませんでした');
            return back();
        }

        if ($room->password !== $password) {
            // パスワードが一致しない場合の処理
            $request->session()->flash('message', 'パスワードが正しくありません');
            return back();
        }

        // ログインユーザーの情報を取得
        $user = Auth::user();

        // 重複参加のチェック
        $existingEntry = RoomEntries::where('room_id', $room->id)->where('user_id', $user->id)->first();
        if ($existingEntry) {
            // 既に参加している場合の処理
            $request->session()->flash('message', '既に参加しています');
            return back();
        }

        // RoomEntriesテーブルにデータを保存
        $roomEntry = new RoomEntries();
        $roomEntry->room_id = $room->id;
        $roomEntry->user_id = $user->id;
        $roomEntry->save();

        $request->session()->flash('message', '参加しました');

        return back();
    }
}
