var contentLoader = '<div class="text-center insideLoader" style="margin: 5%;"><i style="font-size: 46px;color: #2ec6d0;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div>';
$(document).ready(function () {
	$('#add-product-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if (resp.type == 'success') {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                    setTimeout(function () {
                        window.location.href = resp.link;
                    }, 2000);

                } else {
                    $.each(resp.error, function (key, val) {
						if(key.indexOf('.') != -1){
							var reskey = key.split('.');
							var fieldname = reskey[0];
							var fieldid = reskey[1];
							$('#add-product-form').find('select[name^="'+fieldname+'"]').each(function(index) {
								if(fieldid == index){
									$(this).closest('.error').find('.help-block').html(val);
								}
							});
							$('#add-product-form').find('input[name^="'+fieldname+'"]').each(function(index) {
								if(fieldid == index){
									$(this).closest('.error').find('.help-block').html(val);
								}
							});
						}else{
							$('#add-product-form').find('[name="' + key + '"]').closest('.error').find('.help-block').html(val);
						}
					});
                }
                ajaxindicatorstop();
            }
        });
    });
	
	$('#edit-product-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if (resp.type == 'success') {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                    setTimeout(function () {
                        window.location.href = resp.link;
                    }, 2000);

                } else {
                    $.each(resp.error, function (key, val) {
					if(key.indexOf('.') != -1){
							var reskey = key.split('.');
							var fieldname = reskey[0];
							var fieldid = reskey[1];
							$('#edit-product-form').find('select[name^="'+fieldname+'"]').each(function(index) {
								if(fieldid == index){
									$(this).closest('.error').find('.help-block').html(val);
								}
							});
                                                        $('#edit-product-form').find('input[name^="'+fieldname+'"]').each(function(index) {
								if(fieldid == index){
									$(this).closest('.error').find('.help-block').html(val);
								}
							});
						}else{
							$('#edit-product-form').find('[name="' + key + '"]').closest('.error').find('.help-block').html(val);
						}
					});
                }
                ajaxindicatorstop();
            }
        });
    });

    $('#category-management-table').DataTable({
        processing: false,
        serverSide: true,
        ajax: full_path + 'admin-category',
        order: [[3, "desc"]],
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'category_name', name: 'category_name'},
            {data: 'title', name: 'title'},
            {data: 'created_at', name: 'created_at'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
	
	$(document).on('submit', '#Create-Category-From', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: $(this).attr('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {

                if (resp.status && resp.status === 400) {
                    Lobibox.notify('error', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                } else if (resp.msg) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                }

                window.location.href = resp.link;
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#Create-Category-From').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#Create-Category-From').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });


    $(document).on('submit', '#Update-Category-Form', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: $(this).attr('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {

                if (resp.status && resp.status === 400) {
                    Lobibox.notify('error', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                } else if (resp.msg) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                }

                window.location.href = resp.link;
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#Update-Category-Form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#Update-Category-Form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });

    $(document).on('submit', '#AdminBillUpdateForm', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: $(this).attr('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {

                if (resp.status && resp.status === 400) {
                    Lobibox.notify('error', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                } else if (resp.msg) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                }

                if (resp.link) {
                    setTimeout(function () {
                        window.location.href = resp.link;
                    }, 4000);
                }

                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#AdminBillUpdateForm').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#AdminBillUpdateForm').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });

    if ($("#admin-show-notification").length > 0) {
        setInterval(function () {
            admin_show_notifications();
        }, 4000);
    }

    $(document).on('click', '.all-notofication-control', function () {
        var prop = $(this).prop('checked');
        if (prop === true) {
            $('.custom-notification-checkbox').prop('checked', true);
        } else {
            $('.custom-notification-checkbox').prop('checked', false);
        }
    });


    $(document).on('click', '.markAsinactive', function () {
        var url = full_path + 'admin-markAsInactive';
        var type = ($(this).hasClass('for1')) ? 1 : 0;
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var ids = [];
        $('.custom-notification-checkbox:checked').each(function (key, element) {
            ids.push($(element).data('id'));
        });
        if (ids.length <= 0) {
            Lobibox.notify('error', {
                continueDelayOnInactiveTab: false,
                position: 'bottom right',
                delayIndicator: false,
                msg: 'Sorry! You do not have any notification.'
            });
            return false;
        }
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            data: {ids: ids, type: type},
            success: function (resp) {
                Lobibox.notify('success', {
                    continueDelayOnInactiveTab: false,
                    position: 'bottom right',
                    delayIndicator: false,
                    msg: resp.msg
                });
                $.each(ids, function (hey, id) {
                    $('.custom-notification-checkbox[data-id="' + id + '"]').closest('li').remove();
                });
                admin_load_all_notifications(0);
            },
        });
    });

    $(document).on('submit', '#CreateBlogForm', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: $(this).attr('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {

                if (resp.msg) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                }

                window.location.href = full_path + 'admin-blog-index';
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#CreateBlogForm').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#CreateBlogForm').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });

    $(document).on('submit', '#UpdateBlogForm', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: $(this).attr('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {

                if (resp.msg) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                }

                window.location.href = full_path + 'admin-blog-index';
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#UpdateBlogForm').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#UpdateBlogForm').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });


      // Bill JS Section

    // $('#add-card-submit-form-modal').submit(function (event) {
    //     event.preventDefault();
    //     ajaxindicatorstart();
    //     $('.help-block').html('').closest('.form-group').removeClass('has-error');
    //     var url = $(this).attr('action');
    //     var csrf_token = $('input[name=_token]').val();
    //     var data = new FormData($(this)[0]);
    //     $.ajax({
    //         url: url,
    //         headers: {'X-CSRF-TOKEN': csrf_token},
    //         type: 'POST',
    //         dataType: 'json',
    //         processData: false,
    //         contentType: false,
    //         data: data,
    //         success: function (resp) {
    //             if(resp.status=="200")
    //             {
    //                 notie.alert({
    //                     type: 'success',
    //                     text: '<i class="fa fa-check"></i> ' + resp.msg,
    //                     time: 3
    //                 });
    //             fetch_my_cards();
    //             }else{
    //                 notie.alert({
    //                     type: 'error',
    //                     text: '<i class="fa fa-times"></i> ' + resp.msg,
    //                     time: 3
    //                 });
    //             }
    //             ajaxindicatorstop();
    //         },
    //         error: function (resp) {
    //             $.each(resp.responseJSON.errors, function (key, val) {
    //                 $('#add-card-submit-form-modal').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
    //                 $('#add-card-submit-form-modal').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
    //             });
    //             ajaxindicatorstop();
    //         }
    //     })
    // });



    $('#upload-bill-submit-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                $('#bill_upload_step_1').attr('style','display:none');
                $('#dynamic_section_content').append(resp.content);
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#upload-bill-submit-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#upload-bill-submit-form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');

                    if(key == 'filepond'){
                        console.log(key);
                     $('#upload-bill-submit-form').find('#bill_image_error').html(val[0]); 
                    }
                });
                ajaxindicatorstop();
            }
        })
    });

//     $(document).on('click', '#paginate_section_by_bills .pagination a', function (event) {
//     event.preventDefault();
//     if ($(this).attr('href') != '#') {
//         fetch_my_bills($(this).attr('href'));
//     }
// });

    // Bill JS Section End

/*

    $('#add-category-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if (resp.type == 'success') {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                    setTimeout(function () {
                        window.location.href = resp.link;
                    }, 2000);

                } else {
                    $(this).addClass('was-validated');
                    $.each(resp.error, function (key, val) {
                        $(".err-" + key).html(val);
                    });
                }
                ajaxindicatorstop();
            }
        });
    });
    $('#edit-order-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if (resp.type == 1) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                    setTimeout(function () {
                        window.location.href = resp.link;
                    }, 2000);

                } else if (resp.type == 2) {
                    Lobibox.notify('error', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                } else {
                    $(this).addClass('was-validated');
                    $.each(resp.error, function (key, val) {
                        $(".err_" + key).html(val);
                    });
                }
                ajaxindicatorstop();
            }
        });
    });
    $('#edit-wallet-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if (resp.type == 1) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                    setTimeout(function () {
                        window.location.href = resp.link;
                    }, 2000);

                } else if (resp.type == 2) {
                    Lobibox.notify('error', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                } else {
                    $(this).addClass('was-validated');
                    $.each(resp.error, function (key, val) {
                        $(".err_" + key).html(val);
                    });
                }
                ajaxindicatorstop();
            }
        });
    });
    $('#add-coupon-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if (resp.type == 'success') {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                    setTimeout(function () {
                        window.location.href = resp.link;
                    }, 2000);

                } else {
                    $.each(resp.error, function (key, val) {
                        $('#add-coupon-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val);
                    });
                }
                ajaxindicatorstop();
            }
        })
    });
    $('#edit-subscriber-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('input[name="csrf-token"]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if (resp.status === 200) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                    setTimeout(function () {
                        window.location.href = resp.link;
                    }, 2000);

                } else {
                    $.each(resp.errors, function (key, val) {
                        $('#edit-subscriber-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val);
                    });
                }
                ajaxindicatorstop();
            }
        })
    });

    $('#add-blogcategory-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if (resp.type == 'success') {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                    setTimeout(function () {
                        window.location.href = resp.link;
                    }, 2000);

                } else {
                    $(this).addClass('was-validated');
                    $.each(resp.error, function (key, val) {
                        $(".err-" + key).html(val);
                    });
                }
                ajaxindicatorstop();
            }
        });
    });

    $('#tire-product-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        var desc = CKEDITOR.instances['ckeditor'].getData();
        data.append('description', desc);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                // Lobibox.notify('success', {
                //     continueDelayOnInactiveTab: false,
                //     position: 'bottom right',
                //     delayIndicator: false,
                //     msg: resp.msg
                // });

                    window.location.href = resp.link;
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#tire-product-form").find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $("#tire-product-form").find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });

    $('#tire-product-update-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        var desc = CKEDITOR.instances['ckeditor'].getData();
        data.append('description', desc);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                // Lobibox.notify('success', {
                //     continueDelayOnInactiveTab: false,
                //     position: 'bottom right',
                //     delayIndicator: false,
                //     msg: resp.msg
                // });

                    window.location.href = resp.link;
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#tire-product-update-form").find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $("#tire-product-update-form").find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });


    $('#add-blog-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                Lobibox.notify('success', {
                    continueDelayOnInactiveTab: false,
                    position: 'bottom right',
                    delayIndicator: false,
                    msg: resp.msg
                });

                setTimeout(function () {
                    window.location.href = resp.link;
                }, 2000);
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#add-blog-form").find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $("#add-blog-form").find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });
    $('#add-shop-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                Lobibox.notify('success', {
                    continueDelayOnInactiveTab: false,
                    position: 'bottom right',
                    delayIndicator: false,
                    msg: resp.msg
                });

                setTimeout(function () {
                    window.location.href = resp.link;
                }, 2000);
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#add-shop-form").find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $("#add-shop-form").find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });

    $('#shop-management').DataTable({
        processing: false,
        serverSide: true,
        ajax: full_path + 'admin-shop',
        order: [[4, "desc"]],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'shop_image', name: 'shop_image'},
            {data: 'first_name', name: 'first_name'},
            {data: 'shop_name', name: 'shop_name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    $('#order-management').DataTable({
        processing: false,
        serverSide: true,
        ajax: full_path + 'order',
        order: [[7, "desc"]],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'first_name', name: 'first_name'},
            {data: 'title', name: 'title'},
            {data: 'item_price', name: 'item_price'},
            {data: 'quantity', name: 'quantity'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    $('#wallet-management').DataTable({
        processing: false,
        serverSide: true,
        ajax: full_path + 'wallet',
        order: [[1, "desc"]],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'user_id', name: 'user_id'},
            {data: 'amount', name: 'amount'},
            {data: 'created_at', name: 'created_at'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    $('#cancelorderrequest-management').DataTable({
        processing: false,
        serverSide: true,
        ajax: full_path + 'cancel-order-request',
        order: [[7, "desc"]],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'first_name', name: 'first_name'},
            {data: 'order_id', name: 'order_id'},
            {data: 'item_price', name: 'item_price'},
            {data: 'quantity', name: 'quantity'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    $('#blogcategories-management').DataTable({
        processing: false,
        serverSide: true,
        ajax: full_path + 'admin-blogcategories-list-datatable',
        order: [[3, "desc"]],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'status', name: 'status', render: function (data, type, row) {
                    if (data == '0') {
                        return '<span class="label label-sm label-warning">Inactive</span>';
                    } else if (data == '1') {
                        return '<span class="label label-sm label-success">Active</span>';
                    } else if (data == '3') {
                        return '<span class="label label-sm label-danger">Delete</span>';
                    } else {
                        return '';
                    }
                }
            },
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    $('#blogs-management').DataTable({
        processing: false,
        serverSide: true,
        ajax: full_path + 'adminblog',
        order: [[4, "desc"]],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'title', name: 'title'},
            {data: 'status', name: 'status', render: function (data, type, row) {
                    if (data == '0') {
                        return '<span class="label label-sm label-warning">Inactive</span>';
                    } else if (data == '1') {
                        return '<span class="label label-sm label-success">Active</span>';
                    } else if (data == '3') {
                        return '<span class="label label-sm label-danger">Delete</span>';
                    } else {
                        return '';
                    }
                }
            },
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    $('#subscribers-management').DataTable({
        processing: false,
        serverSide: true,
        ajax: full_path + 'subscriber',
        order: [[4, "desc"]],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'email', name: 'email'},
            {data: 'status', name: 'status', render: function (data, type, row) {
                    if (data == '0') {
                        return '<span class="label label-sm label-warning">Inactive</span>';
                    } else if (data == '1') {
                        return '<span class="label label-sm label-success">Active</span>';
                    } else if (data == '3') {
                        return '<span class="label label-sm label-danger">Delete</span>';
                    } else {
                        return '';
                    }
                }
            },
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $(document).on('change', '.toggle-switch', function (e) {
        ajaxindicatorstart();
        var id = $(this).data('id');
        var status = $(this).prop('checked');
        $.ajax({
            url: full_path + 'admin-showcategoryfront',
            type: 'GET',
            dataType: 'json',
            data: {status: status, id: id},
            success: function (resp) {
                if (resp.status === 200) {
                    $(this).prop('checked', status);
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                } else {
                    $(e.target).prop('checked', false);
                    Lobibox.notify('error', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                }
                ajaxindicatorstop();
            }
        });
    });*/

    /*$(document).on('change', '#category', function () {
        var product_id = $(this).data('product_id');
        $.get(full_path + 'admin-subcategory-list', {category_id: $(this).val(), product_id: product_id}, function (resp) {
            $('.sub_category_render').html(resp.html);
        }, 'json');
    });*/

    $('#shop-update-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if (resp.type == 'success') {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                    setTimeout(function () {
                        window.location = resp.link;
                    }, 3000);
                } else if (resp.type == 'failure') {
                    $.each(resp.error, function (key, val) {
                        $('#shop-update-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val);
                    });
                } else {

                }
                ajaxindicatorstop();
            }
        });
    });
});

