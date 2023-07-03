<x-app-layout>
    <x-slot name="header">
        <div class="room-header-container">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('支払い記録の追加') }}
            </h2>
            <div class="back-button">
                <form action="{{ route('room.show', ['room' => $room->id]) }}" method="GET">
                    <button type="submit" class="ml-3">
                        戻る
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div>
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif
    </div>

    <form method="POST" action="{{ route('room_edit.store', ['room' => $room->id])  }}" class="max-w-md mx-auto make-room">
        @csrf

        <!-- Lender Name -->
        <div>
            <x-input-label for="payer" :value="__('余分に支払った人')" />
            <select name="payer" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="payer" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Money -->
        <div class="mt-4">
            <x-input-label for="money" :value="__('金額')" />
            <x-text-input id="money" class="block mt-1 w-full"
                            type="number"
                            name="money"
                            required autocomplete="off" />

            <x-input-error :messages="$errors->get('money')" class="mt-2" />       
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ml-4">
                {{ __('追加') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>