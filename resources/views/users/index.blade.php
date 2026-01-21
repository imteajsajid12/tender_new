@extends('layouts.admin.header')
@section('content')

	<main id="main" class="main" style="overflow-x: hidden; min-width: 1200px; ">
		<section class="section-topbar">
			<div class="container-fluid">
				<div class="row justify-content-between">
					<div class="py-4 px-3">
						<h2 class="page-name">ניהול משתמשים והרשאות</h2>
					</div>
					<div class="py-4 px-3">
						<a href="#create-user" class="create-user"  data-toggle="modal" data-target="#addUserModal">
							<i class="icon icon-plus"></i>
							<span>משתמש חדש</span>
						</a>
					</div>
				</div>
			</div>
		</section>

		<!-- Tabs Navigation -->
		<section class="section-tabs">
			<div class="container-fluid">
				<ul class="nav nav-tabs users-tabs" id="userSettingsTabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="users-tab" data-toggle="tab" href="#users-content" role="tab" aria-controls="users-content" aria-selected="true">
							<i class="fa fa-users"></i> משתמשים
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="twofactor-tab" data-toggle="tab" href="#twofactor-content" role="tab" aria-controls="twofactor-content" aria-selected="false">
							<i class="fa fa-shield"></i> אימות דו-שלבי (2FA)
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="securitylog-tab" data-toggle="tab" href="#securitylog-content" role="tab" aria-controls="securitylog-content" aria-selected="false">
							<i class="fa fa-file-text"></i> יומן אבטחה
						</a>
					</li>
				</ul>
			</div>
		</section>

		<section class="section-content">
			<div class="tab-content" id="userSettingsTabContent">
				<!-- Users Tab Content -->
				<div class="tab-pane fade show active" id="users-content" role="tabpanel" aria-labelledby="users-tab">
					<div class="container-fluid h-100">
						<div class="row h-100">
							<div class="col-8 px-0">
								<div class="user-list">
									<table class="apps-list">
										<thead>
											<th>שם פרטי</th>
											<th>שם משפחה</th>
											<th>מחלקה/אגף</th>
											<th>תפקיד</th>
										</thead>
										<tbody>
											@if(!empty($users))
	                    					@foreach($users as $user)
	                    						<?php
	                    						$name = explode(' ', $user->name);
	                    						$name[1] = isset($name[1]) ? $name[1] : '';
	                    						$department = isset($user->meta['department']) ? $userdata['department'][$user->meta['department']]: "";
	                    						$user_role = isset($user->meta['user_role']) ? $user->meta['user_role']: "";
	                    						?>
							                    <tr class="new">
													<td><a href="/admin/users/edit-area/{{$user->id}}" class="name edit-user-b">{{$name[0]}}</a></td>
													<td>{{$name[1]}}</td>
													<td>{{$department}}</td>
													<td>{{$user_role}}</td>
												</tr>
						                    @endforeach
						                @endif
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-4 px-0 edit-area empty">
								<div class="no-selected h-100">
									<div class="container-fluid h-100">
										<div class="row align-items-center h-100">
											<div class="col-12">
												<i class="icon icon-arrow"></i>
												<span class="text">נא בחר משתמש לעריכה</span>
											</div>
										</div>
									</div>
								</div>
								<img src="{{ asset('img/loader.gif') }}" class="loader-img">
							</div>
						</div>
					</div>
				</div>

				<!-- Two-Factor Settings Tab Content -->
				<div class="tab-pane fade" id="twofactor-content" role="tabpanel" aria-labelledby="twofactor-tab">
					<div class="container-fluid py-4">
						@include('users.twofactor-settings')
					</div>
				</div>
			</div>
		</section>
	</main>
	<div class="modal c-modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<img src="{{ asset('img/loader.gif') }}" class="loader-img">
			</div>
		</div>
	</div>
    <div class="container_s">
    	<?php
    	//dd($pageTitle);
    	// dd($user);
    	//print_r($users->items());
    	?>
    </div>

	<style>
	.section-tabs {
		background: #fff;
		border-bottom: 1px solid #dee2e6;
	}

	.users-tabs {
		border-bottom: none;
		padding: 0 15px;
	}

	.users-tabs .nav-item {
		margin-bottom: 0;
	}

	.users-tabs .nav-link {
		border: none;
		border-bottom: 3px solid transparent;
		color: #6c757d;
		padding: 15px 25px;
		font-weight: 500;
		transition: all 0.3s ease;
	}

	.users-tabs .nav-link:hover {
		color: #495057;
		border-bottom-color: #dee2e6;
	}

	.users-tabs .nav-link.active {
		color: #3498db;
		border-bottom-color: #3498db;
		background: transparent;
	}

	.users-tabs .nav-link i {
		margin-left: 8px;
	}

	#twofactor-content {
		background: #f8f9fa;
		min-height: calc(100vh - 200px);
	}

	.tab-content {
		min-height: calc(100vh - 200px);
	}

	#users-content {
		height: calc(100vh - 200px);
	}
	</style>
@endsection