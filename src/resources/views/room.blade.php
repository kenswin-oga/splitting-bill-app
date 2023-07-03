<x-app-layout>
    <x-slot name="header">
        <div class="room-header-container">
            <h2 class="room-name font-semibold text-xl text-gray-800 leading-tight">
                「{{$room->room_name}}」　ルーム
            </h2>
            <div class="money-edit-button">
                <form action="{{ route('room_edit', ['room' => $room->id]) }}" method="GET">
                    <button type="submit" class="ml-3">
                        ＋
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div id="money-status-container" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="money-status bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="money-amount-container p-6 text-gray-900">
                    <span class="money-amount-name">
                      {{$room->roomEntries[0]->user->name}} さん
                    </span>
                    <span class="money-amount {{ $totalSubtraction >= 0 ? 'positive-amount' : 'negative-amount' }}">
                      ￥{{$totalSubtraction}}
                    </span>
                </div>
            </div>     
            <div class="money-status bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="money-amount-container p-6 text-gray-900">
                    <span class="money-amount-name">
                      {{$room->roomEntries[1]->user->name}} さん
                    </span>
                    <span class="money-amount {{ $totalSubtraction <= 0 ? 'positive-amount' : 'negative-amount' }}">
                      ￥{{-$totalSubtraction}}
                    </span>
                </div>
            </div>                    
        </div>
    </div>
</x-app-layout>
