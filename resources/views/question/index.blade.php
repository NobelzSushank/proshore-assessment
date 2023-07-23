<x-cms-master>

    <x-breadcrumb :title="$pageTitle" :method="''" :maintitleroute="'question.index'" :maintitle="'Location'" :item="'3'"/>

    <x-error />
    <x-success />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap align-items-center">
                        <h4 class="card-title">{{$pageTitle}} List</h4>

                        <div class="ms-auto">
                            <div>
                                <a href="{{route('question.create')}}" type="button" class="btn btn-primary btn-md">
                                    <i class="bx bx-plus"></i> New {{$pageTitle}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <table id="car-tables" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SN.</th>
                            <th>Question</th>
                            <th>Option A</th>
                            <th>Option B</th>
                            <th>Option C</th>
                            <th>Option D</th>
                            <th>Answer</th>
                            <th>Subject</th>
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
            $("#car-tables").DataTable({
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
                ajax: "{{route('question.index')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'question', name: 'question'},
                    {data: 'option_a', name: 'option_a'},
                    {data: 'option_b', name: 'option_b'},
                    {data: 'option_c', name: 'option_c'},
                    {data: 'option_d', name: 'option_d'},
                    {data: 'answer', name: 'answer'},
                    {data: 'subject', name: 'subject'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ]
            });
        });

        $('#car-tables').on('click', '#delete-btn', function (event) {
            event.preventDefault();
            event.stopPropagation();
            var id = $(this).data('id');
            var delete_url = "{{ route('question.destroy', '') }}/" + id;

            showConfirmationDialog(delete_url);
        });
    </script>
        
    @endpush

</x-cms-master>