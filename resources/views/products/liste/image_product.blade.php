@php
    $id;
    $image_link;
    $product_name;
@endphp

<div class="modal fade shadow shadow-lg" id="{{'product_'.$id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button class="btn-close position-absolute top-0 end-0 modal-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            <div class="modal-header">
                Photo : {{$product_name}}
            </div>
            <div class="modal-body p-2">
                <img src="{{$image_link}}" alt=""  class="img img-fluid">
            </div>
        </div>
    </div>
</div>