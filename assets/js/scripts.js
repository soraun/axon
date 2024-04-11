
jQuery(document).on('click','.share-link',function (e){
    e.preventDefault();
    var jQuerythis = this;
    var title = jQuery(this).data('title') || '-';
    var url = jQuery('#shortlink').val();

    if (jQuery(this).hasClass('active')) {
        jQuery(this).removeClass('active');
        jQuery('.share-box').remove();
    } else {
        jQuery(this).addClass('active');
        var shareBox = jQuery('<div>', {});
        shareBox.addClass('share-box');
        shareBox.css({
            'width': '250px',
            'height': 'auto',
            'border-radius': '10px',
            'box-shadow': '0px 15px 20px -10px rgba(0,0,0,0.1)',
            'display': 'flex',
            'align-items': 'center',
            'justify-content': 'center',
            'position': 'absolute',
            'border': '1px solid #f0f0f0',
            'background': '#FFF',
            'z-index': '99999999999',
            'flex-direction': 'column',
            'padding': '20px',
            'top': '44px',
            'left': '-17px'
        });

        var triangle = jQuery('<span>', {});
        triangle.css({
            'width': 0,
            'height': 0,
            'border-left': '6px solid transparent',
            'border-right': '6px solid transparent',
            'border-bottom': '6px solid #9d9d9d',
            'position': 'absolute',
            'left': window.innerWidth > 1024 ? 0 : jQuerythis.getBoundingClientRect().x - (jQuery(jQuerythis).width() / 2) - 3,
            'right': window.innerWidth > 1024 ? '157px' : 'initial',
            'margin': 'auto',
            'top': -6
        });

        var facebookIcon = '<a href="https://www.facebook.com/sharer/sharer.php?u=' + url + '&t=' + title + '" style="margin:0 10px;" title="" target="_blank"><svg height="18" viewBox="0 0 512 512" width="18" xmlns="http://www.w3.org/2000/svg"><path d="m483.738281 0h-455.5c-15.597656.0078125-28.24218725 12.660156-28.238281 28.261719v455.5c.0078125 15.597656 12.660156 28.242187 28.261719 28.238281h455.476562c15.605469.003906 28.257813-12.644531 28.261719-28.25 0-.003906 0-.007812 0-.011719v-455.5c-.007812-15.597656-12.660156-28.24218725-28.261719-28.238281zm0 0" fill="#4267b2"/><path d="m353.5 512v-198h66.75l10-77.5h-76.75v-49.359375c0-22.386719 6.214844-37.640625 38.316406-37.640625h40.683594v-69.128906c-7.078125-.941406-31.363281-3.046875-59.621094-3.046875-59 0-99.378906 36-99.378906 102.140625v57.035156h-66.5v77.5h66.5v198zm0 0" fill="#fff"/></svg></a>';
        var twitterIcon = '<a href="http://twitter.com/share?text=' + title + '&url=' + url + '" style="margin:0 10px;" title="" target="_blank"><svg version="1.1" width="18" height="18" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490.659 490.659" style="enable-background:new 0 0 490.659 490.659;" xml:space="preserve"><path style="fill:#03A9F4;" d="M487.84,92.931c-3.262-3.567-8.514-4.494-12.8-2.261c-4.406,2.002-8.964,3.65-13.632,4.928 c7.28-9.316,12.777-19.897,16.213-31.211c1.513-5.693-1.876-11.535-7.569-13.048c-3.04-0.808-6.281-0.233-8.857,1.571 c-16.219,8.777-33.458,15.52-51.328,20.075c-36.787-34.722-92.823-39.05-134.507-10.389c-32.109,21.71-49.786,59.232-46.08,97.813 c-69.603-5.931-133.642-40.422-176.896-95.275c-2.222-2.688-5.584-4.168-9.067-3.989c-3.532,0.212-6.728,2.162-8.533,5.205 c-14.68,23.997-18.933,52.944-11.776,80.149c3.67,13.978,9.961,27.132,18.539,38.763c-3.864-1.892-7.5-4.218-10.837-6.933 c-4.575-3.711-11.292-3.011-15.004,1.564c-1.54,1.899-2.382,4.269-2.383,6.714c0.634,39.467,22.306,75.588,56.832,94.72 c-4.658-0.572-9.256-1.557-13.739-2.944c-5.641-1.697-11.59,1.5-13.287,7.141c-0.74,2.461-0.567,5.107,0.487,7.451 c14.985,33.567,44.943,58.084,80.811,66.133c-34.173,19.28-73.523,27.381-112.533,23.168c-5.058-0.646-9.85,2.429-11.371,7.296 c-1.568,4.829,0.484,10.093,4.907,12.587c47.765,28.38,102.102,43.82,157.653,44.8c53.294-0.195,105.345-16.113,149.632-45.76 c84.544-56.107,137.237-156.843,129.899-246.976c18.077-13.381,33.758-29.725,46.379-48.341 C491.587,101.802,491.114,96.488,487.84,92.931z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></a>';
        var telegramIcon = '<a href="https://telegram.me/share/url?url=' + url + '&text=' + title + '" style="margin:0 10px;" title="" target="_blank"><svg enable-background="new 0 0 24 24" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" fill="#039be5" r="12"/><path d="m5.491 11.74 11.57-4.461c.537-.194 1.006.131.832.943l.001-.001-1.97 9.281c-.146.658-.537.818-1.084.508l-3-2.211-1.447 1.394c-.16.16-.295.295-.605.295l.213-3.053 5.56-5.023c.242-.213-.054-.333-.373-.121l-6.871 4.326-2.962-.924c-.643-.204-.657-.643.136-.953z" fill="#fff"/></svg></a>';
        var whatsappIcon = '<a href="whatsapp://send?text=' + title + ' ' + url + '" style="margin:0 10px;" title="" target="_blank"><svg height="22" viewBox="-1 0 512 512" width="22" xmlns="http://www.w3.org/2000/svg"><path d="m10.894531 512c-2.875 0-5.671875-1.136719-7.746093-3.234375-2.734376-2.765625-3.789063-6.78125-2.761719-10.535156l33.285156-121.546875c-20.722656-37.472656-31.648437-79.863282-31.632813-122.894532.058594-139.941406 113.941407-253.789062 253.871094-253.789062 67.871094.0273438 131.644532 26.464844 179.578125 74.433594 47.925781 47.972656 74.308594 111.742187 74.289063 179.558594-.0625 139.945312-113.945313 253.800781-253.867188 253.800781 0 0-.105468 0-.109375 0-40.871093-.015625-81.390625-9.976563-117.46875-28.84375l-124.675781 32.695312c-.914062.238281-1.84375.355469-2.761719.355469zm0 0" fill="#e5e5e5"/><path d="m10.894531 501.105469 34.46875-125.871094c-21.261719-36.839844-32.445312-78.628906-32.429687-121.441406.054687-133.933594 109.046875-242.898438 242.976562-242.898438 64.992188.027344 125.996094 25.324219 171.871094 71.238281 45.871094 45.914063 71.125 106.945313 71.101562 171.855469-.058593 133.929688-109.066406 242.910157-242.972656 242.910157-.007812 0 .003906 0 0 0h-.105468c-40.664063-.015626-80.617188-10.214844-116.105469-29.570313zm134.769531-77.75 7.378907 4.371093c31 18.398438 66.542969 28.128907 102.789062 28.148438h.078125c111.304688 0 201.898438-90.578125 201.945313-201.902344.019531-53.949218-20.964844-104.679687-59.09375-142.839844-38.132813-38.160156-88.832031-59.1875-142.777344-59.210937-111.394531 0-201.984375 90.566406-202.027344 201.886719-.015625 38.148437 10.65625 75.296875 30.875 107.445312l4.804688 7.640625-20.40625 74.5zm0 0" fill="#fff"/><path d="m19.34375 492.625 33.277344-121.519531c-20.53125-35.5625-31.324219-75.910157-31.3125-117.234375.050781-129.296875 105.273437-234.488282 234.558594-234.488282 62.75.027344 121.644531 24.449219 165.921874 68.773438 44.289063 44.324219 68.664063 103.242188 68.640626 165.898438-.054688 129.300781-105.28125 234.503906-234.550782 234.503906-.011718 0 .003906 0 0 0h-.105468c-39.253907-.015625-77.828126-9.867188-112.085938-28.539063zm0 0" fill="#64b161"/><g fill="#fff"><path d="m10.894531 501.105469 34.46875-125.871094c-21.261719-36.839844-32.445312-78.628906-32.429687-121.441406.054687-133.933594 109.046875-242.898438 242.976562-242.898438 64.992188.027344 125.996094 25.324219 171.871094 71.238281 45.871094 45.914063 71.125 106.945313 71.101562 171.855469-.058593 133.929688-109.066406 242.910157-242.972656 242.910157-.007812 0 .003906 0 0 0h-.105468c-40.664063-.015626-80.617188-10.214844-116.105469-29.570313zm134.769531-77.75 7.378907 4.371093c31 18.398438 66.542969 28.128907 102.789062 28.148438h.078125c111.304688 0 201.898438-90.578125 201.945313-201.902344.019531-53.949218-20.964844-104.679687-59.09375-142.839844-38.132813-38.160156-88.832031-59.1875-142.777344-59.210937-111.394531 0-201.984375 90.566406-202.027344 201.886719-.015625 38.148437 10.65625 75.296875 30.875 107.445312l4.804688 7.640625-20.40625 74.5zm0 0"/><path d="m195.183594 152.246094c-4.546875-10.109375-9.335938-10.3125-13.664063-10.488282-3.539062-.152343-7.589843-.144531-11.632812-.144531-4.046875 0-10.625 1.523438-16.1875 7.597657-5.566407 6.074218-21.253907 20.761718-21.253907 50.632812 0 29.875 21.757813 58.738281 24.792969 62.792969 3.035157 4.050781 42 67.308593 103.707031 91.644531 51.285157 20.226562 61.71875 16.203125 72.851563 15.191406 11.132813-1.011718 35.917969-14.6875 40.976563-28.863281 5.0625-14.175781 5.0625-26.324219 3.542968-28.867187-1.519531-2.527344-5.566406-4.046876-11.636718-7.082032-6.070313-3.035156-35.917969-17.726562-41.484376-19.75-5.566406-2.027344-9.613281-3.035156-13.660156 3.042969-4.050781 6.070313-15.675781 19.742187-19.21875 23.789063-3.542968 4.058593-7.085937 4.566406-13.15625 1.527343-6.070312-3.042969-25.625-9.449219-48.820312-30.132812-18.046875-16.089844-30.234375-35.964844-33.777344-42.042969-3.539062-6.070312-.058594-9.070312 2.667969-12.386719 4.910156-5.972656 13.148437-16.710937 15.171875-20.757812 2.023437-4.054688 1.011718-7.597657-.503906-10.636719-1.519532-3.035156-13.320313-33.058594-18.714844-45.066406zm0 0" fill-rule="evenodd"/></g></svg></a>';

        var socials = jQuery('<div>', {});
        socials.css({'display': 'flex', 'align-items': 'center', 'justify-content': 'center', 'width': '100%'});
        socials.append(facebookIcon, twitterIcon, telegramIcon, whatsappIcon);

        var inputWrapper = jQuery('<div>', {});
        inputWrapper.css({
            'display': 'flex',
            'align-items': 'center',
            'justify-content': 'space-between',
            'width': '100%',
            'margin-top': '15px'
        });
        var input = jQuery('<input>', {});
        input.prop('readonly', true);
        input.css({
            'width': '100%',
            'height': '40px',
            'border-radius': '5px',
            'border': '1px solid #f0f0f0',
            'background': '#f2f2f2',
            'text-align': 'left'
        });

        input.val(url);
        var copyButton = jQuery('<a>', {});
        copyButton.attr('href', '#');
        copyButton.html('');
        copyButton.css({'margin-left': '6px', 'font-weight': '700', 'font-size': '12px'});
        copyButton.addClass("share-copy-btn")
        copyButton.click(function (e) {
            e.preventDefault();
            input.focus().select();
            document.execCommand('copy');
            if (!jQuery('#share-box-message').length) {
                shareBox.append('<span id="share-box-message" style="color:#27ae60;font-weight:700;font-size:12px;margin-top:15px;display:block;">کپی شد!</span>');
            }
            setTimeout(function () {
                jQuery('#share-box-message').slideUp(200);
            }, 3000);
            setTimeout(function () {
                jQuery('#share-box-message').remove();
            }, 3100);
        });

        inputWrapper.append(copyButton, input);

        shareBox.append(triangle, socials, inputWrapper);
        jQuery('.share-wrapper').append(shareBox);
    }
});


