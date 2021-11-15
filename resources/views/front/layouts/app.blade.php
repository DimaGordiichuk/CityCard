@include('front.layouts.inc.begin')
@include('front.layouts.inc.header')


{{--<div class="col-md-12">--}}
{{--    <br> <!-- TODO -->--}}
{{--    @include('front.layouts.inc.notifications')--}}
{{--</div>--}}

@yield('content')

@include('front.layouts.inc.footer')
@include('front.layouts.inc.end')

@include('front.layouts.inc.toastr')
