var cells = [];
var cWidth;
var cHeight;
var loop;
var time;
var maxTime;
var next;

var prevX;
var prevY;

var pattern;
var count;

function windowResized(){
	resizeCanvas(windowWidth,windowHeight-50);
	cWidth = width/cells.length;
	cHeight = height/cells[0].length;
}

function setup() {
	createCanvas(windowWidth,windowHeight-50);
	for (var i = 0; i < width/15; i++) {
		cells[i] = [];
		for (var j = 0; j < height/15; j++) {
			cells[i][j] = new Cell(i, j);
		}
	}
	cWidth = width/cells.length;
	cHeight = height/cells[0].length;

	count = 0;
	loop = true; next = false;
	time = 0;
	maxTime = document.getElementById('range').max - document.getElementsByTagName('input')[0].value + 1;
	pattern = document.getElementById('dropdown').value;

	document.getElementsByTagName('button')[0].addEventListener('click', function() {
		next = true;
	});
}

function draw() {
	drawGrid();
	noStroke();
	loop = document.getElementById('loop').checked;
	maxTime = document.getElementById('range').max - document.getElementsByTagName('input')[0].value + 1;
	for (var i = 0; i < cells.length; i++) {
		for (var j = 0; j < cells[0].length; j++) {
			cells[i][j].show();
			if((time >= maxTime && loop) || next) {
				cells[i][j].update();
			}
		}
	}
	if((time >= maxTime && loop) || next) {
		time = 0;
		document.getElementsByTagName('output')[0].innerHTML = count++;
		for (var i = 0; i < cells.length; i++) {
			for (var j = 0; j < cells[0].length; j++) {
				cells[i][j].preLive = cells[i][j].live;
			}
		}
	}
	time++;

	if(document.getElementById('dropdown').value != pattern) {
		pattern = document.getElementById('dropdown').value;
		setPattern();
	}
	if(next) next = false;
}

function drawGrid() {
	background(10);
	stroke(40);
	for (var i = 0; i <= cells[0].length; i++) {
		line(0, i*cHeight, width, i*cHeight);
		for (var j = 0; j <= cells.length; j++) {
			line(j*cWidth, 0, j*cWidth, height);
		}
	}
}

function mousePressed() {
	var x = floor(mouseX/cWidth);
	var y = floor(mouseY/cHeight);
	if(y >= cells[0].length) return;
	if(cells[x][y].live) {
		cells[x][y].setLive(false);
	} else {
		cells[x][y].setLive(true);
	}
}
function mouseDragged() {
	var x = floor(mouseX/cWidth);
	var y = floor(mouseY/cHeight);
	if(y >= cells[0].length || (x == prevX && y == prevY)) return;
	if(cells[x][y].live) {
		cells[x][y].setLive(false);
	} else {
		cells[x][y].setLive(true);
	}
	prevX = x;
	prevY = y;
}

