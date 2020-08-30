import Camera from './Camera.js';
import Timer from './Timer.js';
import {loadLevel} from './loaders/level.js';
import {createMario} from './entities.js';
import {createCollisionLayer, createCameraLayer} from './layers.js';
import {setupKeyboard} from './input.js';
import {setupMouseControl} from './debug.js';
import trimCanvas from './trimCanvas.js'
import getKey from './getKey.js'
const canvas = document.getElementById('screen');
const context = canvas.getContext('2d');

Promise.all([ //wait the promise synchronous
    createMario(),
    loadLevel('1-1'),
])
.then(([mario, level]) => {
    const camera = new Camera(); //creating camera uses later
    window.camera = camera;

    mario.pos.set(64, 64);

    // level.comp.layers.push(
    //     createCollisionLayer(level),
    //     createCameraLayer(camera));
    

    level.entities.add(mario);

    const input = setupKeyboard(mario);
    input.listenTo(window);

    //setupMouseControl(canvas, mario, camera);


    const timer = new Timer(1/60); // split 1 second into 60 frames
    timer.update = function update(deltaTime) {
        level.update(deltaTime); //use timer and requestAnimationFrame for drawing 60 * per second 

        if(mario.pos.x > 100) {
            camera.pos.x = mario.pos.x -100; //setting up camera who follows mario when he reach a certain amount of canvas x
        }

        level.comp.draw(context, camera);
    }

    timer.start(); //finally , we begin the start of timer for multiple mathematics functionnality
});

document.body.addEventListener('keydown', function (e) {
    var key = getKey(e);
    if (!key) {
        return console.warn('No key for', e.keyCode);
    }
    key.classList.add('pressed');
});
document.body.addEventListener('keyup', function (e) {
    var key = getKey(e);
    key && key.classList.remove('pressed');
});