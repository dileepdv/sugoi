var Game = (function () {

    var playArea = $('.play-area');
    var start = $('.start');

    var _scoreCount = function () {
        var score = 0;
        $('.square').click(function(){
            $(this).remove();
            $('#score').val(++score);
            $(this).removeClass('square');
        });
    };
    var _startCountDown = function () {
        _scoreCount();
        var time = $('#time').data('time');

        $("#s_timer").countdowntimer({
            seconds: time,
            size: "lg",
            timeUp: _endGame
        });
    };

    var _endGame = function () {
        $('.play-area').remove();
        $('.save-score').removeClass('hide');
    };

    var _startGame = function () {
        $('.start').click(function () {
            playArea.removeClass('hide');
            start.toggle('hide');
            _startCountDown();
        });
    };

    var init = function () {
        _startGame();
    };

    return {
        init: init
    }
})();
