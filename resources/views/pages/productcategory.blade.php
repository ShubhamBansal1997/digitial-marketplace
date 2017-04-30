@extends('app')

@section('css')

@endsection


@section('content')
<section class="positive">
        <div class="container">
            <div class="row">
			
				<!-- product heading -->
                <div class="col-md-12">
					<p>&nbsp;</p>
                    <span class="next">Home &nbsp;<img src="{{ asset('home_asset/fonts/Shape1.png')}}"/>&nbsp; 
                    Products &nbsp;<img src="{{ asset('home_asset/fonts/Shape1.png')}}"/>&nbsp; {{ $name }}
                    </span>
                    <div class="description">

                        <h1 class="prod pro-title">{{ $name }}</h1>
                    
                    </div>
					<div class="gap20"></div>
                </div>    
				
				<!-- Catrgory list -->
				<div class="col-md-12 col-xs-12 over-hide">
					<div class="row">
                   
                    <div class="col-sm-12">
                        <div class="masonry noo-blog home-masonry">
                            <div class="row masonry-container" style="position: relative;">
                                @foreach($products as $product)
                                <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                        <div class="ih-item square effect13 left_to_right">
                                            <a href="{{ URL::to('product') }}/{{ $product->prod_slug }}/{{ $product->id }}">
                                              <div class="img">
                                                <img src="{{ \App\Products::getFileUrl($product->prod_image) }}" alt="{{ $product->prod_image_alt }}">
                                              </div>
                                              <div class="info">
                            					  <div class="col-md-6 col-xs-6"><span class="off1"><a href="{{ URL::to('product') }}/{{ $product->prod_slug }}/{{ $product->id }}">View</a></span></div>
                                                    <div class="col-md-6 col-xs-6"><span class="off2"><a href="{{ URL::to('addtocart') }}/{{ $product->id }}">Add to Cart</a></span></div>
                                                  </div>

                                            </a>
                                        </div>
								        <div class="blog-description row">
                                            <div class="col-md-8 col-xs-8">
                                                <ul class="details">
                                                    <li>
                                                        <span>{{ $product->prod_name }}</span>
                                                        @foreach(\App\Users::where('id',$product->prod_vendor_id)->get() as $user)
                                                        <span><a href="{{ URL::to('vendor')}}/{{ $user->user_slug }}/{{ $user->id }}">By <strong>{{ \App\Users::username($product->prod_vendor_id) }}</strong> in <strong> {{ \App\Category::cat_name(explode(",", $product->prod_categories)[0]) }}</strong></a></span>
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 col-xs-4">
                                                <ul>
                                                    <li>
    													<span class="price new">$ {{ $product->prod_price}}</span>
                                                    </li>
                                                </ul>
                                            </div>
									   </div>
                                    </div>
                                </div>
                               
                                @endforeach
                            </div>
                        </div>
                    </div>
                
                   
                
					
					</div>
					<div class="gap40"></div>
					
				
					
					<div class="gap60"></div>
                </div>
				
				<div class="clearfix"></div>
            </div>
        </div>
		<!-- Ads Bannner -->
		<div class="container">
			<div class="ads-banner"> </div>
		</div>
		<div class="gap60"></div>
    </section>

@endsection

@section('script')

@endsection