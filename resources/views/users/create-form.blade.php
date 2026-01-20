<?php
$permissions = array();
if(!empty($user->role)){
	$permissions = explode(',', $user->role);
}
?>
<div class="modal-header">
	<h5 class="modal-title" id="addUserModalTitle">הוספת משתמש/ נמען חדש</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<i class="icon icon-close"></i>
	</button>
</div>
<div class="modal-body">
<form class="container-fluid align-right" action="#" id="create-user-form">
	<div class="row personal-data">
		<div class="col-3">
			<label class="field">
				<span class="txt">שם פרטי</span>
				<input name="name" type="text" class="c-input-alt" required/>
			</label>
		</div>
		<div class="col-3">
			<label class="field">
				<span class="txt">שם משפחה</span>
				<input name="fname" type="text" class="c-input-alt" required/>
			</label>
		</div>
		<div class="col-3">
			<label class="field">
				<span class="txt">אגף / מחלקה</span>
				<select class="c-select-alt" name="department">
					<option value="education">חינוך</option>
				</select>
			</label>
		</div>
		<div class="col-3">
			<label class="field">
				<span class="txt">תפקיד</span>
				<input name="user_role" type="text" class="c-input-alt" value="" required/>
			</label>
		</div>
	</div>
	<div class="row user-data">
		<div class="col-6">
			<label class="field">
				<span class="txt">שם משתמש</span>
				<input name="email" type="email" class="c-input-alt" placeholder="אנא הזן כתובת מייל" autocomplete="off" required/>
			</label>
		</div>
		<div class="col-6">
			<div class="field">
				<span class="txt">סוג משתמש</span>
				<label class="radio-control">
					<input type="radio" name="user_type" value="0" checked />
					<span class="virtual"></span>
					<span class="text">נמען בלבד</span>
				</label>
				<label class="radio-control">
					<input type="radio" name="user_type" value="1" />
					<span class="virtual"></span>
					<span class="text">משתמש במערכת</span>
				</label>
			</div>
		</div>
	</div>
	<div class="row additional-data hidden" id="permissions">
		<span style="font-size: 20px;display:none;">הרשאות לביצוע פעולות במערכת  </span>

		<label class="field f-section access-data">
			<span class="txt mt-3 mb-3">הרשאות לביצוע פעולות בטפסים</span>
			<div class="select-wrapper" style="width: 69%; display: inline-block;"  data-text="">
				<select class="c-select c-ddd adduser_apppermissions" name="form_type">
					<option style="color:#ddd">בחירת טופס</option>
					@if(!empty($forms))
						@foreach($forms as $key => $form)
							<option style="color:#111" value="{{$form->type}}" data-dep="{{$form->department}}">שם הטופס: {{$form->name}}</option>
						@endforeach
					@endif
				</select>
			</div>
			<div class="select-wrapper"  style="width: 30%; display: inline-block;" data-text="">
				<select class="c-select adduser_apppermissions" name="institution_type" >
					<option style="color:#ddd">בחירת טופס</option>
				</select>
			</div>
		</label>
		<div class="field checkboxes hidden" name="appperm">
			<div><label class="checkbox-control">
					<input type="checkbox" name="permissions[]" value="1" <?php if(in_array(1, $permissions)) echo 'checked' ?> />
					<span class="virtual"></span>
					<span class="text">כניסה וביצוע פעולות בהגדרות</span>
				</label>
			</div><div>
				<label class="checkbox-control">
					<input type="checkbox" name="permissions[]" value="2" <?php if(in_array(2, $permissions)) echo 'checked' ?> />
					<span class="virtual"></span>
					<span class="text">מחיקת פניות</span>
				</label>
			</div><div>
				<label class="checkbox-control">
					<input type="checkbox" name="permissions[]" value="3" <?php if(in_array(3, $permissions)) echo 'checked' ?> />
					<span class="virtual"></span>
					<span class="text">הקמת מכרז חדש</span>
				</label>
			</div><div>
				<label class="checkbox-control">
					<input type="checkbox" name="permissions[]" value="4" <?php if(in_array(4, $permissions)) echo 'checked' ?> />
					<span class="virtual"></span>
					<span class="text">עריכת מכרז</span>
				</label></div><div>
				<label class="checkbox-control">
					<input type="checkbox" name="permissions[]" value="5" <?php if(in_array(5, $permissions)) echo 'checked' ?> />
					<span class="virtual"></span>
					<span class="text">עצירת מכרז</span>
				</label></div><div>
				<label class="checkbox-control">
					<input type="checkbox" name="permissions[]" value="6" <?php if(in_array(6, $permissions)) echo 'checked' ?> />
					<span class="virtual"></span>
					<span class="text">הפעלת מכרז</span>
				</label></div><div>
				<label class="checkbox-control">
					<input type="checkbox" name="permissions[]" value="7" <?php if(in_array(7, $permissions)) echo 'checked' ?> />
					<span class="virtual"></span>
					<span class="text">שכפול מכרז</span>
				</label>
			</div>
		</div>
		<script type="text/javascript">
			var instypes = <?=json_encode(\App\Applications::$instypes)?>
		</script>

		<div class="field f-section auth-data">
			<span class="txt">פרטי התחברות</span>
			<div class="container-fluid"  style="padding: 0">
				<div class="row">
					<div class="col-4">
						<label class="field">
							<input type="password" name="password" class="c-input-alt" placeholder="סיסמה"  autocomplete="off" />
						</label>
					</div>
					<div class="col-4">
						<label class="field">
							<input type="password" name="password_confirmation" class="c-input-alt" placeholder="אימות סיסמה" autocomplete="off" />
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-res">

	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-success" >שמור</button>
	</div>
</form>
</div>
