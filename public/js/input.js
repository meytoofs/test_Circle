import Keyboard from './keyboardState.js'


export function setupKeyboard(mario) {
    // let left = document.getElementById('left').getAttribute('data-keyboard')
    // let right = document.getElementById('right').getAttribute('data-keyboard')
    // let jump = document.getElementById('Space').getAttribute('data-keyboard')
    // let down = document.getElementById('down').getAttribute('data-keyboard')    
    const input = new Keyboard(); //creating the input
    input.addMapping('Space', keyState => {
        if(keyState) {
            mario.jump.start(); // mario begins to jump, increment y axe of mario
        }
        else {
            mario.jump.cancel(); // mario cancel the jump action, decreasing y axe of mario
        }
        //console.log(keyState)
    })

    input.addMapping('KeyS', keyState => {
        mario.turbo(keyState)
    })
    input.addMapping('KeyD', keyState => {
        mario.go.dir += keyState ? 1 : -1;
    })
    input.addMapping('KeyA', keyState => {
        mario.go.dir += keyState ? -1 : 1;
    })
    return input;
}