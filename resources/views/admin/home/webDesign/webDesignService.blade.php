<div class="col-lg-4 col-md-6 designServiceContain mt-3">
    <form id="webDesignForm_{{ $item->id }}">
        @csrf
        <div class="designServiceSave">
            <i class="far fa-save designServiceSaveButton" data-id="{{ $item->id }}"
                onclick="serviceProcess({{ $item->id }})"></i>
        </div>
        <input type="text" name="webDesign_id" value="{{ $item->id }}" hidden>
        <div class="card card-custom">
            <div class="card-body my-auto">
                <div class="designServiceContain">
                    <h3 class="designServiceSubTitle">
                        <input type="text" value="{{ $item->title }}" class="form-control designServiceInput"
                            name="title">
                    </h3>
                    <div class="designServiceSubDesc">
                        <textarea name="content"cols="30" rows="5" class="form-control">{{ $item->content }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

