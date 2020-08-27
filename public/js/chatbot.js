const talk = document.querySelector('.talk');
const voice2text = document.querySelector('.voice2text');

const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
const recorder = new SpeechRecognition();

function botVoice(message) {
    const speech = new SpeechSynthesisUtterance();
    if(message.includes('je vais bien merci')) {
        speech.text = "Ah ben bravo la politesse !";
        console.log(speech);
    }
    else if(message.includes('je vais bien et toi')) {
        speech.text = "quel gentillesse de demander à un programme si il va bien :) Je suis en pleine santé sans bug ;D"
        console.log(speech);
    };
    speech.volume = 1;
    speech.rate = 1;
    speech.pitch = 1;
    window.speechSynthesis.speak(speech);
}

recorder.onstart = () => {
    console.log('la voix est activé, vous pouvez parler');
};

recorder.onresult = (event) => {
    const current = event.resultIndex;
    const transcript = event.results[current][0].transcript;
    voice2text.innerHTML = transcript;
    botVoice(transcript);
    console.log(transcript);
};

talk.addEventListener('click', () => {
    recorder.start();
})