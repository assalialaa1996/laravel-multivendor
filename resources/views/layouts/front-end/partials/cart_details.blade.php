<div class="feature_header">
    <span>{{ \App\CPU\translate('shopping_cart')}}</span>
</div>

<!-- Grid-->
<hr class="view_border">
@php($shippingMethod=\App\CPU\Helpers::get_business_settings('shipping_method'))
@php($cart=\App\Model\Cart::where(['customer_id' => auth('customer')->id()])->get()->groupBy('cart_group_id'))

<div class="row">
    <!-- List of items-->
    <section class="col-lg-8">
        <div class="cart_information">
            @foreach($cart as $group_key=>$group)
                @foreach($group as $cart_key=>$cartItem)
                    @if($cart_key==0)
                        @if($cartItem->seller_is=='admin')
                            {{\App\CPU\Helpers::get_business_settings('company_name')}}
                        @else
                            {{\App\Model\Shop::where(['seller_id'=>$cartItem['seller_id']])->first()->name}}
                        @endif
                    @endif
                    <div class="cart_item mb-2">
                        <div class="row">
                            <div class="col-md-7 col-sm-6 col-9 d-flex align-items-center">
                                <div class="media">
                                    <div
                                        class="media-header d-flex justify-content-center align-items-center {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}">
                                        <a href="{{route('product',$cartItem['slug'])}}">
                                            <img style="height: 82px;"
                                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                 src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$cartItem['thumbnail']}}"
                                                 alt="Product">
                                        </a>
                                    </div>

                                    <div class="media-body d-flex justify-content-center align-items-center">
                                        <div class="cart_product">
                                            <div class="product-title">
                                                <a href="{{route('product',$cartItem['slug'])}}">{{$cartItem['name']}}</a>
                                            </div>
                                            <div
                                                class=" text-accent">{{ \App\CPU\Helpers::currency_converter($cartItem['price']-$cartItem['discount']) }}</div>
                                            @if($cartItem['discount'] > 0)
                                                <strike style="font-size: 12px!important;color: grey!important;">
                                                    {{\App\CPU\Helpers::currency_converter($cartItem['price'])}}
                                                </strike>
                                            @endif
                                            @foreach(json_decode($cartItem['variations'],true) as $key1 =>$variation)
                                                <div class="text-muted"><span
                                                        class="{{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}">{{$key1}} :</span>{{$variation}}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-2 col-3 d-flex align-items-center">
                                <div>
                                    <select name="quantity[{{ $cartItem['id'] }}]" id="cartQuantity{{$cartItem['id']}}"
                                            onchange="updateCartQuantity('{{$cartItem['id']}}')">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option
                                                value="{{$i}}" {{$cartItem['quantity'] == $i?'selected':''}}>
                                                {{$i}}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div
                                class="col-md-4 col-sm-4 offset-4 offset-sm-0 text-center d-flex justify-content-between align-items-center">
                                <div class="">
                                    <div class=" text-accent">
                                        {{ \App\CPU\Helpers::currency_converter(($cartItem['price']-$cartItem['discount'])*$cartItem['quantity']) }}
                                    </div>
                                </div>
                                <div style="margin-top: 3px;">
                                    <button class="btn btn-link px-0 text-danger"
                                            onclick="removeFromCart({{ $cartItem['id'] }})" type="button"><i
                                            class="czi-close-circle {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($cart_key==$group->count()-1)
                    <!-- choosen shipping method-->
                        @php($choosen_shipping=\App\Model\CartShipping::where(['cart_group_id'=>$cartItem['cart_group_id']])->first())
                        @if(isset($choosen_shipping)==false)
                            @php($choosen_shipping['shipping_method_id']=0)
                        @endif

                        @if($shippingMethod=='sellerwise_shipping')
                            @php($shippings=\App\CPU\Helpers::get_shipping_methods($cartItem['seller_id'],$cartItem['seller_is']))
                            <div class="row">
                                <div class="col-12">
                                    <select class="form-control"
                                            onchange="set_shipping_id(this.value,'{{$cartItem['cart_group_id']}}')">
                                        <option>{{\App\CPU\translate('choose_shipping_method')}}</option>
                                        @foreach($shippings as $shipping)
                                            <option
                                                value="{{$shipping['id']}}" {{$choosen_shipping['shipping_method_id']==$shipping['id']?'selected':''}}>
                                                {{$shipping['title'].' ( '.$shipping['duration'].' ) '.\App\CPU\Helpers::currency_converter($shipping['cost'])}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
                <div class="mt-3"></div>
            @endforeach

            @if($shippingMethod=='inhouse_shipping')
                @php($shippings=\App\CPU\Helpers::get_shipping_methods(1,'admin'))
                <div class="row">
                    <div class="col-12">
                        <select class="form-control" onchange="set_shipping_id(this.value,'all_cart_group')">
                            <option>{{\App\CPU\translate('choose_shipping_method')}}</option>
                            @foreach($shippings as $shipping)
                                <option
                                    value="{{$shipping['id']}}" {{$choosen_shipping['shipping_method_id']==$shipping['id']?'selected':''}}>
                                    {{$shipping['title'].' ( '.$shipping['duration'].' ) '.\App\CPU\Helpers::currency_converter($shipping['cost'])}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            @if( $cart->count() == 0)
                <div class="d-flex justify-content-center align-items-center">
                    <h4 class="text-danger text-capitalize">{{\App\CPU\translate('cart_empty')}}</h4>
                </div>
            @endif
        </div>
        
        <form  method="get">
            <div class="form-group">
                <div class="row">
                    <div class="col-12">
                        <label for="phoneLabel" class="form-label input-label">{{\App\CPU\translate('order_note')}} <span
                                            class="input-label-secondary">({{\App\CPU\translate('Optional')}})</span></label>
                        <textarea class="form-control" id="order_note" name="order_note" style="width:100%;">{{ session('order_note')}}</textarea>
                    </div>
                </div>
            </div>
        </form>
       

        <div class="row pt-2">
            <div class="col-6">
                <a href="{{route('home')}}" class="btn btn-primary">
                    <i class="fa fa-{{Session::get('direction') === "rtl" ? 'forward' : 'backward'}} px-1"></i> {{\App\CPU\translate('continue_shopping')}}
                </a>
            </div>
            
            <div class="col-6">
                <a onclick="checkout()"
                   class="btn btn-primary pull-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}">
                    {{\App\CPU\translate('checkout')}}
                    <i class="fa fa-{{Session::get('direction') === "rtl" ? 'backward' : 'forward'}} px-1"></i>
                </a>
            </div>
        </div>
    </section>
    <!-- Sidebar-->
    @include('web-views.partials._order-summary')
</div>


<script>
    cartQuantityInitialize();

    function set_shipping_id(id, cart_group_id) {
        $.get({
            url: '{{url('/')}}/customer/set-shipping-method',
            dataType: 'json',
            data: {
                id: id,
                cart_group_id: cart_group_id
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                location.reload();
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }
</script>
<script>
    function checkout(){
        let order_note = $('#order_note').val();
        console.log(order_note);
        $.post({
            url: "{{route('order_note')}}",
            data: {
                    _token: '{{csrf_token()}}',
                    order_note:order_note,
                    
                },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                let url = "{{ route('checkout-details') }}";
                location.href=url;

            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }
    
</script>