// validator


function validateField(fields){
    let validator = [];
    let validate={};
    fields.forEach(function (field){
        switch (field.type){
            case "mobile":
                if (field.value==="" || field.value===null || field.value===undefined){
                    validate.status=false;
                    var obj={
                        "validation":false,
                        "message":"شماره موبایل خود را وارد کنید",
                        'id':field.id
                    }
                }
                else if(/^[0][9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/.test(field.value) === false){
                    validate.status=false;
                    var obj={
                        "validation":false,
                        "message":"شماره موبایل وارد شده معتبر نیست.",
                        'id':field.id
                    }
                }
                else {
                    var obj ={
                        "validation":true,
                        'id':field.id
                    }
                }
                break;

            case "email":
                if (field.value==="" || field.value===null || field.value===undefined){
                    validate.status=false;
                    var obj={
                        "validation":false,
                        "message":"ایمیل خود را وارد نمایید.",
                        'id':''
                    }
                }
                else if(/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(field.value) === false){
                    validate.status=false;
                    var obj={
                        "validation":false,
                        "message":"ایمیل وارد شده معتبر نیست.",
                        'id':''
                    }
                }
                else {
                    var obj ={
                        "validation":true,
                        'id':field.id
                    }
                }
                break;
            case "password":
                if (field.value==="" || field.value===null || field.value===undefined){
                    validate.status=false;
                    var obj={
                        "validation":false,
                        "message":"کد ارسالی خود را وارد نمایید."
                    }
                }
                else if(field.value.length <10 && field.value.length>5){
                    validate.status=false;
                    var obj={
                        "validation":false,
                        "message":"کد ارسال شده معتبر نیست."
                    }
                }
                else {
                    var obj ={
                        "validation":true,
                        'id':field.id
                    }
                }
                break;
            case "string":
                if (field.value==="" || field.value===null || field.value===undefined){
                    validate.status=false;
                    var obj={
                        "validation":false,
                        "message":field.name+" را وارد نمایید ",
                        'id':field.id
                    }
                }
                else {
                    var obj ={
                        "validation":true,
                        'id':field.id
                    }
                }
                break;
            case "postalcode":
                if (field.value==="" || field.value===null || field.value===undefined){
                    validate.status=false;
                    var obj={
                        "validation":false,
                        "message":"کدپستی خود را وارد نمایید.",
                        'id':field.id
                    }
                }
                else if(/\b(?!(\d)\1{3})[13-9]{4}[1346-9][013-9]{5}\b/.test(field.value) === false){
                    validate.status=false;
                    var obj={
                        "validation":false,
                        "message":"کدپستی وارد شده معتبر نیست.",
                        'id':field.id
                    }
                }
                else {
                    var obj ={
                        "validation":true,
                        'id':field.id
                    }
                }
                break;
        }
        validator.push(obj)
    })
    validate.messages=validator;
    return validate

}
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

$('.tool-carousel').owlCarousel({
    // loop:true,
    margin:30,
    nav:true,
    rtl:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
});




    /* Text and Arc 1 */
    $( "#arc-01" ).on( "mouseenter", function() {$( "#text-01" ).css({"display": "block", "transform": "scale(1.5);"});$( "#text-02" ).css({"display": "none"});})
    .on( "mouseleave", function() {var styles = { display : "none"}; $( "#text-01" ).css( styles ); $( "#text-02" ).css({"display": "block"});});

    /* Text and Arc 2 */
    $( "#arc-02" ).on( "mouseenter", function() {$( "#text-02" ).css({"display": "block"});})
    .on( "mouseleave", function() {var styles = { display : "block"}; $( "#text-02" ).css( styles );});

    /* Text and Arc 3 */
    $( "#arc-03" ).on( "mouseenter", function() {$( "#text-03" ).css({"display": "block"});$( "#text-02" ).css({"display": "none"});})
    .on( "mouseleave", function() {var styles = { display : "none"}; $( "#text-03" ).css( styles ); $( "#text-02" ).css({"display": "block"});});

    /* Text and Arc 4 */
    $( "#arc-04" ).on( "mouseenter", function() {$( "#text-04" ).css({"display": "block"});$( "#text-02" ).css({"display": "none"});})
    .on( "mouseleave", function() {var styles = { display : "none"}; $( "#text-04" ).css( styles ); $( "#text-02" ).css({"display": "block"});});

    /* Text and Arc 5 */
    $( "#arc-05" ).on( "mouseenter", function() {$( "#text-05" ).css({"display": "block"});$( "#text-02" ).css({"display": "none"});})
    .on( "mouseleave", function() {var styles = { display : "none"}; $( "#text-05" ).css( styles ); $( "#text-02" ).css({"display": "block"});});

// Toast
jQuery("#newsTeller").submit(function (e){
    e.preventDefault()
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: ajax_request.url,
        data: {
            'action' : 'add_news_letter',
            "mail":jQuery("#newsTeller input").val(),
        },
        success: function (data) {
            jQuery("#newsTellerToast").css('left','3px')
            jQuery("#newsTeller input").val("");
            setTimeout(function (){
                jQuery("#newsTellerToast").css('left','-350px')
            },3000)
        },
        error: function (errorThrown) {

        }
    });
});
jQuery("#newsTellerToast button").click(function (){
    jQuery("#newsTellerToast").css('left','-350px')
})
// Toast




