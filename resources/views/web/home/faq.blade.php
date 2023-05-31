<section class="faqBackground" id="FAQ">
    <div class="container faqContainer">
        <div class="homeFormBox">
            <h2 class="faqTitle"> Câu hỏi thường gặp (FAQ) </h2>
            <div class="faqCollapseContain">
                <div id="accordion">
                    @foreach ($faq as $index => $item)
                        <div data-bs-toggle="collapse" data-bs-target="#myCollapse{{ $item->id }}"
                            class="collapsed faqCollapseBox" data-id="{{ $item->id }}"
                            aria-expanded="{{ $index != 0 ? 'false' : 'true' }}">
                            <div class="faqCollapseTitleContain">
                                <div class="d-flex justify-content-between">
                                    <h3 class="faqCollapseTitle">{{ $item->title }}</h3>
                                    <i class="fa-sharp fa-solid fa-chevron-down fa-lg d-flex align-items-center"></i>
                                </div>
                            </div>
                        </div>
                        <div id="myCollapse{{ $item->id }}"
                            class="collapse faqCollapseBody {{ $index != 0 ? '' : 'show' }}"
                            data-bs-parent="#accordion">
                            <div class="faqCollapseBodyContent">
                                {{ $item->content }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
