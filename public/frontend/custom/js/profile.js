function ajaxindicatorstart() {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="' + full_path + 'public/frontend/images/loading_img.gif" alt="ajax indicator" style="background-color: #ffffff;margin: auto;padding: 0px;border-radius: 5px;width: 60px;height: 60px;"></div><div class="bg"></div></div>');
    }
    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });
    jQuery('#resultLoading .bg').css({
        'background': '#ffffff',
        'opacity': '0.8',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });
    jQuery('#resultLoading>div:first').css({
        'width': '100%',
        'height': '50vh',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'
    });
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop() {
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}

$(document).ready(function () {
    
    $('#update-profile-form').submit(function (event) {
        event.preventDefault();
        // ajaxindicatorstart();
        $('.help-block').html('').closest('.field').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        // console.log(data);return false;
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                console.log(resp);
                // swal({
                //     title: resp.msg,
                //     icon: "success",
                //     buttons: false,
                //     timer: 3000,
                //   }).then(function () {
                //       window.location.href = resp.link;
                // });
                toastr.options ={
                    "closeButton" : true,
                    "progressBar" : true,
                    'timeOut': 3000
                }
                toastr.success(resp.msg);
                setTimeout(function(){
                    window.location.href = resp.link;
                },3000);
                
//                notie.alert({
//                    type: 'success',
//                    text: '<i class="fa fa-check"></i> ' + resp.msg,
//                    time: 3
//                });
//                window.location.href = resp.link;
                // ajaxindicatorstop();
            },
            error: function (resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#update-profile-form').find('[name="' + key + '"]').closest('.field').find('.help-block').html(val[0]);
                    $('#update-profile-form').find('[name="' + key + '"]').closest('.field').addClass('has-error');
                });
                // ajaxindicatorstop();
            }
        })
    });

    $('#change-password-form').submit(function (event) {
        event.preventDefault();
        // ajaxindicatorstart();
//        return false;
        $('.help-block').html('').closest('.field').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        // console.log(data);return false;
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                console.log(resp)
                if(resp.status=="success")
                {
                    // swal({
                    //     title: resp.msg,
                    //     icon: "success",
                    //     buttons: false,
                    //     timer: 3000,
                    //   }).then(function () {
                    //       window.location.href = resp.link;
                    // });
                    toastr.options ={
                        "closeButton" : true,
                        "progressBar" : true,
                        'timeOut': 3000
                    }
                    toastr.success(resp.msg);
                    setTimeout(function(){
                        window.location.href = resp.link;
                    },3000);
//                    notie.alert({
//                        type: 'success',
//                        text: '<i class="fa fa-check"></i> ' + resp.msg,
//                        time: 3
//                    });
//                    window.location.href = resp.link;
                }else{
                    $.each(resp.errors, function (key, val) {
                        $('#change-password-form').find('[name="' + key + '"]').closest('.field').find('.help-block').html(val[0]);
                        $('#change-password-form').find('[name="' + key + '"]').closest('.field').addClass('has-error');
                    });
                }
                // notie.alert({
                //     type: 'success',
                //     text: '<i class="fa fa-check"></i> ' + resp.msg,
                //     time: 3
                // });
                // window.location.href = resp.link;
                // ajaxindicatorstop();
            },
            error: function (resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#change-password-form').find('[name="' + key + '"]').closest('.field').find('.help-block').html(val[0]);
                    $('#change-password-form').find('[name="' + key + '"]').closest('.field').addClass('has-error');
                });
                // ajaxindicatorstop();
            }
        })
    });
});

function check_tab(obj)
{
    $(obj).parent().find('.popup__tag').removeClass("active");
    $(obj).addClass("active");
    var data=$(obj).data("id");
    if(data=="password")
    {
        $("#profile-data").addClass("d-none");
        $("#change-password-data").removeClass("d-none");
    }else{
        $("#profile-data").removeClass("d-none");
        $("#change-password-data").addClass("d-none");
    }
}
function check_option(obj)
{
    var data=obj.value;
    if(data=="password")
    {
        $("#profile-data").addClass("d-none");
        $("#change-password-data").removeClass("d-none");
    }else{
        $("#profile-data").removeClass("d-none");
        $("#change-password-data").addClass("d-none");
    }
}

