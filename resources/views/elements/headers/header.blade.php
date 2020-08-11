<header>
	<div class="container">
		<div class="header-data">
			<div class="logo">
				<a href="{{ route('home') }}" title=""><img src="images/logo.png" alt=""></a>
			</div>
			<div class="search-bar">
				<form>
					<input type="text" name="search" placeholder="Search...">
					<button type="submit"><i class="la la-search"></i></button>
				</form>
			</div>
			@include('elements.headers.navigation')			
		</div>
	</div>
</header>