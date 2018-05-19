class Drop {
   constructor() {
      this.x = random(width);
      this.y = random(-600, -50);
      this.z = random(20);
      this.yspeed = map(this.z, 0, 20, 0, 20);
      this.length = map(this.z, 0, 20, 10, 40);
   }

   fall() {
      this.y += this.yspeed;
      this.yspeed += map(this.z, 0, 20, 0.01, 0.2);
   }

   show() {
      if (this.y > height) {
         this.x = random(width);
         this.y = random(-500, -100);
         this.z = random(20);
         this.yspeed = map(this.z, 0, 20, 0, 10);
         this.length = map(this.z, 0, 20, 10, 40);
      }
      strokeWeight(map(this.z, 0, 20, 1, 3));
      stroke(224, 34, 89);
      line(this.x, this.y, this.x, this.y + this.length);
   }
}
