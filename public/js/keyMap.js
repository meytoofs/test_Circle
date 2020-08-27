const canvas = document.getElementById('screen');
const ctx = canvas.getContext('2d');
function keyMap(event, identifier) {
    ctx.save();
    identifier.value = '';
    var keyCode = event.code
    identifier.setAttribute("data-keyboard", keyCode);
    console.log(keyCode);
    ctx.restore();
}