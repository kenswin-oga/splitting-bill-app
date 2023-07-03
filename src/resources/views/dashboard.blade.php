<x-app-layout>
    @csrf
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('参加しているルーム一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ul>
                @if($rooms->isEmpty())
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h1>参加しているルームはありません</h1>
                        </div>
                    </div>
                @else
                    @foreach ($rooms as $room)
                        <li>
                            <div class="room-list bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <span class="room-list-name">{{ $room->room_name }}</span>
                                    <span class="flex justify-end ">
                                        <form action="{{ route('room.show', ['room' => $room->id]) }}" method="GET">
                                            <x-primary-button class="ml-3">
                                                {{ __('入室') }}
                                            </x-primary-button>
                                        </form>
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
            
        </div>
    </div>
</x-app-layout>
