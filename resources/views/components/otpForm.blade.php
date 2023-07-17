<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Confirm OTP</h1>
							<div class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="otp">OTP</label>
									<input id="otp" type="text" class="form-control" name="otp" value="" required autofocus maxlength="4">
								
								</div>

								<div class="align-items-center">
									<button type="submit" onclick="verifyOtp()" class="btn btn-primary ms-auto">
										Confirm OTP	
									</button>
								</div>
							</div>
						</div>
					</div>
					<script>

						async function verifyOtp(){

							let otpCode = document.getElementById('otp').value;
							if(otpCode.length!==4){
								alert('please provide 4 digits code');
							}else{
							
								try{
									let res = await axios.post('/verify-otp',{
										email:sessionStorage.getItem('email'),
										otp:otpCode
										
										
									});

									if(res.status===200){
										sessionStorage.clear();
										window.location.href="/password-reset";

									}
								}catch(error){
									alert('Access Denied! Invalid OTP Code!');
								}
							}
						}

					</script>