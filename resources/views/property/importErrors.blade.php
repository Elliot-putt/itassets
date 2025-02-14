@extends('layouts.app')

@section('title', 'Property Import Errors')


@section('css')
    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet"/>
@endsection

@section('content')
    {{--    <form action="/components/create/import" method="POST">--}}

    <div class="d-sm-flex align-items-center justify-content-between mb-4"><?php  ?>
        <h1 class="h3 mb-0 text-gray-800">Import Failures</h1>
        @php $errorRows = '';foreach($errorArray as $id => $key){ $errorRows = !empty($errorRows)? $errorRows.', '.$id:$id;}  @endphp

        <div>
            <form action="{{route('properties.export.import')}}" method="POST" class="d-inline">
                @csrf
                <div class="form-group">
                    <input type="hidden" class="form-control " name="name" id="name" placeholder=""
                           value="{{htmlspecialchars(json_encode($valueArray))}}">
                </div>
                <button type="submit" class="d-inline-block btn btn-sm btn-yellow shadow-sm loading"><i
                        class="far fa-save fa-sm text-dark-50"></i> Download Errors
                </button>
            </form>
            <a href="{{ route('properties.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-grey shadow-sm"><i
                    class="fas fa-chevron-left fa-sm te
                    xt-white-50"></i> Back to Property</a>
            <a id="importHelpBtn" class="d-none d-sm-inline-block btn btn-sm btn-blue shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50 fa-text-width"></i> Importing Help</a>
            <a onclick="javscript:checkErrors(this);" class="d-inline-block btn btn-sm btn-green shadow-sm"><i
                    class="far fa-save fa-sm text-white-50"></i> Save
            </a>
        </div>
    </div>

    <div class="m-3 alert alert-danger">You have several errors Within your Import in rows
        <div class="col-md-12">
            <div id="summary">
                <p class="collapse" id="collapseSummary">{{$errorRows}}</p>
                <a class="collapsed" data-bs-toggle="collapse" href="#collapseSummary" aria-expanded="false"
                   aria-controls="collapseSummary"></a>
            </div>
        </div>
    </div>

    <x-handlers.alerts/>

    <section>
        <p class="mb-4">There were some errors in your csv file that you have tried to upload to the system. Any rows
                        that had valid information will have already been
                        uploaded. If there a lot of returned errors you can choose to download them all in excel format
                        allowing you to retry with only the failed rows. </p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">

                    <table id="categoryTable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th><small>Name</small></th>
                            <th><small>Type</small></th>
                            <th><small>Location</small></th>
                            <th><small>Date</small></th>
                            <th><small>Cost</small></th>
                            <th><small>Donated</small></th>
                            <th><small>Depreciation</small></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th><small>Name</small></th>
                            <th><small>Type</small></th>
                            <th><small>Location</small></th>
                            <th><small>Date</small></th>
                            <th><small>Cost</small></th>
                            <th><small>Donated</small></th>
                            <th><small>Depreciation</small></th>
                        </tr>
                        </tfoot>

                        @csrf
                        @php($line = 0)
                        @foreach($errorArray as $row =>$error)
                            <?php $errors = explode(",", $error); ?>
                            <tr>
                                <td>
                                        <span id="name{{$line}}" class="tooltip-danger">
                                            <input type="text"
                                                   class="import-control @if(in_array('name', $errors)){{ 'border-bottom border-danger'}}@endif"
                                                   name="name[]" value="{{ $valueArray[$row]['name'] }}"
                                                   placeholder="This Row is Empty Please Fill!" required
                                                   data-bs-container='#name{{$line}}' data-bs-placement='top'
                                               @if(array_key_exists('name', $errorValues[$row])) {!! "data-bs-toggle='tooltip' title='{$errorValues[$row]['name']}'" !!}@endif>
                                        </span>
                                </td>
                                <td>
                                        <span id="type{{$line}}" class="tooltip-danger">
                                            <input type="text"
                                                   class="import-control @if(in_array('type', $errors)){{ 'border-bottom border-danger'}}@endif"
                                                   name="type[]" value="{{ $valueArray[$row]['type'] }}"
                                                   placeholder="This Row is Empty Please Fill!" required
                                                   data-bs-container='#type{{$line}}' data-bs-placement='top'
                                               @if(array_key_exists('type', $errorValues[$row])) {!! "data-bs-toggle='tooltip' title='{$errorValues[$row]['type']}'" !!}@endif>
                                        </span>
                                </td>
                                <td>
                                        <span id="location_id{{$line}}" class="tooltip-danger">
                                        <select type="dropdown"
                                                class="import-control @if(in_array('location_id', $errors)){{ 'border-bottom border-danger'}}@endif"
                                                name="location_id[]" required data-bs-container='#location_id{{$line}}'
                                        @if(array_key_exists('location_id', $errorValues[$row])) {!! "data-bs-toggle='tooltip' data-bs-placement='bottom' title='{$errorValues[$row]['location_id']} - {$valueArray[$row]['location_id']}'" !!}@endif
                                        >
                                            <option
                                                value="0" @if($valueArray[$row]['location_id'] == ''){{'selected'}}@endif>Please Select a Location</option>
                                            @foreach($locations as $location)
                                                <option
                                                    value="{{ $location->id  }}" @if( $valueArray[$row]['location_id'] == $location->name){{'selected'}}@endif>{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                        </span>
                                </td>
                                <td>
                                    <?php
                                    try
                                    {
                                        $date = \Carbon\Carbon::parse(str_replace('/', '-', $valueArray[$row]['purchased_date']))->format('Y-m-d');
                                    } catch(\Exception $e)
                                    {
                                        $date = 'dd/mm/yyyy';
                                    }
                                    ?>
                                    <span id="purchased_date{{$line}}" class="tooltip-danger">
                                        <input type="date"
                                               class="import-control @if(in_array('purchased_date', $errors)){{ 'border-bottom border-danger'}}@endif"
                                               name="purchased_date[]" id="purchased_date"
                                               placeholder="This Row is Empty Please Fill!" value="{{ $date }}" required
                                               data-bs-container='#purchased_date{{$line}}' data-bs-placement='top'
                                               @if(array_key_exists('purchased_date', $errorValues[$row])) {!! "data-bs-toggle='tooltip' title='{$errorValues[$row]['purchased_date']}'" !!}
                                                   @endif
                                               >
                                        </span>

                                </td>
                                <td>
                                        <span id="purchased_cost{{$line}}" class="tooltip-danger">
                                        <input type="text"
                                               class="import-control @if(in_array('purchased_cost', $errors)){{'border-bottom border-danger'}}@endif"
                                               name="purchased_cost[]" id="purchased_cost"
                                               placeholder="This Row is Empty Please Fill!"
                                               value="{{ $valueArray[$row]['purchased_cost'] }}" required
                                               data-bs-container='#purchased_cost{{$line}}' data-bs-placement='top'
                                               @if(array_key_exists('purchased_cost', $errorValues[$row])) {!! "data-bs-toggle='tooltip'  title='{$errorValues[$row]['purchased_cost']}'" !!}@endif
                                        >
                                        </span>
                                </td>
                                <td>
                                    <span id="donated{{$line}}" class="tooltip-danger">
                                        <select type="dropdown"
                                                class="import-control @if(in_array('donated', $errors)){{ 'border-bottom border-danger'}}@endif"
                                                name="donated[]" required data-bs-container='#donated{{$line}}'
                                        @if(array_key_exists('donated', $errorValues[$row])) {!! "data-bs-toggle='tooltip' data-bs-placement='bottom' title='{$errorValues[$row]['donated']} - {$valueArray[$row]['donated']}'" !!}@endif
                                        >
                                            <option value="0" @if( $valueArray[$row]['donated'] == 0){{'selected'}}@endif>No</option>
                                            <option value="1" @if( $valueArray[$row]['donated'] == 1){{'selected'}}@endif>Yes</option>
                                        </select>
                                        </span>
                                </td>
                                <td>
                                        <span id="depreciation{{$line}}" class="tooltip-danger">
                                        <input type="text"
                                               class="import-control @if(in_array('depreciation', $errors)){{ 'border-bottom border-danger'}}@endif"
                                               name="depreciation[]" id="order_no"
                                               placeholder="This Row is Empty Please Fill!"
                                               value="{{ $valueArray[$row]['depreciation'] }}" required
                                               data-bs-container='#depreciation{{$line}}' data-bs-placement='top'
                                            @if(array_key_exists('depreciation', $errorValues[$row])) {!! "data-bs-toggle='tooltip'  title='{$errorValues[$row]['depreciation']}'" !!}@endif
                                        >
                                        </span>
                                </td>

                            </tr>
                            @php($line++)@endforeach{{--    </form>--}}</tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('modals')
    <div class="modal fade bd-example-modal-lg" id="importHelpModal" tabindex="-1" role="dialog"
         aria-labelledby="importHelpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importHelpModalLabel">Importing Data Help</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/importmanufacturer" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <h2 class="h3 mb-0 text-gray-800">Requirements needed to finish your import</h2>
                        <ol>
                            <li>The Required fields are: Name, Supplier,Location and serial num.</li>
                            <li>All Correct rows skip this page and import straight to the database so please don't
                                re-import your file!
                            </li>
                            <li>Struggling to Pass this stage are all your data fields in the correct format?</li>
                            <li>Need More help? Click <a href="{{route("documentation.index").'#collapseSevenImport'}}">here</a>
                                to be redirected to the Documentation on Importing!
                            </li>

                        </ol>
                    </div>
                    <div class="modal-footer">
                        <p>For Anymore information please email Apollo@clpt.co.uk</p>
                        <a href="https://clpt.sharepoint.com/:x:/s/WebDevelopmentTeam/ERgeo9FOFaRIvmBuTRVcvycBkiTnqHf3aowELiOt8Hoi1Q?e=CXfTdb"
                           target="_blank" class="btn btn-blue">
                            Download Import Template
                        </a>
                        <button class="btn btn-grey" type="button" data-bs-dismiss="modal">Cancel</button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        const importModal = new bootstrap.Modal(document.getElementById('importHelpModal'));
        const importHelpBtn = document.querySelector('#importHelpBtn');

        importHelpBtn.addEventListener('click', function () {
            importModal.show();
        });

        function enableToolTips() {
            const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltips.forEach(t => {
                new bootstrap.Tooltip(t);
            })
        }

        enableToolTips();


        const importControl = document.querySelectorAll('.import-control');

        const errorMessage = document.querySelector('.alert.alert-danger');


        //validation
        function checkErrors(obj) {

            const token = document.querySelector("[name='_token']").value;
            const data = new FormData();
            data.append('_token', token);

            //Names
            const inputs = document.querySelector("input[name='name[]']");
            inputs.forEach(element => {
                data.append('name[]', element.value);
            });

            //Type
            const tpInputs = document.querySelector("input[name='type[]']");
            tpInputs.forEach(element => {
                data.append('type[]', element.value);
            });

            //Location
            const loInputs = document.querySelector("select[name='location_id[]']");
            loInputs.forEach(element => {
                data.append('location_id[]', element.value);
            });

            //Purchased Cost
            const pcInputs = document.querySelector("input[name='purchased_cost[]']");
            pcInputs.forEach(element => {
                data.append('purchased_cost[]', element.value);
            });

            //Purchased Date
            const pdInputs = document.querySelector("input[name='purchased_date[]']");
            pdInputs.forEach(element => {
                data.append('purchased_date[]', element.value);
            });

            //Depreciation
            const dpInputs = document.querySelector("input[name='depreciation[]']");
            dpInputs.forEach(element => {
                data.append('depreciation[]', element.value);
            });

            const xhr = new XMLHttpRequest()

            xhr.onload = function () {
                if (xhr.responseText === 'Success') {
                    window.location.href = '/properties';
                } else {
                    importControl.forEach((item) => {
                        item.classList.remove('border-bottom', 'border-danger');
                    });

                    let i = 0;
                    console.log(xhr.response);
                    Object.entries(JSON.parse(xhr.responseText)).forEach(entry => {
                        console.log(entry);
                        const [key, value] = entry;
                        res = key.split('.');
                        const error = value.toString().replace(key, res[0]);
                        console.log(error);
                        console.log(res[1]);
                        let elements = document.querySelectorAll(`[name='${res[0]}[]']`);
                        console.log(elements[0]);
                        let num = parseInt(res[1]);
                        elements[num].classList.add('border-bottom', 'border-danger');
                        elements[num].setAttribute('data-bs-toggle', 'tooltip');
                        elements[num].setAttribute('data-bs-original-title', error);
                        new bootstrap.Tooltip(elements[num]);
                        i++;
                        enableToolTips();
                    });

                    errorMessage.innerHTML = `There were ${i} errors in the following rows`;
                }
            };

            xhr.open("POST", "/import/properties/errors");
            xhr.send(data);
        }

    </script>
@endsection
