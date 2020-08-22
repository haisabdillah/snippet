<form id="delete" method="POST">
    @csrf
    @method('DELETE')
</form>
@section('js')
    <script>
        function deleteData(route) {
            var route = route
            swal({
                    title: "Are you sure?",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#delete').attr('action', route).submit();
                    } else {
                        swal.close();
                    }
                });
            }
            function deleteDataMultiply(route) {
                var id = [];
                $('.delete-checkbox:checked').each(function () {
                    id.push(parseInt($(this).val()));
                });
                if (id.length > 0) {
                    swal({
                            title: "Are you sure?",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.each(id, function (index, value) {
                                    $('#delete').append('<input type="hidden" name="ids[]" value="' + value + '"/>');
                                });
                                $('#delete').attr('action', route).submit();
                            } else {
                                swal.close();
                            }
                        });
                } else {
                    swal('Data is Empty')
                }
            } 
        </script>
@endsection
