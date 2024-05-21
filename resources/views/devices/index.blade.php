@extends('adminlte::page')

@section('title', 'All Devices')

@section('content_header')
<h1>All Devices</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row">
        <div class="col d-flex justify-content-end pb-3">
           <a href="{{ route('devices.createQR') }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> Generate QR</a>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-between pb-3">
            <a href="{{ route('devices.printEmptyQR') }}" class="btn btn-outline-dark" id="printEmptyQRButton" target="_blank"><i class="fas fa-print"></i> Print Empty QR</a>
            <a href="#" class="btn btn-outline-danger ml-3" id="deleteSelectedData" style="display: none;"><i class="fa fa-trash"></i> Delete Selected</a>
        </div>
    </div>
</div>
<div class="table-responsive py-3">
    <table class="table table-bordered table-hover devicesTable text-center" id="devicesTable">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Name</th>
                <th class="text-center">Serial Number</th>
                <th class="text-center">Cal. Date</th>
                <th class="text-center">Status</th>
                <th class="text-center">Generated by</th>
                <th class="text-center">Action</th>
                <th><input type="checkbox" name="checkboxAll" id="checkboxAll"></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@stop

@section('css')

@stop

@section('js')
<script>
    $(document).ready(function () {
        var table = $('.devicesTable').DataTable({
            autoWidth: true,
            lengthMenu: [
                [10, 25, 50, 100, 250, 500, 1000, -1],
                [10, 25, 50, 100, 250, 500, 1000, 'All']
            ],
            pageLength: 100,
            processing: true,
            serverSide: true,
            ajax: "{{ route('devices.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'no', orderable: false, searchable: false},
                {data: 'names.name', name: 'names.name', width:'30%'},
                {data: 'serial_number', name: 'serial_number'},
                {data: 'calibration_date', name: 'calibration_date'},
                {data: 'status', name: 'status'},
                {data: 'users.name', name: 'users.name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false}
            ],
        });

        $('#checkboxAll').on('click', function(e){
            if($(this).is(':checked', true)){
                $('.devicesTable tbody :checkbox').prop('checked', $(this).is(':checked'));
                document.getElementById("deleteSelectedData").style.display = "";
                e.stopImmediatePropagation();
            }else{
                $('.devicesTable tbody :checkbox').prop('checked', $(this).is(''));
                document.getElementById("deleteSelectedData").style.display = "none";
                e.stopImmediatePropagation();
            }
        });

        $('.checkboxClass').on('click', function() {
            if($('.checkboxClass:checked').length == $('.checkboxClass').length){
                $('#checkboxAll').prop('checked', true);
            }else{
                $('#checkboxAll').prop('checked', false);
            }
        });

        $('#deleteSelectedData').on('click', function(e){
            var deviceIdArr = [];
            $(".checkboxClass:checked").each(function(){
                deviceIdArr.push($(this).attr('data-id'));
            });

            if(deviceIdArr.length <= 0){
                alert("Pilih data yang ingin dihapus");
            }else{
                if(confirm("Yakin ingin menghapus data yang dipilih?")){
                    var devIds = deviceIdArr.join(",");
                    $.ajax({
                        url: "{{ route('devices.deleteSelected') }}",
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'devIds='+devIds,
                        success: function(data){
                            if(data['status'] == true){
                                $('.checkboxClass:checked').each(function(){
                                    $(this).parents("devId").remove();
                                });
                                alert(data['message']);
                                setTimeout(function(){// wait for 5 secs(2)
                                    location.reload(); // then reload the page.(3)
                                }, 500);
                            }else{
                                alert('Terjadi error.');
                            }
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });
                }
            }
        });

  });
</script>

@stop
