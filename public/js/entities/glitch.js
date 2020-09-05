import Entity, {Sides} from '../Entity.js';
import PendulumWalk from '../traits/PendulumWalk.js';
import {loadSpriteSheet} from '../loaders.js';

export function loadGlitch() {
    return loadSpriteSheet('glitch')
    .then(createGlitchFactory);
}

function createGlitchFactory(sprite) {
    const walkAnim = sprite.animations.get('walk');

    function drawGlitch(context) {
        sprite.draw(walkAnim(this.lifetime), context, 0, 0);
    }

    return function createGlitch() {
        const glitch = new Entity();
        glitch.size.set(16, 16);

        glitch.addTrait(new PendulumWalk());

        glitch.draw = drawGlitch;

        return glitch;
    };
}