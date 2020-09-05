import Entity, {Sides} from '../Entity.js';
import {loadSpriteSheet} from '../loader.js';

export function loadGlitch(){
    return loadSpriteSheet('glitch')
    .then(createGlitchFactory);
}

function createGlitchFactory(sprite) {
    function drawGlitch(context) {
        sprite.draw('glitch', context, 0,0);
    }

    return function createGlitch() {
        const glitch = new Entity();
        glitch.size.set(16,16);

        glitch.addTrait({
            NAME: 'walk',
            speed: 20,
            obstruct(glitch, side) {
                if (side === Sides.LEFT || side === Sides.RIGHT) {
                    this.speed = -this.speed;
                }
            },
            update(glitch) {
                if (glitch.vel.x == 0 ) {
                    this.speed = -this.speed
                }
                // console.log("velocity", glitch.vel.x)
                glitch.vel.x = this.speed;
            }
        })
        glitch.draw = drawGlitch;
        return glitch;
    };
}