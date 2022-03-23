@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('css')

@endsection

@section('content')
    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Supplier</h1>

            <div>
                @can('viewAny' , \App\Models\Supplier::class)

                    <a href="{{ route('suppliers.index') }}"
                       class="d-none d-sm-inline-block btn btn-sm btn-grey shadow-sm"><i
                            class="fas fa-chevron-left fa-sm text-white-50"></i> Back to Suppliers</a>
                @endcan
                <a href="{{ route('documentation.index')."#collapseFourteenSuppliers"}}"
                   class="d-none d-sm-inline-block btn btn-sm  bg-yellow shadow-sm"><i
                        class="fas fa-question fa-sm text-dark-50"></i> need Help?</a>
                <button type="submit" class="d-inline-block btn btn-sm btn-green shadow-sm"><i
                        class="far fa-save fa-sm text-white-50"></i> Save
                </button>
            </div>
        </div>

        <section>
            <p class="mb-4">Change the following information for the selected supplier and click the 'Save' button to
                            update or click 'Back' to return to all suppliers.</p>
            <div class="row row-eq-height">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="card shadow h-100">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text"
                                       class="form-control <?php if ($errors->has('name')) {?>border-danger<?php }?>"
                                       name="name" id="name" placeholder="" value="{{ $supplier->name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="address2">Street Address</label>
                                <input type="text"
                                       class="form-control mb-3 <?php if ($errors->has('address_1') || $errors->has('address_2')) {?>border-danger<?php }?>"
                                       name="address_1" id="address_1" value="{{ $supplier->address_1}}">
                                <input type="text" class="form-control" name="address_2" id="address_2"
                                       value="{{ $supplier->address_2}}">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="city">City</label>
                                    <input type="text"
                                           class="form-control <?php if ($errors->has('city')) {?>border-danger<?php }?>"
                                           id="city" name="city" value="{{ $supplier->city}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city">County</label>
                                    <input type="text"
                                           class="form-control <?php if ($errors->has('county')) {?>border-danger<?php }?>"
                                           id="county" name="county" value="{{ $supplier->county}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="postcode">Post Code</label>
                                    <input type="text"
                                           class="form-control <?php if ($errors->has('postcode')) {?>border-danger<?php }?>"
                                           id="postcode" name="postcode" value="{{ $supplier->postcode}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea name="notes" id="notes" class="form-control"
                                          rows="10">{{ $supplier->notes }}</textarea>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <div class="card shadow h-100">
                        <div class="card-body">
                            <div class="w-100">
                                <div class="formgroup mb-2 p-2">
                                    <h4 class="h6 mb-3">Location Image</h4>
                                    @php
                                        if($supplier->photo()->exists()){
                                            $path = $supplier->photo->path;
                                        }else{
                                            $path = 'images/svg/suppliers.svg';
                                        }
                                    @endphp
                                    <img id="profileImage" src="{{asset($path)}}" width="100%"
                                         alt="Select Profile Picture" data-bs-toggle="modal" data-bs-target="#imgModal">
                                    <input type="hidden" id="photo_id" name="photo_id" value="0">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="url">Website URL:</label>
                                <input class="form-control" type="text" id="url" name="url" placeholder="https://"
                                       value="{{ $supplier->url}}">
                            </div>

                            <div class="form-group">
                                <label for="telephone">Telephone</label>
                                <input type="text" class="form-control" name="telephone" id="telephone"
                                       value="{{ $supplier->telephone }}">
                            </div>

                            <div class="form-group">
                                <label for="telephone">Fax</label>
                                <input type="text" class="form-control" name="fax" id="fax"
                                       value="{{ $supplier->fax ?? ''}}">
                            </div>

                            <div class="form-group">
                                <label for="telephone">Email Address</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="@"
                                       value="{{ $supplier->email }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-admin.suppliers.details/>

        </section>
    </form>
@endsection

@section('modals')
    <x-modals.photo-upload/>
    <x-modals.photo-upload-form/>
@endsection

@section('js')
    <script src="{{asset('js/photo.js')}}"></script>

@endsection