$('.slider-carousel').owlCarousel({
    loop:true,
    margin:30,
    rtl:true,
    autoplay:true,
    autoPlaySpeed: 5000,
    autoPlayTimeout: 3000,
    autoplayHoverPause: true,
    responsive:{
        0:{
            items:1,
            nav:false,
            dots:true,
        },
        600:{
            items:1,
            nav:false,
            dots:true,
        },
        1000:{
            items:1,
            nav:true,
            dots:false,
        }
    }
});
$('.team-carousels').owlCarousel({
    margin:30,
    touchDrag:true,
    nav:true,
    rtl:true,
    autoplayTimeout:3000,
    loop:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});


// siavash scripts

$('.product-gallery-carousel').owlCarousel({
    // loop:true,
    // margin:30,
    nav:true,
    rtl:true,
    loop:true,
    dots:false,
    responsive:{
        0:{
            items:4,
            margin:5
        },
        600:{
            items:4,
            margin:10
        },
        1000:{
            items:4
        }
    }
});

$(".gallery-item").click(function (){
    let src=$(this).data("src");
    let id="#"+$(this).data("id");
    $(id).attr("src",src);
});
$(".product-category-page .detail-desc-pin").mouseout(function (){
    let id="#"+$(this).data("id");
    $(this).removeClass("active");
    $(id).fadeOut(300);
})
$(".product-category-page .detail-desc-pin").mouseover(function (){
    let id="#"+$(this).data("id");
    $(this).addClass("active");
    $(id).fadeIn(300);
})
$(".product-item").click(function (){
    let id="#"+$(this).data("id")
    $(".single-product-detail").hide();
    $(id).fadeIn();
    $('html, body').animate({
        scrollTop: $("#productItemWrapper").offset().top
    }, 100);
});
function filter_ajax(checked_array){

    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: ajax_request.url,
        data: {
            'action' : 'filter_product',
            "terms":checked_array,
        },
        success: function (data) {
            $(".products-wrapper").html(data.result);
            return true;

        },
        error: function (errorThrown) {

        }
    });
}
$(".product-filter-input").change(function (){
    let sc_width=$( window ).width();
    if (sc_width>768){
        let checked_array=[];
        $(".product-filter-input:checked").each(function (){
            checked_array.push($(this).val())
        })
        filter_ajax(checked_array)
    }

});

