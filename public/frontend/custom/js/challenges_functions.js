
function post_like_challenge(input, image_id = null)
{
    // ajaxindicatorstart();
    var id = atob(input);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: full_path+"like-a-challenge",
        type: 'POST',
        dataType: 'json',
        // processData: false,
        // contentType: false,
        data: {
            cid : input,
            image_id: image_id
        },
        success: function (data) {
            console.log(data);
            if (data.success) {
                if (image_id === null) {
                    $('#like-challenge-'+id).addClass('liked_challenge');
                }else{
                    $('#like-challenge-'+image_id).addClass('liked_challenge');
                }
            }else{
                if (image_id === null) {
                    $('#like-challenge-'+id).removeClass('liked_challenge');
                }else{
                    $('#like-challenge-'+image_id).removeClass('liked_challenge');
                }
                
            }
            // ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
        }
    });
}

function like_login_alert(){
    // swal({
    //     title: 'You must login first!',
    //     icon: "warning",
    //     buttons: false,
    //     timer: 3000,
    // });
    toastr.options = {
        "closeButton" : true,
        "progressBar" : true,
        'timeOut': 5000
    }
    toastr.error('You must login first!');
}


$(document).ready(function(){ 
    $('#comment-submit-form').submit(function (event) {
        // ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        event.preventDefault();
        var data = new FormData($(this)[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: full_path+"post-challenge-comment",
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                console.log(data);
                if (data.success) {
                    $('#comment-submit-form')[0].reset();
                    $.magnificPopup.close();
                    // swal({
                    //     title: 'Commented successfully!',
                    //     icon: "success",
                    //     buttons: false,
                    //     timer: 3000,
                    // });
                    toastr.options ={
                        "closeButton" : true,
                        "progressBar" : true,
                        'timeOut': 3000
                    }
                    toastr.success('Commented successfully!');
                    if (data.count ==1) {
                        $('#load-comments-here').empty();
                    }
                    $('#load-comments-here').prepend(data.content);
                } else {
                    // swal({
                    //     title: 'Ooops! there was some error!',
                    //     icon: "error",
                    //     buttons: false,
                    //     timer: 3000,
                    // });
                    toastr.options ={
                        "closeButton" : true,
                        "progressBar" : true,
                        'timeOut': 5000
                    }
                    toastr.error('Ooops! there was some error!');
                }
                // ajaxindicatorstop();
            },
            error: function (resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function (key, value) {
                    $('#comment-submit-form').find('[name="' + key + '"]').closest('.popup__field').find('.help-block').html(value[0]);
                    $('#comment-submit-form').find('[name="' + key + '"]').closest('.popup__field').addClass('has-error');
                });
                // ajaxindicatorstop();
            }
        });
    });
});

var challenge_comments_page = 1;

function load_more_comments()
{
    // var url = window.location.pathname;
    // var id = url.substring(url.lastIndexOf('/') + 1);
    // var challenge_id = atob(id);
    // var leaderboard_page = 1;
    var challenge_id = $('#hidden_challenge_id').val();
    // ajaxindicatorstart();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: full_path+"challenge-comments-load?cid="+challenge_id+"&page="+challenge_comments_page,
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
                $('#load-comments-here').append(data.content);
                challenge_comments_page++;
            }
            if (data.count < 4) {
                $('#loadmore-button-comments').prop('hidden',true);
            }
            // ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
            // ajaxindicatorstop();
        }
    });
}

function like_comment(input)
{
    // ajaxindicatorstart();
    // var id = atob(input);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: full_path+"like-a-comment",
        type: 'POST',
        dataType: 'json',
        // processData: false,
        // contentType: false,
        data: {
            cid : input
        },
        success: function (data) {
            console.log(data);
            if (data.success) {
                $('#liked-comment-'+input).addClass('comment_liked');
            }else{
                $('#liked-comment-'+input).removeClass('comment_liked');

            }
            // ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
        }
    });
}

