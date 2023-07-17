<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Forgot Password</h1>
							<div method="POST" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="align-items-center">
									<button type="submit" onclick="sendOTP()" class="btn btn-primary ms-auto">
										Send OTP	
									</button>
								</div>
							</div>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Remember your password? <a href="{{route('login.page')}}" class="text-dark">Login</a>
							</div>
						</div>
</div>

<script>
	async function sendOTP(){
		let email = document.getElementById('email').value;

		if(email.length===0){
			alert('email required');
		}

		try{


			let res = await axios.post('/send-otp',{email:email});

			if(res.status===200){
				sessionStorage.setItem('email',email);
				window.location.href="/confirm-otp";
				
			}


		}catch{
			alert('something went wrong!');
		}



	}
</script>