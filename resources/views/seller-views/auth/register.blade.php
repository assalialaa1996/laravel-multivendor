@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('Seller Apply'))

@push('css_or_js')
<link href="{{asset('public/assets/back-end')}}/css/select2.min.css" rel="stylesheet"/>
<link href="{{asset('public/assets/back-end/css/croppie.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush


@section('content')

<div class="container main-card rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">

    <div class="card o-hidden border-0 shadow-lg my-4">
        <div class="card-body ">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center mb-2 ">
                            <h3 class="" > {{\App\CPU\translate('Shop')}} {{\App\CPU\translate('Application')}}</h3>
                            <hr>
                        </div>
                        <form class="user" action="{{route('shop.apply')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h5 class="black">{{\App\CPU\translate('Seller')}} {{\App\CPU\translate('Info')}} </h5>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="f_name" value="{{old('f_name')}}" placeholder="{{\App\CPU\translate('first_name')}}" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName" name="l_name" value="{{old('l_name')}}" placeholder="{{\App\CPU\translate('last_name')}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0 mt-4">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" value="{{old('email')}}" placeholder="{{\App\CPU\translate('email_address')}}" required>
                                </div>
                                <div class="col-sm-6"><small class="text-danger">( * {{\App\CPU\translate('country_code_is_must')}} {{\App\CPU\translate('like_for_BD_880')}} )</small>
                                    <input type="number" class="form-control form-control-user" id="exampleInputPhone" name="phone" value="{{old('phone')}}" placeholder="{{\App\CPU\translate('phone_number')}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" minlength="6" id="exampleInputPassword" name="password" placeholder="{{\App\CPU\translate('password')}}" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" minlength="6" id="exampleRepeatPassword" placeholder="{{\App\CPU\translate('repeat_password')}}" required>
                                    <div class="pass invalid-feedback">{{\App\CPU\translate('Repeat')}}  {{\App\CPU\translate('password')}} {{\App\CPU\translate('not match')}} .</div>
                                </div>
                            </div>
                            <div class="">
                                <div class="pb-1">
                                    <center>
                                        <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewer"
                                            src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                                    </center>
                                </div>

                                <div class="form-group">
                                    <div class="custom-file" style="text-align: left">
                                        <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUpload">{{\App\CPU\translate('Upload')}} {{\App\CPU\translate('image')}}</label>
                                    </div>
                                </div>
                            </div>


                            <h5 class="black">{{\App\CPU\translate('Shop')}} {{\App\CPU\translate('Info')}}</h5>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0 ">
                                    <input type="text" class="form-control form-control-user" id="shop_name" name="shop_name" placeholder="{{\App\CPU\translate('shop_name')}}" value="{{old('shop_name')}}"required>
                                </div>
                                <div class="col-sm-6">
                                    
                                    <select style="background: whitesmoke; appearance: auto;"
                                            class="form-control custom-select" name="shop_address">
                                           
                                            <option disabled> -- Makkah Province --</option>
                                            <option>Jeddah Governorate</option>
                                            <option>City of Makkah</option>
                                            <option>Ta'if Governorate</option>
                                            <option>Qunfudhah Governorate</option>
                                            <option>Laith Governorate</option>
                                            <option>Jumum Governorate</option>
                                            <option>Rabigh Governorate</option>
                                            <option>Khulays Governorate</option>
                                            <option>Ranyah Governorate</option>
                                            <option>Turbah Governorate</option>
                                            <option>Khurmah Governorate</option>
                                            <option>Kamil Governorate</option>
                                            
                                            <option disabled> -- Riyadh Province --</option>
                                            <option>City of Riyadh</option>
                                            <option>Kharj Governorate</option>
                                            <option>Duwaidmi Governorate</option>
                                            <option>Majma'ah Governorate</option>
                                            <option>Quwai'iyah Governorate</option>
                                            <option>Wadi ad-Dawasir Governorate</option>
                                            <option>'Afif Governorate</option>
                                            <option>Zulfi Governorate</option>
                                            <option>Dir'iyah Governorate</option>
                                            <option>Aflaj Governorate</option>
                                            <option>Hawtat Bani Tamim Governorate</option>
                                            <option>Muzahmiyah Governorate</option>
                                            <option>Sulayyil Governorate</option>
                                            <option>Shaqra' Governorate</option>
                                            <option>Rumah Governorate</option>
                                            <option>Dhurma Governorate</option>
                                            <option>Thadij Governorate</option>
                                            <option>Hariq Governorate</option>
                                            <option>Huraymila Governorate</option>
                                            <option>Ghat Governorate</option>

                                            <option disabled> -- Madinah Province --</option>
                                            <option>City of Madinah</option>
                                            <option>Qatif Governorate</option>
                                            <option>Khobar Governorate</option>
                                            <option>Hafr al-Batin Governorate</option>
                                            <option>Jubail Governorate</option>
                                            <option>Khafji Governorate</option>
                                            <option>Buqayq Governorate</option>
                                            <option>Na'iriyah Governorate</option>
                                            <option>Ra's Tanura Governorate</option>
                                            <option>Qaryat al-'Ulya Governorate</option>

                                            <option disabled> -- Eastern Province --</option>
                                            <option>City of Dammam</option>
                                            <option>Ahsa' Governorate</option>
                                            <option>Yanbu' al-Bahr Governorate</option>
                                            <option>Badr Governorate</option>
                                            <option>'Alula Governorate</option>
                                            <option>Mahd Governorate</option>
                                            <option>Henakiyah Governorate</option>
                                            <option>Khaybar Governorate</option>

                                            <option disabled> -- Al Baha Province --</option>
                                            <option>City of Baha</option>
                                            <option>Mukhwah Governorate</option>
                                            <option>Baljurashi Governorate</option>
                                            <option>Qilwah Governorate</option>
                                            <option>Mandaq Governorate</option>
                                            <option>Qari Governorate</option>
                                            <option>'Aqiq Governorate</option>
                                            
                                            <option disabled> -- Al Jawf Province --</option>
                                            <option>City of Sakaka</option>
                                            <option>Qurayyat Governorate</option>
                                            <option>Daumat Governorate</option>

                                            <option disabled> -- Northern Borders Province --</option>
                                            <option>City of 'Ar'ar</option>
                                            <option>Rafha Governorate</option>
                                            <option>Turaif Governorate</option>
                                      
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <div class="pb-1">
                                    <center>
                                        <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewerLogo"
                                            src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                                    </center>
                                </div>

                                <div class="form-group">
                                    <div class="custom-file" style="text-align: left">
                                        <input type="file" name="logo" id="LogoUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="LogoUpload">{{\App\CPU\translate('Upload')}} {{\App\CPU\translate('logo')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="pb-1">
                                    <center>
                                        <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewerBanner"
                                             src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                                    </center>
                                </div>

                                <div class="form-group">
                                    <div class="custom-file" style="text-align: left">
                                        <input type="file" name="banner" id="BannerUpload" class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" style="overflow: hidden; padding: 2%">
                                        <label class="custom-file-label" for="BannerUpload">{{\App\CPU\translate('Upload')}} {{\App\CPU\translate('Banner')}}</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block" id="apply">{{\App\CPU\translate('Apply')}} {{\App\CPU\translate('Shop')}} </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small"  href="{{route('seller.auth.login')}}">{{\App\CPU\translate('already_have_an_account?_login.')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif
<script>
    $('#exampleInputPassword ,#exampleRepeatPassword').on('keyup',function () {
        var pass = $("#exampleInputPassword").val();
        var passRepeat = $("#exampleRepeatPassword").val();
        if (pass==passRepeat){
            $('.pass').hide();
        }
        else{
            $('.pass').show();
        }
    });
    $('#apply').on('click',function () {

        var image = $("#image-set").val();
        if (image=="")
        {
            $('.image').show();
            return false;
        }
        var pass = $("#exampleInputPassword").val();
        var passRepeat = $("#exampleRepeatPassword").val();
        if (pass!=passRepeat){
            $('.pass').show();
            return false;
        }


    });
    function Validate(file) {
        var x;
        var le = file.length;
        var poin = file.lastIndexOf(".");
        var accu1 = file.substring(poin, le);
        var accu = accu1.toLowerCase();
        if ((accu != '.png') && (accu != '.jpg') && (accu != '.jpeg')) {
            x = 1;
            return x;
        } else {
            x = 0;
            return x;
        }
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewer').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#customFileUpload").change(function () {
        readURL(this);
    });

    function readlogoURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewerLogo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readBannerURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewerBanner').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#LogoUpload").change(function () {
        readlogoURL(this);
    });
    $("#BannerUpload").change(function () {
        readBannerURL(this);
    });
</script>
@endpush
