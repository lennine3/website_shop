<div id="faqQuestionBox">
    <div class="row">
        @foreach ($faq as $item)
            <div class="col-lg-4 col-md-4 designServiceContain" id="faqQuestionBox">
                <form id="faqQuestionForm{{ $item->id }}">
                    @csrf
                    <div class="designServiceSave">
                        <i class="far fa-save designServiceSaveButton" data-id="{{ $item->id }}"
                            onclick="benefitProcess({{ $item->id }})"></i>
                    </div>
                    <input type="text" name="faqQuestion_id" value="{{ $item->id }}" hidden>
                    <div class="card card-custom">
                        <div class="card-body my-auto">
                            <div class="designServiceContain">
                                <h3 class="designServiceSubTitle">
                                    <input type="text" value="{{ $item->title }}"
                                        class="form-control designServiceInput" name="title">
                                </h3>
                                <div class="designServiceSubDesc">
                                    <textarea name="content"cols="30" rows="7" class="form-control">{{ $item->content }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</div>
