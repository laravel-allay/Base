@extends('vice::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('vice::base.dashboard') }}<small>{{ trans('vice::base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('vice.base.route_prefix', 'admin')) }}">{{ config('vice.base.project_name') }}</a></li>
        <li class="active">{{ trans('vice::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('vice::base.login_status') }}</div>
                </div>

                <div class="box-body">{{ trans('vice::base.logged_in') }}</div>
            </div>
        </div>
    </div>
@endsection
