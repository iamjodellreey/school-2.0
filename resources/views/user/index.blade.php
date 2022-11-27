<x-main-app-layout>
    <x-table>
        <x-slot:title>
            Users Table
        </x-slot:title>

        <x-slot:thead>
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        User</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Role</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Code</th>
                    <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>
        </x-slot:thead>

        <x-slot:tbody>
            @foreach ($allData as $user)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div>
                                <img src="{{ asset('assets/img/team-2.jpg') }}"
                                    class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $user->role }}</p>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $user->code }}</span>
                    </td>

                    <td class="align-middle">
                        {{-- TODO: Put this in a reasonable place --}}
                        <a href="{{ route('users.create') }}" class="text-secondary font-weight-bold text-xs"
                            data-toggle="tooltip" data-original-title="Edit user"><i class="material-icons opacity-10">
                                add_circle
                            </i>
                        </a>

                        <a href="{{ route('users.edit', ['user' => $user]) }}"
                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                            data-original-title="Edit user"><i class="material-icons opacity-10">
                                edit
                            </i>
                        </a>

                        <a href="{{ route('users.delete', ['user' => $user]) }}"
                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                            data-original-title="Delete user">
                            <i class="material-icons opacity-10">
                                delete
                            </i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </x-slot:tbody>
    </x-table>
</x-main-app-layout>
