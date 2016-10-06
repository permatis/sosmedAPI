<!DOCTYPE html>
<html>
<head>
	<title>SosmedAPI - Make posts in multiple social media accounts.</title>
</head>
<body>
	<ul>
		<li class=""><a href="posts">Post Products</a></li>	
		<li class=""><a href="setting/accounts">Setting Accounts</a></li>	
	</ul>
	
	<h2>Input your posts</h2>
	<form method="post" action="/posts">	
		{{ csrf_field() }}
		<label for="title">Title posts</label>
		<textarea name="title"></textarea> <br />
		<input type="checkbox" name="facebook"> Facebook  <br />
		<input type="checkbox" name="fb_fanspage"> Fanspage Facebook<br />
		<input type="checkbox" name="twitter"> Twitter <br />
		<input type="checkbox" name="instagram"> Instagram <br />
		<input type="checkbox" name="google"> Google Plus <br />
		<input type="submit" value="Posts">
	</form>

</body>
</html>