var buttonEl = document.querySelectorAll('#animatebutton');

function animateButton(el, scale, duration, elasticity) {
  anime.remove(el);
  anime({
    targets: el,
    scale: scale,
    duration: duration,
    elasticity: elasticity
  });
}

function enterButton(el) {
  animateButton(el, 1.1, 800, 200)
};

function leaveButton(el) {
  animateButton(el, 1.0, 600, 300)
};

for (var i = 0; i < buttonEl.length; i++) {
  buttonEl[i].addEventListener('mouseenter', function(e) {
    enterButton(e.target);
  }, false);
  
  buttonEl[i].addEventListener('mouseleave', function(e) {
    leaveButton(e.target)
  }, false);  
}