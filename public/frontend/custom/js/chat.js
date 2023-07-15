/* global full_path, mejs, contentLoader, ModelOnlineInterval, checkModelOnline */
var chatInterval, prependrequest, pertialChatInterval;
var messagerequest = null;
var prependpartialrequest = null;
var currentRequest = null;
var checkDisconnectOrNotVar = null;
var ModelOnlineInterval = null;
//var CallComingOrNot = null;
var smallLoader = '<i style="font-size: 16px;color: #2ec6d0;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i>';
var contentLoader = '<div class="text-center insideLoader" style="margin: 5%;"><i style="font-size: 46px;color: #2ec6d0;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div>';
$(document).ready(function () {

    // lastOnlineTime = setInterval(function () {
    //     lastOnlineTimeUpdate();
    // }, 4000);
	
	/*CallComingOrNot = setInterval(function () {
        checkCallComingOrNot();
    }, 6000);*/

    $(".cust-scroll-table").niceScroll({touchbehavior: false, cursorcolor: "#B7001F", cursoropacitymax: 0.7, cursorwidth: 5, background: "#fff", cursorborder: "none", cursorborderradius: "5px", autohidemode: false});
    $(window).scroll(function () {
        $(".cust-scroll-table").getNiceScroll().resize();
    });
    $(window).resize(function () {
        $(".cust-scroll-table").getNiceScroll().resize();
    });
    var nicesx = $(".field-scroll").niceScroll(".field-scroll div", {touchbehavior: true, cursorcolor: "#B7001F", cursoropacitymax: 0.6, cursorwidth: 24, usetransition: true, hwacceleration: true, autohidemode: "hidden"});
    $(window).scroll(function () {
        $(".field-scroll").getNiceScroll().resize();
    });
    $(window).resize(function () {
        $(".field-scroll").getNiceScroll().resize();
    });

    $(document).on('keyup', "#filterReceipent", function () {
        var filter = $(this).val(), count = 0;
        // Loop through the comment list
        $("#contacts li .user_info").each(function () {
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).closest('li').fadeOut();

                // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).closest('li').show();
                count++;
            }
        });
    });

    $(document).on('click', '.attachement-file-box', function () {
        $('#file-input').trigger('click');
    });

    $(document).on('change', '#message_chat', function () {
        var value=$("#message_chat").val();
        var send_receiver_id=$("#send_receiver_id").val();
        if(value=="store")
        {
            window.location.href = full_path + 'store/'+btoa(send_receiver_id);
            return false;
        }
        var state = value;
        var pointer = $(this);
        var connectionid = $('#connection_id').val();
        var reciverid = $('#send_receiver_id').val();
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        if (pointer.hasClass('unblockuser')) {
            state = 'unblock';
        }
        pointer.addClass('disabled');
        pointer.find('i').addClass('fa fa-spinner fa-spin').removeClass('icofont-ui-block');

        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': csrf_token},
            url: full_path + 'manager-connection-status/' + state,
            dataType: 'json',
            data: {connectionid: connectionid, reciverid: reciverid, state: state},
            success: function (resp) {
                if (resp.status === 200) {
                    if (state == 'block') {
                        htmldesign='';
                        htmldesign+='<option value="" disabled selected><i class="icofont-ui-block"></i> Select Type</option>';
                        htmldesign+='<option value="unblock"><i class="icofont-ui-block"></i> Unblock</option>';
                        htmldesign+='<option value="store"><i class="icofont-ui-block"></i> Visit Store</option>';
                        $('#send-msg-form').addClass('d-none');
                        pointer.html(htmldesign);
                    } else {
                        htmldesign='';
                        htmldesign+='<option value="" disabled selected><i class="icofont-ui-block"></i> Select Type</option>';
                        htmldesign+='<option value="block"><i class="icofont-ui-block"></i> Block</option>';
                        htmldesign+='<option value="store"><i class="icofont-ui-block"></i> Visit Store</option>';
                        $('#send-msg-form').removeClass('d-none');
                        pointer.html(htmldesign);
                    }
                } else {
                    pointer.find('i').addClass('icofont-ui-block').removeClass('fa fa-spinner fa-spin');
                }
                pointer.removeClass('disabled');
                ajaxindicatorstop();
            }
        });
    });

    $(document).on('click', 'li.recipient-box', function () {
        $("#send-msg-form")[0].reset();
        $('.emoji-wysiwyg-editor').empty();
        $('.file-upload-here').empty();
        htmldesign='';
        htmldesign+='<option value="" disabled selected><i class="icofont-ui-block"></i> Select Type</option>';
        htmldesign+='<option value="block"><i class="icofont-ui-block"></i> Block</option>';
        htmldesign+='<option value="store"><i class="icofont-ui-block"></i> Visit Store</option>';
        $('#message_chat').html(htmldesign);
        if ($(this).hasClass('active')) {
            $('li.recipient-box').not(this).removeClass('active');
            $('.contact-profile').removeClass('d-none');
            $(this).addClass('active');
            var username = $(this).find('.user_info').text();
            var user_id = $(this).data('id');
            $('.bln-messege-des-hdr').removeClass('d-none');
            $('.bln-msg-des-title a').attr('href', $(this).data('job_link'));
            $('.bln-msg-des-title a').html($(this).data('user'));
            $('.bln-msg-des-fea strong').html($(this).data('job_location')+'<i class="fas fa-map-marker"></i>');
            $('.bln-messege-des-hdr-lft p').html($(this).data('job_title'));
            $('.bln-messege-des-hdr-rgt .view-job').attr('href', $(this).data('job_link'));
            $(this).find('.preview').removeAttr('style');
            $('.active-chat-user-name span').text(username);
            $('#chatBox').html(contentLoader);
            $('.active-chat-user-img img').attr('src', $(this).find('.connection-img img').attr('src'));
            $('.call_anchor').attr('data-userId', user_id);
            $('.bln-msg-inr').removeClass('d-none');
            fetchMessages();
            clearInterval(chatInterval);
            chatInterval = setInterval(updateMessages, 4000);


        } else {
            $('#scroll_offset').val(0);
            $('#scroll_total').val(0);
            $('#chatBox').html('');
            $('.bln-messege-des').addClass('d-none');
            $('.contact-profile').addClass('d-none');
            $('.shwblkmsg').addClass('d-none');
            $('#send-msg-form').find('#send_receiver_id').val('');
            $('#send-msg-form').find('#connection_id').val('');
            $('[name="last_message_id"]').val('');
            clearInterval(chatInterval);
        }
    });

    $('#send-msg-form').submit(function (e) {
        e.preventDefault();
    });

    $(document).on('click', '.filesendtoopponent', function () {
        $('.modal').modal('hide');
        $('.file-upload-wrapper').attr('data-text','Upload Here');
        $('#upload_media_modal').modal('show');
    });

    $(document).on('submit', '#send_upload_msg_form', function (e) {
        e.preventDefault();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var data = new FormData($('#send_upload_msg_form')[0]);
        var last_as = $('[name="last_message_as"]').data('as');
        data.append('connection_id', $('#connection_id').val());
        data.append('receiver_id', $('#send_receiver_id').val());
        data.append('last_as', last_as);
        $('.upbtn').addClass('disabled');
		ajaxindicatorwithtextstart();
        //$('.upbtn').find('i').addClass('fa fa-spinner fa-spin').removeClass('icofont-paper-plane');
        messagerequest = $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': csrf_token},
            url: full_path + 'post-message',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            beforeSend: function () {
                if (messagerequest !== null) {
                    messagerequest.abort();
                }
                clearInterval(chatInterval);
            },
            success: function (resp) {
				
                $('.upbtn').removeClass('disabled');
                //$('.upbtn').find('i').addClass('icofont-paper-plane').removeClass('fa fa-spinner fa-spin');
				ajaxindicatorstop();
                if (resp.status === 200 && resp.message) {
                    $('#upload_media_modal').modal('hide');
                    var id = 0;
                    $('#send_upload_msg_form')[0].reset();
                    $('#chatBox').append(resp.message);
                    initVideoPLayer();
                    if ($('.message-content-part').length > 0) {
                        id = $('.message-content-part:last-child').data('id');
                        $('[name="last_message_as"]').val($('.message-content-part:last-child').data('as'));
                    }
                    $('[name="last_message_id"]').val(id);
                    $(".messages").animate({
                        scrollTop: $(".messages")[0].scrollHeight}, 2000);
                }

                chatInterval = setInterval(updateMessages, 4000);
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#send_upload_msg_form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#send_upload_msg_form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
				ajaxindicatorstop();
                $('.upbtn').removeClass('disabled');
                //$('.upbtn').find('i').addClass('icofont-paper-plane').removeClass('fa fa-spinner fa-spin');
            }
        });
    });

    /********************Fatch Load More Content On scroll***************/

    if ($("#chatBox").length > 0) {
        $("#chatBox").scrollTop($("#chatBox")[0].scrollHeight);
    }

    $('#chatBox').scroll(function () {
        var scroll_offset = $('#scroll_offset').val();
        var scroll_total = $('#scroll_total').val();
       console.log(scroll_offset, scroll_total);
        if ($('#chatBox').scrollTop() === 0 && (Number(scroll_total) >= Number(scroll_offset))) {
            var fetch_id = $('li.recipient-box.active').data('id');
            var connectionid = $('li.recipient-box.active').data('connection');
            var csrf_token = $('meta[name=csrf-token]').attr('content');
            prependrequest = $.ajax({
                url: full_path + 'prepend-message',
                type: 'POST',
                headers: {'X-CSRF-TOKEN': csrf_token},
                dataType: 'json',
                data: {fetch_id: fetch_id, connectionid: connectionid, scroll_offset: scroll_offset},
                success: function (resp) {
                    if (resp.c_status == 2 && resp.connection_update_id != fetch_id) {
                        $('.bln-msg-inr').addClass('d-none');
                        $('.shwblkmsg').removeClass('d-none');
                        $('.block_rgt_bx').removeClass('d-none');
                        $('.block_rgt_bx').find('.manageuserstatus').addClass('unblockuser').html('<i class="icofont-ui-block"></i> Unblock');
                    } else if (resp.c_status == 2) {
                        $('.shwblkmsg').removeClass('d-none');
                        $('.bln-msg-inr').addClass('d-none');
                        $('#send-msg-form').find('#send_receiver_id').val('');
                        $('#send-msg-form').find('#connection_id').val('');
                        $('.block_rgt_bx').addClass('d-none');
                    } else if (resp.c_status == 1) {
                        $('.shwblkmsg').addClass('d-none');
                        $('.bln-msg-inr').removeClass('d-none');
                        $('.block_rgt_bx').removeClass('d-none');
                    } else {
                        $('.block_rgt_bx').addClass('d-none');
                        $('.bln-msg-inr').addClass('d-none');
                    }

                    if (resp.status && resp.status === 200) {
                        $('#chatBox').prepend(resp.html);

                        $('#chatBox').scrollTop(30);
                    }
                    $('#scroll_offset').val(resp.offset);
                    $('#scroll_total').val(resp.totalMsg);
                    $('#chatBox').scrollTop(30); // Scroll alittle way down, to allow user to scroll more
                }
            });
        }
    });

});