function setPattern() {
	for (var i = 0; i < cells.length; i++) {
		for (var j = 0; j < cells[0].length; j++) {
			cells[i][j].setLive(false);
		}
	}
	count = 0;
	var i = floor(cells.length/2);
	var j = floor(cells[0].length/2);
	if(pattern == 'glider') {
		cells[i][j].setLive(true);
		cells[i+1][j].setLive(true);
		cells[i+2][j].setLive(true);
		cells[i+2][j-1].setLive(true);
		cells[i+1][j-2].setLive(true);
	}
	if(pattern == 'small_exploder') {
		cells[i][j-1].setLive(true);
		cells[i][j].setLive(true);
		cells[i][j+2].setLive(true);
		cells[i-1][j].setLive(true);
		cells[i-1][j+1].setLive(true);
		cells[i+1][j].setLive(true);
		cells[i+1][j+1].setLive(true);
	}
	if(pattern == 'exploder') {
		cells[i][j-2].setLive(true);
		cells[i][j+2].setLive(true);
		cells[i-2][j-2].setLive(true);
		cells[i-2][j-1].setLive(true);
		cells[i-2][j].setLive(true);
		cells[i-2][j+1].setLive(true);
		cells[i-2][j+2].setLive(true);
		cells[i+2][j-2].setLive(true);
		cells[i+2][j-1].setLive(true);
		cells[i+2][j].setLive(true);
		cells[i+2][j+1].setLive(true);
		cells[i+2][j+2].setLive(true);
	}
	if(pattern == '10cell_row') {
		cells[i-1][j].setLive(true);
		cells[i-2][j].setLive(true);
		cells[i-3][j].setLive(true);
		cells[i-4][j].setLive(true);
		cells[i-5][j].setLive(true);
		cells[i][j].setLive(true);
		cells[i+1][j].setLive(true);
		cells[i+2][j].setLive(true);
		cells[i+3][j].setLive(true);
		cells[i+4][j].setLive(true);
	}
	if(pattern == 'spaceship') {
		cells[i][j].setLive(true);
		cells[i][j+2].setLive(true);
		cells[i+1][j-1].setLive(true);
		cells[i+2][j-1].setLive(true);
		cells[i+3][j-1].setLive(true);
		cells[i+4][j-1].setLive(true);
		cells[i+4][j].setLive(true);
		cells[i+4][j+1].setLive(true);
		cells[i+3][j+2].setLive(true);
	}
	if(pattern == 'tumbler') {
		cells[i-2][j].setLive(true); cells[i+2][j].setLive(true);
		cells[i-1][j].setLive(true); cells[i+1][j].setLive(true);
		cells[i-1][j+1].setLive(true); cells[i+1][j+1].setLive(true);
		cells[i-2][j+1].setLive(true); cells[i+2][j+1].setLive(true);
		cells[i-1][j+2].setLive(true); cells[i+1][j+2].setLive(true);
		cells[i-1][j+3].setLive(true); cells[i+1][j+3].setLive(true);
		cells[i-1][j+4].setLive(true); cells[i+1][j+4].setLive(true);
		cells[i-3][j+3].setLive(true); cells[i+3][j+3].setLive(true);
		cells[i-3][j+4].setLive(true); cells[i+3][j+4].setLive(true);
		cells[i-3][j+5].setLive(true); cells[i+3][j+5].setLive(true);
		cells[i-3][j+5].setLive(true); cells[i+3][j+5].setLive(true);
		cells[i-2][j+5].setLive(true); cells[i+2][j+5].setLive(true);
	}
	if(pattern == 'spaceship_generator') {
		cells[i][j+2].setLive(true);
		cells[i][j+3].setLive(true);
		cells[i-1][j+2].setLive(true);
		cells[i-1][j+3].setLive(true);
		cells[i-8][j+3].setLive(true);
		cells[i-8][j+4].setLive(true);
		cells[i-9][j+2].setLive(true);
		cells[i-9][j+4].setLive(true);
		cells[i-10][j+2].setLive(true);
		cells[i-10][j+3].setLive(true);
		cells[i-16][j+4].setLive(true);
		cells[i-16][j+5].setLive(true);
		cells[i-16][j+6].setLive(true);
		cells[i-17][j+4].setLive(true);
		cells[i-18][j+5].setLive(true);
		cells[i-22][j+1].setLive(true);
		cells[i-22][j+2].setLive(true);
		cells[i-23][j+0].setLive(true);
		cells[i-23][j+2].setLive(true);
		cells[i-24][j+0].setLive(true);
		cells[i-24][j+1].setLive(true);
		cells[i-24][j+12].setLive(true);
		cells[i-24][j+13].setLive(true);
		cells[i-25][j+12].setLive(true);
		cells[i-25][j+14].setLive(true);
		cells[i-26][j+12].setLive(true);
		cells[i-34][j+0].setLive(true);
		cells[i-34][j+1].setLive(true);
		cells[i-35][j+0].setLive(true);
		cells[i-35][j+1].setLive(true);
		cells[i-35][j+7].setLive(true);
		cells[i-35][j+8].setLive(true);
		cells[i-35][j+9].setLive(true);
		cells[i-36][j+7].setLive(true);
		cells[i-37][j+8].setLive(true);
	}
	if(pattern == 'clown') {
		cells[i-1][j].setLive(true); cells[i+1][j].setLive(true);
		cells[i-1][j+1].setLive(true); cells[i+1][j+1].setLive(true);
		cells[i-1][j+2].setLive(true); cells[i+1][j+2].setLive(true);
		cells[i][j+2].setLive(true);
	}
}
