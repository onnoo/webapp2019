/* CSE3026 : Web Application Development
 * Lab 09 - Maze
 */
"use strict";

var loser = null;  // whether the user has hit a wall

window.onload = function() {
  $("start").observe("click", startClick);
};

// called when mouse enters the walls; 
// signals the end of the game with a loss
function overBoundary(event) {
  var walls = $$(".boundary");
  for (var i = 0; i < walls.length; i++) {
    walls[i].addClassName("youlose");
    walls[i].stopObserving("mouseover");
  }
  document.body.stopObserving("mousemove");
  $("end").stopObserving("mouseover");
  $("status").innerHTML = "You lose! :(";
}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
  var walls = $$(".boundary");
  for (var i = 0; i < walls.length; i++) {
    walls[i].removeClassName("youlose");
    walls[i].observe("mouseover", overBoundary);
  }
  document.body.observe("mousemove", overBody);
  $("end").observe("mouseover", overEnd);
}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
  var walls = $$(".boundary");
  for (var i = 0; i < walls.length; i++) {
    walls[i].stopObserving("mouseover");
  }
  document.body.stopObserving("mousemove");
  $("end").stopObserving("mouseover");
  $("status").innerHTML = "You win! :)";
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
  // console.log(event.element().tagName, event.element().id);
  if (event.element().tagName == 'BODY')
  {
    overBoundary();
  }
}
