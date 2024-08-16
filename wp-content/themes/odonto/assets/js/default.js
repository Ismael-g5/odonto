function applyClassIfMobile() {
    if (window.matchMedia("(orientation: portrait)").matches) {
        document.getElementById('content-icon-1').classList.add('d-flex');
        document.getElementById('content-icon-2').classList.add('d-flex');
        document.getElementById('content-icon-3').classList.add('d-flex');
    }
}

applyClassIfMobile();

window.addEventListener('orientationchange', applyClassIfMobile);


$(document).ready(function() {
    function applyClassIfMobile() {
        if (window.matchMedia("(orientation: portrait)").matches) {
            $('#content-icon-1').addClass('d-flex');
            $('#content-icon-2').addClass('d-flex');
            $('#content-icon-3').addClass('d-flex');

        
            $('#text-icon-1').addClass('d-flex align-items-center px-4');
            $('#text-icon-2').addClass('d-flex align-items-center px-4');
            $('#text-icon-3').addClass('d-flex align-items-center px-4');

        }
    }

    applyClassIfMobile();

    $(window).on('orientationchange', applyClassIfMobile);
});
