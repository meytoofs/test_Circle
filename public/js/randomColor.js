// function randomColor() {
//     let letters = document.querySelector('#mario_logo').innerHTML.split('');
//     console.log(letters)
//     color = ['#E52521', '#049CD8', '#43B047', '#FBD000'] // [red, blue, green, yellow]
//     for (var i = 0; i < letters.length; i++)
//     {
//         html = '';
//         randomizeColor = color[Math.floor(Math.random() * color.length)]
//         element = '<span style="color: ' + randomizeColor + '">' + letters[i] + '</span>';
//         letters.innerHTML = element;
//         console.log(element);
//     }
//     console.log(letters)
// }
// randomColor();
function changeColor() {
    var paragraphs = document.getElementsByTagName("a");
    color = ['#E52521', '#049CD8', '#43B047', '#FBD000'] // [red, blue, green, yellow]
    for(var i = 0; i < paragraphs.length; i++)
    {
        var innerText = paragraphs[i].innerText;
        var innerTextSplit = innerText.split("");
        paragraphs[i].innerText = ""
        
        for(var j = 0; j < innerTextSplit.length; j++) {
            // var randomColor = "rgb(" + Math.floor((Math.random() * 255) + 1) + ", " + Math.floor((Math.random() * 255) + 1) + ", " + Math.floor((Math.random() * 255) + 1) + ");"
            var randomColor = color[Math.floor(Math.random() * color.length)]
            innerTextSplit[j] = '<span style="color: ' + randomColor + '">' + innerTextSplit[j] + '</span>';
            paragraphs[i].innerHTML += innerTextSplit[j];
        }
    }
}
changeColor();