$("#filterProducts").click(function (){
    let checked_array=[];
    $(".product-filter-input:checked").each(function (){
        checked_array.push($(this).val())
    })
    filter_ajax(checked_array)
    $(".filter-wrapper").css("top","-2000px");
    $(".overlay").fadeOut(300);
})
$(document).on('click','body .remove-filter',function(){
    let checked_array=[];
    filter_ajax(checked_array)
    $(".product-filter-input:checked").each(function (){
        $(this).prop('checked', false);
    })

    $(".filter-wrapper").css("top","-2000px");
    $(".overlay").fadeOut(300);
});

$(".show-filter").click(function (){
    $(".filter-wrapper").css("top","0px");
    $(".overlay").fadeIn(300);
})
$(".close-filter").click(function (){
    $(".filter-wrapper").css("top","-2000px");
    $(".overlay").fadeOut(300);
})
$(".overlay").click(function (){
    $(".filter-wrapper").css("top","-2000px");
    $(".overlay").fadeOut(300);
})
$(".product-filter-item-header").click(function (){

    var el = $(this).parents(".product-filter-wrapper"),
        curHeight = el.height(),
        autoHeight = el.css('height', 'auto').height();
    if (el.hasClass("active")){
        el.height(curHeight).animate({height: 60}, 100);
    }else {
        el.height(curHeight).animate({height: autoHeight}, 100);
    }
    el.toggleClass("active")


    // $(this).parents(".product-filter-wrapper").toggleClass("active");
    $(this).toggleClass("active");
})


// mahdis js
/* FAQ ACCordion JS */



$('.faq-content .answer').slideUp();
$('.question').click(function(e) {
    e.preventDefault();
    var $this = $(this);
    if ($this.next().hasClass('show')) {
        $this.next().removeClass('show');
        $this.next().slideUp(350);
        $this.parents('.faq-content').removeClass('active');
    } else {
        $this.parents('.faq-content').addClass('active');
        $this.next().toggleClass('show');
        $this.next().slideToggle(350);
        $this.parents('.faq-content').siblings('.active').find('.answer').slideUp();
        $this.parents('.faq-content').siblings('.active').find('.answer').removeClass('show');
        $this.parents('.faq-content').siblings('.active').removeClass('active');

    }
});
// faqs search
$(document).ready(function() {
    $('#faqs_search').keyup(function(e) {
        var s = $(this).val().trim();
        if (s === '') {
            $('#faqs_accordion .faq-content').show();
            return true;
        }
        $('.search-faqs .icon-close').fadeIn();
        $('#faqs_accordion .faq-content:not(:contains(' + s + '))').hide();
        $('#faqs_accordion .faq-content:contains(' + s + ')').show();
        return true;
    });

    // if ($(".blog-page-archive-category").length>0){
    //     $('html,body').animate({
    //         scrollTop: $(window).scrollTop() + 400
    //     });
    // }

});
// contact form
$(document).on('submit','#contactForm',function (e){
    $('.error').remove();
    e.preventDefault()
    $('#contact_botton').addClass('loading');
    let formData=$('#contactForm').serializeArray();
    let $this = $(this);
    // console.log(formData);
    let fields =[
        {
            "type":"mobile",
            "value":$('#mobile').val(),
            "id":"#mobile",
            "name":"",
        },
        {
            "type":"email",
            "value":$('#email').val(),
            "id":"#email",
            "name":"",
        }

    ];
    let validation=validateField(fields);
    let formValidation=true;
    $.each(validation , function (index,value){
        if (!validation.status) {
            formValidation=false;
            if (index === 'messages') {
                $.each(value, function (name, val) {
                    if(val.validation == false){
                        // console.log(val.id , val.message);
                        $(val.id).parent().append('<span class="error">'+val.message+'</span>');
                    }
                })
            }

        }
    });
    if (!formValidation){
        if($('.error').length>0) {
            $('html, body').animate({
                scrollTop: $(".error").offset().top
            });
            $('#contact_botton').removeClass('loading');
            return
        }
    }
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: ajax_request.url,
        data: {
            'action' : 'add_form_entry',
            'data':formData,
            'form':"form",
        },
        success: function (data) {
            if (data.status){
                // alert(data.message)
                $this.append('<span class="success-alert">'+data.message+'</span>');
                setTimeout(function (){
                    $('.success-alert').remove();
                },5000);
                $('#contact_botton').removeClass('loading');
            }else {
                $('#contact_botton').removeClass('loading');
            }

        },
        error: function (errorThrown) {

        }
    });
});
$(document).on("keyup change","#mobile,#postalcode,#phone", function() {
    var val = jQuery(this).val();
    val = val.replace(/۰/g, "0");
    val = val.replace(/۱/g, "1");
    val = val.replace(/۲/g, "2");
    val = val.replace(/۳/g, "3");
    val = val.replace(/۴/g, "4");
    val = val.replace(/۵/g, "5");
    val = val.replace(/۶/g, "6");
    val = val.replace(/۷/g, "7");
    val = val.replace(/۸/g, "8");
    val = val.replace(/۹/g, "9");
    val = val.replace(/٠/g, "0");
    val = val.replace(/١/g, "1");
    val = val.replace(/٢/g, "2");
    val = val.replace(/٣/g, "3");
    val = val.replace(/٤/g, "4");
    val = val.replace(/٥/g, "5");
    val = val.replace(/٦/g, "6");
    val = val.replace(/٧/g, "7");
    val = val.replace(/۸/g, "8");
    val = val.replace(/٩/g, "9");
    jQuery(this).val(val);
});
// mahdis js end
var feature_owl = jQuery('.feature-owl').owlCarousel({
    rtl: true,
    nav: true,
    dots: true,
    loop:true,
    items: 1,
    stagePadding: 0,
});



