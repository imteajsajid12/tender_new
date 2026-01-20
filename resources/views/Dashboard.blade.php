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
					<a href="#"  class="nav-item nav-link active">
						<i class="icon icon-chat"></i>
						פניות
					</a>
					<a href="/admin/chart"  class="nav-item nav-link">
						<i class="icon icon-graphic"></i>
						גרף
					</a>
				</div>
			</div>
		</div>
		<div id="example">
			<div id="dialog">
			</div>
		</div>
	</section>
	<section class="tab-content" id="nav-tabContent">
        <div class="container-fluid">
			<div class="row justify-content-center">
				<?php
				//	var_dump($reports);
    				$forms = $reports[0];
				//var_dump($forms);

				$App = $reports[1];
    				$instypes = \App\Applications::$instypes;
				?>
				@foreach($forms as $key => $form)
					<?php
	    				$institutions = explode(',', $form->department);
	    				$type = $form->type;
					?>
					<div class="reports_item col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<div class="item_content">
							<h3 class="i-title">פניות בנושא  {{$form->name}}</h3>
							<ul class="nav nav-tabs">
								@foreach($institutions as $key => $ins)
									<li class="<?php if($key==0) echo 'active' ?>"><a data-toggle="tab" href="#data-{{$ins}}-{{$type}}"><?php if(isset($instypes[$ins])) echo $instypes[$ins]; ?></a></li>
								@endforeach
							</ul>
							<div class="tab-content">
								@foreach($institutions as $key => $ins)
									<div id="data-{{$ins}}-{{$type}}" class="tab-pane fade <?php if($key==0) echo 'active show' ?>">
										<span>{{\App\Dashboard::search($App ,array('department' => $ins, 'type' => $type ), true)}}</span>
										<a href="/admin/apps?institution-type={{$ins}}&form-type={{$type}}">סה”כ פניות</a>
										<span>{{\App\Dashboard::search($App ,array('department' => $ins, 'type' => $type, 'status' => 0  ), true)}}</span>
										<a href="/admin/apps?institution-type={{$ins}}&form-type={{$type}}&status=0">ממתין לטיפול</a>
										<span>{{\App\Dashboard::search($App ,array('department' => $ins, 'type' => $type, 'status' => 1  ), true)}}</span>
										<a href="/admin/apps?institution-type={{$ins}}&form-type={{$type}}&status=1">ממתין למסמכים</a>
										<span>{{\App\Dashboard::search($App ,array('department' => $ins, 'type' => $type, 'status' => 2 ), true)}}</span>
										<a href="/admin/apps?institution-type={{$ins}}&form-type={{$type}}&status=2">ממתין לאישור מסמך חדש</a>
										<span>{{\App\Dashboard::search($App ,array('department' => $ins, 'type' => $type, 'status' => 3 ), true)}}</span>
										<a href="/admin/apps?institution-type={{$ins}}&form-type={{$type}}&status=3">ממתין לאישור/דחיית ועדה</a>
										@if($type == 'fsa')
											<span>{{\App\Dashboard::search($App ,array('department' => $ins, 'type' => $type, 'status' => 6 ), true)}}</span>
											<a href="/admin/apps?institution-type={{$ins}}&form-type={{$type}}&status=6">אושר עם התחייבות</a>
											<span>{{\App\Dashboard::search($App ,array('department' => $ins, 'type' => $type, 'status' => 7 ), true)}}</span>
											<a href="/admin/apps?institution-type={{$ins}}&form-type={{$type}}&status=7">אושר בלי התחייבות</a>
										@else
											<span>{{\App\Dashboard::search($App ,array('department' => $ins, 'type' => $type, 'status' => 4 ), true)}}</span>
											<a href="/admin/apps?institution-type={{$ins}}&form-type={{$type}}&status=4">אושר</a>
										@endif
										<span>{{\App\Dashboard::search($App ,array('department' => $ins, 'type' => $type, 'status' => 5 ), true)}}</span>
										<a href="/admin/apps?institution-type={{$ins}}&form-type={{$type}}&status=5">נדחה</a>
										@if($type == 'taf')
											<span>{{\App\Dashboard::search($App ,array('department' => $ins, 'type' => $type, 'status' => 8 ), true)}}</span>
											<a href="/admin/apps?institution-type={{$ins}}&form-type={{$type}}&status=8">ממתין להחלטת וועדת ערעור</a>
											<span>{{\App\Dashboard::search($App ,array('department' => $ins, 'type' => $type, 'status' => 9 ), true)}}</span>
											<a href="/admin/apps?institution-type={{$ins}}&form-type={{$type}}&status=9">אושר בוועדת ערער</a>
											<span>{{\App\Dashboard::search($App ,array('department' => $ins, 'type' => $type, 'status' => 10 ), true)}}</span>
											<a href="/admin/apps?institution-type={{$ins}}&form-type={{$type}}&status=10">נדחה בוועדת ערער</a>
										@endif
									</div>
								@endforeach
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
</main>
@endsection
