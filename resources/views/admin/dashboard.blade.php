@extends('../layout/user-master')
@section('title', 'Dashboard')
@section('username', auth()->user()->username)
@section('content')
    <h1>Dashboard</h1>
@endsection
