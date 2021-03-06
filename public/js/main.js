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

Promise.all([
    createMario(),
    loadLevel('1-1'),
])
.then(([mario, level]) => {
    const camera = new Camera();
    window.camera = camera;

    mario.pos.set(64, 64);

    // level.comp.layers.push(
    //     createCollisionLayer(level),
    //     createCameraLayer(camera));


    level.entities.add(mario);

    const input = setupKeyboard(mario);
    input.listenTo(window);

    //setupMouseControl(canvas, mario, camera);


    const timer = new Timer(1/60);
    timer.update = function update(deltaTime) {
        level.update(deltaTime);

        if(mario.pos.x > 100) {
            camera.pos.x = mario.pos.x -100;
        }

        level.comp.draw(context, camera);
    }

    timer.start();
});
document.body.addEventListener('keydown', function (e) {
    var key = getKey(e);
    if (!key) {
        return console.warn('No key for', e.keyCode);
    }

    key.setAttribute('data-pressed', 'on');
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