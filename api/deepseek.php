<?php
header('Content-Type: text/plain; charset=utf-8'); // Cambiado a text/plain

$userMessage = strtolower(trim($_GET['message'] ?? ''));

// 1. |Sistema de respuestas simplificado
$musicKeywords = [
    'rock' => [
        [
            'song' => 'AC/DC - Highway to Hell',
            'url' => 'https://youtu.be/MjAMHH3vysA?si=S9mTTPLQaeQKSgJj'
        ],
        [
            'song' => 'Soda Stereo - Prófugos',
            'url' => 'https://youtu.be/eguctGjUNLI?si=1nNW4pkG0aJkO4Ez'
        ],
        [
            'song' => 'Nirvana - Smells Like Teen Spirit',
            'url' => 'https://www.youtube.com/watch?v=hTWKbhttps://youtu.be/hTWKbfoikeg?si=xAIF64BtCJ_iMzsbfoikeg'
        ],
        [
            'song' => 'Led Zeppelin - Stairway to Heaven',
            'url' => 'https://www.youtuhttps://youtu.be/xbhCPt6PZIU?si=iLEgQaCiPSZv9CNrbe.com/watch?v=xbhCPt6PZIU'
        ],
        [
            'song' => 'The Rolling Stones - Paint It Black',
            'url' => 'https://www.youtube.com/watch?v=O4ihttps://youtu.be/O4irXQhgMqg?si=Icm2QInBDtg83xKqrXQhgMqg'
        ],
        [
            'song' => 'Guns N\' Roses - Sweet Child O\' Mine',
            'url' => 'https://www.youtube.com/watch?v=1w7OgIMhttps://youtu.be/1w7OgIMMRc4?si=wpkxDo38VB128ikNMRc4'
        ]
    ],
    'pop' => [
        [
            'song' => 'Bruno Mars - That\'s What I Like',
            'url' => 'https://www.youtube.com/watch?v=PMivT7MJ41M'
        ],
        [
            'song' => 'Dua Lipa - Don\'t Start Now',
            'url' => 'https://www.youtube.com/watch?v=oygrmJFKYZY'
        ],
        [
            'song' => 'Taylor Swift - Shake It Off',
            'url' => 'https://www.youtube.com/watch?v=nfWlot6h_JM'
        ],
        [
            'song' => 'Ed Sheeran - Shape of You',
            'url' => 'https://www.youtube.com/watch?v=JGwWNGJdvx8'
        ],
        [
            'song' => 'Adele - Rolling in the Deep',
            'url' => 'https://www.youtube.com/watch?v=rYEDA3JcQqw'
        ],
        [
            'song' => 'Michael Jackson - Billie Jean',
            'url' => 'https://www.youtube.com/watch?v=Zi_XLOBDo_Y'
        ]
    ],
    'electrónica' => [
        [
            'song' => 'Avicii - Levels',
            'url' => 'https://www.youtube.com/watch?v=_ovdm2yX4MA'
        ],
        [
            'song' => 'Daft Punk - One More Time',
            'url' => 'https://www.youtube.com/watch?v=FGBhQbmPwH8'
        ],
        [
            'song' => 'Calvin Harris - Summer',
            'url' => 'https://youtu.be/ebXbLfLACGM?si=YtxvsNvrNMe9jwLJ'
        ],
        [
            'song' => 'David Guetta ft. Sia - Titanium',
            'url' => 'https://www.youtube.com/watch?v=JRfuAukYTKg'
        ],
        [
            'song' => 'Swedish House Mafia - Don\'t You Worry Child',
            'url' => 'https://www.youtube.com/watch?v=1y6smkh6c-0'
        ],
        [
            'song' => 'The Chainsmokers ft. Halsey - Closer',
            'url' => 'https://www.youtube.com/watch?v=PT2_F-1esPk'
        ]
    ],
    'reggaeton' => [
        [
            'song' => 'Bad Bunny - Tití Me Preguntó',
            'url' => 'https://www.youtube.com/watch?v=Cr8K88UcO0s'
        ],
        [
            'song' => 'J Balvin - Mi Gente',
            'url' => 'https://www.youtube.com/watch?v=wnJ6LuUFpMo'
        ],
        [
            'song' => 'Daddy Yankee - Gasolina',
            'url' => 'https://www.youtube.com/watch?v=7zp1TbLFPp8'
        ],
        [
            'song' => 'Karol G - Tusa',
            'url' => 'https://www.youtube.com/watch?v=tbneQDc2H3I'
        ],
        [
            'song' => 'Ozuna - Baila Baila Baila',
            'url' => 'https://youtu.be/32F2d-wj4Xw?si=kaFAPh95iqUDaRin'
        ],
        [
            'song' => 'Wisin & Yandel - Rakata',
            'url' => 'https://youtu.be/sN5P4QftaXo?si=zKLN_-ZgwQ2LFvbm'
        ]
    ],
    'jazz' => [
        [
            'song' => 'Miles Davis - So What',
            'url' => 'https://www.youtube.com/watch?v=zqNTltOGh5c'
        ],
        [
            'song' => 'John Coltrane - Giant Steps',
            'url' => 'https://www.youtube.com/watch?v=30FTr6G53VU'
        ],
        [
            'song' => 'Louis Armstrong - What a Wonderful World',
            'url' => 'https://youtu.be/CaCSuzR4DwM?si=iwdN2UL-SiYGkQsd'
        ],
        [
            'song' => 'Ella Fitzgerald & Louis Armstrong - Summertime',
            'url' => 'https://www.youtube.com/watch?v=u2bigf337aU'
        ],
        [
            'song' => 'Dave Brubeck - Take Five',
            'url' => 'https://www.youtube.com/watch?v=vmDDOFXSgAs'
        ],
        [
            'song' => 'Duke Ellington - Take the A Train',
            'url' => 'https://www.youtube.com/watch?v=cb2w2m1JmCY'
        ]
    ],
    'musica peruana' => [
        [
            'song' => 'Eva Ayllón - Mal Paso',
            'url' => 'https://youtu.be/NvxQMshAhb4?si=lwrQ_j0WqoEqhNKy'
        ],
        [
            'song' => 'Los Mirlos - El Poder Verde',
            'url' => 'https://www.youtube.com/watch?https://youtu.be/14sumWTyjyg?si=Th4zkmnwWQe-JDj4v=5X6y0b4GX8I'
        ],
        [
            'song' => 'Chabuca Granda - La Flor de la Canela',
            'url' => 'https://youtu.be/KisngEru6sQ?si=BFVWfeksA7OHQlDP'
        ],
        [
            'song' => 'Jean Pierre Magnet - Amor de Verano',
            'url' => 'https://www.youtube.com/watch?v=6vhttps://youtu.be/5NcSDoND95U?si=kCDFAnONviOXPNHuY0Xw6J9XQ'
        ],
        [
            'song' => 'Pedro Suárez Vértiz - Cuando pienses en volver',
            'url' => 'https://youtu.be/fOBdcuX1FyQ?si=p0-w9-gHh3hfOfL9'
        ],
        [
            'song' => 'Libido - Pero aun sigo viendote',
            'url' => 'https://www.youtube.com/wathttps://youtu.be/cTPjhubNfdk?si=AlifXIeNn8ZjGcXOch?v=3XZ5gXhQrUc'
        ]
    ],
    'salsa' => [
    [
        'song' => 'Héctor Lavoe - El Cantante',
        'url' => 'https://www.youtube.com/watch?v=KfjB690ZTD4'
    ],
    [
        'song' => 'Willie Colón & Rubén Blades - Pedro Navaja',
        'url' => 'https://www.youtube.com/watch?v=5LqnbAkqRYQ'
    ],
    [
        'song' => 'Celia Cruz - La Vida Es Un Carnaval',
        'url' => 'https://www.youtube.com/watch?v=0nBFWzpWXuM'
    ],
    [
        'song' => 'Marc Anthony - Vivir Mi Vida',
        'url' => 'https://www.youtube.com/watch?v=YXnjy5YlDwk'
    ],
    [
        'song' => 'Tito Puente - Oye Como Va',
        'url' => 'https://www.youtube.com/watch?v=BpAXzTpANNw'
    ],
    [
        'song' => 'Grupo Niche - Una Aventura',
        'url' => 'https://www.youtube.com/watch?v=UwnmzIgNzyU'
    ]

    ],
    'hip hop' => [
        [
            'song' => 'Eminem - Lose Yourself',
            'url' => 'https://www.youtube.com/watch?v=_Yhyp-_hX2s'
        ],
        [
            'song' => 'Tupac Shakur - Changes',
            'url' => 'https://www.youtube.com/watch?v=eXvBjCO19QY'
        ],
        [
            'song' => 'The Notorious B.I.G. - Juicy',
            'url' => 'https://www.youtube.com/watch?v=_JZom_gVfuw'
        ],
        [
            'song' => 'Kendrick Lamar - HUMBLE.',
            'url' => 'https://www.youtube.com/watch?v=tvTRZJ-4EyI'
        ],
        [
            'song' => 'Drake - God\'s Plan',
            'url' => 'https://www.youtube.com/watch?v=xpVfcZ0ZcFM'
        ],
        [
            'song' => 'J. Cole - No Role Modelz',
            'url' => 'https://youtu.be/0EnRK5YvBwU?si=DEr7pNgn-Pc5EvVD'
        ]
    ],
'baladas' => [
    [
        'song' => 'Ricardo Arjona - Fuiste Tú',
        'url' => 'https://www.youtube.com/watch?v=I9cCPQVPv8o'
    ],
    [
        'song' => 'Luis Miguel - La Incondicional',
        'url' => 'https://youtu.be/wOjzo02Tmck?si=wATT1KLj57zXnDy7'
    ],
    [
        'song' => 'José José - El Triste',
        'url' => 'https://youtu.be/E20G25SCAEg?si=jwU3mAPok7VYeHMZ'
    ],
    [
        'song' => 'Juan Gabriel - Querida',
        'url' => 'https://youtu.be/mmt4EO3oXSI?si=wlYSEo5Etmyo-Ur2'
    ],
    [
        'song' => 'Camilo Sesto - Perdóname',
        'url' => 'https://youtu.be/SJ1rEU_Whvs?si=mFoIJAJNq5LZFzBy'
    ],
    [
        'song' => 'Mijares - Para Amarnos Más',
        'url' => 'https://youtu.be/DNmueHrg5PA?si=CPFasMidkprGPg2k'
    ]
],

'cumbia' => [
    [
        'song' => 'Grupo 5 - Te Vas',
        'url' => 'https://www.youtube.com/watch?v=YkI04FsN1iU'
    ],
    [
        'song' => 'Armonía 10 - Esperame',
        'url' => 'https://www.youtube.com/watch?v=5X6yhttps://youtu.be/ZzmF-MhmXas?si=YeFfq4063e8KRKf_0b4GX8I'
    ],
    [
        'song' => 'Agua Marina - Paloma Ajena',
        'url' => 'https://www.youtube.com/watch?v=3iQERmlmWeA'
    ],
    [
        'song' => 'Caribeños de Guadalupe - Me Extrañarás',
        'url' => 'https://www.youtube.com/watch?v=mFbNGCZMdiY'
    ],
    [
        'song' => 'Grupo Alegría - Corazón de Piedra',
        'url' => 'https://www.youtube.com/watch?v=aa56ETp7UB4'
    ],
    [
        'song' => 'Los Ecos - La Chismosa',
        'url' => 'https://www.youtube.com/watch?v=9-EkaSUvFyk'
    ]
],


'huayno' => [
    [
        'song' => 'Dina Páucar - Amor Prohibido',
        'url' => 'https://www.youtube.com/watch?v=8vqKVJDQZoY'
    ],
    [
        'song' => 'Jilguero del Huascarán - Pajarillo',
        'url' => 'https://www.youtube.com/watch?v=F94qrKgj75A'
    ],
    [
        'song' => 'Anita Santivañez - Viva Mi Patria',
        'url' => 'https://www.youtube.com/watch?v=jHT1A9tnWp8'
    ],
    [
        'song' => 'Los Hermanos García - Adiós Pueblo de Ayacucho',
        'url' => 'https://www.youtube.com/watch?v=dHXXIkkdh64'
    ],
    [
        'song' => 'Picaflor de los Andes - Valicha',
        'url' => 'https://www.youtube.com/watch?v=QxYExfsybls'
    ],
    [
        'song' => 'Damaris - Corazón Herido',
        'url' => 'https://www.youtube.com/watch?v=9b_MlPGkzWA'
    ]
],


'indie' => [
    [
        'song' => 'Tame Impala - The Less I Know The Better',
        'url' => 'https://www.youtube.com/watch?v=sBzrzS1Ag_g'
    ],
    [
        'song' => 'Arctic Monkeys - Do I Wanna Know?',
        'url' => 'https://www.youtube.com/watch?v=bpOSxM0rNPM'
    ],
    [
        'song' => 'The Strokes - Last Nite',
        'url' => 'https://www.youtube.com/watch?v=b8-tXG8KrWs'
    ],
    [
        'song' => 'Vampire Weekend - A-Punk',
        'url' => 'https://youtu.be/_XC2mqcMMGQ?si=R78v6p414s6sAZ9R'
    ],
    [
        'song' => 'MGMT - Kids',
        'url' => 'https://www.youtube.com/watch?v=bIEOZCcaXzE'
    ],
    [
        'song' => 'Foster the People - Pumped Up Kicks',
        'url' => 'https://www.youtube.com/watch?v=SDTZ7iX4vTQ'
    ]
],

    'musica clasica' => [
        [
            'song' => 'Beethoven - Sinfonía No. 5',
            'url' => 'https://www.youtube.com/watch?v=_4IRMYuE1hI'
        ],
        [
            'song' => 'Mozart - Eine kleine Nachtmusik',
            'url' => 'https://www.youtube.com/watch?v=o1FSN8_pp_o'
        ],
        [
            'song' => 'Vivaldi - Las cuatro estaciones (Primavera)',
            'url' => 'https://www.youtube.com/watch?v=GRxofEmo3HA'
        ],
        [
            'song' => 'Bach - Tocata y fuga en Re menor',
            'url' => 'https://www.youtube.com/watch?v=ho9rZjlsyYY'
        ],
        [
            'song' => 'Tchaikovsky - El lago de los cisnes',
            'url' => 'https://www.youtube.com/watch?v=CShopT9QUzw'
        ],
        [
            'song' => 'Chopin - Nocturno Op. 9 No. 2',
            'url' => 'https://www.youtube.com/watch?v=tV5U8kVYS88'
        ]
    ],

'merengue' => [
    [
        'song' => 'Juan Luis Guerra - Ojalá Que Llueva Café',
        'url' => 'http://www.youtube.com/watch?v=suQC8d-YkeU'
    ],
    [
        'song' => 'Wilfrido Vargas - El Africano',
        'url' => 'http://www.youtube.com/watch?v=MvrNHquxgM4'
    ],
    [
        'song' => 'Sergio Vargas - La Ventanita',
        'url' => 'http://www.youtube.com/watch?v=Yx09-v8KfPs'
    ],
    [
        'song' => 'Los Hermanos Rosario - La Dueña del Swing',
        'url' => 'http://www.youtube.com/watch?v=QCcBiAwp9nc'
    ],
    [
        'song' => 'Fernando Villalona - El Mayimbe',
        'url' => 'http://www.youtube.com/watch?v=dIBmuXnaWpQ'
    ],
    [
        'song' => 'Milly Quezada - Volví a Nacer',
        'url' => 'http://www.youtube.com/watch?v=qXXuv5kI5-g'
    ]
    ],

'chicha peruana' => [
    [
        'song' => 'Los Shapis - El Aguajal',
        'url' => 'http://www.youtube.com/watch?v=6LjPNddITP8'
    ],
    [
        'song' => 'Chacalón y la Nueva Crema - Soy Provinciano',
        'url' => 'http://www.youtube.com/watch?v=d333pd8dhlo'
    ],
    [
        'song' => 'Los Destellos - Elsa',
        'url' => 'http://www.youtube.com/watch?v=5WmckGCocto'
    ],
    [
        'song' => 'Eusebio y su Banjo - La Chichera',
        'url' => 'http://www.youtube.com/watch?v=bI9asWE-zlA'
    ],
    [
        'song' => 'Los Mirlos - El Poder Verde',
        'url' => 'http://www.youtube.com/watch?v=14sumWTyjyg'
    ],
    [
        'song' => 'Juaneco y su Combo - Ya se ha muerto mi abuelo',
        'url' => 'http://www.youtube.com/watch?v=cBQi8PVq4uI'
    ]
    ],
'ranchera' => [
    [
        'song' => 'Vicente Fernández - Volver Volver',
        'url' => 'http://www.youtube.com/watch?v=gZVKe_0n7tg'
    ],
    [
        'song' => 'Javier Solís - Sombras',
        'url' => 'http://www.youtube.com/watch?v=UasiMOoMz1o'
    ],
    [
        'song' => 'Pedro Infante - Amorcito Corazón',
        'url' => 'http://www.youtube.com/watch?v=bb5K3vpNEvw'
    ],
    [
        'song' => 'Jorge Negrete - México Lindo y Querido',
        'url' => 'http://www.youtube.com/watch?v=3L0zULMbu_U'
    ],
    [
        'song' => 'Antonio Aguilar - Un Puño de Tierra',
        'url' => 'http://www.youtube.com/watch?v=mxplRc6a0aQ'
    ],
    [
        'song' => 'Lola Beltrán - Cucurrucucú Paloma',
        'url' => 'http://www.youtube.com/watch?v=mRbARIgjgss'
    ]
    ],
'metal' => [
    [
        'song' => 'Metallica - Enter Sandman',
        'url' => 'http://www.youtube.com/watch?v=CD-E-LDc384'
    ],
    [
        'song' => 'Iron Maiden - The Trooper',
        'url' => 'http://www.youtube.com/watch?v=X4bgXH3sJ2Q'
    ],
    [
        'song' => 'Black Sabbath - Paranoid',
        'url' => 'http://www.youtube.com/watch?v=0qanF-91aJo'
    ],
    [
        'song' => 'Slayer - Raining Blood',
        'url' => 'http://www.youtube.com/watch?v=z8ZqFlw6hYg'
    ],
    [
        'song' => 'Megadeth - Symphony of Destruction',
        'url' => 'http://www.youtube.com/watch?v=3L_isSGyVqU'
    ],
    [
        'song' => 'Pantera - Walk',
        'url' => 'http://www.youtube.com/watch?v=AkFqg5wAuFk'
    ]
    ],
'kpop' => [
    [
        'song' => 'BTS - Dynamite',
        'url' => 'http://www.youtube.com/watch?v=gdZLi9oWNZg'
    ],
    [
        'song' => 'BLACKPINK - DDU-DU DDU-DU',
        'url' => 'http://www.youtube.com/watch?v=IHNzOHi8sJs'
    ],
    [
        'song' => 'EXO - Love Shot',
        'url' => 'http://www.youtube.com/watch?v=pSudEWBAYRE'
    ],
    [
        'song' => 'TWICE - FANCY',
        'url' => 'http://www.youtube.com/watch?v=kOHB85vDuow'
    ],
    [
        'song' => 'PSY - Gangnam Style',
        'url' => 'http://www.youtube.com/watch?v=9bZkp7q19f0'
    ],
    [
        'song' => 'Red Velvet - Psycho',
        'url' => 'http://www.youtube.com/watch?v=uR8Mrt1IpXg'
    ]
]


    
];

