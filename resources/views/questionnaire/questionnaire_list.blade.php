<x-cms-master>

    <x-breadcrumb :title="$pageTitle" :method="''" :maintitleroute="'questionnaire.index'" :maintitle="'Car'" :item="'3'"/>

    <x-error />
    <x-success />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap align-items-center">
                        <h4 class="card-title">{{$pageTitle}} List</h4>
                    </div>
                </div>
                <div class="card-body">

                    <table id="questionnaire-tables" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SN.</th>
                            <th>Title</th>
                            <th>Expiry Date</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(() => {
            $("#questionnaire-tables").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom":
                    "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
                processing: true,
                serverSide: true,
                "scrollX": true,
                "scrollY": false,
                responsive: false,
                ajax: "{{route('questionnaire.list')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'title', name: 'title'},
                    {data: 'expiry_date', name: 'expiry_date', orderable: false},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ]
            });
        });
    </script>
        
    @endpush

</x-cms-master> 