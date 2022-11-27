<x-main-app-layout>
    <x-form :route="route('setups.exam.type.update', ['studentShift' => $examType->id])">

        @if (!empty($errors->all()))
            <div class="row mb-3">
                <x-input-error :messages="$errors->get('name')" />
            </div>
        @endif

        {{-- TODO: Fix UI when there is validation --}}
        <x-input class="{{ is_filled($errors->all(), $examType) }}">
            <x-input-label>
                <x-slot:label>
                    Type
                </x-slot:label>
            </x-input-label>
            <input name="name" type="text" class="form-control" value="{{ old('name', $examType->name) }}" required>
        </x-input>
        <div class="d-flex flex-row-reverse">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </x-form>
</x-main-app-layout>
