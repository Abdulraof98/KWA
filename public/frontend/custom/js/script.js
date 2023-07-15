/* global notie, full_path, grecaptcha, map, getLat, getLong */

function deleteAccount(obj) {
    $.confirm({
        title: 'Delete Account',
        content: 'Are you sure to delete your account?',
        type: 'blue',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Yes',
                btnClass: 'btn-blue',
                action: function () {
                    window.location.href = $(obj).attr('data-href');
                }
            },
            cancel: function () {}
        }
    });
}
function submit_join_form(obj)
{
    ajaxindicatorstart();
    if ($(obj).val() == 1) {
        var type = 1;
    }else{
        var type = 2;
    }
    var data = new FormData($('#join-form')[0]);
    data.append('type', type);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: full_path+'post-join',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        success: function (data) {
            console.log(data);
            if (data.success) {
                window.location.href = data.link;
            }
            ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
            $.each(resp.responseJSON.errors, function (key, val) {
                $('#join-form').find('[name="' + key + '"]').closest('.input-field-col').find('.help-block').html(val[0]);
                $('#join-form').find('[name="' + key + '"]').closest('.input-field-col').addClass('has-error');
            });
            ajaxindicatorstop();
        }
    });
}

$(document).ready(function () {
    $('#contact-us-form-submit').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
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
                // notie.alert({
                //     type: 'success',
                //     text: '<i class="fa fa-check"></i> ' + resp.msg,
                //     time: 3
                // });
                toastr.options ={
                    "closeButton" : true,
                    "progressBar" : true,
                    'timeOut': 3000
                }
                toastr.success(resp.msg);
                $('#contact-us-form-submit')[0].reset();
                ajaxindicatorstop();
            },
            error: function (resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#contact-us-form-submit').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#contact-us-form-submit').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

$('#signup-form-submit').submit(function (event) {
    event.preventDefault();
    ajaxindicatorstart();
    $('.help-block').html('').closest('.field').removeClass('has-error');
    var url = $(this).attr('action');
    var data = new FormData($(this)[0]);
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
            if (resp.success) {
                notie.alert({
                    type: 'success',
                    text: '<i class="fa fa-check"></i> ' + resp.msg,
                    time: 5
                });
                $('#signup-form-submit')[0].reset();
                setTimeout(function(){
                    window.location.href = resp.link;
                },3000);
            }
            ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
            $.each(resp.responseJSON.errors, function (key, val) {
                $('#signup-form-submit').find('input[name="' + key + '"]').closest('.input-field-col').find('.help-block').html(val[0]);
                $('#signup-form-submit').find('input[name="' + key + '"]').closest('.input-field-col').addClass('has-error');
                if (key == 'terms') {
                    $('#signup-form-submit').find('input[name="' + key + '"]').closest('.login-check-cntlr').find('.help-block').html(val[0]);
                    $('#signup-form-submit').find('input[name="' + key + '"]').closest('.login-check-cntlr').addClass('has-error');
                }
            });
            ajaxindicatorstop();
        }
    })
});

$('#pro-signup-form-submit').submit(function (event) {
    event.preventDefault();
    ajaxindicatorstart();
    $('.help-block').html('').closest('.field').removeClass('has-error');
    var url = $(this).attr('action');
    var data = new FormData($(this)[0]);
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
            if (resp.success) {
                notie.alert({
                    type: 'success',
                    text: '<i class="fa fa-check"></i> ' + resp.msg,
                    time: 5
                });
                $('#pro-signup-form-submit')[0].reset();
                setTimeout(function(){
                    window.location.href = resp.link;
                },3000);
            }
            ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
            $.each(resp.responseJSON.errors, function (key, val) {
                $('#pro-signup-form-submit').find('input[name="' + key + '"]').closest('.input-field-col').find('.help-block').html(val[0]);
                $('#pro-signup-form-submit').find('input[name="' + key + '"]').closest('.input-field-col').addClass('has-error');
                if (key == 'terms') {
                    $('#pro-signup-form-submit').find('input[name="' + key + '"]').closest('.login-check-cntlr').find('.help-block').html(val[0]);
                    $('#pro-signup-form-submit').find('input[name="' + key + '"]').closest('.login-check-cntlr').addClass('has-error');
                }
            });
            ajaxindicatorstop();
        }
    })
});

