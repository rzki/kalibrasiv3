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
            <a href="{{ route('devices.create') }}" class="btn btn-success ml-3"><i class="fa fa-plus" aria-hidden="true"></i>Create New</a>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-start pb-3">
            @if (!$devices->isEmpty())
                <a href="{{ route('devices.printEmptyQR') }}" class="btn btn-outline-dark" id="printEmptyQRButton" target="_blank"><i class="fa fa-print"></i> Print Empty QR</a>
            @endif
            <a href="#" class="btn btn-outline-danger ml-3" id="deleteSelectedData" style="display: none;"><i class="fa fa-trash"></i> Delete Selected</a>
        </div>
    </div>
    <div class="pb-3">
        <table class="table table-bordered" id="devicesTable">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">QR Code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Type</th>
                    <th scope="col">Serial Number</th>
                    <th scope="col">Cal. Date</th>
                    <th scope="col">Next Cal.</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    <th scope="col"><input type="checkbox" name="checkboxAll" id="checkboxAll"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($devices as $device)
                <tr id="devId{{ $device->deviceId }}">
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ asset('storage/'.$device->barcode) }}" alt="" width="100" height="100"></td>
                    <td>{{ $device->names->name ?? '' }}</td>
                    <td>{{ $device->brands}}</td>
                    <td>{{ $device->types}}</td>
                    <td>{{ $device->serial_number }}</td>
                    <td>{{ $device->calibration_date }}</td>
                    <td>{{ $device->next_calibration_date }}</td>
                    <td>{{ $device->status }}</td>
                    <td>
                        <div class="action-form d-flex justify-content-center">
                            <a href="{{ route('devices.qr', $device->deviceId) }}"
                                class="btn btn-info mr-lg-2"><i class="fa fa-circle-info" aria-hidden="true"></i></a>
                            <a href="{{ route('devices.edit', $device->deviceId) }}"
                                class="btn btn-primary mr-lg-2"><i class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                            <a href="{{ route('devices.print', $device->deviceId) }}" class="btn btn-secondary mr-lg-2" target="__blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                            <form action="{{ route('devices.destroy', $device->deviceId) }}" method="post"
                                class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                        aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </td>
                    <td><input type="checkbox" name="deviceIds" class="checkboxClass" data-id="{{ $device->deviceId }}"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script>
    $(document).ready( function () {
        $('#devicesTable').DataTable({
            columnDefs: [
                {className : 'text-center', targets: '_all'},
                {orderable : false, target: 10}],
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('#checkboxAll').on('click', function(e){
            if($(this).is(':checked', true)){
                $('.checkboxClass').prop('checked', true);
                document.getElementById("deleteSelectedData").style.display = "";
            }else{
                $('.checkboxClass').prop('checked', false);
                document.getElementById("deleteSelectedData").style.display = "none";
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
                                }, 1000);
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
    })
</script>
@stop
