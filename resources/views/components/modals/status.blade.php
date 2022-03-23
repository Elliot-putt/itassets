@props(['route'=>"#" , 'model'=>null , 'title' => ''])
<!-- Status Model Modal-->
<div class="modal fade bd-example-modal-lg" id="{{lcfirst($title)}}ModalStatus" tabindex="-1" role="dialog"
     aria-labelledby="{{lcfirst($title)}}ModalStatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{lcfirst($title)}}ModalStatusLabel">Change the Status </h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{$route}}" method="post">
                <div class="modal-body">
                    @csrf
                    <select name="status" class="form-control">
                        @foreach(\App\Models\Status::all() as $status)
                            <option
                                value="{{ $status->id}}" @if($status->id == $model->status_id){{ 'selected'}}@endif>{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-grey" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-green" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
