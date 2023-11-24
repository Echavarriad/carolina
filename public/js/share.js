(function () {
  "use strict";

  var WEBSITE = WEBSITE || {};
  WEBSITE.var = {};
  WEBSITE.var.window = jQuery(window);

  var $j = jQuery.noConflict();

  WEBSITE.page = {
        init: function () {
        $j('.btn_action_wtspp').click(function(event) {
            const number = $j(this).data('whatsapp');
            let text = $j(this).data('text_whatsapp');
            event.preventDefault();
            if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
                // Para enviar whatsapp mobile
                if (number == '') {
                   var LinkTextToShare = 'https://api.whatsapp.com/send?text=' + text;
                }else{
                   var LinkTextToShare = 'https://api.whatsapp.com/send?phone=+57' + number + '&text=' + text;
                }
           } else {
               //Enviar en móvil
               if (number == '') {
                   var LinkTextToShare = 'https://web.whatsapp.com/send?l=es&text=' + text;
                }else{
                   var LinkTextToShare = 'https://web.whatsapp.com/send?l=es&phone=+57'+number+'&text=' + text;
                }                     
           }
            window.open(LinkTextToShare, "_blank");
        });
      
    $j('.btn_share_facebook').click(function(event) {
        let urlShare = $j(this).data('url');
        event.preventDefault();
        var urlFacebook = 'http://www.facebook.com/share.php?u='+urlShare;
        window.open(urlFacebook, "Creaciones Dulcy","status = 1, height = 500, width = 500, resizable = 0");
    });  
    
    $j('.btn_share_twitter').click(function(event) {
        let urlShare = $j(this).data('url');
        var urlTwitter = 'http://twitter.com/intent/tweet?status=Creaciones Dulcy - '+ urlShare;
        window.open(urlTwitter, "Creaciones Dulcy","status = 1, height = 500, width = 500, resizable = 0");
    });
      
    $j('.btn_share_whatsapp').click(function(event) {
        let urlShare = $j(this).data('url');
        event.preventDefault();
        if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
            // Para enviar whatsapp mobile
            var LinkTextToShareMobile = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(urlShare);
            window.open(LinkTextToShareMobile, "_blank");
        } else {
            // Para enviar whatsapp web
            var LinkTextToShare = 'https://web.whatsapp.com/send?l=en&text=' + encodeURIComponent(urlShare);
            window.open(LinkTextToShare, "_blank");
    }
    });
    }
};

WEBSITE.onReady = {
    init: function () {
        WEBSITE.page.init();
    }
};

$j(function () {
    WEBSITE.onReady.init();
});

})();