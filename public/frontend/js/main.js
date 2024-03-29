(function($) {
var windowWidth = $(window).width();
$('.navbar-toggle').on('click', function(){
	$('#mobile-nav').slideToggle(300);
});

$('.select-2-cntlr').select2();

if( $('.hamburgar-cntlr').length ){
  $('.hamburgar-cntlr').click(function(){
    $('body').toggleClass('allWork');
  });
}
if(windowWidth <=767){
    if( $('ul > li.menu-item-has-children').length ){
      $('ul > li.menu-item-has-children').click(function(){
       $(this).find('.sub-menu').slideToggle(300);
       $(this).toggleClass('sub-menu-arrow');
     });
    }
}
if($("ul.slick-dots li").length == 1){
   $("ul.slick-dots").hide();
}
if($('.mHc').length){
  $('.mHc').matchHeight();
};
if($('.mHc1').length){
  $('.mHc1').matchHeight();
};
if($('.mHc2').length){
  $('.mHc2').matchHeight();
};
if($('.mHc3').length){
  $('.mHc3').matchHeight();
};
if($('.mHc4').length){
  $('.mHc4').matchHeight();
};
if($('.mHc5').length){
  $('.mHc5').matchHeight();
};
if($('.mHc6').length){
  $('.mHc6').matchHeight();
};
$(window).load(function() {
  if($('.mHc').length){
    $('.mHc').matchHeight();
  };
  if($('.mHc1').length){
    $('.mHc1').matchHeight();
  };
  if($('.mHc2').length){
    $('.mHc2').matchHeight();
  };
  if($('.mHc3').length){
    $('.mHc3').matchHeight();
  };
  if($('.mHc4').length){
    $('.mHc4').matchHeight();
  };
  if($('.mHc5').length){
    $('.mHc5').matchHeight();
  };
  if($('.mHc6').length){
    $('.mHc6').matchHeight();
  };
});

$(window).scroll(function() {
  var scroll = $(window).scrollTop();
  $('.page-banner-bg').css({
    '-webkit-transform' : 'scale(' + (1 + scroll/2000) + ')',
    '-moz-transform'    : 'scale(' + (1 + scroll/2000) + ')',
    '-ms-transform'     : 'scale(' + (1 + scroll/2000) + ')',
    '-o-transform'      : 'scale(' + (1 + scroll/2000) + ')',
    'transform'         : 'scale(' + (1 + scroll/2000) + ')'
  });
});


if($('.fancybox').length){
$('.fancybox').fancybox({
  });

}

if ($('.toggle-btn').length) {
  $('.toggle-btn').on('click', function(){
    $(this).toggleClass('menu-expend');
    $('.toggle-bar ul').slideToggle(500);
  });
}
if( $('.responsive-slider').length ){
    $('.responsive-slider').slick({
      dots: true,
      infinite: false,
      autoplay: true,
      autoplaySpeed: 4000,
      speed: 700,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
}

(function() {
  'use strict';
  window.addEventListener('load', function() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

$('.bln-accordion-hdr').on('click', function(){
  $(this).toggleClass('active');
  $(this).parents('.cmn-questions').siblings().find('.bln-accordion-hdr').removeClass('active');
  $(this).parents('.cmn-questions').find('.bln-accordion-des').slideToggle(300);
  $(this).parents('.cmn-questions').siblings().find('.bln-accordion-des').slideUp(300);
});

  if( $('.companyItemTagSlider').length ){
    $('.companyItemTagSlider').slick({
      dots: false,
      infinite: false,
      arrows: true,
      autoplay: false,
      autoplaySpeed: 4000,
      speed: 700,
      slidesToShow: 6,
      slidesToScroll: 6,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 5,
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 4,
          }
        },
        {
          breakpoint: 575,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
          }
        },
        {
          breakpoint: 479,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          }
        }
      ]
    });
}

var expertiseC = $('.expertise-filters-module ul li').length;
var expertiseC1 = expertiseC - 6;
if (expertiseC > 6) {
  $('.explr-fltr-expertise-mdul-cntlr').addClass('explr-fltr-expertise-mdul-extra-hide');
  $('.explore-filter-more').append("+" + expertiseC1 + "<span>more</span>");
  $('.explore-filter-more').click(function(){
    $('.expertise-filters-module').addClass('expertise-filters-module-fheight');
    $('.explr-fltr-expertise-mdul-cntlr').removeClass('explr-fltr-expertise-mdul-extra-hide').addClass('item-expended');
  });
  $('.explore-filter-less').click(function(){
    $('.expertise-filters-module').removeClass('expertise-filters-module-fheight');
    $('.explr-fltr-expertise-mdul-cntlr').addClass('explr-fltr-expertise-mdul-extra-hide').removeClass('item-expended');
  });
}

var containerWidth = $('.container').width();
var offset = (windowWidth - containerWidth);
var rgtOffSet = (offset / 2);
$('.service-lft-img').css('margin-right', rgtOffSet);

$(window).resize(function(){
  var windowWidth = $(window).width();
  var containerWidth = $('.container').width();
  var offset = (windowWidth - containerWidth);
  var rgtOffSet = (offset / 2);
  $('.service-lft-img').css('margin-right', rgtOffSet);
});

if(windowWidth > 639){
  if( $('#sidebar').length ){
    $('#sidebar').stickySidebar({
        topSpacing: 50,
        bottomSpacing: 50
    });
  }  
}

if(windowWidth <= 767){
  if( $('.hireProSlider').length ){
    $('.hireProSlider').slick({
      dots: true,
      infinite: true,
      autoplay: false,
      arrows: false,
      autoplaySpeed: 1000,
      speed: 700,
      slidesToShow: 1,
      slidesToScroll: 1
    });
  }
}
if(windowWidth <= 767){
    $('.HowItWorksSlider').slick({
      dots: true,
      infinite: true,
      autoplay: true,
      arrows: false,
      autoplaySpeed: 4000,
      speed: 700,
      slidesToShow: 2,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 575,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
}

if(windowWidth > 767){
  if($('.tol-tip').length){
    $('.tol-tip').mouseenter(function(){
      $(this).addClass('tol-tip-cntlr');
    });
    $('.tol-tip-des').mouseenter(function(){
      $(this).parent().find('.tol-tip').addClass('tol-tip-cntlr');
    })
    $('.tol-tip-des').mouseleave(function(){
      $(this).parent().find('.tol-tip').removeClass('tol-tip-cntlr');
    })
    $('.tol-tip').mouseleave(function(){
      $(this).removeClass('tol-tip-cntlr');
    });
  };
}else{

  if($('.tol-tip').length){

    $('.tol-tip').on('click',function(){
       $(this).parents('.form-block').siblings().find('.tol-tip-cntlr').removeClass('tol-tip-cntlr');
      $(this).toggleClass('tol-tip-cntlr');

    })

  };
}



if($('#bln-nav').length){
  $('#bln-nav').onePageNav({
    scrollThreshold: 0.1,
  });
}


if($('.fancybox').length){
  $(document).ready(function() {
    $(".fancybox").fancybox();
  });
}

$('.create-a-job-form .select-2-cntlr-multi').select2({
  placeholder: 'Select tags',
});
$('.select-2-cntlr').select2();

if($('.input-tol-tip').length){
  $('.input-tol-tip').mouseenter(function(){
    $(this).addClass('tol-tip-cntlr');
  });
  $('.input-tol-tip').mouseleave(function(){
    $(this).removeClass('tol-tip-cntlr');
  });
};


/* 
* account settings ui elements
*/
if($('#file').length){
  $('#file').change( function(e){
    var fileValue = e.target.files[0].name;
    $('.file-upload-here.file1').html("<span>" +  fileValue + "</span> ");
  });
}
if($('#file2').length){
  $('#file2').change( function(e){
    var fileValue2 = e.target.files[0].name;
    $('.file-upload-here.file2').html("<span>" +  fileValue2 + "</span> ");
  });
}

/* 
* create-a-job
*/
if($('#file3').length){
  $('#file3').change( function(e){
    var fileValue3 = e.target.files[0].name;
    $('.file-upload-here').html("<span style='padding-top: 8px;'>" +  fileValue3 + "</span> ");
  });
}

/* 
* edit-job-posting
*/
if($('#file4').length){
  $('#file4').change( function(e){
    var fileValue4 = e.target.files[0].name;
    $('.file-upload-here').html("<span style='padding-top: 8px;'>" +  fileValue4 + "</span> ");
  });
}

/* 
* Messege
*/
if($('#file5').length){
  $('#file5').change( function(e){
    var fileValue5 = e.target.files[0].name;
    $('.file-upload-here').html("<span style='padding-top: 8px;'>" +  fileValue5 + "</span> ");
  });
}

/* 
* Profile image 
*/
if($('#profile').length){
  $('#profile').change( function(e){ 
    var image = document.getElementById('pro_image');
    image.src = URL.createObjectURL(event.target.files[0]);
  });
}


$(document).ready(function() {
  $('body').addClass('jsLoaded');
});


$(window).load(function() {
 
});

// if($('.job-cntnt-item-copy a').length){
//   $('.job-cntnt-item-copy a').click( function(e){ 
//     e.preventDefault();
//     $(this).closest('.job-cntnt-item').toggleClass('expended');
//     $(this).parents('.job-cntnt-item').find('.job-cntnt-item-lft .expend-module').slideToggle();
//   });
// }
if($('.mgs-s-switch').length){
  $('.mgs-s-switch').click( function(e){ 
    e.preventDefault();
    $(this).closest('.job-cntnt-item').toggleClass('expended');
    $(this).next('.mgs-settings').slideToggle();
  });
}



if($('.input-field-label-col').length){
  $('.input-field-label-col input').each(function(){
    $(this).on("keyup", function(e){
      var labelVal = $(this).val();
      if (labelVal != '') {
        $(this).parent('.input-field-label-col').find('label').hide();
        /*$('.input-field-label-col label').hide();*/
      }else{
        /*$('.input-field-label-col label').show();*/
        $(this).parent('.input-field-label-col').find('label').show();
      }
    });
  });
}

if($('.flexible-input').length){
  $('.flexible-input').each(function(){
    $(this).on("keyup", function(e){
      var labelVal = $(this).text();
      if (labelVal != '') {
        $(this).addClass('has-value');
      }else{
        $(this).removeClass('has-value');
      }
      $(this).next('input').val(labelVal);
      console.log($(this).next('input').val());
    });
  });
}

if($('.flexible-textarea').length){
  $('.flexible-textarea').each(function(){
    $(this).on("keyup", function(e){
      var labelVal = $(this).text();
      if (labelVal != '') {
        $(this).addClass('has-value');
      }else{
        $(this).removeClass('has-value');
      }
      $(this).next('input').val(labelVal);
      console.log($(this).next('input').val());
    });
  });
}

$('.create-a-job-form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});

$('#pro-edit-account-submit').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});


if($('input#tags').length){
  $('input#tags').tagsinput({
    trimValue: true
  });
}

$('.filter-menu').on('click', function(){
  $('body').addClass('has-filter');
});
$('.close-filter').on('click', function(){
  $('body').removeClass('has-filter');
});

$('.bln-messege-company-list ul li a.chat-window').on('click', function(e){
  e.preventDefault();
  var wind = $(this).attr('href');
  $('.bln-messege-company-list ul li').removeClass('active');
  $(this).parents('li').addClass('active');
});

$('.jc-brief a.jc-e-full').on('click', function(e){
  e.preventDefault();
  $(this).parents('.job-cntnt-item-des').find('.jc-brief').hide();
  $(this).parents('.job-cntnt-item-des').find('.jc-full').show();
});

$(window).scroll(function(){
  var sticky = $('body'),
      scroll = $(window).scrollTop();

  if (scroll >= 150) sticky.addClass('has-to-top');
  else sticky.removeClass('has-to-top');
});

$('.to-top').on('click', function(e){
  e.preventDefault();
  $("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
});

})(jQuery);