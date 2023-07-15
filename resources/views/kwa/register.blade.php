
     <!-- Registration Start -->
     <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered " role="document">
		    <div class="modal-content">
		      <div class="modal-header border-0">
		        <button type="button" class="close d-flex align-items-center justify-content-center" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		    
				      <div class="modal-body  img d-flex align-items-center color-2">
				      	<div class="text w-100 py-0 textRight">
				      		<h3 class="mb-4 text-center">{{__('header.Register')}}</h3>
                              <div class="text-red login-error" style="display:none; color:red;">Email or password are incorrect!</div>
				      		<form action="{{route('kwa_register')}}"  class="signup-form" id="register_id" method="POST" enctype="multipart/form-data">
                                @csrf
					      		<div class="form-group mb-3">
					      			<label class="label" for="name" style="font-weight: bold;">{{__('forms.Name')}}</label>
					      			<input type="فثطف" class="form-control" name="name" id="name" placeholder="" required>
                                  
                                        <div class="email-error" style="display:none; color:red;"></div>
                                </div>
                                <div class="form-group mb-3">
					      			<label class="label" for="phone_no" style="font-weight: bold;">{{__('forms.Mobile No.')}}</label>
					      			<input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="" required>
                                  
                                        <div class="email-error" style="display:none; color:red;"></div>
                                </div>
				            <div class="form-group mb-3">
				            	<label class="label" for="email" style="font-weight: bold;">{{__('forms.Email')}}</label>
				              <input type="text" class="form-control" name="email" id="email" placeholder="" required>
                              <div class="text-red password-error" style="display:none; color:red;">Password length must be greater than 6 digits</div>
				            </div>
				            <div class="form-group">
				            	<button type="submit"  class="form-control btn btn-primary rounded submit px-3">{{__('forms.Register')}} </button>
				            </div>
				          </form>
				          
				      	</div>
				      </div>
				  
		    </div>
		  </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script>
        //     $('#register_id').click(function(e){
        // //  e.preventDefault();
		//  console.log("hii");
		//  return true;
		//  console.log('bye');
		// 	});
			$('#register_id').click(function(e){
			if($("form")[0].checkValidity()) {
				e.preventDefault();
				var data = new FormData($(this)[0]);
				var url="{{route('kwa_register')}}";
				$.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        data: data,
                        success: function (resp) {
                            console.log(resp);
                            if (resp.status == 'success') {
								$('#loginModal').modal('hide');
                                swal({
									    showConfirmButton: false, 
                                        title: resp.success ,
                                        icon: "success",
										timer: 2000,
                                    });
                              
                            }else if(resp.status=='errors'){
                                $('.login-error').css('display','block');
                            }
                        },
                        error: function (resp) {
                            if(resp.status==422){
                                console.log(resp.responseJSON.errors.email);
                                if(resp.responseJSON.errors.email!=''){
                                    $('.email-error').html(resp.responseJSON.errors.email).css('display','block');
                                }
                            }
                        }
                    });
			}else console.log("invalid form");
            });
        </script>   
       