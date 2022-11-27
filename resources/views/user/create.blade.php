<x-main-app-layout>
    <x-form :route="route('users.store')">

        @if (!empty($errors->all()))
            <div class="row mb-3">
                <x-input-error :messages="$errors->get('name')" />
                <x-input-error :messages="$errors->get('email')" />
            </div>
        @endif

        {{-- TODO: Fix UI when there is validation --}}
        <x-input class="{{ is_filled($errors->all()) }}">
            <x-input-label>
                <x-slot:label>
                    Name
                </x-slot:label>
            </x-input-label>
            <input name="name" type="text" class="form-control" value="{{ old('name') }}" required>
        </x-input>
        <x-input class="{{ is_filled($errors->all()) }}">
            <x-input-label>
                <x-slot:label>
                    Email
                </x-slot:label>
            </x-input-label>
            <input name="email" type="email" class="form-control" value="{{ old('email') }}" required>
        </x-input>
        <x-dropdown name="role" label="role" selectName="role" selectId="roleId">
            <option value="1" {{ selected(old('role', ''), 'admin') }}>Admin</option>
            <option value="2" {{ selected(old('role', ''), 'operator') }}>Operator</option>
            <option value="3" {{ selected(old('role'), '', 'user') }}>User</option>
        </x-dropdown>
        <div class="d-flex flex-row-reverse">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </x-form>
</x-main-app-layout>
