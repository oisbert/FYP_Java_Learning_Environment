var animation = anime({
  targets: '#square',
  translateX: 270,
  delay: function (el, i) { return i * 400; },
  direction: 'alternate',
  borderRadius: ['0%', '50%'],
  loop: true,
  autoplay: false,
  duration: 5000,
  easing: 'easeInOutSine'
});

document.querySelectorAll(".button-play").forEach((el)=> el.onclick = animation.play);
document.querySelectorAll(".button-pause").forEach((el)=> el.onclick = animation.pause);