function change_year(value)
{
    var url= full_path + 'admin-change_year/'+value;
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function (resp) {
            if (resp.status == 'success') {
                var data=resp.model;
                var htmldesign="";
                htmldesign+="<option value=''>-----Select Brand----</option>";
                for(i=0;i<data.length;i++)
                {
                    htmldesign+="<option value='"+data[i].brand_id+"'>"+data[i].b_name+"</option>";
                }
                $("#show-brand-data").html(htmldesign);
            } 
        }
    });
}


function change_brand(obj)
{  
    
    var url= full_path + 'admin-change_brand/'+$(obj).val();
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function (resp) {
            if (resp.status == 'success') {
                var data=resp.model;
                var htmldesign="";
                htmldesign+="<option value=''>-----Select Model----</option>";
                for(i=0;i<data.length;i++)
                {
                    htmldesign+="<option value='"+data[i].id+"'>"+data[i].model_name+"</option>";
                }
                $("#show-model-data").html(htmldesign);
            } 
        }
    });
}


function change_model(obj)
{
    var url= full_path + 'admin-change_model/'+$(obj).val();
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function (resp) {
            if (resp.status == 'success') {
                var data=resp.model;
                var htmldesign="";
                htmldesign+="<option value=''>-----Select Body----</option>";
                for(i=0;i<data.length;i++)
                {
                    htmldesign+="<option value='"+data[i].id+"'>"+data[i].name+"</option>";
                }
                $("#show-body-data").html(htmldesign);
            } 
        }
    });
}

