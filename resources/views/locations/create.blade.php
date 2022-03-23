@extends('layouts.app')

@section('title' ,'Add New Location')

@section('content')
<x-form.layout :action="route('location.store')" >
    <x-wrappers.nav title="Add New Location" >
        <x-buttons.return :route="route('properties.index')" > Property</x-buttons.return >
        <a href="{{ route('documentation.index')."#collapseThreeAssets"}}"
           class="btn btn-sm  bg-yellow shadow-sm p-2 p-md-1" ><i
                class="fas fa-question fa-sm text-dark-50 mr-lg-1" ></i ><span class="d-none d-lg-inline-block">Help</span></a >
        <x-buttons.submit >Save</x-buttons.submit >
    </x-wrappers.nav >
    <section >
        <p class="mb-4" >
            Add a new location to the Apollo Asset Manager. 
        </p >
        <div class="row row-eq-height no-gutters p-0 p-md-4 container m-auto" >
            <div class="col-12" >
                <div class="card shadow h-100" >
                    <div class="card-body" >
                        <x-handlers.alerts />

                        <ul id="tab-bar" class="nav nav-tabs" >

                            <li class="nav-item" >
                                <a class="nav-link active" id="location-tab" data-toggle="tab" href="#location" role="tab"
                                   aria-controls="home" aria-selected="true" >Location Information</a >
                            </li >
                        </ul >
                        <div class="tab-content border-left border-right border-bottom border-gray"
                             id="myTabContent" >
                            
                            <div class="tab-pane fade show p-2 pt-4 active" id="location" role="tabpanel"
                                 aria-labelledby="location-tab" >
                                <div class="row" >
                                    <div class="col-12 col-md-6 p-4 mb-3 " >
                                        <div class="form-group" >
                                            <x-form.input name="name" formAttributes="" value="{{old('name')}}"/>
                                        </div >

                                        <div class="form-group">
                                            <label for="address2">Street Address</label>
                                            <input type="text"
                                                   class="form-control mb-3 <?php if ($errors->has('address_1') || $errors->has('address_2')) {?>border-danger<?php }?>"
                                                   name="address_1" id="address_1" placeholder="Street Name"
                                                   value="{{ old('address_1')}}" required>
                                            <input type="text" class="form-control" name="address_2" id="address_2"
                                                   placeholder="Location" value="{{ old('address_2')}}">
                                        </div>

                                        <div class="form-group" >
                                            <x-form.input name="city" formAttributes="" value="{{old('city')}}"/>
                                        </div >

                                        <div class="form-group" >
                                            <x-form.input name="county" formAttributes="" value="{{old('county')}}"/>
                                        </div >

                                        <div class="form-group" >
                                            <x-form.input name="postcode" formAttributes="" value="{{old('postcode')}}"/>
                                        </div >

                                        <div class="form-group">
                                            <label for="telephone">Telephone</label>
                                            <input type="tel" class="form-control" name="telephone" id="telephone"
                                                   placeholder="Telelphone" value="{{ old('telephone')}}">
                                        </div>
            
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                                                   value="{{ old('email')}}">
                                        </div>
                                    </div >
                                    <div class="col-12 col-md-6 p-4 mb-3 " >
                                        <div id="locationInfo" class="bg-light p-4" >
                                            <div class="model_title text-center h4 mb-3" >Location Image</div >
                                                <div class="w-100">
                                                    <div class="formgroup mb-2 p-2">
                                                        <img id="profileImage" src="{{ asset('images/svg/location-image.svg') }}"
                                                                width="100%" alt="Select Profile Picture" data-toggle="modal"
                                                                data-target="#imgModal">
                                                        <input type="hidden" id="photo_id" name="photo_id"
                                                        value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <hr>
                                                <label for="icon">Select School Icon Colour:</label>
                                                <input class="form-control" type="color" id="icon" name="icon"
                                                    value="{{ old('icon')}}">
                                                    </div>
                                                
                                            </div >
                                        </div >
                                    </div >
                                </div >
                            </div >

                        </div >
                    </div >
                </div >
            </div >
        </div >
    </section >
</x-form.layout >
@endsection

@section('modals')
    <x-modals.photo-upload/>
    <x-modals.photo-upload-form/>
@endsection

@section('js')
    <script src="{{asset('js/photo.js')}}"></script>
@endsection
