@extends('frontend.main-master')
@section('content')
@section('title')
Subcategory Product
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>

                @foreach($breadsubcat as $item)
                <li class='active'>{{ $item->category->category_name_en }}</li>
                @endforeach

                @foreach($breadsubcat as $item)
                <li class='active'>{{ $item->subcategory_name_en }}</li>
                @endforeach
            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-3 sidebar'>

                <!-- ===== == TOP NAVIGATION ======= ==== -->
                @include('frontend.common.vertical_menu')
                <!-- = ==== TOP NAVIGATION : END === ===== -->

                <div class="sidebar-module-container">
                    <div class="sidebar-filter">
                        <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
                        <div class="sidebar-widget wow fadeInUp">
                            <h3 class="section-title">shop by</h3>
                            <div class="widget-header">
                                <h4 class="widget-title">Category</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <div class="accordion">

                                    @foreach($categories as $category)
                                    <div class="accordion-group">
                                        <div class="accordion-heading"> <a href="#collapse{{ $category->id }}"
                                                data-toggle="collapse" class="accordion-toggle collapsed">
                                                @if(session()->get('language') == 'indonesia')
                                                {{ $category->category_name_ind }} @else
                                                {{ $category->category_name_en }} @endif </a> </div>
                                        <!-- /.accordion-heading -->
                                        <div class="accordion-body collapse" id="collapse{{ $category->id }}"
                                            style="height: 0px;">
                                            <div class="accordion-inner">

                                                @php
                                                $subcategories =
                                                App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
                                                @endphp

                                                @foreach($subcategories as $subcategory)
                                                <ul>
                                                    <li><a
                                                            href="{{ url('subcategory/product/'.$subcategory->id.'/'.$subcategory->subcategory_slug_en ) }}">
                                                            @if(session()->get('language') == 'indonesia')
                                                            {{ $subcategory->subcategory_name_ind }} @else
                                                            {{ $subcategory->subcategory_name_en }} @endif</a></li>

                                                </ul>
                                                @endforeach


                                            </div>
                                            <!-- /.accordion-inner -->
                                        </div>
                                        <!-- /.accordion-body -->
                                    </div>
                                    <!-- /.accordion-group -->
                                    @endforeach
                                </div>
                                <!-- /.accordion -->
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

                        <!-- == ====== PRODUCT TAGS ==== ======= -->
                        @include('frontend.common.product_tags')
                        <!-- /.sidebar-widget -->
                        <!-- == ====== END PRODUCT TAGS ==== ======= -->

                        <div class="home-banner"> <img
                                src="{{ asset('frontend/assets/images/banners/LHS-banner.jpg') }}" alt="Image"> </div>
                    </div>
                    <!-- /.sidebar-filter -->
                </div>
                <!-- /.sidebar-module-container -->
            </div>
            <!-- /.sidebar -->
            <div class='col-md-9'>

                <!-- == ==== SECTION – HERO === ====== -->

                <div id="category" class="category-carousel hidden-xs">
                    <div class="item">
                        <div class="image"> <img src="{{ asset('frontend/assets/images/banners/cat-banner-1.jpg') }}"
                                alt="" class="img-responsive"> </div>
                        <div class="container-fluid">
                            <div class="caption vertical-top text-left">
                                <div class="big-text"> Big Sale </div>
                                <div class="excerpt hidden-sm hidden-md"> Save up to 49% off </div>
                                <div class="excerpt-normal hidden-sm hidden-md"> Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit </div>
                            </div>
                            <!-- /.caption -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                </div>

                @foreach($breadsubcat as $item)

                <span class="badge badge-danger" style="background: #808080">{{ $item->category->category_name_en }}
                </span>
                @endforeach
                /
                @foreach($breadsubcat as $item)
                <span class="badge badge-danger" style="background: #FF0000">{{ $item->subcategory_name_en }} </span>

                @endforeach

                <div class="clearfix filters-container m-t-10">
                    <div class="row">
                        <div class="col col-sm-6 col-md-2">
                            <div class="filter-tabs">
                                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                    <li class="active"> <a data-toggle="tab" href="#grid-container"><i
                                                class="icon fa fa-th-large"></i>Grid</a> </li>
                                    <li><a data-toggle="tab" href="#list-container"><i
                                                class="icon fa fa-th-list"></i>List</a></li>
                                </ul>
                            </div>
                            <!-- /.filter-tabs -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-12 col-md-6">
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                                Position <span class="caret"></span> </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a href="#">position</a></li>
                                                <li role="presentation"><a href="#">Price:Lowest first</a></li>
                                                <li role="presentation"><a href="#">Price:HIghest first</a></li>
                                                <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.fld -->
                                </div>
                                <!-- /.lbl-cnt -->
                            </div>
                            <!-- /.col -->
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Show</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1
                                                <span class="caret"></span> </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a href="#">1</a></li>
                                                <li role="presentation"><a href="#">2</a></li>
                                                <li role="presentation"><a href="#">3</a></li>
                                                <li role="presentation"><a href="#">4</a></li>
                                                <li role="presentation"><a href="#">5</a></li>
                                                <li role="presentation"><a href="#">6</a></li>
                                                <li role="presentation"><a href="#">7</a></li>
                                                <li role="presentation"><a href="#">8</a></li>
                                                <li role="presentation"><a href="#">9</a></li>
                                                <li role="presentation"><a href="#">10</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.fld -->
                                </div>
                                <!-- /.lbl-cnt -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-6 col-md-4 text-right">

                            <!-- /.pagination-container -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>

                <!--    //////////////////// START Product Grid View  ////////////// -->

                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div class="row" id="grid_view_product">
                                    @include('frontend.product.grid-view-product')
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.category-product -->
                        </div>
                        <!-- /.tab-pane -->

                        <!--            //////////////////// END Product Grid View  ////////////// -->
                        
                        <!--            //////////////////// Product List View Start ////////////// -->
                        <div class="tab-pane " id="list-container">
                            <div class="category-product" id="list_view_product">

                                @include('frontend.product.list-view-product')

                                <!--            //////////////////// Product List View END ////////////// -->
                            </div>
                            <!-- /.category-product -->
                        </div>
                        <!-- /.tab-pane #list-container -->
                    </div>
                    <!-- /.tab-content -->
                    <div class="clearfix filters-container">
                        <div class="text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">
                                </ul>
                                <!-- /.list-inline -->
                            </div>
                            <!-- /.pagination-container -->
                        </div>
                        <!-- /.text-right -->
                    </div>
                    <!-- /.filters-container -->
                </div>
                <!-- /.search-result-container -->
            </div>
            <!-- /.col -->
            <div class="ajax-loadmore-product text-center" style="display: none;">
                <img src="{{ asset('frontend/assets/images/loader.svg') }}" style="width: 120px; height: 120px;">
            </div>
        </div>
        <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider wow fadeInUp">
            <div class="logo-slider-inner">
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                    <div class="item m-t-15"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt=""> </a>
                    </div>
                    <!--/.item-->

                    <div class="item m-t-10"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt=""> </a>
                    </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand3.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand6.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand2.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand1.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->
                </div>
                <!-- /.owl-carousel #logo-slider -->
            </div>
            <!-- /.logo-slider-inner -->

        </div>
        <!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->

</div>
<!-- /.body-content -->

<script>
    function loadmoreProduct(page) {
        $.ajax({
                type: "get",
                url: "?page=" + page,
                beforeSend: function (response) {

                    $('.ajax-loadmore-product').show();
                }

            })

            .done(function (data) {
                if (data.grid_view == " " || data.list_view == " ") {
                    return;
                }
                $('.ajax-loadmore-product').hide();

                $('#grid_view_product').append(data.grid_view);
                $('#list_view_product').append(data.list_view);
            })

            .fail(function () {
                alert('Something Went Wrong');
            })

    }

    var page = 1;
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            loadmoreProduct(page);
        }

    });

</script>

@endsection
