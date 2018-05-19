var stars = [];
var speed;

function windowResized (){
   resizeCanvas(windowWidth,windowHeight);
   background(20, 20, 20);
}

function setup() {
   createCanvas(windowWidth, windowHeight);
   for (var i = 0; i < 500; i++) {
      stars[i] = new Star();
   }
}

function draw() {
   background(20, 20, 20);

   var d = dist(mouseX, mouseY, width/2, height/2);
   var dMax = dist(0, 0, width/2, height/2);
   speed = map(d, dMax, 0, 0, 50);

   translate(width/2, height/2);
   for (var i = 0; i < stars.length; i++) {
      stars[i].update();
      stars[i].show();
   }
}