feature_owl.on('changed.owl.carousel', function(event) {

    jQuery(".feature-content").fadeOut(200);
    setTimeout(function (){
        var data_id = jQuery('.active .feature-img ').attr('data-id');
        console.log(data_id);
        jQuery('#'+data_id).fadeIn();
    },200);
});


$(".mobile-icon").click(function (e){
    e.preventDefault()

    var el = $(this).parents("a").siblings(".sub-menu"),
        curHeight = el.height(),
        autoHeight = el.css('height', 'auto').height();
    if ($(this).hasClass("active")){
        el.height(curHeight).animate({height: 0}, 100);
    }else {
        el.height(curHeight).animate({height: autoHeight}, 100);
    }
    $(this).toggleClass("active")
})

$(".navbar-toggler").click(function (e){
    e.preventDefault()
    $(this).toggleClass("active");
    $(".menu-overlay").toggleClass("active");
    if ($(this).hasClass("active")){
        $(".navbar-collapse").animate({right: 0}, 200)
    }else {
        $(".navbar-collapse").animate({right: -500}, 200)
    }
})
$(".menu-overlay").click(function (){
    $(this).toggleClass("active");
    $(".navbar-toggler").toggleClass("active");
    if ($(this).hasClass("active")){
        $(".navbar-collapse").animate({right: 0}, 200)
    }else {
        $(".navbar-collapse").animate({right: -500}, 200)
    }
})
$(".close-menu").click(function (){
    $(".menu-overlay").toggleClass("active");
    $(".navbar-toggler").toggleClass("active");
    if ($(".menu-overlay").hasClass("active")){
        $(".navbar-collapse").animate({right: 0}, 200)
    }else {
        $(".navbar-collapse").animate({right: -500}, 200)
    }
})



$(document).ready(function() {
    if ( $(window).width() > 748 ) {
        startCarousel();
    } else {
        stopCarousel();
    }
});

$(window).resize(function() {
    if ( $(window).width() > 748 ) {
        startCarousel();
    } else {
        stopCarousel();
    }
});

function startCarousel(){
    $('.event-gallery').owlCarousel({
        loop:true,
        margin:30,
        nav:true,
        rtl:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:4
            },
            1000:{
                items:4
            }
        }
    });
    $('.product-carousel').owlCarousel({
        loop:true,
        margin:30,
        nav:true,
        rtl:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:4
            },
            1000:{
                items:4
            }
        }
    });

    $('.event-carousel').owlCarousel({
        // loop:true,
        margin:30,
        nav:true,
        rtl:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:3
            }
        }
    });

    $('.vending-location-carousel').owlCarousel({
        // loop:true,
        margin:30,
        nav:false,
        rtl:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:5
            },
            1000:{
                items:5
            }
        }
    });

}
function stopCarousel() {
    var owl = $('.desktop-carousel');
    owl.trigger('destroy.owl.carousel');
    owl.addClass('off').removeClass("owl-carousel owl-theme");
}

/******************
 AJAX search
 ****************/
function debounce(fn, delay) {
    var timer = null;
    return function () {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            fn.apply(context, args);
        }, delay);
    };
}
jQuery('.search-close , .search-form .search-remove').click(function(){
    jQuery(".search-results-box").html('');
    jQuery("#search-text").val('');
    jQuery('.search-form .search-remove').fadeOut(400)
});

jQuery(document).ready(function($) {

    jQuery('#search-text').on('input',function(){
        var subject=jQuery(this).val().trim();
        if(subject.length>1){
            jQuery('.search-form .search-remove').fadeOut(400);
        }else{
            jQuery('.search-form .search-remove').fadeOut(400)}
    });
    jQuery("#search-text").keypress(debounce(function (event) {
        // do the Ajax request


        var subject = jQuery(this).val().trim();
        if (subject.length > 2) {
            jQuery.ajax({
                type : 'post',
                url: ajax_request.url,

                data : {
                    action : 'load_search_results',
                    'subject': subject,
                    keyword: jQuery('#search-text').val(),
                },
                dataType: "html"

            }).done(function (data) {
                jQuery('.icon-close.search-remove').fadeIn(400);
                jQuery('.search-loading').fadeOut(400);
                jQuery(".search-results-box").html(data).fadeIn(400);
                jQuery('#head_search form').addClass('sc_open');
            });
        } else {
            jQuery(".search-results-box").html('').fadeOut(400);
        }
    }, 3000));
});
$(document).ready(function ($){
    $('.table-of-contents a').on('click',function (e){
        e.preventDefault();
        let href = $(this).attr('href');
         let top = $(String(href)).offset().top - 60;
        jQuery('html,body').animate({
                scrollTop: top},
            'slow');
    })

        $('.cycle_section a').on('click',function (e){
            e.preventDefault();
            if($('.home').length>0){
                let href = $(this).attr('href');
                let splitHref = href.split("#");
                let top = $(String('#'+splitHref[1])).offset().top - 180;
                jQuery('html,body').animate({
                        scrollTop: top},
                    'slow');
            }else {

                let href = $(this).attr('href');
                function goToURL(href) {
                    location.href = href
                }
                let top = goToURL(href);
                jQuery('html,body').animate({
                        scrollTop: top},
                    'slow');

            }
        })

});

// vending request