$('#edit-user-profile').submit(function (event) {
    event.preventDefault();
    ajaxindicatorstart();
    $('.help-block').html('').closest('.field').removeClass('has-error');
    var url = $(this).attr('action');
    var data = new FormData($(this)[0]);
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
            if (resp.success) {
                notie.alert({
                    type: 'success',
                    text: '<i class="fa fa-check"></i> ' + resp.msg,
                    time: 3
                });
                setTimeout(()=>{
                    location.reload();
                },3000);
            }
            ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
            $.each(resp.responseJSON.errors, function (key, val) {
                $('#edit-user-profile').find('input[name="' + key + '"]').closest('.input-field-col').find('.help-block').html(val[0]);
                $('#edit-user-profile').find('input[name="' + key + '"]').closest('.input-field-col').addClass('has-error');
                
            });
            ajaxindicatorstop();
        }
    })
});

$('#user-login-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.field').removeClass('has-error');
        var url = $(this).attr('action');
        var data = new FormData($(this)[0]);
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
                if (resp.success) {
                    notie.alert({
                         type: 'success',
                         text: '<i class="fa fa-check"></i> ' + resp.message,
                         time: 3
                     });
                     setTimeout(function(){
                         window.location.href = resp.link;
                     },3000);
                }else{
                    notie.alert({
                    type: 'error',
                    text: '<i class="fa fa-check"></i> ' + resp.message,
                    time: 5
                });
                }
                ajaxindicatorstop();
            },
            error: function (resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#user-login-form').find('[name="' + key + '"]').closest('.input-field-col').find('.help-block').html(val[0]);
                    $('#user-login-form').find('[name="' + key + '"]').closest('.input-field-col').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#change_password_form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var data = new FormData($(this)[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: full_path+"post-change-user-password",
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log(data);
                if (data.success) {
                    $('#change_password_form')[0].reset();
                    notie.alert({
                        type: 'success',
                        text: '<i class="fa fa-check"></i> '+data.message,
                        time: 3
                    });
                    ajaxindicatorstop();
                } else {
                    notie.alert({
                        type: 'error',
                        text: '<i class="fa fa-close"></i> '+data.message+'<a>',
                        time: 5
                    });
                    ajaxindicatorstop();
                }
            },
            error: function (resp) {
                console.log(resp.responseJSON.errors);
                $.each(resp.responseJSON.errors, function (key, value) {
                    $('#change_password_form').find('[name="' + key + '"]').closest('.input-field-col').find('.help-block').html(value[0]);
                    $('#change_password_form').find('[name="' + key + '"]').closest('.input-field-col').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });
    
    
    $('#forgot-password').submit(function (event) {
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        event.preventDefault();
        var data = new FormData($(this)[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: full_path+"user-forgot-password",
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                notie.alert({
                    type: 'success',
                    text: '<i class="fa fa-check"></i> '+data.msg,
                    time: 10
                });
                $('#forgot-password')[0].reset();
                ajaxindicatorstop();
            },
            error: function (resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function (key, value) {
                    $('#forgot-password').find('[name="' + key + '"]').closest('.input-field-col').find('.help-block').html(value[0]);
                    $('#forgot-password').find('[name="' + key + '"]').closest('.input-field-col').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });

    $('#reset-password-submit').submit(function (event) {
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        event.preventDefault();
        var data = new FormData($(this)[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: full_path+"set-password",
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                $('#reset-password-submit')[0].reset();
                notie.alert({
                    type: 'success',
                    text: '<i class="fa fa-check"></i>'+data.msg,
                    time: 3
                });
                window.location.replace(data.link);
                ajaxindicatorstop();
            },
            error: function (resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function (key, value) {
                    $('#reset-password-submit').find('[name="' + key + '"]').closest('.input-field-col').find('.help-block').html(value[0]);
                    $('#reset-password-submit').find('[name="' + key + '"]').closest('.input-field-col').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });

    $('.cast-slet').select2({
        theme:'classic',
    });

});

function forgot_password()
{
    $("#loginModal").modal("hide");
    $("#forgotpasswordModal").modal("show");
}

$('#createAjob').submit(function (event) {
    ajaxindicatorstart();
    $('.help-block').html('').closest('.form-group').removeClass('has-error');
    event.preventDefault();
    var data = new FormData($(this)[0]);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: full_path+"post-create-job",
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        success: function (data) {
            $('#createAjob')[0].reset();
            notie.alert({
                type: 'success',
                text: '<i class="fa fa-check"></i>'+data.message,
                time: 3
            });
            setTimeout(()=>{
                window.location.replace(data.link);
            }, 3000)
            ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
            $.each(resp.responseJSON.errors, function (key, value) {
                $('#createAjob').find('[name="' + key + '"]').closest('.input-field-col').find('.help-block').html(value[0]);
                $('#createAjob').find('[name="' + key + '"]').closest('.input-field-col').addClass('has-error');
            });
            ajaxindicatorstop();
        }
    });
});

$('#editAjob').submit(function (event) {
    ajaxindicatorstart();
    $('.help-block').html('').closest('.form-group').removeClass('has-error');
    event.preventDefault();
    var data = new FormData($(this)[0]);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: full_path+"post-edit-job",
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        success: function (data) {
            $('#editAjob')[0].reset();
            notie.alert({
                type: 'success',
                text: '<i class="fa fa-check"></i>'+data.message,
                time: 3
            });
            setTimeout(() => {
                window.location.href = data.link;
            }, 3000);
            ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
            $.each(resp.responseJSON.errors, function (key, value) {
                $('#editAjob').find('[name="' + key + '"]').closest('.input-field-col').find('.help-block').html(value[0]);
                $('#editAjob').find('[name="' + key + '"]').closest('.input-field-col').addClass('has-error');
            });
            ajaxindicatorstop();
        }
    });
});

$('#pro-edit-account-submit').submit(function (event) {
    event.preventDefault();
    ajaxindicatorstart();
    $('.help-block').html('').closest('.field').removeClass('has-error');
    var url = $(this).attr('action');
    var data = new FormData($(this)[0]);
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
            if (resp.success) {
                notie.alert({
                    type: 'success',
                    text: '<i class="fa fa-check"></i> ' + resp.message,
                    time: 3
                });
            }
            setTimeout(()=>{
                location.reload();
            },3000);
            ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
            $.each(resp.responseJSON.errors, function (key, val) {
                $('#pro-edit-account-submit').find('input[name="' + key + '"]').closest('.input-field-col').find('.help-block').html(val[0]);
                $('#pro-edit-account-submit').find('input[name="' + key + '"]').closest('.input-field-col').addClass('has-error');
                if (key == 'terms') {
                    $('#pro-edit-account-submit').find('input[name="' + key + '"]').closest('.login-check-cntlr').find('.help-block').html(val[0]);
                    $('#pro-edit-account-submit').find('input[name="' + key + '"]').closest('.login-check-cntlr').addClass('has-error');
                }
            });
            ajaxindicatorstop();
        }
    })
});

