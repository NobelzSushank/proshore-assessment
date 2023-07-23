<!-- Sweet Alert Laravel Confirmation Try -->
<script>
    function showConfirmationDialog(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3d4144',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'delete',
                    data: {'_token': '{{ @csrf_token() }}'},
                    success: function (result) {
                        if (result.success) {
                            Swal.fire(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            })
                        } else {
                            Swal.fire(
                                'Error!',
                                'Some Problem Occured. Please Try again later.',
                                'error'
                            ).then(() => {
                                location.reload();
                            })
                        }
                    },
                    error: function (result) {
                        console.log(result.success)
                        Swal.fire(
                            'Error!',
                            'Some Problem Occured. Please Try again later.',
                            'error'
                        ).then(() => {
                            location.reload();
                        })
                    }
                })
            } else {
                Swal.fire("Cancelled", "Deletion Cancelled", "error");
            }
        })
    }
</script>

<!-- Alertify -->
@php
    $errors = Session::get('error');
    $messages = Session::get('success');
    $info = Session::get('info');
    $warnings = Session::get('warning')
@endphp

{{-- @if (is_array($errors)) @foreach($errors as $key => $value)
    <script>
        alertify.error("{{ $value }}")
    </script>
@endforeach @endif

@if ($messages) @foreach($messages as $key => $value)
    <script>
        alertify.success("{{ $value }}")
    </script>
@endforeach @endif

@if ($info) @foreach($info as $key => $value)
    <script>
        alertify.info("{{ $value }}")
    </script>
@endforeach @endif

@if ($warnings) @foreach($warnings as $key => $value)
    <script>
        alertify.warning("{{ $value }}")
    </script>
@endforeach @endif --}}
