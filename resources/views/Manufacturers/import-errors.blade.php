@extends('layouts.app')

@section('css')
    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet"/>
@endsection

@section('content')
    {{-- <form action="/manufacturers/create/import" method="POST"> --}}

        <div class="d-sm-flex align-items-center justify-content-between mb-4"><?php  ?>
            <h1 class="h3 mb-0 text-gray-800">Import
                Failures</h1>@php $errorRows = '';foreach($errorArray as $id => $key){ $errorRows = !empty($errorRows)? $errorRows.', '.$id:$id;}  @endphp
            <div class="alert alert-danger">You have several errors Within your Import in rows {{$errorRows}}</div>
            <div>
                <a href="/manufacturers" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i
                        class="fas fa-chevron-left fa-sm text-white-50"></i> Back to Manufacturers</a>
                <button onclick="javscript:checkErrors(this);" class="d-inline-block btn btn-sm btn-success shadow-sm"><i
                        class="far fa-save fa-sm text-white-50"></i> Save
                </button>
            </div>
        </div>

        @if(session('danger_message'))
            <div class="alert alert-danger"> {{ session('danger_message')}} </div>
        @endif

        @if(session('success_message'))
            <div class="alert alert-success"> {{ session('success_message')}} </div>
        @endif

        <section>
            <p class="mb-4">Below are the different Import Failures of all the different assets stored in the management
                system. Each has
                displays the amount of different assets that are assigned the category.</p>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="categoryTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th class="col-4">Manufacturers Name</th>
                                <th>Support Url</th>
                                <th>Support Number</th>
                                <th>Support Email</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th class="col-4">Manufacturers Name</th>
                                <th>Support Url</th>
                                <th>Support Number</th>
                                <th>Support Email</th>
                            </tr>
                            </tfoot>
                            @csrf
                            @foreach($errorArray as $row =>$error)
                                <?php $errors = explode(",", $error); ?>
                                <tr>
                                    <td>
                                        <input type="text"
                                               class="form-control <?php if (in_array('name', $errors)) {?>border-danger<?php }?>
                                                   "
                                               name="name[]"
                                               id="name" value="{{ $valueArray[$row]['name'] }}"
                                               placeholder="This Row is Empty Please Fill!" required>
                                                @if(array_key_exists('name', $errorValues[$row]))<small class="text-danger text-capitalize">{{$errorValues[$row]['name']}}</small>@endif
                                    <td>
                                        <input type="text"
                                               class="form-control <?php if (in_array('supporturl', $errors)) {?>border-danger<?php }?>"
                                               name="supportUrl[]"
                                               id="supportUrl" value="{{ $valueArray[$row]['supporturl'] }}"
                                               placeholder="This Row is Empty Please Fill!" required>
                                               @if(array_key_exists('supporturl', $errorValues[$row]))<small
                                                class="text-danger text-capitalize">{{$errorValues[$row]['supporturl']}}</small>@endif
                                    </td>
                                    <td>
                                        <input type="text"
                                               class="form-control <?php if (in_array('supportphone', $errors)) {?>border-danger<?php }?>"
                                               name="supportPhone[]"
                                               id="supportPhone" placeholder="This Row is Empty Please Fill!"
                                               value="{{ $valueArray[$row]['supportphone'] }}" required>
                                               @if(array_key_exists('supportphone', $errorValues[$row]))<small
                                                class="text-danger text-capitalize">{{$errorValues[$row]['supportphone']}}</small>@endif
                                    </td>
                                    <td>
                                        <input type="text"
                                               class="form-control <?php if (in_array('supportemail', $errors)) {?>border-danger<?php }?>"
                                               name="supportEmail[]"
                                               id="supportEmail" placeholder="This Row is Empty Please Fill!"
                                               value="{{ $valueArray[$row]['supportemail'] }}" required>
                                               @if(array_key_exists('supportemail', $errorValues[$row]))<small
                                                class="text-danger text-capitalize">{{$errorValues[$row]['supportemail']}}</small>@endif
                                    </td>
                                </tr>
        @endforeach
    {{-- </form> --}}
    </tbody>
    </table>
    </div>
    </div>
    </div>

    </section>

@endsection

@section('modals')

@endsection

@section('js')
   
    <script type="text/javascript">
        function checkErrors(obj){
            
            var token = $("[name='_token']").val();
            var data = new FormData();
            data.append('_token', token);

            //Names
            var inputs = $("input[name='name[]']").get();
            inputs.forEach(element => {
                data.append('name[]', element.value);
            });
            
            //Url
            var urlInputs = $("input[name='supportUrl[]']").get();
            urlInputs.forEach(element => {
                data.append('supportUrl[]', element.value);
            });

            //Phone
            var telInputs = $("input[name='supportPhone[]']").get();
            telInputs.forEach(element => {
                data.append('supportPhone[]', element.value);
            });

            //Email
            var emInputs = $("input[name='supportEmail[]']").get();
            emInputs.forEach(element => {
                data.append('supportEmail[]', element.value);
            });

            $.ajax({
                url: '/manufacturers/create/ajax', 
                type: 'POST',
                data: data, 
                processData: false,
                contentType: false,
                success: function(response){
                    if(response === 'Success'){
                        window.location.href = '/manufacturers';
                    }else{
                        $('small.text-danger').remove();
                        $('input').removeClass('border-danger');
                        var i = 0;
                        Object.entries(response).forEach(entry => {
                            const [key, value] = entry;
                            res = key.split('.');
                            const error = value.toString().replace(key, res[0]);
                            $(`input[name='${res[0]}[]']:eq(${res[1]})`).addClass('border-danger');
                            $(`input[name='${res[0]}[]']:eq(${res[1]})`).after(`<small class="text-danger text-capitalize">${error}</small>`);
                            i++;
                        });
                        $('.alert.alert-danger').html(`There were ${i} errors in the following rows`);
                    }
                },
            });
        }
    </script>

@endsection