function change_profile_page()
{
    // ajaxindicatorstart();
    var url=full_path+"upload-profile-image";
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    var data=new FormData($("#image-upload-form")[0]);
    $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                console.log(resp)
                if(resp.status=="success")
                {
                    // swal({
                    //     title: "Successfully uploaded.",
                    //     icon: "success",
                    //     buttons: false,
                    //     timer: 3000,
                    //   });

                    toastr.options ={
                        "closeButton" : true,
                        "progressBar" : true,
                        'timeOut': 3000
                    }
                    toastr.success("Successfully uploaded.");

//                    notie.alert({
//                        type: 'success',
//                        text: '<i class="fa fa-check"></i> Successfully uploaded.',
//                        time: 3
//                    });
                    $("#delete-image").removeClass("disabled");
                    $("#delete-image").prop("onclick", null).off("click");
                    $("#delete-image").click("on",function(){
                        delete_profile_pic();
                    });
                    $("#image-preview").html('<img class="popup__pic" src="'+full_path+'public/uploads/frontend/profile_picture/preview/'+resp.data.profile_picture+'" alt="" onerror="this.onerror=null;this.src="'+full_path+'public/frontend/img/avatar.png">');
                    $("#header-profile-image").html('<img class="header__pic" src="'+full_path+'public/uploads/frontend/profile_picture/preview/'+resp.data.profile_picture+'" alt="" onerror="this.onerror=null;this.src="'+full_path+'public/frontend/img/avatar.png">');
                }else{
                    // swal({
                    //     title: resp.errors.image[0],
                    //     icon: "error",
                    //     buttons: false,
                    //     timer: 3000,
                    //   });

                      toastr.options ={
                        "closeButton" : true,
                        "progressBar" : true,
                        'timeOut': 5000
                    }
                    toastr.error(resp.errors.image[0]);
//                    notie.alert({
//                        type: 'error',
//                        text: '<i class="fa fa-times"></i> ' + resp.errors.image[0],
//                        time: 3
//                    });
                }
                // notie.alert({
                //     type: 'success',
                //     text: '<i class="fa fa-check"></i> ' + resp.msg,
                //     time: 3
                // });
                // window.location.href = resp.link;
                // ajaxindicatorstop();
            }
        });
}

function delete_profile_pic()
{
    $.confirm({
        title: 'Delete Profile Picture',
        content: 'Are you sure to delete this profile picture?',
        type: 'red',
        theme: (localStorage.getItem('darkMode')=="on")?"black":"white",
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    // ajaxindicatorstart();
                    var url=full_path+"delete-profile-image";
                    var csrf_token=$('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'POST',
                        dataType: 'json',
                        success: function (resp) {
                            console.log(resp)
                            if(resp.status=="success")
                            {
                                // swal({
                                //     title: "Successfully deleted.",
                                //     icon: "success",
                                //     buttons: false,
                                //     timer: 3000,
                                //   });

                                  toastr.options ={
                                    "closeButton" : true,
                                    "progressBar" : true,
                                    'timeOut': 3000
                                }
                                toastr.success("Successfully deleted.");
//                                notie.alert({
//                                    type: 'success',
//                                    text: '<i class="fa fa-check"></i> Successfully deleted.',
//                                    time: 3
//                                });
                                $("#delete-image").addClass("disabled");
                                $("#delete-image").prop("onclick", null).off("click");
                                $("#image-preview").html('<img class="popup__pic" src="'+full_path+'public/frontend/img/avatar.png" alt="" onerror="this.onerror=null;this.src="'+full_path+'public/frontend/img/avatar.png">');
                                $("#header-profile-image").html('<img class="header__pic" src="'+full_path+'public/frontend/img/avatar.png" alt="" onerror="this.onerror=null;this.src="'+full_path+'public/frontend/img/avatar.png">');
                            }else{
                                // swal({
                                //     title: resp.data,
                                //     icon: "error",
                                //     buttons: false,
                                //     timer: 3000,
                                //   });
                                  toastr.options ={
                                    "closeButton" : true,
                                    "progressBar" : true,
                                    'timeOut': 5000
                                }
                                toastr.error(resp.data);

//                                notie.alert({
//                                    type: 'error',
//                                    text: '<i class="fa fa-times"></i> ' + resp.data,
//                                    time: 3
//                                });
                            }
                            // notie.alert({
                            //     type: 'success',
                            //     text: '<i class="fa fa-check"></i> ' + resp.msg,
                            //     time: 3
                            // });
                            // window.location.href = resp.link;
                            // ajaxindicatorstop();
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });
}

var load_public_prfile_page = 1;

function load_public_profile()
{
    var user_id = $('#user-id-hidden').val();
    // ajaxindicatorstart();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: full_path+"user-publicprofile-load?user_id="+user_id+"&page="+load_public_prfile_page,
        type: 'GET',
        dataType: 'json',
        // processData: false,
        // contentType: false,
        // data: {
        //     cid : input
        // },
        success: function (data) {
            console.log(data);
            if (data.success) {
                if (data.count<12) {
                    $('#loadmore-public-profile').prop('hidden',true);
                }else{
                    $('#loadmore-button-profile').prop('hidden',false);
                }
                $('#profile-data-list').append(data.content);
                load_public_prfile_page++;
            }
            // ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
        }
    });
}

