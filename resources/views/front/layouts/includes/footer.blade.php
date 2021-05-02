<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2">2021©</span>
            <a href="{{ env('APP_URL') }}" target="_blank" class="text-dark-75 text-hover-primary">{{ env('APP_NAME') }}</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Nav-->
        <div class="nav nav-dark order-1 order-md-2">
            @foreach($pages as $page)
                <a href="{{ route('page', $page->slug) }}" target="_blank" class="nav-link pr-3 pl-0">{{ $page->title }}</a>
            @endforeach
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Container-->
</div>
