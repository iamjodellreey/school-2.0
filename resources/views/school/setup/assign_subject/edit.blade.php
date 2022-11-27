<x-main-app-layout>
    {{-- Modify --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <x-form :route="route('setups.assign.subject.update', $editData[0]->class_id)">

        @if (!empty($errors->all()))
            <div class="row mb-3">
                <x-input-error :messages="$errors->get('amount')" />
            </div>
        @endif
        <div class="add_item">
            {{-- TODO: Fix UI when there is validation --}}
            <x-dropdown name="class_id" label="class_id" selectName="Class" selectId="classId">
                <option value="" selected="" disabled="">Select Class</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}"
                        {{ selected(intval(old('class_id', $editData['0']->class_id)), $class->id) }}>
                        {{ $class->name }}
                    </option>
                @endforeach
            </x-dropdown>

            @foreach ($editData as $edit)
                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                    <x-dropdown name="subject_id[]" label="subject_id[]" selectName="Subject" selectId="subjectId">
                        <option value="" selected="" disabled="">Select Subject</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                {{ selected(intval(old('subject_id[]', $edit->subject_id)), $subject->id) }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </x-dropdown>
                    <x-input class="{{ is_filled($errors->all(), $edit) }}">
                        <x-input-label>
                            <x-slot:label>
                                Full Mark
                            </x-slot:label>
                        </x-input-label>
                        <input name="full_mark[]" type="text" class="form-control"
                            value="{{ old('full_mark[]', $edit->full_mark) }}" required>
                    </x-input>
                    <x-input class="{{ is_filled($errors->all(), $edit) }}">
                        <x-input-label>
                            <x-slot:label>
                                Pass Mark
                            </x-slot:label>
                        </x-input-label>
                        <input name="pass_mark[]" type="text" class="form-control"
                            value="{{ old('pass_mark[]', $edit->pass_mark) }}" required>
                    </x-input>
                    <x-input class="{{ is_filled($errors->all(), $edit) }}">
                        <x-input-label>
                            <x-slot:label>
                                Subjective Mark
                            </x-slot:label>
                        </x-input-label>
                        <input name="subjective_mark[]" type="text" class="form-control"
                            value="{{ old('subjective_mark[]', $edit->subjective_mark) }}" required>
                    </x-input>
                </div>
            @endforeach

            <div class="d-flex justify-content-between">
                <span class="btn btn-info addeventmore">Add Subject</span>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

        {{-- TODO: Must add elements before buttons and --}}
        <div style="visibility: hidden;">
            <div class="whole_extra_item_add" id="whole_extra_item_add">
                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                    <x-dropdown name="subject_id[]" label="subject_id[]" selectName="Subject" selectId="classId">
                        <option value="" selected="" disabled="">Select Subject</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ selected(old('subject_id[]', ''), $subject->id) }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </x-dropdown>
                    <x-input class="{{ is_filled($errors->all()) }}">
                        <x-input-label>
                            <x-slot:label>
                                Full Mark
                            </x-slot:label>
                        </x-input-label>
                        <input name="full_mark[]" type="text" class="form-control" value="{{ old('full_mark[]') }}">
                    </x-input>
                    <x-input class="{{ is_filled($errors->all()) }}">
                        <x-input-label>
                            <x-slot:label>
                                Pass Mark
                            </x-slot:label>
                        </x-input-label>
                        <input name="pass_mark[]" type="text" class="form-control" value="{{ old('pass_mark[]') }}">
                    </x-input>
                    <x-input class="{{ is_filled($errors->all()) }}">
                        <x-input-label>
                            <x-slot:label>
                                Subjective Mark
                            </x-slot:label>
                        </x-input-label>
                        <input name="subjective_mark[]" type="text" class="form-control"
                            value="{{ old('subjective_mark[]') }}">
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
