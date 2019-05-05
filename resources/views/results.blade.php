@extends("layouts.app")

@section('content')
    <div class="container">{!! $gendersChart->container() !!}</div>
    <div class="container">{!! $agesChart->container() !!}</div>
    <div class="container">{!! $countriesChart->container() !!}</div>
    <div class="container">{!! $hadMadeOnlinePurchaseChart->container() !!}</div>
    <div class="container">{!! $marketingStrategyChart->container() !!}</div>
    <div class="container">{!! $marketsChart->container() !!}</div>
    <div class="container">{!! $bestProductsChart->container() !!}</div>
    <div class="container">{!! $averageBudgetsChart->container() !!}</div>
@stop

@section('scripts')
    {!! $gendersChart->script() !!}
    {!! $agesChart->script() !!}
    {!! $countriesChart->script() !!}
    {!! $hadMadeOnlinePurchaseChart->script() !!}
    {!! $marketingStrategyChart->script() !!}
    {!! $marketsChart->script() !!}
    {!! $bestProductsChart->script() !!}
    {!! $averageBudgetsChart->script() !!}
@stop