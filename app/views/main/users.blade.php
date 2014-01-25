<h2>All registered Users</h2>

<ul>
@foreach($users as $user)
	<li>{{ HTML::linkRoute('user.profile', $user->name, $user->id) }}</li>
@endforeach
</ul>