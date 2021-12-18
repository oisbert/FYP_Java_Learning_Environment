var squares = anime({
    targets: '.squares',
    //translateY: '100px',
    //borderRadius: 50,
    duration: 2000,
    easing: 'easeInOutQuad',
    //direction: 'alternate',
  });

  var circle = anime({
    targets: '.circle',
    keyframes: [
      {borderRadius: 50}
    ],
    duration: 2000,
    easing: 'easeInOutQuad',
    //direction: 'alternate',
    autoplay: false
  });

var btnPlay = document.querySelector('.play');

btnPlay.addEventListener('click', function(e) {
	e.preventDefault();
	//square.play();
  circle.play();
});