function lastOnlineTimeUpdate() {
    clearInterval(ModelOnlineInterval);
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    $.ajax({
        url: full_path + 'lastOnlineTimeUpdate',
        headers: {'X-CSRF-TOKEN': csrf_token},
        type: 'GET',
        dataType: 'json',
        success: function (resp) {
            var activeUserId = $('li.recipient-box.active').data('id');
            $('span.unread-msg').html(resp.total_unread_msg);
            $.each(resp.users, function (key, val) {
                $('.contact_status' + key).removeClass('online').removeClass('offline').addClass(val.status);
                $('.contact_status' + key).parents('.ligrp_bx').find('p.preview').remove();
                if (!$('.contact_status' + key).parents('.ligrp_bx').find('div.media-body').hasClass('hasSmall')) {
                    $('.contact_status' + key).parents('.ligrp_bx').find('div.media-body').append(val.msg);
                }
                $('.contact_status' + key).parents('.ligrp_bx').find('div.media-body .show-time').html(val.time);
                $('.contact_status' + key).parents('.ligrp_bx').find('.unread-num-msg').html(val.unread);
//                if (key == activeUserId) {
//                    $('.pf-online').removeClass('offline online').addClass(val.status);
//                }
            });
        },
        error: function (resp) {
        }
    });
}

