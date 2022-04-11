//create animation for fade in effect on the posts page using anime.js
anime({
    //targets the .posts div
    targets: '.Posts',
    //move the posts 110% to 0%
    translateX: () => ["110%", "0%"],
     //opacity slides from 0 to 1
    opacity: [0, 1],
    //for a duration of 1500
    duration: 1500,
    //ease in effect
    easing: 'easeInOutQuart',
  }); 
  