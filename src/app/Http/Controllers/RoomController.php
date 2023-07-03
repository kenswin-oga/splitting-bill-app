<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\RoomEntries;
use App\Models\User;
use App\Models\MoneyRecords;

class RoomController extends Controller
{
    public function show(Room $room) {
        $roomEntries = RoomEntries::where('room_id', $room->id)->get();

        // エントリーuserのidを取得
        $userIds = $roomEntries->pluck('user_id');

        // roomに関連するmoney_recordsのレコードを取得する
        $moneyRecords = $room->moneyRecords;

        // 一人目の貸し金額の合計
        $firstUserRecords = $moneyRecords->where('lender_id', $userIds[0]);
        $firstTotalAmount = $firstUserRecords->sum('money_amount');
        
        // 二人目
        $secondUserRecords = $moneyRecords->where('lender_id', $userIds[1]);
        $secondTotalAmount = $secondUserRecords->sum('money_amount');

        // 差し引きの合計
        $totalSubtraction =  $firstTotalAmount - $secondTotalAmount;

        return view('room', compact('room', 'totalSubtraction'));
    }

    public function edit(Room $room) {
        // ルームの全てのエントリーユーザーのリストを取得
        $roomUsers = $room->roomEntries->pluck('user_id');

        // 選択肢として表示するユーザーのリストを取得
        $users = User::whereIn('id', $roomUsers)->get();
        return view('room_edit', compact('room', 'users'));
    }

        public function store(Request $request, $room)
    {
        $validatedData = $request->validate([
            'payer' => 'required',
            'money' => 'required|numeric',
        ]);

        // MoneyRecords モデルのインスタンスを作成してデータを設定
        $moneyRecord = new MoneyRecords;
        $moneyRecord->room_id = $room;
        $moneyRecord->lender_id = $validatedData['payer'];
        $moneyRecord->money_amount = $validatedData['money'];

        // 保存
        $moneyRecord->save();

        // 成功時のリダイレクトなどの処理を追加
        // ...

        $request->session()->flash('message', '支払い情報を追加しました');

        return back();
    }
}
