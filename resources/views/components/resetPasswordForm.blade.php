<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Reset Password</h1>
							<div class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">New Password</label>
									<input id="password" type="password" class="form-control" name="password" value="" required autofocus>
									<div class="invalid-feedback">
										Password is required	
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password-confirm">Confirm Password</label>
									<input id="password-confirm" type="password" class="form-control" name="password_confirm" required>
								    <div class="invalid-feedback">
										Please confirm your new password
							    	</div>
								</div>

								<div class="align-items-center">
									<button type="submit" onclick="resetPassword()" class="btn btn-primary ms-auto">
										Reset Password	
									</button>
								</div>
							</div>
						</div>
					</div>

					<script>
						async function resetPassword(){
							let password = document.getElementById('password').value;
							let confirmPassword = document.getElementById('password-confirm').value;

							if((password.length===0)|| (confirmPassword===0)){
								alert('please fill up the fields');
							}
							else if(password!==confirmPassword){
								alert('password did not matched');
							}else{

								try{

									let res = await axios.post('/reset-password',{password:password});
									if(res.status===200){
										alert('password reset successful!');
										window.location.href="/";
									}

								}catch(error){
									alert('something went wrong!');
								}

								
							}
						}
					</script>