function showNumberofImageSelect(input) {
    if (input.files && input.files.length > 0) {
        sendMsg();
    }
}


function fetchMessages() {
    var fatch_id = $('li.recipient-box.active').data('id');
    $('#send-msg-form').find('#send_receiver_id').val(fatch_id);
    $('#send-msg-form').find('#connection_id').val($('li.recipient-box.active').data('connection'));
    var connectionid = $('li.recipient-box.active').data('connection');
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: full_path + 'fetch-messages',
        dataType: 'json',
        data: {fatch_id: fatch_id, connectionid: connectionid},
        success: function (resp) {
            $('#chatBox').html(resp.html);
			$('.block_rgt_bx').find('.sendtips').attr('onclick', 'openSendTipsModal("'+resp.encode_model_id+'", "Message Tips", "","'+connectionid+'")');
            if (resp.c_status == 2 && resp.connection_update_id != fatch_id) {
                $('.bln-msg-inr').addClass('d-none');
                $('.shwblkmsg').removeClass('d-none');
                $('.block_rgt_bx').removeClass('d-none');                
                
                $('.block_rgt_bx').find('.manageuserstatus').addClass('unblockuser').html('<i class="icofont-ui-block"></i> Unblock');
            } else if (resp.c_status == 2) {
                $('.shwblkmsg').removeClass('d-none');
                $('.bln-msg-inr').addClass('d-none');
                $('#send-msg-form').find('#send_receiver_id').val('');
                $('#send-msg-form').find('#connection_id').val('');
                $('.block_rgt_bx').addClass('d-none');
            } else if (resp.c_status == 1) {
                $('.shwblkmsg').addClass('d-none');
                $('.bln-msg-inr').removeClass('d-none');
                $('.block_rgt_bx').removeClass('d-none');
            } else {
                $('.block_rgt_bx').addClass('d-none');
                $('.bln-msg-inr').addClass('d-none');
            }
            if (resp.usemode != 3) {
                $('#send-msg-form').addClass('d-none');
            } else {
                $('#send-msg-form').removeClass('d-none');
            }

            $("#chatBox").animate({
                scrollTop: $("#chatBox")[0].scrollHeight}, 1500);
            var id = 0;
            if ($('.message-content-part').length > 0) {
                console.log($('#chatBox li:last').data('id'));
                id = $('#chatBox li:last').data('id');
                $('[name="last_message_as"]').val($('#chatBox li:last').data('as'));
            }
            $('[name="last_message_id"]').val(id);
        }
    });
}