function change_body(value)
{
    var url= full_path + 'admin-change_body/'+value;
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function (resp) {
            if (resp.status == 'success') {
                var data=resp.model;
                var htmldesign="";
                htmldesign+="<option value=''>-----Select Trim----</option>";
                for(i=0;i<data.length;i++)
                {
                    htmldesign+="<option value='"+data[i].id+"'>"+data[i].name+"</option>";
                }
                $("#show-trim-data").html(htmldesign);
            } 
        }
    });
}

// function change_trim(value)
// {
//     var url= full_path + 'admin-change_trim/'+value;
//     $.ajax({
//         url: url,
//         dataType: 'json',
//         // processData: false,
//         // contentType: false,
//         success: function (resp) {
//             if (resp.status == 'success') {
//                 var data=resp.model;
function tire_change_brand(obj)
{  
    
    var url= full_path + 'admin-change_brand/'+$(obj).val();
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function (resp) {
            if (resp.status == 'success') {
                var data=resp.model;
                var htmldesign="";
                htmldesign+="<option value=''>-----Select Model----</option>";
                for(i=0;i<data.length;i++)
                {
                    htmldesign+="<option value='"+data[i].id+"'>"+data[i].model_name+"</option>";
                }
                $("#show-model-data").html(htmldesign);
            } 
        }
    });
}


function tire_change_model(obj)
{
    var url= full_path + 'admin-change_model/'+$(obj).val();
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function (resp) {
            if (resp.status == 'success') {
                var data=resp.model;
                var htmldesign="";
                htmldesign+="<option value=''>-----Select Body----</option>";
                for(i=0;i<data.length;i++)
                {
                    htmldesign+="<option value='"+data[i].id+"'>"+data[i].name+"</option>";
                }
                $("#show-body-data").html(htmldesign);
            } 
        }
    });
}

function tire_change_body(value)
{
    var url= full_path + 'admin-change_body/'+value;
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function (resp) {
            if (resp.status == 'success') {
                var data=resp.model;
                var htmldesign="";
                htmldesign+="<option value=''>-----Select Trim----</option>";
                for(i=0;i<data.length;i++)
                {
                    htmldesign+="<option value='"+data[i].id+"'>"+data[i].name+"</option>";
                }
                $("#show-trim-data").html(htmldesign);
            } 
        }
    });
}


function change_category(value)
{
    var url= full_path + 'admin-change_category/'+value;
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function (resp) {
            if (resp.status == 'success') {
                var data=resp.model;
                var htmldesign="";
                htmldesign+="<option value=''>-----Select Subcategory----</option>";
                for(i=0;i<data.length;i++)
                {
                    htmldesign+="<option value='"+data[i].id+"'>"+data[i].name+"</option>";
                }
                $("#subcategory_list").html(htmldesign);
            } 
        }
    });
}

function deleteBlogCategory(obj) {
    $.confirm({
        title: 'Delete Blog Category',
        content: 'Are you sure to delete this blog category?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    window.location.href = $(obj).attr('data-href');
                }
            },
            cancel: function () {}
        }
    });
}

function deleteSubscriber(obj) {
    $.confirm({
        title: 'Delete Subscriber',
        content: 'Are you sure to delete this Subscriber?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    window.location.href = $(obj).attr('data-href');
                }
            },
            cancel: function () {}
        }
    });
}
function deleteCategory(obj) {
    $.confirm({
        title: 'Delete Category',
        content: 'Are you sure to delete this category?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    window.location.href = $(obj).attr('data-href');
                }
            },
            cancel: function () {}
        }
    });
}

function changenotistatus(id,obj) {
    var location = $(obj).data('location');
    $.ajax({
            url: full_path + 'changenotistatus',
            type: 'get',
            dataType: 'json',
            data: {id:id},
            success: function (data) {
                if (data.value == "success") {
               window.location.href = location;
            }
            }
        });
}

function loadmorenoti() {
    var row = Number($('#row').val());
    var allcount = Number($('#all').val())
    var rowperpage = 15;
    row = row + rowperpage;
    console.log(row);
    if(row <= allcount){
        var csrf_token = $('input[name=_token]').val();
        $("#row").val(row);
         $.ajax({
                url: full_path + 'load-notification',
                type: 'get',
                dataType: 'json',
                data: {row:row},
                beforeSend:function(){
                    $("#loadmore").text("Loading...");
                },
                success: function(resp){
                    
                    $("#loadnoti").append(resp.html);
                    setTimeout(function() {
                        var rowno = row + rowperpage;
                        if(rowno >= allcount){
                            $('#loadmore').hide();
                        }else{
                            $("#loadmore").text("Load more");
                        }
                    }, 2000);

                }
            });
    }
}

