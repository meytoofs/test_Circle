import Entity from './Entity.js';
import Go from './traits/Go.js';
import Jump from './traits/Jump.js';
import {loadSpriteSheet} from './loader.js';
import {createAnim} from './anim.js';

const SLOW_DRAG = 1/1000;
const FAST_DRAG = 1/5000;

export function createMario() {
    return loadSpriteSheet('mario')
    .then(sprite => {
        const mario = new Entity();
        mario.size.set(14, 16);

        mario.addTrait(new Go());
        mario.go.dragFactor = SLOW_DRAG;
        mario.addTrait(new Jump());

        mario.turbo = function setTurboState(turboOn) {
            mario.go.dragFactor = turboOn ? FAST_DRAG : SLOW_DRAG;

        }

        const runAnim = createAnim(['run-1', 'run-2', 'run-3'], 6);
        function routeFrame(mario) {
            if (mario.jump.falling) {
                return 'jump'
            }
            if (mario.go.distance > 0) {
                if (mario.vel.x > 0 && mario.go.dir <0 || mario.vel.x < 0 && mario.go.dir > 0) {
                    return 'break';
                }
                return runAnim(mario.go.distance);
            }

            return 'idle';
        }

        mario.draw = function drawMario(context) {
            sprite.draw(routeFrame(this), context, 0, 0, this.go.heading < 0);
        }

        return mario;
    });
}