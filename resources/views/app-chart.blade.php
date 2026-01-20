@extends('layouts.admin.header')
@section('content')
<main id="main" class="main dashboard">
	<section class="section-topbar">
		<div class="container-fluid">
			<div class="row justify-content-between">
				<div class="py-4 px-3">
					<h2 class="page-name">לוח בקרה</h2>
				</div>
				<div class="nav sub-menu" id="nav-tab">
					<a href="/admin/"  class="nav-item nav-link">
						<i class="icon icon-chat"></i>
						פניות
					</a>
					<a href="#"  class="nav-item nav-link active">
						<i class="icon icon-graphic"></i>
						גרף
					</a>
				</div>
			</div>
		</div>
	</section>
	<section class="chart-content">
        <div class="container-fluid">
			<div class="row justify-content-center">
				<div class="item_content w100">
					<ul class="nav nav-tabs">
						@php
							$instypes = \App\Applications::$instypes;
						@endphp
						@foreach($departments as $key => $dep)
							<li class="@if($key == 0) active @endif"><a class="get_chart" href="{{url('/')}}/admin/chart/get/{{$dep}}">{{$instypes[$dep]}}</a></li>
						@endforeach
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active show" style="width: 100%">
							<div style="width: 100%" class="chart_content">
							    {!! $appChart->container() !!}
							    {!! $appChart->script() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection