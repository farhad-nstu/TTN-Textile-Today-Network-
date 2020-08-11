<nav>
	<ul>
	@foreach($menus as $menu)
		<li>
			<a href="{{ $menu['url'] }}" title="">
				<span><img src="{{ $menu['icon_path'] }}" alt=""></span>
				{{ $menu['name'] }}
			</a>
		</li>
	@endforeach
	</ul>
</nav>
<div class="user-account">
	<div class="user-info">
		<img src="images/resources/user.png" alt="">
		<a href="#" title="">{{ auth()->user()->name }}</a>
		<i class="la la-sort-down"></i>
	</div>
	<div class="user-account-settingss" id="users">	
		<ul class="us-links">
			<li><a href="{{ route('profile', ['id' => auth()->user()->id]) }}" title="">Account Setting</a></li>
			<li><a href="#" title="">Pages</a></li>
			<li><a href="#" title="">Groups</a></li>
			<li><a href="#" title="">Events</a></li>
		</ul>

		<h3 class="tc">
			<a class="dropdown-item" href="{{ route('logout') }}"
				onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
				{{ __('Logout') }}
			</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
		</h3>
			
	</div>
</div>