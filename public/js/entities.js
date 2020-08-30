import Entity from './Entity.js';
import Go from './traits/Go.js';
import Jump from './traits/Jump.js';
import {loadSpriteSheet} from './loader.js';
import {createAnim} from './anim.js';

const SLOW_DRAG = 1/1000; //use early for setting mario Speed x when "run" is not pressed
const FAST_DRAG = 1/5000; // change mario speed x when  "run" is pressed

export function createMario() {
    return loadSpriteSheet('mario') //call function with "mario" name and parameter
    .then(sprite => {
        const mario = new Entity(); //create mario Entity
        mario.size.set(14, 16); // Adding (x,y) size for tiles Collider

        mario.addTrait(new Go()); //Adding traits for moving
        mario.go.dragFactor = SLOW_DRAG; //This is for setting Mario speed
        mario.addTrait(new Jump()); //Adding traits for jump 

        mario.turbo = function setTurboState(turboOn) {
            mario.go.dragFactor = turboOn ? FAST_DRAG : SLOW_DRAG; // setting mario speed with a ternaire operation 

        }

        const runAnim = createAnim(['run-1', 'run-2', 'run-3'], 6); //each 6 frames, we load a new sprites from mario when 
        function routeFrame(mario) {
            if (mario.jump.falling) {
                return 'jump' //if mario falling, continue "mario jump tiles"
            }
            if (mario.go.distance > 0) { // when mario move
                if (mario.vel.x > 0 && mario.go.dir < 0 || mario.vel.x < 0 && mario.go.dir > 0) { //a little bit technics, basically, condition is mirrored
                    return 'break'; // break are sprites of mario when he turns violently into the opposite sides
                }
                return runAnim(mario.go.distance);
            }

            return 'idle'; //else return just mario standing
        }

        mario.draw = function drawMario(context) {
            sprite.draw(routeFrame(this), context, 0, 0, this.go.heading < 0);
        }

        return mario;
    });
}