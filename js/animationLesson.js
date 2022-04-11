//animate the lessons page using anime.js
//select the div grid-item
var buttonEl = document.querySelectorAll('.grid-item');

//create a function to animate the button
function animateButton(el, scale, duration, elasticity) {
  anime.remove(el);
  //set the item names
  anime({
    targets: el,
    scale: scale,
    duration: duration,
    elasticity: elasticity
  });
}

function enterButton(el) {
  //move the button scale 1.1, duration 800, and elasticity animation 200
  animateButton(el, 1.1, 800, 200)
};

function leaveButton(el) {
  //when we hover off the button rescale
  animateButton(el, 1.0, 600, 300)
};
//wait for mouse to hover over targeted button
for (var i = 0; i < buttonEl.length; i++) {
  //if the current button is hovers run the function enterButton
  buttonEl[i].addEventListener('mouseenter', function(e) {
    enterButton(e.target);
  }, false);
  //if the user hovers off the button run the animation leaveButton
  buttonEl[i].addEventListener('mouseleave', function(e) {
    leaveButton(e.target)
  }, false);  
}