$('#module_vending').on('click',function (e){
    e.preventDefault();
    $('#form_request_vending').show();
    $('.request-overlay').addClass('active');
})
$('#form_request_vending .icon-close,.request-overlay').on('click',function (e){
    e.preventDefault();
    $('#form_request_vending').hide();
    $('.request-overlay').removeClass('active');
    $('#form_request_vending').hide();
})
$(document).on('submit','#form_request_vendingform',function (e){
    $('.error').remove();
    e.preventDefault()
    $('#vending_submission').addClass('loading');
    let formData=$('#form_request_vending').serializeArray();
    let mobile = $('#mobile').val();
    let name = $('#form_request_vending #name').val();
    let $this = $(this);
    let fields =[
        {
            "type":"mobile",
            "value":$('#mobile').val(),
            "id":"#mobile",
            "name":"",
        },
        {
            "type":"email",
            "value":$('#email').val(),
            "id":"#email",
            "name":"",
        }

    ];
    let validation=validateField(fields);
    let formValidation=true;
    $.each(validation , function (index,value){
        if (!validation.status) {
            formValidation=false;
            if (index === 'messages') {
                $.each(value, function (name, val) {
                    if(val.validation == false){
                        $(val.id).parent().append('<span class="error">'+val.message+'</span>');
                    }
                })
            }

        }
    });
    if (!formValidation){
        if($('.error').length>0) {
            $('html, body').animate({
                scrollTop: $(".error").offset().top
            });
            $('#vending_submission').removeClass('loading');
            return
        }
    }
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: ajax_request.url,
        data: {
            'action' : 'request_submission',
            'data':$(this).serializeArray(),
            'mobile':mobile,
            'name' : name
        },
        success: function (data) {
            console.log(data);
            if (data.status){
                // alert(data.message)

                $('#form_request_vending').addClass('success');
                $('#form_request_vending').html('<span class="success-alert">'+data.message+'</span>');
                $('#vending_submission').removeClass('loading');
                setTimeout(function (){
                    $('#form_request_vending').removeClass('success');
                    $('#form_request_vending').hide();
                    $('.request-overlay').removeClass('active');
                },5000);

            }else {
                $('#vending_submission').removeClass('loading');
            }

        },
        error: function (errorThrown) {

        }
    });
})


$(".event-main-video-wrapper span").click(function (){
    $(this).siblings("video").trigger('play');
    $(this).siblings("video").addClass("active");
    $(this).toggleClass("active");
});

$(".event-main-video-wrapper video").on("pause", function (e) {
    let video=$(this);
    let span=video.siblings("span");
    video.removeClass("active");
    span.toggleClass("active");
});
$(".event-main-video-wrapper video").on("play", function (e) {
    let video=$(this);
    video.addClass("active");
    let span=video.siblings("span");
    span.toggleClass("active");
});
$(".event-play-btn").click(function (){
    let video=$(this).data("video");
    let aparat=$(this).data("aparat");
    let link=$(this).data("link");
    let name=$(this).data("name");
    let activity=$(this).data("activity");
    if (video.length>0){
        $("#eventVideoModal h5").html(name)
        $("#eventVideoModal h6").html(activity)
        $('#eventVideoModal video source').attr('src', video);
        $("#eventVideoModal video")[0].load();
        $("#eventVideoModal video").trigger('play');
        $(".modal-video-wrapper").show();
        $(".modal-iframe-wrapper").hide();
        var eventVideoModal = new bootstrap.Modal(document.getElementById('eventVideoModal'), {
            keyboard: false
        })
        eventVideoModal.toggle()
    }else if (aparat.length>0){
        $("#eventVideoModal h5").html(name)
        $("#eventVideoModal h6").html(activity)
        let iframe='<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span><iframe src="https://www.aparat.com/video/video/embed/videohash/'+aparat+'/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe></div>';
        $(".modal-video-wrapper").hide();
        $(".modal-iframe-wrapper").show().html(iframe);
        var eventVideoModal = new bootstrap.Modal(document.getElementById('eventVideoModal'), {
            keyboard: false
        })
        eventVideoModal.toggle()
    }else if (link.length>0){
        window.location.href = link;
    }



});
$("#eventVideoModal").on("hidden.bs.modal", function () {
    $("#eventVideoModal video").trigger('pause');
});

// // flip countdown
// function handleTickInit(tick) {
// let time = $('#time_event').val();
//     Tick.helper.interval(function(){
//         let splitTime =time.split('.');
//
//         console.log(Tick.count);
//         tick.value = {
//             sep: '.',
//             days: d[0],
//             hours: d[1],
//             minutes: d[2],
//             seconds: d[3]
//         };
//     });
// }

function addHours(numOfHours, date = new Date()) {
    date.setTime(date.getTime() + numOfHours * 60 * 60 * 1000);

    return date;
}

function handleTickInit(tick) {
    let time = $('#time_event').val();
    let splitTime =time.split('.');
    let date=new Date(splitTime[0]+'-'+splitTime[1]+'-'+splitTime[2]+' '+splitTime[3]+':'+splitTime[4]+':'+splitTime[5]);
    date.toLocaleString('fa', { timeZone: 'Asia/Tehran' })
    Tick.count.down(date).onupdate = function(value) {
        tick.value = value;
    };
}
$(window).on('load', function() {
    let timer = $('.tick').find(".tick-group");
    for(let i=0 ; i < timer.length ; i++){
        let label = [];
        let attrlabel = [];
           label[i] = $(timer[i]).find('.tick-label').data('value');
           attrlabel[i] =  $(timer[i]).find("[data-value='" + label[i] + "']");
            $(attrlabel[i]).parents('.tick-group').addClass( label[i].toLowerCase());
    }
$('.tick-group.days').prepend('<span>روز</span>');
$('.tick-group.hours').prepend('<span>ساعت</span>');
$('.tick-group.minutes').prepend('<span>دقیقه</span>');
$('.tick-group.seconds').prepend('<span>ثانیه</span>');

});
var persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g];
var  arabicNumbers  = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];
var fixNumbers = function (str)
{
    if(typeof str === 'string')
    {
        for(var i=0; i<10; i++)
        {
            str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i);
        }
    }
    return str;
};

Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}
let now=new Date();
let prev=now.setDate(now.getDate() - 40);
now=now.setDate(now.getDate());
let lastPeriod=$('#lastPeriod').persianDatepicker({
    "inline": false,
    "format": "l",
    "viewMode": "day",
    "initialValue": true,
    "maxDate": Date.now(),
    'minDate':prev,
    "autoClose": true,
    "position": "auto",
    "altFormat": "l",
    "altField": "#altfieldExample",
    "onlyTimePicker": false,
    "onlySelectOnDate": false,
    "calendarType": "persian",
    "inputDelay": 800,
    "observer": false,
    "calendar": {
        "persian": {
            "locale": "en",
            "showHint": false,
            "leapYearMode": "algorithmic"
        },
        "gregorian": {
            "locale": "en",
            "showHint": false
        }
    },
    "navigator": {
        "enabled": true,
        "scroll": {
            "enabled": false
        },
        "text": {
            "btnNextText": "<",
            "btnPrevText": ">"
        }
    },
    "toolbox": {
        "enabled": true,
        "calendarSwitch": {
            "enabled": false,
            "format": "MMMM"
        },
        "todayButton": {
            "enabled": true,
            "text": {
                "fa": "امروز",
                "en": "امروز"
            }
        },
        "submitButton": {
            "enabled": true,
            "text": {
                "fa": "تایید",
                "en": "تایید"
            }
        },
        "text": {
            "btnToday": "امروز"
        }
    },
    "timePicker": {
        "enabled": false,
        "step": 1,
        "hour": {
            "enabled": false,
            "step": null
        },
        "minute": {
            "enabled": false,
            "step": null
        },
        "second": {
            "enabled": false,
            "step": null
        },
        "meridian": {
            "enabled": false
        }
    },
    "dayPicker": {
        "enabled": true,
        "titleFormat": "YYYY MMMM"
    },
    "monthPicker": {
        "enabled": true,
        "titleFormat": "YYYY"
    },
    "yearPicker": {
        "enabled": false,
        "titleFormat": "YYYY"
    },
    "responsive": true,

});

