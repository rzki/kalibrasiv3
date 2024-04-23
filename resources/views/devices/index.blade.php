@extends('adminlte::page')

@section('title', 'All Devices')

@section('content_header')
<h1>All Devices</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row">
        <div class="col d-flex justify-content-end pb-3">
           <a href="{{ route('devices.createQR') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Generate QR</a>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-between pb-3">
            <a href="{{ route('devices.printEmptyQR') }}" class="btn btn-outline-dark" id="printEmptyQRButton" target="_blank"><i class="fa fa-print"></i> Print Empty QR</a>
            <a href="#" class="btn btn-outline-danger ml-3" id="deleteSelectedData" style="display: none;"><i class="fa fa-trash"></i> Delete Selected</a>
        </div>
    </div>
</div>
<div class="table-responsive py-3">
    <table class="table table-bordered table-hover devicesTable text-center" id="devicesTable">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Name</th>
                <th>Serial Number</th>
                <th>Cal. Date</th>
                <th>Status</th>
                <th>Action</th>
                <th><input type="checkbox" name="checkboxAll" id="checkboxAll"></th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($devices as $device)
                <tr id="devId{{ $device->deviceId }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $device->names->name ?? '' }}</td>
                    <td>{{ $device->serial_number }}</td>
                    <td>{{ $device->calibration_date }}</td>
                    <td>{{ $device->status }}</td>
                    <td>
                        <div class="action-form d-flex justify-content-center">
                            <a href="{{ route('devices.qr', $device->deviceId) }}" class="btn btn-info mr-2"><i
                                    class="fa fa-circle-info" aria-hidden="true"></i></a>
                            <a href="{{ route('devices.edit', $device->deviceId) }}" class="btn btn-primary mr-2"><i
                                    class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                            <a href="{{ route('devices.print', $device->deviceId) }}" class="btn btn-secondary mr-2"
                                target="__blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                            <form action="{{ route('devices.destroy', $device->deviceId) }}" method="post"
                                class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                        aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </td>
                    <td class="text-center"><input type="checkbox" name="deviceIds" class="checkboxClass"
                            data-id="{{ $device->deviceId }}"></td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>
    {{-- {{ $dataTable->table(['class' => 'table table-bordered table-hover text-center']) }} --}}
</div>
@stop

@section('css')

@stop

@section('js')
{{-- <script>
    $(document).ready( function () {
        $('#devicesTable').DataTable({
            autoWidth: true,
            columnDefs: [
                    {className : 'text-center', targets: '_all'},
                    {orderable : false, target: 6}
                ],
            lengthMenu: [
                [10, 25, 50, 100, 250, 500, -1],
                [10, 25, 50, 100, 250, 500, 'All']
            ],
        });
    });
</script> --}}
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
                {data: 'names.name', name: 'names.name'},
                {data: 'serial_number', name: 'serial_number'},
                {data: 'calibration_date', name: 'calibration_date'},
                {data: 'status', name: 'status'},
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
