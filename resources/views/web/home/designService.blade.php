<section class="container homeServiceSection" id="WebsiteDesignService">
    <h2 class="titleText homeServiceHeadTitle"> {{ $webDesignInfo->name }} <br>{{ $webDesignInfo->sub_name }}
    </h2>
    <div class="row">
        @foreach ($designService as $item)
        <div class="col-lg-4 col-md-6 homeServiceDesc">
            <div class="homeServiceBox">
                <h3 class="homeServiceBoxTitle"> {{ $item->title }} </h3>
                <div class="homeServiceBoxDesc"> {{ $item->content }} </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