$("#periodForm").submit(function (e){
    e.preventDefault();
    let lastPeriodArray=$('#lastPeriod').val().split("/");
    let cycle=parseInt($("#cycle").val());
    let duration=parseInt($("#duration").val());
    let lastPeriodPersianDate=new persianDate([parseInt(fixNumbers(lastPeriodArray[0])),parseInt(fixNumbers(lastPeriodArray[1])),parseInt(fixNumbers(lastPeriodArray[2]))]);
    let lastDays=[];
    let firstDays=[];
    let periodArray=[];
    for(let k = 0; k < 6; k++){
        let firstDayOfMonth=fixNumbers(lastPeriodPersianDate.add('days', cycle*k).format("YYYY,M,D"));
        let lastDayOfMonth=fixNumbers(lastPeriodPersianDate.add('days', cycle*k+duration-1).format("YYYY,M,D"));
        firstDays.push(firstDayOfMonth)
        lastDays.push(lastDayOfMonth)
        let MonthArray=[];
       let j = duration*(k-1);
        for (let i = 0; i < duration; i++) {
            MonthArray[i]=fixNumbers(lastPeriodPersianDate.add('days', cycle*k+i).format("YYYY,M,D"));
            periodArray[j]=fixNumbers(lastPeriodPersianDate.add('days', cycle*k+i).format("YYYY,M,D"));

            j++;
        }
    }
    let calendar=$($(".datepicker-container")[1]).html();
    $($(".datepicker-container")[1]).find(".pwt-btn-next").click();
    calendar+=$($(".datepicker-container")[1]).html();
    $($(".datepicker-container")[1]).find(".pwt-btn-next").click();
    calendar+=$($(".datepicker-container")[1]).html();
    $($(".datepicker-container")[1]).find(".pwt-btn-next").click();
    calendar+=$($(".datepicker-container")[1]).html();
    for(let d = 0; d < 3; d++){
        $($(".datepicker-container")[1]).find(".pwt-btn-prev").click();
    }

    $("#calendar-wrapper").html(calendar)
    $("#calendar-wrapper").find(".pwt-btn-next,.pwt-btn-prev").hide();
    $("#calendar-wrapper").find("td").each(function (){
        if (periodArray.includes($(this).data("date"))){
            $(this).addClass("active-p")
            if (firstDays.includes($(this).data("date"))){
                $(this).addClass("f-p")
            }
            if (lastDays.includes($(this).data("date"))){
                $(this).addClass("l-p")
            }
        }
    })
    $("#calendar-wrapper").find(".other-month").parent().each(function (){
        $(this).css("opacity",0)
    })
})

$("#firstMontPeriod").persianDatepicker({
    "inline": false,
    "format": "LLLL",
    "viewMode": "day",
    "initialValue": true,
    "autoClose": false,
    "position": "auto",
    "altFormat": "lll",
    "altField": "#altfieldExample2",
    "onlyTimePicker": false,
    "onlySelectOnDate": false,
    "calendarType": "persian",
    "inputDelay": 800,
    "observer": true,
    "calendar": {
        "persian": {
            "locale": "en",
            "showHint": true,
            "leapYearMode": "algorithmic"
        },
        "gregorian": {
            "locale": "en",
            "showHint": false
        }
    },
    "navigator": {
        "enabled": true,
        "scroll": {
            "enabled": false
        },
        "text": {
            "btnNextText": "<",
            "btnPrevText": ">"
        }
    },
    "toolbox": {
        "enabled": true,
        "calendarSwitch": {
            "enabled": false,
            "format": "MMMM"
        },
        "todayButton": {
            "enabled": false,
            "text": {
                "fa": "امروز",
                "en": "Today"
            }
        },
        "submitButton": {
            "enabled": false,
            "text": {
                "fa": "تایید",
                "en": "Submit"
            }
        },
        "text": {
            "btnToday": "امروز"
        }
    },
    "timePicker": {
        "enabled": false,
        "step": 1,
        "hour": {
            "enabled": false,
            "step": null
        },
        "minute": {
            "enabled": false,
            "step": null
        },
        "second": {
            "enabled": false,
            "step": null
        },
        "meridian": {
            "enabled": true
        }
    },
    "dayPicker": {
        "enabled": true,
        "titleFormat": "YYYY MMMM"
    },
    "monthPicker": {
        "enabled": true,
        "titleFormat": "YYYY"
    },
    "yearPicker": {
        "enabled": true,
        "titleFormat": "YYYY"
    },
    "responsive": true
});

    // event signup
    var periodDate =  $('#brithdate').persianDatepicker({
        "inline": false,
        "format": "l",
        "viewMode": "day",
        "initialValue": true,
        "maxDate": Date.now(),
        'minDate':prev,
        "autoClose": true,
        "position": [-100,0],
        "altFormat": "l",
        "altField": "#altfieldExample",
        "onlyTimePicker": false,
        "onlySelectOnDate": false,
        "calendarType": "persian",
        "inputDelay": 800,
        "observer": false,
        "calendar": {
            "persian": {
                "locale": "en",
                "showHint": false,
                "leapYearMode": "algorithmic"
            },
            "gregorian": {
                "locale": "en",
                "showHint": false
            }
        },
        "navigator": {
            "enabled": true,
            "scroll": {
                "enabled": false
            },
            "text": {
                "btnNextText": "<",
                "btnPrevText": ">"
            }
        },
        "toolbox": {
            "enabled": true,
            "calendarSwitch": {
                "enabled": false,
                "format": "MMMM"
            },
            "todayButton": {
                "enabled": true,
                "text": {
                    "fa": "امروز",
                    "en": "امروز"
                }
            },
            "submitButton": {
                "enabled": true,
                "text": {
                    "fa": "تایید",
                    "en": "تایید"
                }
            },
            "text": {
                "btnToday": "امروز"
            }
        },
        "timePicker": {
            "enabled": false,
            "step": 1,
            "hour": {
                "enabled": false,
                "step": null
            },
            "minute": {
                "enabled": false,
                "step": null
            },
            "second": {
                "enabled": false,
                "step": null
            },
            "meridian": {
                "enabled": false
            }
        },
        "dayPicker": {
            "enabled": true,
            "titleFormat": "YYYY MMMM"
        },
        "monthPicker": {
            "enabled": true,
            "titleFormat": "YYYY"
        },
        "yearPicker": {
            "enabled": false,
            "titleFormat": "YYYY"
        },
        "responsive": true,

    });

    var eventSignUp = new bootstrap.Modal(document.getElementById('eventSignUp'), {
        keyboard: false
    });
    $('#registerModal').on('click',function (e){
        e.preventDefault();

        eventSignUp.toggle();
    })
    $('.icon-close').on('click',function (){
        eventSignUp.toggle();
    });