function post_fav_challenge(obj,image_id = null){
    // ajaxindicatorstart();
    var url = window.location.href;
    var parts = url.split('/');
    var lastSegment = parts.pop() || parts.pop();  // handle potential trailing slash

//    alert(url);return false;
    var input = obj.value;
    var id = atob(obj.value);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: full_path+"fav-a-challenge",
        type: 'POST',
        dataType: 'json',
        // processData: false,
        // contentType: false,
        data: {
            cid : input,
            image_id: image_id
        },
        success: function (data) {
            console.log(data);
            if (data.success) {
                if (url == full_path+'details-challenge/'+lastSegment) {
                    $(obj).addClass('fav_challenge');
                    $(obj).children().eq(1).html('Favorite');
                }
                else {
                    $(obj).find('.favourite_img').prop('src',data.img);
                }
                if (url ==  full_path+'u/'+lastSegment) {
                    $(obj).addClass('fav_challenge');
                    $(obj).children().eq(1).html('Favorite');
                }
                
                // swal({
                //     title: 'Added to favorites successfully!',
                //     icon: "success",
                //     buttons: false,
                //     timer: 3000,
                // });
                toastr.options ={
                    "closeButton" : true,
                    "progressBar" : true,
                    'timeOut': 3000
                }
                toastr.success('Added to favorites successfully!');
            }
            // else{
            //     $('#fav-challenge-'+id).prop('style','');
            // }
            // ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
        }
    });
}

function comment_reply(cid)
{
    $('#comment_id').val(cid);
    $('#popup-reply-modal')[0].click();
}

$(document).ready(function(){ 
    
    var comment_id = $('#comment_id').val();
    $('#reply-submit-form').submit(function (event) {
        // ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        event.preventDefault();
        var data = new FormData($(this)[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: full_path+"post-comment-reply",
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                console.log(data);
                if (data.success) {
                    $('#reply-submit-form')[0].reset();
                    $.magnificPopup.close();
                    // swal({
                    //     title: 'Commented successfully!',
                    //     icon: "success",
                    //     buttons: false,
                    //     timer: 3000,
                    // });
                    toastr.options ={
                        "closeButton" : true,
                        "progressBar" : true,
                        'timeOut': 3000
                    }
                    toastr.success('Commented successfully!');
                    $('#comment-id-'+comment_id).prepend(data.content);
                } else {
                    // swal({
                    //     title: 'Ooops! there was some error!',
                    //     icon: "error",
                    //     buttons: false,
                    //     timer: 3000,
                    // });
                    toastr.options ={
                        "closeButton" : true,
                        "progressBar" : true,
                        'timeOut': 5000
                    }
                    toastr.error('Ooops! there was some error!');
                }
                // ajaxindicatorstop();
            },
            error: function (resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function (key, value) {
                    $('#reply-submit-form').find('[name="' + key + '"]').closest('.popup__field').find('.help-block').html(value[0]);
                    $('#reply-submit-form').find('[name="' + key + '"]').closest('.popup__field').addClass('has-error');
                });
                // ajaxindicatorstop();
            }
        });
    });
});

// function comment_reply_load(cid,obj)
// {
//     var offset = obj.val();
//     ajaxindicatorstart();
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $.ajax({
//         url: full_path+"load-comment-reply",
//         type: 'POST',
//         dataType: 'json',
//         // processData: false,
//         // contentType: false,
//         data: {
//             cid : cid,
//             offset = offset
//         },
//         success: function (data) {
//             console.log(data);
//             if (data.success) {
//                 $(obj).val(data.new_offset);
//             }
//             // else{
//             //     $('#fav-challenge-'+id).prop('style','');
//             // }
//             ajaxindicatorstop();
//         },
//         error: function (resp) {
//             console.log(resp);
//         }
//     });
// }

function share_popup(obj){
    FB.ui({
    method: 'share',
    href: obj.value,
    }, function(response){});
}


function voting_valid_user(cid){
    ajaxindicatorstart();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: full_path+"valid-user-for-vote?cid="+cid,
        type: 'GET',
        dataType: 'json',
        processData: false,
        contentType: false,
        
        success: function (data) {
            console.log(data);
            if (data.success) {
                window.location.replace(data.link);
            } else {
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true,
                    'timeOut': 5000
                }
                toastr.error(data.message);
            }
            ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
            ajaxindicatorstop();
        }
    });
}

