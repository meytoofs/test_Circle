import Camera from './Camera.js';
import Timer from './Timer.js';
import {loadLevel} from './loaders/level.js';
import {loadEntities} from './entities.js';
import {setupKeyboard} from './input.js';
import {createCollisionLayer} from './layers.js';
import getKey from './getKey.js'


const canvas = document.getElementById('screen');
const context = canvas.getContext('2d');

Promise.all([
    loadEntities(),
    loadLevel('1-1'),
])
.then(([entity, level]) => {
    console.log(entity);

    const camera = new Camera();
    window.camera = camera;

    const mario = entity.mario();
    mario.pos.set(64, 64);

    const goomba = entity.goomba();
    goomba.pos.x = 220;
    level.entities.add(goomba);

    const glitch = entity.glitch();
    glitch.pos.x = 300;
    level.entities.add(glitch);

    level.entities.add(mario);

    // level.comp.layers.push(createCollisionLayer(level));

    const input = setupKeyboard(mario);
    input.listenTo(window);

    const timer = new Timer(1/60);
    timer.update = function update(deltaTime) {
        level.update(deltaTime);

        if (mario.pos.x > 100) {
            camera.pos.x = mario.pos.x - 100;
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
    key.classList.add('pressed');
});
document.body.addEventListener('keyup', function (e) {
    var key = getKey(e);
    key && key.classList.remove('pressed');
});