function readImageURL(input) {
    $('[name="screenshot"]').val(0);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(input).closest('.row').find('.show-photo').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// function deleteCategory(obj) {
//     $.confirm({
//         title: 'Delete Category',
//         content: 'Are you sure to delete this category?',
//         type: 'red',
//         typeAnimated: true,
//         buttons: {
//             confirm: {
//                 text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
//                 btnClass: 'btn-red',
//                 action: function () {
//                     window.location.href = $(obj).attr('data-href');
//                 }
//             },
//             cancel: function () {}
//         }
//     });
// }

function loadMagnifier() {
    $('.imagegallery').magnificPopup({
        delegate: 'div.for-all', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery: {
            enabled: false
        },
        zoom: {
            enabled: true, // By default it's false, so don't forget to enable it

            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function

            opener: function (openerElement) {
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });
}

function changenotistatus(id, obj) {
    var location = $(obj).data('location');
    $.ajax({
        url: full_path + 'changenotistatus',
        type: 'get',
        dataType: 'json',
        data: {id: id},
        success: function (data) {
            if (data.value == "success") {
                window.location.href = location;
            }
        }
    });
}

function loadmorenoti() {
    var row = Number($('#row').val());
    var allcount = Number($('#all').val())
    var rowperpage = 15;
    row = row + rowperpage;
    console.log(row);
    if (row <= allcount) {
        var csrf_token = $('input[name=_token]').val();
        $("#row").val(row);
        $.ajax({
            url: full_path + 'load-notification',
            type: 'get',
            dataType: 'json',
            data: {row: row},
            beforeSend: function () {
                $("#loadmore").text("Loading...");
            },
            success: function (resp) {

                $("#loadnoti").append(resp.html);
                setTimeout(function () {
                    var rowno = row + rowperpage;
                    if (rowno >= allcount) {
                        $('#loadmore').hide();
                    } else {
                        $("#loadmore").text("Load more");
                    }
                }, 2000);

            }
        });
    }
}

function admin_show_notifications() {
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    // var csrf_token = $('input[name=_token]').val();
    $.ajax({
        url: full_path + 'admin-get-notifications',
        headers: {'X-CSRF-TOKEN': csrf_token},
        type: 'POST',
        dataType: 'json',
        success: function (resp) {
            $('#admin-show-notification').html(resp.content);
            if (resp.total_unread_notification > 0) {
                $('.showadminnoticount').html(resp.total_unread_notification);
            } else {
                $('.showadminnoticount').html('0');
            }
        }
    });
}

function admin_load_all_notifications() {
    if (notification_offset == 0) {
        $('[name="notification_offset"]').val(notification_offset);
    }
    $('.custom-notification-list').append(contentLoader);
    var notification_offset = $('input[name="notification_offset"]').val();
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    // var csrf_token = $('input[name=_token]').val();
    $.ajax({
        type: 'GET',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: full_path + 'admin-notification',
        dataType: 'json',
        data: {notification_offset: notification_offset},
        success: function (resp) {
            $('.custom-notification-list').find('.insideLoader').remove();
            $('.custom-notification-list').append(resp.content);
            $('[name="notification_offset"]').val(resp.notification_offset);
            $('[name="notification_total"]').val(resp.notification_total);
        }
    });
}

function pay_installment(installment_id)
{
    $.confirm({
        title: 'Pay Installment',
        content: 'Are you sure to pay this installment?',
        type: 'green',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-green',
                action: function () {
                    ajaxindicatorstart();
                    var url = full_path+"pay-installment";
                    var csrf_token = $('meta[name=csrf-token]').attr('content')
                    var data = new FormData();
                    data.append("installment_id",installment_id);
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'POST',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        data: data,
                        success: function (resp) {
                            if (resp.status && resp.status === 200) {
                                Lobibox.notify('success', {
                                    continueDelayOnInactiveTab: false,
                                    position: 'bottom right',
                                    delayIndicator: false,
                                    msg: resp.msg
                                });
                                window.location.href = resp.link;
                            } else if (resp.status && resp.status === 400) {
                                Lobibox.notify('error', {
                                    continueDelayOnInactiveTab: false,
                                    position: 'bottom right',
                                    delayIndicator: false,
                                    msg: resp.msg
                                });
                            } else {
                                $.each(resp.errors, function (key, val) {
                                    $('#express-checkout-form-submit').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                                    $('#express-checkout-form-submit').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                                });
                            }
                            ajaxindicatorstop();
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });
    
}

// Bill JS Section 
function show_addCard_modal(obj)
{
    // console.log($('#select_card').find(":selected").val());
    var value = $(obj).find(":selected").val();
    if(value == '')
    {
        $('#add-card-submit-form-modal').trigger("reset");
        $('#add-card-submit-form-modal').find('span').empty();
        $('#add-card-submit-form-modal').find('div').removeClass('has-error');
        $('#addCardModal').modal("show");
    }else if(value==2){
        $('#addCardModal').modal("hide");
    }else{
       $('#addCardModal').modal("hide");
    }
}

function show_customAmount_field(obj)
{
   var value = $(obj).find(":selected").val();
   if(value == ''){
    $('#custom_amount_field').attr("style","display:block");
    $('#my_avaliable_balance').attr("style","display:none");
   }else{
     // $('#my_avaliable_balance').attr("style","display:block");
     $('#custom_amount_field').attr("style","display:none");
   }
}

function show_customDate_field(obj)
{
   var value = $(obj).find(":selected").val();
   if(value == 1){
    $(obj).parent().find("p").html("<i class='icofont-info-circle'></i> This bill will be scheduled to be paid as soon as it's been processed.");
    $('#custom_date_field').attr("style","display:none");
   }else if(value == ''){
    $(obj).parent().find("p").html("");
    $('#custom_date_field').attr("style","display:block");
   }
}

function cancel_card_save_modal(){
    $('#add-card-submit-form-modal').trigger("reset");
    $('#add-card-submit-form-modal').find('span').empty();
    $('#add-card-submit-form-modal').find('div').removeClass('has-error');
    $('#addCardModal').modal("hide"); 
}

function fetch_my_cards()
{
//    console.log('fetch_my_cards');
    $.ajax({
        url: full_path + 'fetch-my-cards',
        type: 'GET',
        dataType: 'json',
        success: function (resp) {
            if (resp){
                $('#addCardModal').modal("hide");
//                console.log(resp.content);
                $('#my_cards_dropdown').html(resp.content);
                $('select').selectpicker();
            }
        }
    });
}

function back_to_bill_step_1()
{

    $('#bill_upload_step_1').attr('style','display:block');
    $("#bill_upload_step_2").remove();
    // $('#dynamic_section_content').append(resp.content);
}

function store_bill()
{
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    var data = new FormData($('#upload-bill-submit-form')[0]);
    ajaxindicatorstart();
    $.ajax({
        url: full_path + 'admin-store-bill-details',
        headers: {'X-CSRF-TOKEN': csrf_token},
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        success: function (resp) {
            Lobibox.notify('success', {
                continueDelayOnInactiveTab: false,
                position: 'bottom right',
                delayIndicator: false,
                msg: resp.msg
            });
            $('#upload-bill-submit-form')[0].reset();
            window.location.href = resp.link;
            ajaxindicatorstop();
        }
    });
}

function fetch_my_bills(url)
{
    var filter = $('#bills_filter_option').find(":selected").val();
    // console.log(filter);
    if (url == null) {
        url = full_path + 'get-my-bills-ajax';
    }
    // var csrf_token = $('meta[name=csrf-token]').attr('content');
    ajaxindicatorstart();
    $.ajax({
        url: url,
        // headers: {'X-CSRF-TOKEN': csrf_token},
        type: 'GET',
        data: {filter:filter},
        dataType: 'json',
        success: function (resp) {
           $('#dynamic_bill_list').html(resp.content);
            if (resp.links == "") {
                $("#paginate_section_by_bills").addClass("d-none");
            } else {
                $("#paginate_section_by_bills").removeClass("d-none");
                $("#paginate_section_by_bills").html(resp.links);
            }
        ajaxindicatorstop();
        }
    }); 
    
}

function show_warning_modal(msg)
{
 $('#warning_message').text(msg);
 $('#show_warning_modal').modal('show');   
}

// function WillNotReview()
// {
//     $('#bill_review_request_modal').modal('hide');
//     store_bill();
// }

// function WillReview()
// {
//     $('#bill_review_request_modal').modal('hide');
//     var csrf_token = $('input[name=_token]').val();
//     var data = new FormData($('#upload-bill-submit-form')[0]);
//     data.append('is_review_requested', '1');
//     ajaxindicatorstart();
//     $.ajax({
//         url: full_path + 'store-bill-details',
//         headers: {'X-CSRF-TOKEN': csrf_token},
//         type: 'POST',
//         dataType: 'json',
//         processData: false,
//         contentType: false,
//         data: data,
//         success: function (resp) {
//             notie.alert({
//                     type: 'success',
//                     text: '<i class="fa fa-check"></i> ' + resp.msg,
//                     time: 3
//                 });
//             $('#upload-bill-submit-form')[0].reset();
//             window.location.href = resp.link;
//             ajaxindicatorstop();
//         }
//     });
// }

// function show_review_request_modal() {
//     $('#bill_review_request_modal').modal('show');
// }

// function dicard_the_bill(bill_id){
//     var csrf_token = $('input[name=_token]').val();
//     ajaxindicatorstart();
//     $.ajax({
//         url: full_path + 'discard-the-bill',
//         headers: {'X-CSRF-TOKEN': csrf_token},
//         type: 'POST',
//         dataType: 'json',
//         data: {'bill_id':bill_id},
//         success: function (resp) {
//             notie.alert({
//                     type: 'success',
//                     text: '<i class="fa fa-check"></i> ' + resp.msg,
//                     time: 3
//                 });
//             window.location.href = resp.link;
//             ajaxindicatorstop();
//         }
//     }); 
// }

// function confirm_the_bill(bill_id){
//     var csrf_token = $('input[name=_token]').val();
//     // console.log(bill_id);
//     // return false;
//     ajaxindicatorstart();
//     $.ajax({
//         url: full_path + 'accept-review-bill',
//         headers: {'X-CSRF-TOKEN': csrf_token},
//         type: 'POST',
//         dataType: 'json',
//         data: {'bill_id':bill_id},
//         success: function (resp) {
//             notie.alert({
//                     type: 'success',
//                     text: '<i class="fa fa-check"></i> ' + resp.msg,
//                     time: 3
//                 });
//             window.location.href = resp.link;
//             ajaxindicatorstop();
//         }
//     }); 
// }


// Bill JS Section End