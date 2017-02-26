	<!-- SUBSCRIBE BANNER -->
	<div id="subscribe-banner-wrap">
		<div id="subscribe-banner">
			<!-- SUBSCRIBE CONTENT -->
			<div class="subscribe-content">
				<!-- SUBSCRIBE HEADER -->
				<div class="subscribe-header">
					<figure>
						<img src="{{ asset('home_asset/images/news_icon.png')}}" alt="subscribe-icon">
					</figure>
					<p class="subscribe-title">Subscribe to our Newsletter</p>
					<p>And receive the latest news and offers</p>
				</div>
				<!-- /SUBSCRIBE HEADER -->

				<!-- SUBSCRIBE FORM -->
				<form class="subscribe-form" id="subscriber" action="{{ URL::to('subscribe') }}" method="post">
					{!! csrf_field() !!}
					<input type="text" name="email" id="subscribe_email" placeholder="Enter your email here...">
					<button class="button medium dark" id="subscriber-submit">Subscribe!</button>
				</form>
				<!-- /SUBSCRIBE FORM -->
				
					
						
			
			</div>
			<!-- /SUBSCRIBE CONTENT -->
		</div>
	</div>
	<!-- /SUBSCRIBE BANNER -->