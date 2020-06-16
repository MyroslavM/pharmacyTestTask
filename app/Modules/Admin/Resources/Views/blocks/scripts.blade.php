<!--ENd:: Chat-->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#042552",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
{{--<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>--}}



<script src="{{asset('assetsnew/js/plugins.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('assetsnew/js/scripts.bundle.js')}}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
{{--<script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>--}}



<!--begin::Page Scripts(used by this page) -->
<script src="{{asset('assets/js/pages/dashboard.js')}}" type="text/javascript"></script>
{{--<script src="{{asset('assetsnew/js/dashboard.js')}}" type="text/javascript"></script>--}}



{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js" integrity="sha256-/7FLTdzP6CfC1VBAj/rsp3Rinuuu9leMRGd354hvk0k=" crossorigin="anonymous"></script>--}}


{{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/i18n/fr.js"></script>--}}
{{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>--}}


@if(  app()->getLocale() == 'ru')
    <script src="{{asset('assetsnew/js/translate_Ru.js')}}" type="text/javascript"></script>
@elseif(  app()->getLocale() == 'uk')
    <script src="{{asset('assetsnew/js/translate_Uk.js')}}" type="text/javascript"></script>
@endif


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

{{--<script src="{{asset('assetsnew/js/sweetalert2@8.js')}}"></script>--}}
<script src="{{ asset('assetsnew/js/save-trait.js') }}"></script>

@stack('scripts')


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>




<script>
    $(document).ready(function () {
        new SaveTrait({
            selector: '#form-delete',
        })
            .setAdditionalData(function (data, target) {
                return data;
            })
            .setAdditionalSuccessCallback(function (response) {
                $('.modal').modal('hide');
            });
    });
    $('.delete-item').on('click', function () {
        $('#deleteModal').modal('show');
        $('#form-delete').find('input[name="id"]').val($(this).data('id'));
    })
</script>