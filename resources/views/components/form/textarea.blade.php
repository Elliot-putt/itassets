@props(['name','formAttributes', 'value' => null])

{{--form input Dynamic || value should be current data stored--}}

<label for="name">{{str_replace(array('_','id'), ' ',ucfirst($name))}}</label>
@if(str_contains('required', $formAttributes))<span class="text-danger">*</span>@endif
<textarea
    name="{{$name}}"
    id="{{$name}}"
    class="form-control <?php if ($errors->has("{!! $name !!}")) {?>border-danger<?php }?>"
    {!!$formAttributes ?? null!!}
>{{old("{!! $name !!}")?? $value}}</textarea>

{{--  pass attribues seperated with spaces  --}}
