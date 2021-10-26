<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="js/boxOver.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
    <link rel="stylesheet" type="text/css" href="style.css" />


    <title>Laravel</title>

    {{-- <!-- Fonts -->--}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">--}}

    {{-- <!-- Styles -->--}}
    <!-- {{-- <style>--}} -->
    <!-- /* {{-- ! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.csshtml{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}}--}} */ -->
    {{-- </style>--}}
    <link href="https://cdn.rawgit.com/rastikerdar/vazir-font/v21.2.1/dist/font-face.css" rel="stylesheet" type="text/css" />

    <style>
        body {
            font-family: 'Vazir', 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <div id="main_container">
        <div id="main_content">
            <div id="menu_tab">
                <div class="left_menu_corner"></div>
                <ul class="menu">
                    <li><a href="{{ url('/home') }}" class="nav1"> خانه</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url('/products') }}" class="nav2">محصولات</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url('/specials') }}" class="nav3">شگفت انگیزها</a></li>
                    @guest
                    <li class="divider"></li>
                    <li><a href="{{ url('/login') }}" class="nav4">ورود</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url('/register') }}" class="nav4">ثبت نام</a></li>

                    @else
                    <li class="divider"></li>
                    <li><a href="{{ url('/profile') }}" class="nav4">پروفایل</a></li>
                    @endguest
                    <li class="divider"></li>
                    <li><a href="{{ url('/contact') }}" class="nav6">ارتباط با ما</a></li>
                </ul>
                <div class="right_menu_corner"></div>
            </div>
            <!-- end of menu tab -->
            <div class="crumb_navigation"> Navigation: <span class="current">Home</span></div>
            <div class="left_content">
                <div class="title_box">دسته بندی ها</div>
                <ul class="left_menu">

                    @foreach(\App\Models\Category::where('parent' , 0)->get() as $category)
                    <li class="odd"><a href="{{route('product.category',$category)}}">{{$category->name}}</a></li>
                    @if($category->child->count())
                    @php
                    $childs = $category->child;
                    @endphp
                    @foreach($childs as $child)
                    <li class="even"><a href="{{route('product.category',$child)}}">{{$child->name}}</a></li>
                    @endforeach
                    @endif
                    @endforeach

                  
                </ul>
                {{-- <div class="title_box">Special Products</div>--}}
                {{-- <div class="border_box">--}}
                {{-- <div class="product_title"><a href="details.html">Motorola 156 MX-VL</a></div>--}}
                {{-- <div class="product_img"><a href="details.html"><img src="image/laptop.png" alt="" border="0" /></a></div>--}}
                {{-- <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>--}}
                {{-- </div>--}}
                {{-- <div class="title_box">Newsletter</div>--}}
                {{-- <div class="border_box">--}}
                {{-- <input type="text" name="newsletter" class="newsletter_input" value="your email"/>--}}
                {{-- <a href="#" class="join">join</a> </div>--}}
                {{-- <div class="banner_adds"> <a href="#"><img src="image/bann2.jpg" alt="" border="0" /></a> </div>--}}
            </div>
            <!-- end of left content -->
            @yield('content')
            <!-- end of center content -->
            @php
            $price = App\Helpers\Cart\Cart::all()->sum(function($cart) {
            return $cart['product']->price * $cart['quantity'];
            });
            @endphp

            <div class="right_content">
                <div class="shopping_cart">

                    <div class="cart_title"> سبد خرید</div>
                    <div class="cart_details"> تعداد محصول : {{count(collect($cart)->pluck('items')->toArray()[0])}} <br />
                        <span class="border_cart"></span> مبلغ : <span class="price">{{number_format($price)}}تومان</span>
                    </div>
                    <div class="cart_icon"><a href="/cart" title="header=[Checkout] body=[&nbsp;] fade=[on]"><img src="image/shoppingcart.png" alt="" width="48" height="48" border="0" /></a></div>
                </div>
            </div>
            <!-- end of right content -->
        </div>
        <!-- end of main content -->
        <div class="footer">
            <div class="right_footer"><a href="/home">home</a> <a href="/about">about</a> <a href="/sitemap">sitemap</a> <a href="#">rss</a> <a href="/contact">contact us</a></div>
        </div>
    </div>
    <!-- end of main_container -->

</body>

</html>