function updateMessages() {
    var fatch_id = $('li.recipient-box.active').data('id');
    var last_id = $('[name="last_message_id"]').val();
    var connectionid = $('li.recipient-box.active').data('connection');
    $('#send-msg-form').find('#send_receiver_id').val(fatch_id);
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    var last_as = $('[name="last_message_as"]').data('as');
    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: full_path + 'append-message',
        dataType: 'json',
        data: {fatch_id: fatch_id, last_id: last_id, connectionid: connectionid, last_as: last_as},
        success: function (resp) {
            $('#chatBox').find('.insideLoader').remove();
            if (resp.c_status == 2 && resp.connection_update_id != fatch_id) {
                $('.shwblkmsg').removeClass('d-none');
                $('.bln-msg-inr').addClass('d-none');
                $('.block_rgt_bx').removeClass('d-none');
                htmldesign='';
                htmldesign+='<option value="" disabled selected><i class="icofont-ui-block"></i> Select Type</option>';
                htmldesign+='<option value="unblock"><i class="icofont-ui-block"></i> Unblock</option>';
                htmldesign+='<option value="store"><i class="icofont-ui-block"></i> Visit Store</option>';
				$('.block_rgt_bx').find('#message_chat').html(htmldesign);
            } else if (resp.c_status == 2) {
                $('.shwblkmsg').removeClass('d-none');
                $('.bln-msg-inr').addClass('d-none');
                $('#send-msg-form').find('#send_receiver_id').val('');
                $('#send-msg-form').find('#connection_id').val('');
                $('.block_rgt_bx').addClass('d-none');
            } else if (resp.c_status == 1) {
                $('.shwblkmsg').addClass('d-none');
                $('.bln-msg-inr').removeClass('d-none');
                $('.block_rgt_bx').removeClass('d-none');
            } else {
                $('.block_rgt_bx').addClass('d-none');
                $('.bln-msg-inr').addClass('d-none');
            }
            if (resp.usemode != '3') {
                $('#send-msg-form').addClass('d-none');
            }

            if (resp.status && resp.status === 200) {
                $('#chatBox').append(resp.html);
                if (prependrequest != null) {
                    $("#chatBox").animate({scrollTop: $("#chatBox")[0].scrollHeight}, 2000);
                }
                var id = 0;
                if ($('.message-content-part').length > 0) {
                    console.log($('#chatBox li:last').data('id'));
                    id = $('#chatBox li:last').data('id');
                    $('[name="last_message_as"]').val($('#chatBox li:last').data('as'));
                }
                $("#chatBox").animate({
                    scrollTop: $("#chatBox")[0].scrollHeight}, 2000);
                $('[name="last_message_id"]').val(id);
            }
        }
    });
}

