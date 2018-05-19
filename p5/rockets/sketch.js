// Daniel Shiffman
// http://codingtra.in
// http://patreon.com/codingtrain
// Code for: https://youtu.be/bGz7mv2vD6g

var population;
// Each rocket is alive till 500 frames
var lifespan = 350;
// Made to display count on screen
var lifeP;
// Keeps track of frames
var count = 0;
// Where rockets are trying to go
var target;
// Max force applied to rocket
var maxforce = 0.3;

// Dimensions of barrier
var rx;
var ry;
var rw;
var rh;

function setup() {
	createCanvas(windowWidth, windowHeight);
	population = new Population();
	lifeP = createP();
	target = createVector(width / 2, 100);

	rh = random(5, 25);
	rw = random(width/5, width/2);
	rx = (width-rw)/2;
	ry = height/2;
}

function draw() {
	background(145, 25, 60);
	population.run();
	// Displays count to window
	lifeP.html(lifespan - count);

	count++;
	if (count == lifespan) {
		population.evaluate();
		population.selection();
		// Population = new Population();
		count = 0;
	}
	// Renders barrier for rockets
	fill(255);
	noStroke();
	rect(rx, ry, rw, rh);
	// Renders target
	ellipse(target.x, target.y, 20, 20);
}