// signup event ajax
$(document).on('submit','#formEventSignup',function (e){
    $('.error').remove();
    e.preventDefault()
    $('#eventSignUp_submission').addClass('loading');
    let formData=$('#formEventSignup').serializeArray();
    let mobile = $('#phone').val();
    let name = $('#formEventSignup #name').val();
    let $this = $(this);
    // console.log(formData);
    let fields =[
        {
            "type":"mobile",
            "value":$('#phone').val(),
            "id":"#phone",
            "name":"",
        }
    ];
    let validation=validateField(fields);
    let formValidation=true;
    $.each(validation , function (index,value){
        if (validation.status == false) {
            formValidation=false;
            if (index === 'messages') {
                $.each(value, function (name, val) {
                    if(val.validation == false){
                        $(val.id).parent().append('<span class="error">'+val.message+'</span>');
                    }
                })
            }
            return
        }
    });
    if(formValidation==true){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_request.url,
            data: {
                'action' : 'event_submission',
                'data':$this.serializeArray(),
                'form':"form",
                'mobile':mobile,
                'name' : name
            },
            success: function (data) {
                if (data.status){
                    // alert(data.message)

                    $('#eventSignUp').addClass('success');
                    $('#eventSignUp .modal-body').html('<span class="success-alert">'+data.message+'</span>');
                    $('#eventSignUp_submission').removeClass('loading');
                    setTimeout(function (){
                        eventSignUp.toggle();
                    },5000);

                }else {
                    $('#eventSignUp_submission').removeClass('loading');
                }

            },
            error: function (errorThrown) {

            }
        });
    }

})

document.getElementById('vid').play();

document.addEventListener('DOMContentLoaded', function() {
    var points = document.querySelectorAll('.timeline-point');

    points.forEach(function(point) {
        point.addEventListener('click', function() {
            points.forEach(function(p) { p.classList.remove('active'); });
            point.classList.add('active');
        });
    });
});



document.addEventListener('DOMContentLoaded', function () {
    const blocks = document.querySelectorAll('.timeline__block');

    blocks.forEach(block => {
        block.querySelector('.timeline__dot').addEventListener('click', function () {
            // Remove active class from all blocks and contents
            blocks.forEach(b => {
                b.classList.remove('timeline__block--active');
                b.querySelector('.timeline__content').classList.remove('timeline__content--active');
            });

            // Add active class to the clicked block and content
            block.classList.add('timeline__block--active');
            block.querySelector('.timeline__content').classList.add('timeline__content--active');
        });
    });

    // If there is a first block, make it active
    if (blocks.length > 0) {
        blocks[0].classList.add('timeline__block--active');
        blocks[0].querySelector('.timeline__content').classList.add('timeline__content--active');
    }
});


$(document).ready(function(){
    $('#pills-tab button').on('click', function (event) {
        event.preventDefault();
        $(this).tab('show');
    });
});

// $(function () {
//     $('#myTab li:last-child button').tab('show')
// })




jQuery(document).ready(function($) {
    // Function to change the background image
    function changeBackground(imageUrl) {
        $('.tab-container').css('background-image', 'url(' + imageUrl + ')');
    }

    // Change background on tab click
    $('#myTab a.nav-link').on('click', function(e) {
        e.preventDefault();

        // Change the background image
        var bgImg = $(this).data('background');
        changeBackground(bgImg);

        // Change the active tab
        $(this).tab('show'); // Bootstrap's built-in method to show the tab

        // Update active state for tab buttons
        $('#myTab .nav-link').removeClass('active').css('background-color', '');
        $(this).addClass('active').css('background-color', '#0d6efd');
    });

    // Initially set the background for the first active tab
    var initialBg = $('#myTab a.nav-link.active').data('background');
    changeBackground(initialBg);
});


$('.article-carousel').owlCarousel({
    // loop:true,
    margin:10,
    nav:true,
    dots:true,
    rtl:true,
    // autoplay:true,
    autoplayTimeout:3000,
    loop:true,
    dots:false,
    responsive:{
        0:{
            items:1,
            dots:true,
            nav:false
        },
        600:{
            items:2.2,
            margin:10,
        },
        1000:{
            items:3
        }
    }
});

$('.certificate-logo').owlCarousel({
    margin:10,
    nav:true,
    dots:true,
    rtl:true,
    loop:true,
    responsive:{
        0:{
            items:1,
            dots:true,
            nav:false
        },
        600:{
            items:2.2,
            margin:10,
        },
        1000:{
            items:3
        }
    }
});

$('.certificate-wrapper').owlCarousel({
    loop:true,
    margin:5,
    rtl:true,
    // autoplay:false,
    // autoPlaySpeed: 5000,
    // autoPlayTimeout: 3000,
    // autoplayHoverPause: false,
    responsive:{
        0:{
            items:1,
            nav:false,
            dots:false,
        },
        600:{
            items:2,
            nav:false,
            dots:false,
        },
        1000:{
            items:1,
            nav:true,
            dots:false,
        }
    }
});
