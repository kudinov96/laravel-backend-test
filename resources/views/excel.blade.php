<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Excel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach($data as $key => $item)
                        <div style="margin-bottom: 10px;">
                            <b>{{ $key }}</b>
                            @foreach($item as $subitem)
                                <div>{{ $subitem["id"] }}, {{ $subitem["name"] ?? null }}, {{ $subitem["date"] ?? null }}</div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

