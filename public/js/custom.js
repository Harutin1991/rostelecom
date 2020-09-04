function checkAvailability(element,serviceId) {
    if($(element).is(':checked')){
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            method: 'post',
            data: {serviceId:serviceId,_token:_token},
            url: 'ajax-request',
            success: function (res) {
               if(res.length > 0) {
                   $('.service-content').each(function () {
                       let serviceContentId = parseInt($(this).data('id'));
                       if(!res.includes(serviceContentId) && serviceContentId != serviceId){
                           $('#service_cart_'+serviceContentId).addClass('serviceDisable');
                           $('#service_choose'+serviceContentId).prop("disabled", true);
                       }
                   });
               } else {
                   $('.service-content').each(function () {
                       let serviceContentId = parseInt($(this).data('id'));
                       if(serviceContentId != serviceId){
                           $('#service_cart_'+serviceContentId).addClass('serviceDisable');
                           $('#service_choose'+serviceContentId).prop("disabled", true);
                       }
                   });
               }
            }
        });
    } else {
        $('.service-content').each(function () {
            $(this).removeClass('serviceDisable');
            $(this).find('.service-checkbox').prop("disabled", false);

        });
    }
}