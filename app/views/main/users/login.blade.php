@extends('layouts.main')

@section('content')
{{ Former::horizontal_open()->secure() }}
	{{ Former::text('auth.email')->name('email')->required() }}
	{{ Former::password('auth.password')->name('password')->required() }}

	{{ Former::actions()->success_submit('auth.login') }}
{{ Former::close() }}
@endsection