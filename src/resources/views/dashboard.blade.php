@extends('allay::layout')

@section('header')
<section class="content-header">
    <!-- Heading -->
    <h1>
        {{ trans('allay::base.dashboard') }}
    </h1>
   
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li>
            <a href="{{ url(config('allay.base.route_prefix', 'admin')) }}">
                {{ config('allay.base.project_name') }}
            </a>
        </li>
        <li class="active">
            {{ trans('allay::base.dashboard') }}
        </li>
    </ol>
</section>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <div class="box-title">{{ trans('allay::base.login_status') }}</div>
            </div>

            <div class="box-body">{{ trans('allay::base.logged_in') }}</div>
        </div>
    </div>
</div>
@endsection
