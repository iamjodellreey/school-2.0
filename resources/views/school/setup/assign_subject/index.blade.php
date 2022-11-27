<x-main-app-layout>
    <x-table>
        <x-slot:title>
            Assign Subjects
        </x-slot:title>

        <x-slot:thead>
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        SL</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Class Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Action</th>
                </tr>
            </thead>
        </x-slot:thead>

        <x-slot:tbody>
            @foreach ($assignSubjectList as $key => $assign)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            {{ $key + 1 }}
                        </div>
                    </td>
                    <td>
                        {{ $assign['student_class']['name'] }}
                    </td>
                    <td class="align-middle">
                        {{-- TODO: Put this in a reasonable place --}}
                        <a href="{{ route('setups.assign.subject.create') }}"
                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                            data-original-title="Edit user"><i class="material-icons opacity-10">
                                add_circle
                            </i>
                        </a>

                        <a href="{{ route('setups.assign.subject.edit', $assign->class_id) }}"
                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                            data-original-title="Edit user"><i class="material-icons opacity-10">
                                edit
                            </i>
                        </a>
                        <a href="{{ route('setups.assign.subject.details', $assign->class_id) }}"
                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                            data-original-title="Delete user">
                            <i class="material-icons opacity-10">
                                info
                            </i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </x-slot:tbody>
    </x-table>
</x-main-app-layout>
