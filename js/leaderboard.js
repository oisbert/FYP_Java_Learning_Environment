//create an animation using anime.js using the function anime
anime({
  //targets the div named leaderboard
    targets: '.leaderboard',
    //move the leaderboard contents in 10%
    translateX: "+=10%",
    //stagger each item in the leaderboard 
    delay: anime.stagger(150, {direction: 'reverse'})
  });