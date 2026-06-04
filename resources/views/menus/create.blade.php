@extends('layouts.app')

@section('content')
<div class="ta-page-header"><div><p class="ta-kicker">Master Data</p><h1 class="ta-title">Tambah Menu</h1></div></div>
<form method="POST" action="{{ route('menus.store') }}" enctype="multipart/form-data" class="ta-card max-w-2xl p-6">
    @csrf
    @include('menus.form', ['menu' => null])
</form>
@endsection