var participated_challenges_page = 1;

function user_participated_challenges()
{
    var user_id = $('#user-id-hidden').val();
    // ajaxindicatorstart();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: full_path+"user-participated-challenges-load?user_id="+user_id+"&page="+participated_challenges_page,
        type: 'GET',
        dataType: 'json',
        // processData: false,
        // contentType: false,
        // data: {
        //     cid : input
        // },
        success: function (data) {
            console.log(data);
            if (data.success) {
                if (data.count<7) {
                    $('#loadmore-participated-challenges').prop('hidden',true);
                }else{
                    $('#loadmore-participated-challenges').prop('hidden',false);
                }
                $('#user-participated-challenges-list').append(data.content);
                participated_challenges_page++;
            }
            // ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
        }
    });
}

function add_follower(){
    var user_id = $('#user-id-hidden').val();
    // ajaxindicatorstart();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: full_path+"post-follow",
        type: 'POST',
        dataType: 'json',
        // processData: false,
        // contentType: false,
        data: {
            user_id : user_id
        },
        success: function (data) {
            console.log(data);
            if (data.success) {
                // swal({
                //     title: 'Followed successfully!',
                //     icon: "success",
                //     buttons: false,
                //     timer: 3000,
                // });
                toastr.options ={
                    "closeButton" : true,
                    "progressBar" : true,
                    'timeOut': 3000
                }
                toastr.success('Followed successfully!');
                $('#follow_btn').prop('hidden',true);
                $('#unfollow_btn').prop('hidden', false)
                $('#follower-count-profile').html(data.count+' followers');
            }else{
                // swal({
                //     title: 'Ooops there was some errors!',
                //     icon: "error",
                //     buttons: false,
                //     timer: 3000,
                // });
                toastr.options ={
                    "closeButton" : true,
                    "progressBar" : true,
                    'timeOut': 5000
                }
                toastr.error('Ooops there was some errors!');
            }
            // ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
        }
    });
}

function post_unfollower()
{
    var user_id = $('#user-id-hidden').val();
    $.confirm({
        title: 'Unfollow',
        content: 'Are you sure to unfollow ?',
        type: 'red',
        theme: (localStorage.getItem('darkMode')=="on")?"black":"white",
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    // ajaxindicatorstart();
                    var url=full_path+"post-unfollow";
                    var csrf_token=$('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'POST',
                        dataType: 'json',
                        data:{user_id:user_id},
                        success: function (resp) {
                            console.log(resp);
                            if(resp.success)
                            {
                                // swal({
                                //     title: resp.message,
                                //     icon: "success",
                                //     buttons: false,
                                //     timer: 3000,
                                // });
                                toastr.options ={
                                    "closeButton" : true,
                                    "progressBar" : true,
                                    'timeOut': 3000
                                }
                                toastr.success( resp.message);
                                $('#follow_btn').prop('hidden',false);
                                $('#unfollow_btn').prop('hidden', true)
                                $('#follower-count-profile').html(resp.count+' followers');
                                ajaxindicatorstop();
                            }else{
                                // swal({
                                //     title: resp.message,
                                //     icon: "error",
                                //     buttons: false,
                                //     timer: 3000,
                                // });
                                toastr.options ={
                                    "closeButton" : true,
                                    "progressBar" : true,
                                    'timeOut': 5000
                                }
                                toastr.error( resp.message);
                                // ajaxindicatorstop();
                            }
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });
}