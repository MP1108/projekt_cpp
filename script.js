const odpowiedzi = [
    "Yo, dawg, GTA 6 gonna be straight fire!",
    "Who’s your top homie in Los Santos, fam?",
    "You rollin’ with a Banshee or flexin’ a T20?",
    "I’m posted up in Vinewood Hills, you slidin’ through?",
    "How about we hit up Union Depository for a quick lick?",
    "I’m good with a brew over them fancy drinks at Vanilla Unicorn",
    "I’ma call Trevor too, shit’s about to get wild!",
    "Last week I smoked a chopper right over Maze Bank, bruh",
    "I got the ammo on lock, you bring the wheels",
    "Yo, you smashed that Big Score mission yet?"
];

function wyslij() {
    const messageInput = document.getElementById('wiadomosc');
    const chat = document.getElementById('chat');

    const jolkaDiv = document.createElement('div');
    jolkaDiv.classList.add('jolka');

    const jolkaImg = document.createElement('img');
    jolkaImg.src = 'me.jpg';
    jolkaImg.alt = 'Ty';

    const jolkaP = document.createElement('p');
    jolkaP.textContent = messageInput.value;

    jolkaDiv.appendChild(jolkaImg);
    jolkaDiv.appendChild(jolkaP);
    chat.appendChild(jolkaDiv);

    chat.scrollTop = chat.scrollHeight;

    messageInput.value = '';
}

function generuj() {
    const randomIndex = Math.floor(Math.random() * odpowiedzi.length);
    const randomResponse = odpowiedzi[randomIndex];
    const chat = document.getElementById('chat');

    const franklinDiv = document.createElement('div');
    franklinDiv.classList.add('franklin');

    const franklinImg = document.createElement('img');
    franklinImg.src = 'franklin.jpg'; 
    franklinImg.alt = 'Franklin Clinton';

    const franklinP = document.createElement('p');
    franklinP.textContent = randomResponse;

    franklinDiv.appendChild(franklinImg);
    franklinDiv.appendChild(franklinP);
    chat.appendChild(franklinDiv);

    chat.scrollTop = chat.scrollHeight;
}