$genreMessages = [
    'rock' => '🤘 ¡Súbele al volumen! Este clásico del rock te electrizará:',
    'pop' => '🎤✨ ¡Un hit pop para alegrar tu día!:',
    'electronica' => '🕺💃 ¡Hora de bailar con esta electrónica energética!:',
    'reggaeton' => '🔥🎶 ¡A mover el cuerpo con este reggaetón candente!:',
    'jazz' => '🎷🥃 Relájate con este jazz sofisticado:',
    'música peruana' => '🇵🇪❤️ ¡Un orgullo peruano para tus oídos!:',
    'salsa' => '💃🕺 ¡Sabor y ritmo con esta salsa explosiva!:',
    'hip hop' => '🎤✊ ¡Flow y actitud con este hip hop!:',
    'baladas' => '🎹💖 Emoción pura con esta balada romántica:',
    'cumbia' => '🌴🎉 ¡Fiesta tropical con esta cumbia!:',
    'huayno' => '🏔️🎻 Sentimiento andino en cada nota:',
    'indie' => '🎧🌌 Un viaje sonoro con este indie alternativo:',
    'música clásica' => '🎻🎹 Elegancia atemporal con este clásico:',
    'merengue' => '🍹💃 ¡Sabor caribeño para bailar sin parar!:',
    'chicha peruana' => '🌵🎸 ¡La auténtica chicha peruana!:',
    'ranchera' => '🤠🎶 Puro sentimiento mexicano:',
    'metal' => '👹🤘 ¡Potencia y distorsión con este metal!:',
    'kpop' => '💖🇰🇷 ¡Color y energía del K-pop!:'
];

