<x-cms-master>

    <x-breadcrumb :title="$pageTitle.' Model'" :method="'Create'" :maintitleroute="'questionnaire.index'" :maintitle="'Questionnaire'" :item="'3'"/>

    <x-error />
    <x-success />

    <x-form-base :route="'questionnaire.store'" :title="$pageTitle .' Model'" :subTitle="$subTitle">  

        <!-- Title -->
        <x-input-field :label="'Title'" :name="'title'" :id="'title'" :placeholder="'Please enter title here.'" :required="TRUE" :autofocus="TRUE" :col="'6'"/>

        <!-- Expiry Date -->
        <x-input-field :label="'Expiry Date'" :name="'expiry_date'" :id="'expiry_date'" :placeholder="'Please enter expiry date here.'" :required="TRUE" :autofocus="TRUE" :col="'6'"/>

        <!-- Buttons -->
        <x-button :title="'Generate'" :col="2" :name="'generate'" class="w-100" />

    </x-form-base>

    @push('scripts')
    <script>
        $(document).ready(function(){
            flatpickr("#expiry_date",{altInput:!0,altFormat:"F j, Y",dateFormat:"Y-m-d"})
        })
    </script>
    @endpush

</x-cms-master>