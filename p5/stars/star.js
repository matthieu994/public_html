class Star {
   constructor() {
      this.x = random(-width, width);
      this.y = random(-height, height);
      this.z = random(width);
   }

   update() {
      this.z -= speed;
      if(this.z < 1) {
         this.x = random(-width, width);
         this.y = random(-height, height);
         this.z = width;
      }
   }

   show() {
      fill(map(this.z, 0, width, 255, 100));
      noStroke();

      var sx = map(this.x / this.z, 0, 1, 0, width);
      var sy = map(this.y / this.z, 0, 1, 0, height);

      var r = map(this.z,0,width,7,0);
      ellipse(sx, sy, r, r);
   }
}