foreach ($musicKeywords as $genre => $tracks) {
    if (strpos($userMessage, $genre) !== false) {
        $randomIndex = random_int(0, count($tracks) - 1);
        $track = $tracks[$randomIndex];
        $message = $genreMessages[$genre] ?? '¡Disfruta esta canción!';
        echo "{$message} 🎵 {$track['song']} | {$track['url']}";
        exit;
    }
}

// Respuestas personalizadas para "gracias" y "hola"
if (strpos($userMessage, 'gracias') !== false) {
    echo "¡De nada! 😊 Si quieres más música, solo dime un género.";
    exit;
}
if (strpos($userMessage, 'hola') !== false) {
    echo "¡Hola de nuevo! 👋 ¿Qué género musical quieres escuchar hoy?";
    exit;
}

// 3. Respuesta de DeepSeek 
$deepseekUrl = "https://api.deepseek.com/v1/chat/completions";

$data = [
    'model' => 'deepseek-chat',
    'messages' => [
        [
            'role' => 'system',
            'content' => "Eres un experto chatbot musical. Responde exclusivamente sobre música. 
            Formato de respuesta: '[Frase amigable] 🎵 Canción - Artista | [URL de YouTube]'.
            Si el usuario pide algo no musical, responde: 'Solo puedo recomendar música. Prueba con: rock, pop o electronica"
        ],
        ['role' => 'user', 'content' => $userMessage]
    ],
    'temperature' => 0.7
];

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $deepseekUrl,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_RETURNTRANSFER => true
]);

$response = json_decode(curl_exec($ch), true);
curl_close($ch);

// 4. Formatear respuesta
if (!empty($response['choices'][0]['message']['content'])) {
    $responseText = $response['choices'][0]['message']['content'];
    
    // Si pide video, extrae la URL o genera una
    if (strpos($userMessage, 'video') !== false) {
        preg_match('/(https?:\/\/[^\s]+)/', $responseText, $matches);
        $url = $matches[0] ?? 'https://youtube.com/results?search_query=' . urlencode(explode('-', $responseText)[0]);
        
        // Devuelve canción + URL directa (sin etiquetas HTML)
        echo "🎵 $responseText $url";
    } else {
        echo "🎵 $responseText";
    }
} else {
    echo "🎧 ¿Qué género te gustaría escuchar hoy? 🤔 Aquí tienes algunas opciones: rock, pop, indie 🔊";
}
?>