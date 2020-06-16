@extends('admin::main')

@section('content')
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="page-header">
                <h4 class="page-title">Тарифи</h4>
                {{ Breadcrumbs::render('adminBlackList') }}
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="card pb-3 pt-3">
                        <div id="generic_price_table">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="generic_content clearfix">
                                            <div class="generic_head_price clearfix">
                                                <div class="generic_head_content clearfix">
                                                    <div class="head_bg"></div>
                                                    <div class="head">
                                                        <span>LIGHT</span>
                                                    </div>
                                                </div>
                                                <div class="generic_price_tag clearfix">
                                                    <span class="price">
                                    <span class="sign">$</span>
                                    <span class="currency">400</span>
                                    <span class="cent">.99</span>
                                    <span class="month">/Місяць</span>
                                </span>
                                                </div>
                                            </div>
                                            <div class="generic_feature_list">
                                                <ul>
                                                    <li><span>Карточка пацієнта</span></li>
                                                    <li><span>Візити пацієнтів</span></li>
                                                    <li><span>Співробітники</span></li>
                                                    <li><span>Клініка</span></li>
                                                    {{--<li><span>Календар</span></li>--}}
                                                    {{--<li><span>+ Віджет</span></li>--}}
                                                    {{--<li><span>+ Чат бот</span></li>--}}
                                                    {{--<li><span>+ Аналітика</span></li>--}}
                                                </ul>
                                            </div>
                                            <div class="generic_price_btn clearfix">
                                                {{--<a class="" href="">Оплатити</a>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="generic_content  clearfix">
                                            <div class="generic_head_price clearfix">
                                                <div class="generic_head_content clearfix">
                                                    <div class="head_bg"></div>
                                                    <div class="head">
                                                        <span>Standard</span>
                                                    </div>
                                                </div>
                                                <div class="generic_price_tag clearfix">
                                                    <span class="price">
                                    <span class="sign">$</span>
                                    <span class="currency">700</span>
                                    <span class="cent">.99</span>
                                    <span class="month">/Місяць</span>
                                </span>
                                                </div>
                                            </div>
                                            <div class="generic_feature_list">
                                                <ul>
                                                    <li><span>Карточка пацієнта</span></li>
                                                    <li><span>Візити пацієнтів</span></li>
                                                    <li><span>Співробітники</span></li>
                                                    <li><span>Клініки</span></li>
                                                    <li class="active"><span>+ Календар</span></li>
                                                </ul>
                                            </div>
                                            <div class="generic_price_btn clearfix">
                                                {{--<a class="" href="">Оплатити</a>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="generic_content active clearfix">
                                            <div class="generic_head_price clearfix">
                                                <div class="generic_head_content clearfix">
                                                    <div class="head_bg"></div>
                                                    <div class="head">
                                                        <span>Pro</span>
                                                    </div>
                                                </div>
                                                <div class="generic_price_tag clearfix">
                                                    <span class="price">
                                    <span class="sign">$</span>
                                    <span class="currency">900</span>
                                    <span class="cent">.99</span>
                                    <span class="month">/Місяць</span>
                                </span>
                                                </div>
                                            </div>
                                            <div class="generic_feature_list">
                                                <ul>
                                                    <li><span>Карточка пацієнта</span></li>
                                                    <li><span>Візити пацієнтів</span></li>
                                                    <li><span>Співробітники</span></li>
                                                    <li><span>Клініки</span></li>
                                                    <li><span>Календар</span></li>
                                                    <li class="active"><span>+ Віджет</span></li>
                                                    <li class="active"><span>+ Чат бот</span></li>
                                                    <li class="active"><span>+ Аналітика</span></li>
                                                </ul>
                                            </div>
                                            <div class="generic_price_btn clearfix">
                                                <a class="" href="">Оплатити</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush