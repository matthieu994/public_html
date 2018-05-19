var rain = [];
var sound;

function windowResized(){
	resizeCanvas(windowWidth,windowHeight);
}

function preload() {
	sound = loadSound('rain.mp3');
}

function setup() {
	sound.loop();
	sound.rate(0.7);
	sound.amp(0.05);
   createCanvas(windowWidth, windowHeight);
   background(145, 25, 60);
   textFont('Roboto');
   for (var i = 0; i < 500; i++) {
      rain[i] = new Drop();
   }
}

function draw() {
   background(145, 25, 60);
   for (var i = 0; i < rain.length; i++) {
      rain[i].fall();
      rain[i].show();
   }
}
