@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('Welcome To').' '.$web_config['name']->value)

@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Welcome To {{$web_config['name']->value}} Home"/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Welcome To {{$web_config['name']->value}} Home"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <link rel="stylesheet" href="{{asset('public/assets/front-end')}}/css/home.css"/>
    <style>
        .media {
            background: white;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
        }

        .cz-countdown-days {
            color: white !important;
            background-color: {{$web_config['primary_color']}};
            padding: 0px 6px;
            border-radius: 3px;
            margin-right: 3px !important;
        }

        .cz-countdown-hours {
            color: white !important;
            background-color: {{$web_config['primary_color']}};
            padding: 0px 6px;
            border-radius: 3px;
            margin-right: 3px !important;
        }

        .cz-countdown-minutes {
            color: white !important;
            background-color: {{$web_config['primary_color']}};
            padding: 0px 6px;
            border-radius: 3px;
            margin-right: 3px !important;
        }

        .cz-countdown-seconds {
            color: {{$web_config['primary_color']}};
            border: 1px solid{{$web_config['primary_color']}};
            padding: 0px 6px;
            border-radius: 3px !important;
        }

        .flash_deal_product_details .flash-product-price {
            font-weight: 700;
            font-size: 18px;
            color: {{$web_config['primary_color']}};
        }

        .featured_deal_left {
            height: 130px;
            background: {{$web_config['primary_color']}} 0% 0% no-repeat padding-box;
            padding: 10px 13px;
            text-align: center;
        }

        .category_div:hover {
            color: {{$web_config['secondary_color']}};
        }

        .deal_of_the_day {
            /* filter: grayscale(0.5); */
            opacity: .8;
            background: {{$web_config['secondary_color']}};
            border-radius: 3px;
        }

        .deal-title {
            font-size: 12px;

        }

        .for-flash-deal-img img {
            max-width: none;
        }

        @media (max-width: 375px) {
            .cz-countdown {
                display: flex !important;

            }

            .cz-countdown .cz-countdown-seconds {

                margin-top: -5px !important;
            }

            .for-feature-title {
                font-size: 20px !important;
            }
        }

        @media (max-width: 600px) {
            .flash_deal_title {
                /*font-weight: 600;*/
                /*font-size: 18px;*/
                /*text-transform: uppercase;*/

                font-weight: 700;
                font-size: 25px;
                text-transform: uppercase;
            }

            .cz-countdown .cz-countdown-value {
                font-family: "Roboto", sans-serif;
                font-size: 11px !important;
                font-weight: 700 !important;
            }

            .featured_deal {
                opacity: 1 !important;
            }

            .cz-countdown {
                display: inline-block;
                flex-wrap: wrap;
                font-weight: normal;
                margin-top: 4px;
                font-size: smaller;
            }

            .view-btn-div-f {

                margin-top: 6px;
                float: right;
            }

            .view-btn-div {
                float: right;
            }

            .viw-btn-a {
                font-size: 10px;
                font-weight: 600;
            }


            .for-mobile {
                display: none;
            }

            .featured_for_mobile {
                max-width: 100%;
                margin-top: 20px;
                margin-bottom: 20px;
            }
        }

        @media (max-width: 360px) {
            .featured_for_mobile {
                max-width: 100%;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .featured_deal {
                opacity: 1 !important;
            }
        }

        @media (max-width: 375px) {
            .featured_for_mobile {
                max-width: 100%;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .featured_deal {
                opacity: 1 !important;
            }
        }

        @media (min-width: 768px) {
            .displayTab {
                display: block !important;
            }
        }

        @media (max-width: 800px) {
            .for-tab-view-img {
                width: 40%;
            }

            .for-tab-view-img {
                width: 105px;
            }

            .widget-title {
                font-size: 19px !important;
            }
        }

        .featured_deal_carosel .carousel-inner {
            width: 100% !important;
        }

        .badge-style2 {
            color: black !important;
            background: transparent !important;
            font-size: 11px;
        }
    </style>

    <link rel="stylesheet" href="{{asset('public/assets/front-end')}}/css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/front-end')}}/css/owl.theme.default.min.css"/>
@endpush

@section('content')
    <!-- Hero (Banners + Slider)-->
    <section class="bg-transparent mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-12">
                    @include('web-views.partials._home-top-slider')
                </div>
            </div>
        </div>
    </section>

    {{--flash deal--}}
    @php($flash_deals=\App\Model\FlashDeal::with(['products.product'])->where(['status'=>1])->where(['deal_type'=>'flash_deal'])->whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'))->first())

    @if (isset($flash_deals))
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row section-header fd rtl mx-0">
                        <div class="" style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0">
                            <div class="d-inline-flex displayTab">
                                <span class="flash_deal_title ">
                                    {{$flash_deals['title']}}
                                </span>
                            </div>
                        </div>
                        <div class="" style="padding-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 0">
                            <div class="row view_all view-btn-div-f float-right mx-0">
                                <div class="{{Session::get('direction') === "rtl" ? 'pl-2' : 'pr-2'}}">
                                    <span class="cz-countdown"
                                          data-countdown="{{isset($flash_deals)?date('m/d/Y',strtotime($flash_deals['end_date'])):''}} 11:59:00 PM">
                                        <span class="cz-countdown-days">
                                            <span class="cz-countdown-value"></span>
                                        </span>
                                        <span class="cz-countdown-value">:</span>
                                        <span class="cz-countdown-hours">
                                            <span class="cz-countdown-value"></span>
                                        </span>
                                        <span class="cz-countdown-value">:</span>
                                        <span class="cz-countdown-minutes">
                                            <span class="cz-countdown-value"></span>
                                        </span>
                                        <span class="cz-countdown-value">:</span>
                                        <span class="cz-countdown-seconds">
                                            <span class="cz-countdown-value"></span>
                                        </span>
                                    </span>
                                </div>
                                <div class="">
                                    <a class="btn btn-outline-accent btn-sm viw-btn-a"
                                       href="{{route('flash-deals',[isset($flash_deals)?$flash_deals['id']:0])}}">{{ \App\CPU\translate('view_all')}}
                                        <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'}}"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-carousel owl-theme mt-2" id="flash-deal-slider">
                        @foreach($flash_deals->products as $key=>$deal)
                            @if( $deal->product)
                                @include('web-views.partials._product-card-1',['product'=>$deal->product])
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{--brands--}}
    <section class="container rtl">
        <!-- Heading-->
        <div class="section-header">
            <div class="feature_header" style="color: black">
                <span> {{\App\CPU\translate('brands')}}</span>
            </div>
            <div>
                <a class="btn btn-outline-accent btn-sm viw-btn-a" href="{{route('brands')}}">
                    {{ \App\CPU\translate('view_all')}}
                    <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'}}"></i>
                </a>
            </div>
        </div>
    {{--<hr class="view_border">--}}
    <!-- Grid-->
        <div class="mt-2 mb-3 brand-slider">
            <div class="owl-carousel owl-theme" id="brands-slider">
                @foreach($brands as $brand)
                    <div class="text-center">
                        <a href="{{route('products',['id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}">
                            <div class="brand_div d-flex align-items-center justify-content-center"
                                 style="height:100px">
                                <img
                                    onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                    src="{{asset("storage/app/public/brand/$brand->image")}}" alt="{{$brand->name}}">
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Products grid (featured products)-->
    @if(count($featured_products) > 0)
        <section class="container rtl">
            <!-- Heading-->
            <div class="section-header">
                <div class="feature_header">
                    <span class="for-feature-title">{{ \App\CPU\translate('featured_products')}}</span>
                </div>
                <div>
                    <a class="btn btn-outline-accent btn-sm viw-btn-a"
                       href="{{route('products',['data_from'=>'featured','page'=>1])}}">
                        {{ \App\CPU\translate('view_all')}}
                        <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'}}"></i>
                    </a>
                </div>
            </div>
        {{--<hr class="view_border">--}}
        <!-- Grid-->
            <div class="row mt-2 mb-3">
                @foreach($featured_products as $product)
                    <div class="col-xl-2 col-sm-3 col-6" style="margin-bottom: 10px">
                        @include('web-views.partials._single-product',['product'=>$product])
                        {{--<hr class="d-sm-none">--}}
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{--featured deal--}}
    @php($featured_deals=\App\Model\FlashDeal::with(['products.product.reviews'])->where(['status'=>1])->where(['deal_type'=>'feature_deal'])->first())

    @if(isset($featured_deals))
        <section class="container featured_deal rtl">
            <div class="row">
                <div class="col-xl-3 col-md-4 right">
                    <div class="d-flex align-items-center justify-content-center featured_deal_left">
                        <h1 class="featured_deal_title"
                            style="padding-top: 12px">{{ \App\CPU\translate('featured_deal')}}</h1>
                    </div>
                </div>

                <div class="col-xl-9 col-md-8">
                    <div class="owl-carousel owl-theme" id="web-feature-deal-slider">
                        @foreach($featured_deals->products as $key=>$product)
                            @include('web-views.partials._product-card-1',['product'=>$product->product])
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    {{--deal of the day--}}
    <div class="container rtl">
        <div class="row">
            {{-- Deal of the day/Recommended Product --}}
            <div class="col-xl-3 col-md-4 pb-4 mt-3">
                <div class="deal_of_the_day">
                    @if(isset($deal_of_the_day))
                        <h1 style="color: white"> {{ \App\CPU\translate('deal_of_the_day') }}</h1>
                        <center>
                            <strong style="font-size: 21px!important;color: {{$web_config['primary_color']}}">
                                {{$deal_of_the_day->discount_type=='amount'?\App\CPU\Helpers::currency_converter($deal_of_the_day->discount):$deal_of_the_day->discount.' % '}}
                                {{\App\CPU\translate('off')}}
                            </strong>
                        </center>
                        <div class="d-flex justify-content-center align-items-center" style="padding-top: 37px">
                            <img style="height: 206px;"
                                 src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$deal_of_the_day->product['thumbnail']}}"
                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                 alt="">
                        </div>
                        <div style="text-align: center; padding-top: 26px;">
                            <h5 style="font-weight: 600; color: {{$web_config['primary_color']}}">
                                {{\Illuminate\Support\Str::limit($deal_of_the_day->product['name'],40)}}
                            </h5>
                            <span class="text-accent">
                                {{\App\CPU\Helpers::currency_converter(
                                    $deal_of_the_day->product->unit_price-(\App\CPU\Helpers::get_product_discount($deal_of_the_day->product,$deal_of_the_day->product->unit_price))
                                )}}
                            </span>
                            @if($deal_of_the_day->product->discount > 0)
                                <strike style="font-size: 12px!important;color: grey!important;">
                                    {{\App\CPU\Helpers::currency_converter($deal_of_the_day->product->unit_price)}}
                                </strike>
                            @endif

                        </div>
                        <div class="pt-3 pb-2" style="text-align: center;">
                            <button class="buy_btn"
                                    onclick="location.href='{{route('product',$deal_of_the_day->product->slug)}}'">{{\App\CPU\translate('buy_now')}}
                            </button>
                        </div>
                    @else
                        @php($product=\App\Model\Product::active()->inRandomOrder()->first())
                        @if(isset($product))
                            <h1 style="color: white"> {{ \App\CPU\translate('recommended_product') }}</h1>
                            <div class="d-flex justify-content-center align-items-center" style="padding-top: 55px">
                                <img style="height: 206px;"
                                     src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                                     onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                     alt="">
                            </div>
                            <div style="text-align: center; padding-top: 60px;" class="pb-2">
                                <button class="buy_btn" onclick="location.href='{{route('product',$product->slug)}}'">
                                    {{\App\CPU\translate('buy_now')}}
                                </button>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="container mt-2">
                    <div class="row p-0">
                        <div class="col-md-3 p-0 text-center mobile-padding mt-1 mt-md-0">
                            <img style="height: 29px;" src="{{asset("public/assets/front-end/png/delivery.png")}}"
                                 alt="">
                            <div class="deal-title">3 {{\App\CPU\translate('days')}}
                                <br><span>{{\App\CPU\translate('free_delivery')}}</span></div>
                        </div>
                        <div class="col-md-3 p-0 text-center mt-1 mt-md-0">
                            <img style="height: 29px;" src="{{asset("public/assets/front-end/png/money.png")}}" alt="">
                            <div class="deal-title">{{\App\CPU\translate('money_back_guarantee')}}</div>
                        </div>
                        <div class="col-md-3 p-0 text-center mt-1 mt-md-0">
                            <img style="height: 29px;" src="{{asset("public/assets/front-end/png/Genuine.png")}}"
                                 alt="">
                            <div class="deal-title">100% {{\App\CPU\translate('genuine')}}
                                <br><span>{{\App\CPU\translate('product')}}</span></div>
                        </div>
                        <div class="col-md-3 p-0 text-center mt-1 mt-md-0">
                            <img style="height: 29px;" src="{{asset("public/assets/front-end/png/Payment.png")}}"
                                 alt="">
                            <div class="deal-title">{{\App\CPU\translate('authentic_payment')}}</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Latest products --}}
            <div class="col-xl-9 col-md-8">
                <div class="section-header">
                    <div class="feature_header">
                        <span class="for-feature-title">{{ \App\CPU\translate('latest_products')}}</span>
                    </div>
                    <div>
                        <a class="btn btn-outline-accent btn-sm viw-btn-a"
                           href="{{route('products',['data_from'=>'latest'])}}">
                            {{ \App\CPU\translate('view_all')}}
                            <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'}}"></i>
                        </a>
                    </div>
                </div>

                <div class="row mt-2 mb-3">
                    @foreach($latest_products as $product)
                        <div class="col-xl-3 col-sm-4 col-6 mb-2">
                            @include('web-views.partials._single-product',['product'=>$product])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{--categries--}}
    <section class="container rtl">
        <!-- Heading-->
        <div class="section-header">
            <div class="feature_header">
                <span>{{ \App\CPU\translate('categories')}}</span>
            </div>
            <div>
                <a class="btn btn-outline-accent btn-sm viw-btn-a"
                   href="{{route('categories')}}">{{ \App\CPU\translate('view_all')}}
                    <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'}}"></i>
                </a>
            </div>
        </div>

        <div class="mt-2 mb-3 brand-slider">
            <div class="owl-carousel owl-theme " id="category-slider">
                @foreach($categories as $category)
                    <div class="category_div" style="height: 132px; width: 100%;">
                        <a href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">
                            <img style="vertical-align: middle; padding: 16%;height: 100px"
                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                 src="{{asset("storage/app/public/category/$category->icon")}}"
                                 alt="{{$category->name}}">
                            <p class="text-center small"
                               style="margin-top: -20px">{{Str::limit($category->name, 17)}}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- top sellers -->
    @if(count($top_sellers) > 0)
        <section class="container rtl">
            <!-- Heading-->
            <div class="section-header">
                <div class="feature_header">
                    <span>{{ \App\CPU\translate('sellers')}}</span>
                </div>
                <div>
                    <a class="btn btn-outline-accent btn-sm viw-btn-a"
                       href="{{route('sellers')}}">{{ \App\CPU\translate('view_all')}}
                        <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'}}"></i>
                    </a>
                </div>
            </div>
            <!-- top seller Grid-->
            <div class="mt-2 mb-3 brand-slider">
                <div class="owl-carousel owl-theme" id="top-seller-slider">
                    @foreach($top_sellers as $seller)
                        @if($seller->shop)
                            <div style="height: 100px; padding: 2%; background: white;border-radius: 5px">
                                <center>
                                    <a href="{{route('shopView',['id'=>$seller['id']])}}">
                                        <img
                                            style="vertical-align: middle; padding: 2%;width:75px;height: 75px;border-radius: 50%"
                                            onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                            src="{{asset("storage/app/public/shop")}}/{{$seller->shop->image}}">
                                        <p class="text-center small font-weight-bold">{{Str::limit($seller->shop->name, 14)}}</p>
                                    </a>
                                </center>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </section>
    @endif

    {{-- Categorized product --}}
    @foreach($home_categories as $category)
        <section class="container rtl">
            <!-- Heading-->
            <div class="section-header">
                <div class="feature_header">
                    <span class="for-feature-title">{{$category['name']}}</span>
                </div>
                <div>
                    <a class="btn btn-outline-accent btn-sm viw-btn-a"
                       href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">
                        {{ \App\CPU\translate('view_all')}}
                        <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'}}"></i>
                    </a>
                </div>
            </div>

            <div class="row mt-2 mb-3">
                @foreach($category['products'] as $key=>$product)
                    <div class="col-xl-2 col-sm-3 col-6" style="margin-bottom: 10px">
                        @include('web-views.partials._single-product',['product'=>$product])
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach


    <!-- Product widgets-->
    <section class="container pb-4 pb-md-5 rtl">
        <div class="row">
            <!-- Bestsellers-->
            <div class="col-12 col-sm-6 col-md-4 mb-2 py-3">
                <div class="widget">
                    <div class="d-flex justify-content-between">
                        <h3 class="widget-title">{{ \App\CPU\translate('best_sellings')}}</h3>
                        <div>
                            <a class="btn btn-outline-accent btn-sm"
                               href="{{route('products',['data_from'=>'best-selling','page'=>1])}}">{{ \App\CPU\translate('view_all')}}
                                <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'}}"></i>
                            </a>
                        </div>
                    </div>
                    @foreach($bestSellProduct as $key=>$bestSell)
                        @if($bestSell->product && $key<4)
                            <div class="media align-items-center pt-2 pb-2 mb-1"
                                 data-href="{{route('product',$bestSell->product->slug)}}">
                                <a class="d-block {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}"
                                   href="{{route('product',$bestSell->product->slug)}}">
                                    <img style="height: 54px; width: 54px"
                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                         src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$bestSell->product['thumbnail']}}"
                                         alt="Product"/>
                                </a>
                                <div class="media-body">
                                    <h6 class="widget-product-title">
                                        <a class="ptr"
                                           href="{{route('product',$product->slug)}}">
                                            {{\Illuminate\Support\Str::limit($bestSell->product['name'],30)}}
                                        </a>
                                    </h6>
                                    <div class="widget-product-meta">
                                        <span class="text-accent">
                                            {{\App\CPU\Helpers::currency_converter(
                                            $bestSell->product->unit_price-(\App\CPU\Helpers::get_product_discount($bestSell->product,$bestSell->product->unit_price))
                                            )}}

                                            @if($bestSell->product->discount > 0)
                                                <strike style="font-size: 12px!important;color: grey!important;">
                                                    {{\App\CPU\Helpers::currency_converter($bestSell->product->unit_price)}}
                                                </strike>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- New arrivals-->
            <div class="col-12 col-sm-6 col-md-4 mb-2 py-3">
                <div class="widget">
                    <div class="d-flex justify-content-between">
                        <h3 class="widget-title">{{\App\CPU\translate('new_arrivals')}}</h3>
                        <div>
                            <a class="btn btn-outline-accent btn-sm"
                               href="{{route('products',['data_from'=>'latest','page'=>1])}}">{{ \App\CPU\translate('view_all')}}
                                <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'}}"></i>
                            </a>
                        </div>
                    </div>
                    @foreach($latest_products as $key=>$product)
                        @if($key<4)
                            <div class="media align-items-center pt-2 pb-2 mb-1"
                                 data-href="{{route('product',$product->slug)}}">
                                <a class="d-block {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}"
                                   href="{{route('product',$product->slug)}}">
                                    <img style="height: 54px; width: 54px"
                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                         src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                                         alt="Product"/>
                                </a>
                                <div class="media-body">
                                    <h6 class="widget-product-title">
                                        <a class="ptr"
                                           href="{{route('product',$product->slug)}}">
                                            {{\Illuminate\Support\Str::limit($product['name'],30)}}
                                        </a>
                                    </h6>
                                    <div class="widget-product-meta">
                                          <span class="text-accent">
                                            {{\App\CPU\Helpers::currency_converter(
                                            $product->unit_price-(\App\CPU\Helpers::get_product_discount($product,$product->unit_price))
                                            )}}
                                              @if($product->discount > 0)
                                                  <strike style="font-size: 12px!important;color: grey!important;">
                                                    {{\App\CPU\Helpers::currency_converter($product->unit_price)}}
                                                </strike>
                                              @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- Top rated-->
            <div class="col-12 col-sm-6 col-md-4 mb-2 py-3">
                <div class="widget">
                    <div class="d-flex justify-content-between">
                        <h3 class="widget-title">{{\App\CPU\translate('top_rated')}}</h3>
                        <div><a class="btn btn-outline-accent btn-sm"
                                href="{{route('products',['data_from'=>'top-rated','page'=>1])}}">{{ \App\CPU\translate('view_all')}}
                                <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'}}"></i></a>
                        </div>
                    </div>
                    @foreach($topRated as $key=>$top)
                        @if($top->product && $key<4)
                            <div class="media align-items-center pt-2 pb-2 mb-1"
                                 data-href="{{route('product',$top->product->slug)}}">
                                <a class="d-block {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}"
                                   href="{{route('product',$top->product->slug)}}">
                                    <img style="height: 54px; width: 54px"
                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                         src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$top->product['thumbnail']}}"
                                         alt="Product"/>
                                </a>
                                <div class="media-body">
                                    <h6 class="widget-product-title">
                                        <a class="ptr"
                                           href="{{route('product',$top->product->slug)}}">
                                            {{\Illuminate\Support\Str::limit($top->product['name'],30)}}
                                        </a>
                                    </h6>
                                    <div class="widget-product-meta">
                                       <span class="text-accent">
                                            {{\App\CPU\Helpers::currency_converter(
                                            $top->product->unit_price-(\App\CPU\Helpers::get_product_discount($top->product,$top->product->unit_price))
                                            )}}

                                           @if($top->product->discount > 0)
                                               <strike style="font-size: 12px!important;color: grey!important;">
                                                    {{\App\CPU\Helpers::currency_converter($top->product->unit_price)}}
                                                </strike>
                                           @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    {{-- Owl Carousel --}}
    <script src="{{asset('public/assets/front-end')}}/js/owl.carousel.min.js"></script>

    <script>
        $('#flash-deal-slider').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 5,
            nav: false,
            //navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: true,
            autoplayHoverPause: true,
            '{{session('direction')}}': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 3
                },
                //Large
                992: {
                    items: 4
                },
                //Extra large
                1200: {
                    items: 4
                },
                //Extra extra large
                1400: {
                    items: 4
                }
            }
        })

        $('#web-feature-deal-slider').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 5,
            nav: false,
            //navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: true,
            autoplayHoverPause: true,
            '{{session('direction')}}': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 2
                },
                //Large
                992: {
                    items: 2
                },
                //Extra large
                1200: {
                    items: 3
                },
                //Extra extra large
                1400: {
                    items: 3
                }
            }
        })
    </script>

    <script>
        $('#brands-slider').owlCarousel({
            loop: false,
            autoplay: false,
            margin: 10,
            nav: false,
            '{{session('direction')}}': true,
            //navText: ["<i class='czi-arrow-left'></i>","<i class='czi-arrow-right'></i>"],
            dots: true,
            autoplayHoverPause: true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 2
                },
                360: {
                    items: 3
                },
                375: {
                    items: 3
                },
                540: {
                    items: 4
                },
                //Small
                576: {
                    items: 5
                },
                //Medium
                768: {
                    items: 7
                },
                //Large
                992: {
                    items: 9
                },
                //Extra large
                1200: {
                    items: 11
                },
                //Extra extra large
                1400: {
                    items: 12
                }
            }
        })
    </script>

    <script>
        $('#category-slider, #top-seller-slider').owlCarousel({
            loop: false,
            autoplay: false,
            margin: 5,
            nav: false,
            // navText: ["<i class='czi-arrow-left'></i>","<i class='czi-arrow-right'></i>"],
            dots: true,
            autoplayHoverPause: true,
            '{{session('direction')}}': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 2
                },
                360: {
                    items: 3
                },
                375: {
                    items: 3
                },
                540: {
                    items: 4
                },
                //Small
                576: {
                    items: 5
                },
                //Medium
                768: {
                    items: 6
                },
                //Large
                992: {
                    items: 8
                },
                //Extra large
                1200: {
                    items: 10
                },
                //Extra extra large
                1400: {
                    items: 11
                }
            }
        })
    </script>
@endpush

