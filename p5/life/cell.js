class Cell {
   constructor(i, j) {
      this.setLive(false);
      this.i = i;
      this.j = j;
   }

   update(i, j) {
      var neighbors = this.check();
      if(!this.live && neighbors == 3) {
         this.live = true;
      } else {
         if(neighbors <= 1 || neighbors >= 4) {
            this.live = false;
         }
      }
   }

   check() {
      var check = 0;
      for (var i = -1; i < 2; i++) {
         for (var j = -1; j < 2; j++) {
            if(this.i + i == -1 || this.j + j == -1 || this.i + i >= cells.length || this.j + j >= cells[0].length) continue;
            if(cells[this.i+i][this.j+j].preLive) check++;
         }
      }
      if(this.live) check--;
      return check;
   }

   show() {
      if(this.live) {
         rect(this.i*cWidth+1, this.j*cHeight+1, cWidth-2, cHeight-2);
      }
   }

   setLive(bool) {
      this.live = bool;
      this.preLive = bool;
   }
}
