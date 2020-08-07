<!doctype html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/css/normalize.css">
		<link rel="stylesheet" href="/css/index.css">
		<title>@if(isset($title)){{ $title }}@endif</title>
		<script>window.Laravel = { csrfToken: "{{ csrf_token() }}" };</script>
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body>
		<div id="app">
			<router-view></router-view>
		</div>
		<script src="/js/index/bundle.js"></script>
	</body>
</html>