function edit_participation(obj)
{
    var title,image,image_id,type, matchmaking,description,cid,link;
    title = $(obj).data('title');
    image = $(obj).data('image');
    image_id = $(obj).data('img_id');
    type = $(obj).data('type');
    matchmaking = $(obj).data('matchmaking');
    description = $(obj).data('description');
    cid = $(obj).data('cid');
    link = $(obj).data('link');
    $('#participant_img_edit_form').prop('src',image);
    $('#edit-participant-form').find('input[name="title"]').val(title);
    $('#hidden-edit-participate-fileds').empty();
    $('#image-title-row').children().eq(1).remove();
    $('#edit-participation-description').remove();
    if (type == 1) {
        $('#image-title-row').append(
            '<div class="popup__field field">'
            +'<div class="field__label">Image</div>'
            +'<div class="upload__file cstfile mdlimg w-100">'
            +'<input class="upload__input" type="file" name="image" onchange="loadFile(event)">'
            +'<button class="upload__btn btn btn_purple w-100 moreradious">'
            +'<span class="btn__text">Select Image</span>'
            +'</button>'
            +'</div>'
            +'<span class="help-block"></span>'
        );
    } else if(type == 2) {
        $('.popup__row').append(
            '<div class="popup__field field">'
            +'<div class="field__label">Youtube link</div>'
            +'<div class="field__wrap"><input class="field__input" type="text" oninput="preview_participate(this.value)" value="'+link+'" name="link"></div>'
            +'<span class="help-block"></span>'
            +'</div>'
        );
    }else{
        $('.popup__row').append(
            '<div class="popup__field field">'
            +'<div class="field__label">Twitch video link</div>'
            +'<div class="field__wrap"><input class="field__input" type="text" oninput="get_twitch_thunbnail(this.value)" value="'+link+'" name="link"></div>'
            +'<span class="help-block"></span>'
            +'</div>'
        );
    }
    if (matchmaking == 'Normal voting') {
        $('#edit-participation-fieldset').append(
        '<div class="popup__field field" id="edit-participation-description">'
        +'<div class="field__label">Description</div>'
        +'<div class="field__wrap">'
        +'<textarea row="5" col="20" name="description" placeholder="Description">'+description+'</textarea>'
        +'</div>'
        +'<span class="help-block"></span>'
        +'</div>'
        );
    }
    $('#hidden-edit-participate-fileds').append(
        '<input type="hidden" name="challenge_id"  value="'+cid+'">'
        +'<input type="hidden" name="image_id"  value="'+image_id+'">'
    );
    $('#open-edit-participate').click()[0];
    if (type == 3) {
        get_twitch_thunbnail(link);
    }
}

function delete_participation(obj)
{
    $.confirm({
        title: 'Delete Participation',
        content: 'Are you sure to delete this Participation?',
        type: 'red',
        theme: (localStorage.getItem('darkMode')=="on")?"black":"white",
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    // ajaxindicatorstart();
                    var url =full_path+'delete-participant';
                    var csrf_token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url:url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type:"POST",
                        dataType: 'json',
                        data:{
                            challenge_id:$(obj).data('challenge'),
                            image_id:$(obj).data('img')
                        },
                        success:function(resp)
                        {
                            console.log(resp);
                            if(resp.success)
                            {
                                toastr.options ={
                                    "closeButton" : true,
                                    "progressBar" : true,
                                    'timeOut': 3000
                                }
                                toastr.success(resp.message);
                                // $(obj).parent().parent().parent().remove();
                                setTimeout(()=>{
                                    location.reload();
                                },3000);

                            }else{
                                toastr.options ={
                                    "closeButton" : true,
                                    "progressBar" : true,
                                    'timeOut': 5000
                                }
                                toastr.error(resp.message);
                            }
                        }
                     });
                    //  ajaxindicatorstop();
                }
            },
            cancel: function () {}
        }
    });
}

function get_twitch_thunbnail(input){
    var video_id = input.substring(input.lastIndexOf('/') + 1);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: full_path+"get-twitch-details",
        type: 'POST',
        dataType: 'json',
        // processData: false,
        // contentType: false,
        data: {
            id : video_id
        },
        success: function (data) {
            console.log(data);
            if (data.success) {
                $('#participant_img').attr('src', data.image);
                $('#participant_img_edit_form').attr('src', data.image);
            }
            // ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
        }
    });
}