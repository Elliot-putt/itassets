@props(["consumable"])
<div class="col-12 col-lg-4 mb-4">
    <div class="card shadow h-100 pb-2" style="border-left: 0.25rem solid ;">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold" style="">Purchase Information</h6>
        </div>
        <div class="card-body">
            <div class="row no-gutters">
                <div class="mb-1">
                    <p class="mb-4 ">Information regarding <strong
                            class="font-weight-bold d-inline-block btn-sm btn-grey shadow-sm p-1"><small>{{ $consumable->name }}</small></strong>
                        purchase order, you find information about the purchase and the supplier.</p>
                    
                    <table class="table table-sm table-bordered table-striped">
                        <tr>
                            <td class="col-4">Order N<sup>o</sup>:</td>
                            <td class="col-8"> {{$consumable->order_no }}</td>
                        </tr>
                        <tr>
                            <td>Supplier:</td>
                            <td>
                                {{ $consumable->supplier->name}}<br>
                                {{ $consumable->supplier->address_1 }}<br>
                                {{ $consumable->supplier->address_2 }}<br>
                                {{ $consumable->supplier->city }}<br>
                                {{ $consumable->supplier->county }}<br>
                                {{ $consumable->supplier->postcode }}<br>
                            </td>
                        </tr>
                        <tr>
                            <td>Date of Purchase:</td>
                            <td>
                                <?php $purchase_date = \Carbon\Carbon::parse($consumable->purchased_date);?>
                                {{ $purchase_date->format('d/m/Y')}}
                            </td>
                        </tr>
                        <tr>
                            <td>Warranty</td>
                            <td>
                                <?php $warranty_end = \Carbon\Carbon::parse($consumable->purchased_date)->addMonths($consumable->warranty);?>
                                {{ $consumable->warranty }} Month(s) - <strong>{{ round(\Carbon\Carbon::now()->floatDiffInMonths($warranty_end)) }} Remaining</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>Purchase Cost:</td>
                            <td>£{{ $consumable->purchased_cost }}</td>
                        </tr>
                    </table>
                    @if($consumable->supplier && $consumable->supplier->email != "")
                    <a href="mailto:{{$consumable->supplier->email}}"><button class="btn btn-sm btn-blue"><i class="far fa-envelope"></i> Email Supplier</button></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>