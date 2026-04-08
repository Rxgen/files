(function ($) {
    'use strict';
    var player = {};

    window.onYouTubeIframeAPIReady = function () {
        $('body')
            .addClass('yt-ready')
            .find('[data-youtube-id]').one('click', function () {
                var id = this.getAttribute('data-youtube-id');

                if ( id ) {
                    player[id] = new YT.Player($(this).find('.youtube-video:first').get(0), {
                        videoId: id,
                        playerVars: {rel: 0},
                        events: {
                            onReady: function (e) {
                                e.target.playVideo();
                                e.target.unMute();
                            }
                        }
                    });
                }
            });
    };

    $('head').append('<script async src="https://www.youtube.com/iframe_api"></script>');
}.call(window, window.jQuery));