function discard_job(obj) {
    $.confirm({
        title: 'Discard Job',
        content: 'Are you sure to discard this job?',
        type: 'Blue',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Yes',
                btnClass: 'btn-blue',
                action: function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        data: { id: $(obj).data('id')},
                        dataType:"json",
                        type:"POST",
                        url: full_path+'discard-job',
                        success: function(data){
                            if (data.success) {
                                notie.alert({
                                    type: 'success',
                                    text: '<i class="fa fa-check"></i> ' + 'job discarded successfully!',
                                    time: 3
                                });
                                $(obj).parent().parent().parent().parent().parent().parent().remove();
                            }else{
                                notie.alert({
                                    type: 'error',
                                    text: '<i class="fa fa-check"></i> ' + 'Ooops! something went wrong!',
                                    time: 3
                                });
                            }
                        },
                        error: function(error){
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });
}

$('#post-apply-job').submit(function (event) {
    event.preventDefault();
    ajaxindicatorstart();
    $('.help-block').html('').closest('.field').removeClass('has-error');
    var url = $(this).attr('action');
    var data = new FormData($(this)[0]);
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
            if (resp.success) {
                notie.alert({
                    type: 'success',
                    text: '<i class="fa fa-check"></i> ' + resp.message,
                    time: 3
                });
                setTimeout(()=>{
                    window.location.href = resp.link;
                },3000);
            }
            else{
                notie.alert({
                    type: 'error',
                    text: '<i class="fa fa-check"></i> ' + resp.message,
                    time: 3
                });
            }
            ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
            $.each(resp.responseJSON.errors, function (key, val) {
                $('#post-apply-job').find('input[name="' + key + '"]').closest('.input-field-col').find('.help-block').html(val[0]);
                $('#post-apply-job').find('input[name="' + key + '"]').closest('.input-field-col').addClass('has-error');
            });
            ajaxindicatorstop();
        }
    })
});

