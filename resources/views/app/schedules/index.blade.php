<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.schedules.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex justify-end">
                        @can('create', App\Models\Schedule::class)
                        <a href="{{ route('schedules.create') }}" class="button button-primary">
                            <i class="mr-1 icon ion-md-add"></i>
                            @lang('crud.common.create')
                        </a>
                        @endcan
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent border border-black">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left"></th>
                                <th class="px-4 py-3 text-center">Monday</th>
                                <th class="px-4 py-3 text-center">Tuesday</th>
                                <th class="px-4 py-3 text-center">Wednesday</th>
                                <th class="px-4 py-3 text-center">Thursday</th>
                                <th class="px-4 py-3 text-center">Friday</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @for ($i = 8; $i < 18; $i++)
                                <tr>
                                    <td class="px-4 py-3 text-center border border-black">
                                        {{ \Carbon\Carbon::createFromTime($i, 0, 0)->format('H:i:s') }}
                                        -
                                        {{ \Carbon\Carbon::createFromTime($i+1, 0, 0)->format('H:i:s') }}
                                    </td>
                                    @for ($j = 0; $j < 5; $j++)
                                        <td class="px-4 py-3 text-center border border-black">
                                            @php
                                                $mergedSchedules = [];
                                            @endphp
                                            
                                            @foreach($schedules as $schedule)
                                            @if (\Illuminate\Support\Carbon::parse($schedule->date)->format('N') == ($j + 1) && \Illuminate\Support\Carbon::parse($schedule->start_time)->format('H') <= $i && \Illuminate\Support\Carbon::parse($schedule->end_time)->format('H') > $i)
                                                    @php
                                                        $mergedSchedules[] = $schedule;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if (count($mergedSchedules) > 0)
                                                <div class="mb-2">
                                                    <div class="text-center">
                                                        @foreach($mergedSchedules as $mergedSchedule)
                                                            {{ optional($mergedSchedule->user)->name ?? '-' }}
                                                            <div class="flex justify-center mt-2">
                                                                @can('update', $mergedSchedule)
                                                                    <a href="{{ route('schedules.edit', $mergedSchedule) }}" class="button button-primary mr-2">
                                                                        Edit
                                                                    </a>
                                                                @endcan
                                                                @can('delete', $mergedSchedule)
                                                                    <form class="inline" action="{{ route('schedules.destroy', $mergedSchedule) }}" method="POST" onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="button button-primary">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                @endcan
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    @endfor
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>