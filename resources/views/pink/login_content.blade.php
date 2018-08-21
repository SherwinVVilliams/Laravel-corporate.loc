<div id = 'content-home' class = 'content group'>
	<div class = 'hentry group'>
		<form id = 'contact-form-contact-us' class = 'contact-form' method = 'post' action = "{{ url('/mylogin') }}">
			{{csrf_field()}}
			<fieldset>
				<ul>
					<li class = 'text-field'>
						<label for = 'login'>
						<span class = 'label'>Name</span>
						<br><span class = 'sublabel'> This is name</span><br>
						</label>
						<div class = 'input-pretend'>
							<span class = 'add-on'><i class = 'icon-user'></i></span>
							<input type = 'text' name = 'name' id ='name' class = 'required' value = ''>
						</div>
						@if($errors->has('name'))
							<span class = 'help-block'>
								<strong>{{ $errors->first('name') }}</strong>
							</span>
						@endif
					</li>
					<li class = 'text-field'>
						<label for = 'password'>
						<span class = 'label'>Password</span>
						<br><span class = 'sublabel'> This is password</span><br>
						</label>
						<div class = 'input-pretend'>
							<span class = 'add-on'><i class = 'icon-user'></i></span>
							<input type = 'password' name = 'password' id ='password' class = 'required' value = ''>
						</div>
						@if($errors->has('password'))
							<span class = 'help-block'>
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</li>
					<li class = 'submit-button'>
						<input type="submit" name="yit_sendmail" value = 'Отправить' class = 'sendmail alignright'>
					</li>
				</ul>
			</fieldset>
		</form>
	</div>
</div>