function reject_job_offer(obj)
{
    $.confirm({
        title: 'Discard Job offer',
        content: 'Are you sure to discard this job offer?',
        type: 'Blue',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Yes',
                btnClass: 'btn-blue',
                action: function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        data: { id: $(obj).data('id')},
                        dataType:"json",
                        type:"POST",
                        url: full_path+'reject-job-offer',
                        success: function(data){
                            if (data.success) {
                                notie.alert({
                                    type: 'success',
                                    text: '<i class="fa fa-check"></i> ' + data.message,
                                    time: 3
                                });
                                $(obj).parent().parent().parent().parent().parent().parent().remove();
                            }else{
                                notie.alert({
                                    type: 'error',
                                    text: '<i class="fa fa-check"></i> ' + 'Ooops! something went wrong!',
                                    time: 3
                                });
                            }
                        },
                        error: function(error){
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });
}

function accept_job_offer(obj)
{
    $.confirm({
        title: 'Accept Job Offer',
        content: 'Are you sure to accept this job offer?',
        type: 'Blue',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Yes',
                btnClass: 'btn-blue',
                action: function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        data: { id: $(obj).data('id')},
                        dataType:"json",
                        type:"POST",
                        url: full_path+'accept-job-offer',
                        success: function(data){
                            if (data.success) {
                                notie.alert({
                                    type: 'success',
                                    text: '<i class="fa fa-check"></i> ' + data.message,
                                    time: 3
                                });
                                setTimeout(function(){
                                    location.reload();
                                },3000);
                            }else{
                                notie.alert({
                                    type: 'error',
                                    text: '<i class="fa fa-check"></i> ' + data.message,
                                    time: 3
                                });
                            }
                        },
                        error: function(error){
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });
}

function complete_job(obj)
{
    $.confirm({
        title: 'Job Completed',
        content: 'Are you sure that this job is done?',
        type: 'Blue',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Yes',
                btnClass: 'btn-blue',
                action: function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        data: { id: $(obj).data('id')},
                        dataType:"json",
                        type:"POST",
                        url: full_path+'complete-job',
                        success: function(data){
                            if (data.success) {
                                notie.alert({
                                    type: 'success',
                                    text: '<i class="fa fa-check"></i> ' + data.message,
                                    time: 3
                                });
                                setTimeout(function(){
                                    location.reload();
                                },3000);
                            }else{
                                notie.alert({
                                    type: 'error',
                                    text: '<i class="fa fa-check"></i> ' + data.message,
                                    time: 3
                                });
                            }
                        },
                        error: function(error){
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });
}

function cancel_job_application(obj)
{
    $.confirm({
        title: 'Cancel Job Application',
        content: 'Are you sure to cancel this job application?',
        type: 'Blue',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Yes',
                btnClass: 'btn-blue',
                action: function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        data: { id: $(obj).data('id')},
                        dataType:"json",
                        type:"POST",
                        url: full_path+'cancel-job-application',
                        success: function(data){
                            if (data.success) {
                                notie.alert({
                                    type: 'success',
                                    text: '<i class="fa fa-check"></i> ' + data.message,
                                    time: 3
                                });
                                setTimeout(function(){
                                    location.reload();
                                },3000);
                            }else{
                                notie.alert({
                                    type: 'error',
                                    text: '<i class="fa fa-check"></i> ' + data.message,
                                    time: 3
                                });
                            }
                        },
                        error: function(error){
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });
}