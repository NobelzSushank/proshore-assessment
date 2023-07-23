<x-cms-master>

    <x-breadcrumb :title="$pageTitle" :maintitleroute="'user.index'" :maintitle="'Customer'" :item="'3'"/>

    <x-error />
    <x-success />


    <x-form-base :route="'user.store'" :title="$pageTitle" :subTitle="$subTitle">

        <!-- Name -->
        <x-input-field
            :label="'Full Name'"
            :name="'name'"
            :placeholder="'Please enter name here.'"
            :required="TRUE"
            :autofocus="TRUE"
            :col="'6'"
        />

        <!-- Email -->
        <x-input-field
            :label="'Email'"
            :name="'email'"
            :placeholder="'Please enter email here.'"
            :required="TRUE"
            :autofocus="TRUE"
            :col="'6'"
        />

        <!-- Password -->
        <x-input-field
            :type="'password'"
            :label="'Password'"
            :name="'password'"
            :placeholder="'Please enter password here.'"
            :required="TRUE"
            :autofocus="TRUE"
            :col="'6'"
        />

        <!-- Roles -->
        <x-select-field
            :label="'Select Roles'"
            :name="'role_id'"
            :placeholder="'Select Roles'"
            :required="true"
            :values="$roles"
            :title="'name'"
            :val_id="'id'"
            :id="'role_id'"
            :col="'6'"
        />

        <!-- Buttons -->
        <x-button :title="'Save'" :col="2" :name="'save'" class="w-100" />

    </x-form-base>

</x-cms-master>