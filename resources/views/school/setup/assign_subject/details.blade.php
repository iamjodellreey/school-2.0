<x-main-app-layout>
    <x-table>
        <x-slot:title>
            {{ $detailsData['0']['student_class']['name'] }}
        </x-slot:title>

        <x-slot:thead>
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        SL</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Subject</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Full Mark</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Pass Mark</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Subjective Mark</th>
                </tr>
            </thead>
        </x-slot:thead>

        <x-slot:tbody>
            @foreach ($detailsData as $key => $detail)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            {{ $key + 1 }}
                        </div>
                    </td>
                    <td>
                        {{ $detail['school_subject']['name'] }}
                    </td>
                    <td>
                        {{ $detail->full_mark }}
                    </td>
                    <td>
                        {{ $detail->pass_mark }}
                    </td>
                    <td>
                        {{ $detail->subjective_mark }}
                    </td>
                </tr>
            @endforeach
        </x-slot:tbody>
    </x-table>
</x-main-app-layout>
