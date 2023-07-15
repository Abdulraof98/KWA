function pay_with_paypal(obj)
{
    // ajaxindicatorstart();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        async:false,
        url: full_path+"pay-with-paypal",
        type: 'POST',
        dataType: 'json',
        // processData: false,
        // contentType: false,
        data: {
            plan_id : $(obj).data('id')
        },
        success: function (data) {
            console.log(data);
            if (data.status == 200) {
                
                window.location.href = data.link;
                // toastr.options = {
                //     "closeButton" : true,
                //     "progressBar" : true,
                //     'timeOut': 5000
                // }
                // toastr.success(data.msg);
                // setTimeout(function(){
                //     window.location.href = data.link;
                // },3000);
            }
            // ajaxindicatorstop();
        },
        error: function (resp) {
            console.log(resp);
            // ajaxindicatorstop();
        }
    });
}