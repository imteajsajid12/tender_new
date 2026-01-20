
<form action="/admin/users/edit-user/{{$user->id}}" class="edit-form h-100 align-right" id="edit-form" method="post">
	<fieldset>
		<div class="field bg-white personal-block <?php if(isset($form_type) && $form_type == 1) echo 'hidden'?> ">
			<div class="container-fluid">
				<div class="row justify-content-between">
					<div class="col-">
						<span class="field-heading">{{$user->name}}</span>
						<span class="field-value">{{isset($user->meta['user_role']) ? $user->meta['user_role']: ""}}</span>
					</div>
					<div class="col-">
						<a href="#" id="edit-personal-data"><i class="icon icon-edit"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div class="field bg-white personal-data <?php if( !isset($form_type) || $form_type != 1) echo 'hidden'?> ">
			<div class="container-fluid">
				<div class="row">
					<?php $name = explode(' ', $user->name);
                    	$name[1] = isset($name[1]) ? $name[1] : ''; ?>
					<div class="col-6">
						<label class="input-field">
							<span class="text">שם פרטי</span>
							<input name="name" type="text" class="c-input-alt" value="{{$name[0]}}" />
						</label>
					</div>
					<div class="col-6">
						<label class="input-field">
							<span class="text">שם משפחה</span>
							<input name="fname" type="text" class="c-input-alt" value="{{$name[1]}}" />
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<label class="input-field">
							<span class="text">אגף / מחלקה</span>
							<select class="c-select-alt" name="department">
								<option value="education" <?php if(isset($user->meta['department']) && $user->meta['department'] == 'education') echo 'selected'?>>חינוך</option>
							</select>
						</label>
					</div>
					<div class="col-6">
						<label class="input-field">
							<span class="text">תפקיד</span>
							<input name="user_role" type="text" class="c-input-alt" value="@if(isset($user->meta['user_role'])) {{$user->meta['user_role']}} @endif" />
						</label>
					</div>
				</div>
				<div class="row edit_row_error">@if($errors && $form_type == 1)
						@foreach($errors as $error)
								{{$error}}<?='<br>'?>
						@endforeach
					@endif</div>
				<div class="row">
					<div class="col-6">
						<input type="submit" name="save-personal-data" id="save-personal-data" class="btn btn-outline-success" value="שמור">
					</div>
					<div class="col-6">
						<button type="button" id="cancel-personal-data" class="btn btn-outline-success">בטל</button>
					</div>
				</div>
			</div>
		</div>
		<div class="field bg-white">
			<div class="container-fluid">
				<div class="row justify-content-between">
					<div class="col-">
						<span class="field-value">גישה למערכת</span>
					</div>
					<div class="col-">
						<label class="switcher-control">
							<input type="checkbox" <?php if($user->status == '1') echo 'checked' ?> name="user_type" value="1"/>
							<span class="frame">
								<span class="inner">
									<span class="text on">פעיל</span>
									<span class="text off">לא פעיל</span>
								</span>
							</span>
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="field system p-0 <?php if($user->status != '1' && ($form_type != 2 || $form_type != 3)) echo 'hidden' ?>">
			<ul class="nav nav-tabs">
				<li class="<?php if($form_type != 2) echo 'active' ?>"><a data-toggle="tab" href="#access-data">הרשאות</a></li>
				<li class="<?php if($form_type == 2) echo 'active' ?>"><a data-toggle="tab" href="#auth-data">פרטי התחברות</a></li>
			</ul>
			<div class="tab-content">
				<div id="access-data" class="tab-pane fade show <?php if($form_type != 2) echo 'active show' ?>">
					<h3 class="tab-title">הרשאות לביצוע פעולות במערכת  </h3>
					<?php
						$permissions = array();
						if(!empty($user->role)){
							$permissions = explode(',', $user->role);
						}
						$instypes = \App\Applications::$instypes;
					?>
					<label class="checkbox-control">
						<input type="checkbox" name="permissions[]" value="1" <?php if(in_array(1, $permissions)) echo 'checked' ?> />
						<span class="virtual"></span>
						<span class="text">כניסה וביצוע פעולות בהגדרות</span>
					</label>
					<label class="checkbox-control">
						<input type="checkbox" name="permissions[]" value="2" <?php if(in_array(2, $permissions)) echo 'checked' ?> />
						<span class="virtual"></span>
						<span class="text">מחיק פניות</span>
					</label>
					<label class="checkbox-control">
						<input type="checkbox" name="permissions[]" value="3" <?php if(in_array(3, $permissions)) echo 'checked' ?> />
						<span class="virtual"></span>
						<span class="text">הקמת מכרז חדש</span>
					</label><label class="checkbox-control">
						<input type="checkbox" name="permissions[]" value="4" <?php if(in_array(4, $permissions)) echo 'checked' ?> />
						<span class="virtual"></span>
						<span class="text">עריכת מכרז</span>
					</label><label class="checkbox-control">
						<input type="checkbox" name="permissions[]" value="5" <?php if(in_array(5, $permissions)) echo 'checked' ?> />
						<span class="virtual"></span>
						<span class="text">עצירת מכרז</span>
					</label><label class="checkbox-control">
						<input type="checkbox" name="permissions[]" value="6" <?php if(in_array(6, $permissions)) echo 'checked' ?> />
						<span class="virtual"></span>
						<span class="text">הפעלת מכרז</span>
					</label><label class="checkbox-control">
						<input type="checkbox" name="permissions[]" value="7" <?php if(in_array(7, $permissions)) echo 'checked' ?> />
						<span class="virtual"></span>
						<span class="text">שכפול מכרז</span>
					</label>


				<?php
					/*
					 *
					 * 	{{--<h3 class="tab-title mt-5 mb-3">הרשאות לביצוע פעולות בטפסים</h3>

					<div class="selects">
						<select class="c-select <?php if( !isset($ins_type[0]) ) echo 'c-ddd'?> apppermissions" name="form_type"  style="max-width: 50%">
							<option style="color:#ddd">בחירת טופס</option>
							@if(!empty($userdata['forms']))
								@foreach($userdata['forms'] as $key => $form)
									<?php $selected = ''; ?>
									@if(isset($ins_type[0]) && $ins_type[0] == $form->type)
										<?php
											$selected = 'selected';
											$institution_form = $form;
										 ?>
									@endif
									<option style="color:#111" value="{{$form->type}}" {{$selected}} data-dep="{{$form->department}}">שם הטופס: {{$form->name}}</option>
								@endforeach
							@endif
						</select>
						<select class="c-select  <?php if( !isset($ins_type[1]) ) echo 'c-ddd'?> apppermissions" name="institution_type" style="max-width: 50%">
							<option style="color:#ddd">בחירת טופס</option>
							@if(!empty($institution_form))
								@php $departments = explode(',', $institution_form->department) @endphp
								@foreach($departments as $key => $dep)
									@php $selected = ''  @endphp
									@if(isset($ins_type[1]) && $ins_type[1] == $dep)
										@php $selected = 'selected'; @endphp
									@endif
									<option style="color:#111" value="{{$dep}}" {{$selected}}><?php if(isset($instypes[$dep])) echo $instypes[$dep]; ?></option>
								@endforeach
							@endif
						</select>
					</div>
					--}}
					 * */

					?>
					<script type="text/javascript">
						var instypes = <?=json_encode($instypes)?>
					</script>
					<div class="apppermissions_content">
						<?php echo isset($apppermissions_html ) ? $apppermissions_html : ""; ?>
					</div>
					@if($errors && $form_type == 3)
						<div class="input-field" style="color: red">
							@foreach($errors as $error)
									{{$error}}<?='<br>'?>
							@endforeach
						</div>
					@endif
					<div class="action-content">
						<button type="button" id="save-form-access-data" class="btn btn-success btn-lg btn-block m-0">שמור</button>
					</div>
				</div>
				<div id="auth-data" class="tab-pane fade <?php if($form_type == 2) echo 'active show' ?>">
					<label class="input-field">
						<span class="text">שם משתמש</span>
						<input class="c-input" placeholder="נא הזן את כתובת המייל שלך" name="email" type="email" value="{{$user->email}}" class="edit-email" />
					</label>
					<label class="input-field">
						<span class="text">סיסמה</span>
						<input class="c-input e-pass" placeholder="נא הזן סיסמה בת 8 סמלים לפחות" type="password" name="password" />
					</label>
					<label class="input-field">
						<span class="text">אימות סיסמה</span>
						<input class="c-input e-pass" placeholder="נא חזור על הסיסמה שהזנת מקודם" type="password" name="password_confirmation"/>
					</label>
					@if($errors && $form_type == 2)
						<div class="input-field" style="color: red">
							@foreach($errors as $error)
									{{$error}}<?='<br>'?>
							@endforeach
						</div>
					@endif
					<div class="action-content">
						<button type="button" id="save-form-auth-data" class="btn btn-success btn-lg btn-block m-0">שמור</button>
					</div>
				</div>
			</div>
		</div>
	</fieldset>
	<div class="action-content cheng_statuss_content <?php if($user->status == '1') echo 'hidden' ?>">
		<button type="button" id="cheng-statuss-button" class="btn btn-success btn-lg btn-block m-0">שמור</button>
	</div>
</form>
