<!DOCTYPE html>
<html lang="en">
	<body>

	<!-- Views for authorization and registration pages -->
	@yield('authLogin')
	@yield('authRegister')

	<!-- View for confirmation email -->
	@yield('email')

	<!-- Views of main pages -->
	@yield('home')
	@yield('posts')

	<!-- This block is in a development mode.
		@yield('fb')
		@yield('vk')
		@yield('twttr')
		@yield('gplus')
 	-->

	</body>
</html>