<x-cms-master>

    <x-breadcrumb :title="$pageTitle" :maintitleroute="'question.index'" :maintitle="'Customer'" :item="'3'"/>

    <x-error />
    <x-success />


    <x-form-base :route="'question.store'" :title="$pageTitle" :subTitle="$subTitle">

        <!-- Question -->
        <x-text-area-field
            :label="__('Question')"
            :name="'question'"
            :id="'question'"
            :placeholder="__('Enter question here...')"
            :required="TRUE"
        />

        <!-- Option A -->
        <x-input-field
            :label="'Option A'"
            :name="'option_a'"
            :placeholder="'Please enter option a here.'"
            :required="TRUE"
            :autofocus="TRUE"
            :col="'6'"
        />

        <!-- Option B -->
        <x-input-field
            :label="'Option B'"
            :name="'option_b'"
            :placeholder="'Please enter option b here.'"
            :required="TRUE"
            :autofocus="TRUE"
            :col="'6'"
        />

        <!-- Option C -->
        <x-input-field
            :label="'Option C'"
            :name="'option_c'"
            :placeholder="'Please enter option c here.'"
            :required="TRUE"
            :autofocus="TRUE"
            :col="'6'"
        />

        <!-- Option D -->
        <x-input-field
            :label="'Option D'"
            :name="'option_d'"
            :placeholder="'Please enter option d here.'"
            :required="TRUE"
            :autofocus="TRUE"
            :col="'6'"
        />

        <!-- Answer -->
        <x-select-field
            :label="__('Answer')"
            :placeholder="__('Select answer')"
            :name="'answer'"
            :id="'answer'"
            :required="TRUE"
            :col="6"
        >
            <option value="a"> {{ __('A') }}</option>
            <option value="b"> {{ __('B') }}</option>
            <option value="c"> {{ __('C') }}</option>
            <option value="d"> {{ __('D') }}</option>
        </x-select-field>


        <!-- Subject -->
        <x-select-field
            :label="__('Subject')"
            :placeholder="__('Select subject')"
            :name="'subject'"
            :id="'subject'"
            :required="TRUE"
            :col="6"
        >
            <option value="physics"> {{ __('Physics') }}</option>
            <option value="chemistry"> {{ __('Chemistry') }}</option>
        </x-select-field>

        <!-- Buttons -->
        <x-button :title="'Save'" :col="2" :name="'save'" class="w-100" />

    </x-form-base>

</x-cms-master>