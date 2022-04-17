@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Product List'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">  <!-- Page Heading -->
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-12 mb-2 mb-sm-0">
                    <h1 class="page-header-title text-capitalize"><i
                            class="tio-files"></i> {{\App\CPU\translate('stock_limit_products_list')}}
                        <span class="badge badge-soft-dark ml-2">{{$pro->total()}}</span>
                    </h1>
                    <span>{{ \App\CPU\translate('the_products_are_shown_in_this_list,_which_quantity_is_below') }} {{ \App\Model\BusinessSetting::where(['type'=>'stock_limit'])->first()->value }}</span>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row flex-between justify-content-between align-items-center flex-grow-1">
                            <div class="col-12 col-md-12 col-lg-4">
                                <h5>
                                    {{\App\CPU\translate('product_table')}} ({{ $pro->total() }})
                                </h5>
                            </div>
                            <div class="col-12 mt-1 col-md-6 col-lg-4">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                               placeholder="{{\App\CPU\translate('Search Product Name')}}"
                                               aria-label="Search orders"
                                               value="{{ $search }}" required>
                                        <input type="hidden" value="{{ $request_status }}" name="status">
                                        <button type="submit"
                                                class="btn btn-primary">{{\App\CPU\translate('search')}}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                            <div class="col-12 mt-1 col-md-6 col-lg-3">
                                <select name="qty_ordr_sort" class="form-control"
                                        onchange="location.href='{{route('admin.product.stock-limit-list',['in_house', ''])}}/?sort_oqrderQty='+this.value">
                                    <option
                                        value="default" {{ $sort_oqrderQty== "default"?'selected':''}}>{{\App\CPU\translate('default_sort')}}</option>
                                    <option
                                        value="quantity_asc" {{ $sort_oqrderQty== "quantity_asc"?'selected':''}}>{{\App\CPU\translate('quantity_sort_by_(low_to_high)')}}</option>
                                    <option
                                        value="quantity_desc" {{ $sort_oqrderQty== "quantity_desc"?'selected':''}}>{{\App\CPU\translate('quantity_sort_by_(high_to_low)')}}</option>
                                    <option
                                        value="order_asc" {{ $sort_oqrderQty== "order_asc"?'selected':''}}>{{\App\CPU\translate('order_sort_by_(low_to_high)')}}</option>
                                    <option
                                        value="order_desc" {{ $sort_oqrderQty== "order_desc"?'selected':''}}>{{\App\CPU\translate('order_sort_by_(high_to_low)')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table id="datatable"
                                   style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                                   class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                   style="width: 100%">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{\App\CPU\translate('SL#')}}</th>
                                    <th>{{\App\CPU\translate('Product Name')}}</th>
                                    <th>{{\App\CPU\translate('purchase_price')}}</th>
                                    <th>{{\App\CPU\translate('selling_price')}}</th>
                                    <th>{{\App\CPU\translate('quantity')}}</th>
                                    <th>{{\App\CPU\translate('orders')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pro as $k=>$p)
                                    <tr>
                                        <th scope="row">{{$pro->firstItem()+$k}}</th>
                                        <td>
                                            <a href="{{route('admin.product.view',[$p['id']])}}">
                                                {{\Illuminate\Support\Str::limit($p['name'],20)}}
                                            </a>
                                        </td>
                                        <td>
                                            {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']))}}
                                        </td>
                                        <td>
                                            {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price']))}}
                                        </td>
                                        <td>
                                            {{$p['current_stock']}}
                                            <button class="btn btn-sm" id="{{ $p->id }}"
                                                    onclick="update_quantity({{ $p->id }})" type="button"
                                                    data-toggle="modal" data-target="#update-quantity"
                                                    title="{{ \App\CPU\translate('update_quantity') }}">
                                                <i class="tio-add-circle"></i>

                                            </button>
                                        </td>
                                        <td>
                                            {{$p['order_details_count']}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$pro->links()}}
                    </div>
                    @if(count($pro)==0)
                        <div class="text-center p-4">
                            <img class="mb-3" src="{{asset('public/assets/back-end')}}/svg/illustrations/sorry.svg"
                                 alt="Image Description" style="width: 7rem;">
                            <p class="mb-0">{{\App\CPU\translate('No data to show')}}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="update-quantity" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{route('admin.product.update-quantity')}}" method="post" class="row">
                        @csrf
                        <div class="card mt-2 rest-part" style="width: 100%"></div>
                        <div class="form-group col-sm-12 card card-footer">
                            <button class="btn btn-primary" class="btn btn-primary" type="submit">{{\App\CPU\translate('submit')}}</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                                {{\App\CPU\translate('close')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function update_quantity(val) {
            $.get({
                url: '{{url('/')}}/admin/product/get-variations?id='+val,
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    $('.rest-part').empty().html(data.view);
                },
            });
        }

        function update_qty() {
            var total_qty = 0;
            var qty_elements = $('input[name^="qty_"]');
            for (var i = 0; i < qty_elements.length; i++) {
                total_qty += parseInt(qty_elements.eq(i).val());
            }
            if (qty_elements.length > 0) {

                $('input[name="current_stock"]').attr("readonly", true);
                $('input[name="current_stock"]').val(total_qty);
            } else {
                $('input[name="current_stock"]').attr("readonly", false);
            }
        }
    </script>
@endpush