function sendMsg() {
    // $('#send-msg-form').submit(function (e) {
    //     e.preventDefault();
    // });
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    var data = new FormData($('#send-msg-form')[0]);
    $('.sendmsgbtn').addClass('disabled');
    $('.sendmsgbtn').find('i').addClass('fa fa-spinner fa-spin').removeClass('icofont-paper-plane');
    messagerequest = $.ajax({
        async:false,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: full_path + 'post-message',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        beforeSend: function () {
            if (messagerequest !== null) {
                messagerequest.abort();
            }
            clearInterval(chatInterval);
        },
        success: function (resp) {
            $('.sendmsgbtn').removeClass('disabled');
            $('.sendmsgbtn').find('i').addClass('icofont-paper-plane').removeClass('fa fa-spinner fa-spin');
            $('#send-msg-form').find('[name="media_file"]').val('');
            // $('#send-msg-form').find('[name="file_type"]').val('');
            // $('.emoji-wysiwyg-editor').empty();
            $('textarea[name="message"]').val("");
            $('textarea[name="message"]').attr("rows", 2);
            console.log(resp);
            if (resp.status === 200 && resp.message) {
                var id = 0;
                // $('#send-msg-form').find('input[name="message"]').val('');
                $('.emoji-wysiwyg-editor').html('');
                $('#chatBox').append(resp.message);
                if ($('.message-content-part').length > 0) {
                    console.log($('#chatBox li:last').data('id'));
                    id = $('#chatBox li:last').data('id');
                    $('[name="last_message_as"]').val($('#chatBox li:last').data('as'));
                }
                $('[name="last_message_id"]').val(id);
                $("#chatBox").animate({
                    scrollTop: $("#chatBox")[0].scrollHeight}, 2000);
            }
            chatInterval = setInterval(updateMessages, 4000);
        },
        error: function (resp) {
            $('.sendmsgbtn').removeClass('disabled');
            $('.sendmsgbtn').find('i').addClass('icofont-paper-plane').removeClass('fa fa-spinner fa-spin');
        }
    });
}

function loadPlayerAndIframe() {
    $('iframe').on('load', function () {
        $("iframe").contents().find("img").css({'width': '100%', 'height': '150px', 'object-fit': 'cover'});
    });
    $('audio').mediaelementplayer();
}

function showLoader(percentComplete) {
    $('.bln-msg-inr').addClass('d-none');
    $("#progressOuter1").show();
    $("#progressBar1").css("width", Math.round(percentComplete) + "%");
    $("#progressBar1").html(Math.round(percentComplete) + "%");
}
function closeLoader() {
    $("#progressOuter1").hide();
    $('.bln-msg-inr').removeClass('d-none');
    $("#progressBar1").css("width", "0%");
    $("#progressBar1").html("0%");
}


function imgError(image) {
    image.onerror = "";
    image.src = full_path + "public/frontend/images/user.png";
    return true;

}

function initVideoPLayer() {
//    var mediaElements = document.querySelectorAll('video');
//    for (var i = 0, total = mediaElements.length; i < total; i++) {
//        new MediaElementPlayer(mediaElements[i], {
//            previewMode: true,
//            muteOnPreviewMode: true,
//            fadeOutAudioInterval: 200,
//            fadeOutAudioStart: 10,
//            fadePercent: 0.02,
//            features: ['playpause', 'current', 'progress', 'duration', 'volume', 'fullscreen', 'preview'],
//        });
//    }

}



