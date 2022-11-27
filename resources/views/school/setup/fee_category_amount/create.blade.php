<x-main-app-layout>
    {{-- Modify --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <x-form :route="route('setups.fee.category.amount.store')">

        @if (!empty($errors->all()))
            <div class="row mb-3">
                <x-input-error :messages="$errors->get('amount')" />
            </div>
        @endif
        <div class="add_item">
            {{-- TODO: Fix UI when there is validation --}}
            <x-dropdown name="fee_category_id" label="fee_category_id" selectName="Fee" selectId="amountId">
                <option value="" selected="" disabled="">Select Fee
                    Category</option>
                @foreach ($fee_categories as $category)
                    <option value="{{ $category->id }}" {{ selected(old('fee_category_id', ''), $category->id) }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-dropdown>
            <x-dropdown name="class_id[]" label="class_id[]" selectName="Student Class" selectId="classId">
                <option value="" selected="" disabled="">Select Student Class</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}" {{ selected(old('class_id[]', ''), $class->id) }}>
                        {{ $class->name }}
                    </option>
                @endforeach
            </x-dropdown>
            <x-input class="{{ is_filled($errors->all()) }}">
                <x-input-label>
                    <x-slot:label>
                        Amount
                    </x-slot:label>
                </x-input-label>
                <input name="amount[]" type="text" class="form-control" value="{{ old('amount[]') }}" required>
            </x-input>
            <div class="d-flex justify-content-between">
                <span class="btn btn-info addeventmore">Add Class</span>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

        {{-- TODO: Must add elements before buttons and --}}
        <div style="visibility: hidden;">
            <div class="whole_extra_item_add" id="whole_extra_item_add">
                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                    <x-dropdown name="class_id[]" label="class_id[]" selectName="Student Class" selectId="classId">
                        <option value="" selected="" disabled="">Select Student Class</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" {{ selected(old('class_id[]', ''), $class->id) }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </x-dropdown>
                    <x-input class="{{ is_filled($errors->all()) }}">
                        <x-input-label>
                            <x-slot:label>
                                Amount
                            </x-slot:label>
                        </x-input-label>
                        {{-- TODO: Label to go up not working --}}
                        <input name="amount[]" type="text" class="form-control" value="{{ old('amount[]') }}">
                    </x-input>
                    <div class="col-md-2" style="padding-top: 25px;">
                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>
                    </div><!-- End col-md-2 -->
                </div>
            </div>
        </div>
    </x-form>

    @push('scripts')
        @include('school.setup.fee_category_amount.includes.script')
    @endpush
</x-main-app-layout>
