$(document).ready(function(){
    var slider = new MasterSlider();
    slider.setup('masterslider', {
        width: 1920,
        height: 500,
        space: 5,
        autoplay: true,
        loop: true,
        centerControls: false,
        layout: 'fullscreen',
        fullscreenMargin: 0,
        mouse: false,
        view: 'basic',
    });
    slider.control('arrows', {autohide: true});
    slider.control('bullets', {autohide: true, dir: "h", align: "bottom"});
    slider.control('timebar', {autohide: false, align: "bottom", color: "#997438"});
});