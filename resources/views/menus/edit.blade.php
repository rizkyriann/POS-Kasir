@extends('layouts.app')

@section('content')
<div class="ta-page-header"><div><p class="ta-kicker">Master Data</p><h1 class="ta-title">Edit Menu</h1></div></div>
<form method="POST" action="{{ route('menus.update', $menu) }}" enctype="multipart/form-data" class="ta-card max-w-2xl p-6">
    @csrf @method('PUT')
    @include('menus.form', ['menu' => $menu])
</form>
@endsection
