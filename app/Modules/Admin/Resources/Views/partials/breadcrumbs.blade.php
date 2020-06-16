@if (count($breadcrumbs))
    <div class="kt-subheader__main">
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb->url && $loop->first)
                <a href="{{ $breadcrumb->url }}"><h3 class="kt-subheader__title">{{ $breadcrumb->title }} <i class="fa fa-home ml-2"></i></h3></a>
                <span class="kt-subheader__separator kt-hidden"></span>
            @endif
        @endforeach
        <div class="kt-subheader__breadcrumbs">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && $loop->first)
                @elseif ($breadcrumb->url && !$loop->first && !$loop->last)
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ $breadcrumb->url }}" class="kt-subheader__breadcrumbs-link">{{ $breadcrumb->title }}</a>
                @else
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{ $breadcrumb->title }}</span>
                    {{--<li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>--}}
                @endif
            @endforeach
        </div>
    </div>
@endif