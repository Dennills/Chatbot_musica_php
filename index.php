<?php
session_start();
unset($_SESSION['chat_history']); // Limpia el historial en cada recarga

if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
}

function addMessage($sender, $message, $type = 'text') {
    $_SESSION['chat_history'][] = [
        'sender' => $sender,
        'message' => $message,
        'type' => $type,
        'timestamp' => date('H:i:s')
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $userMessage = trim($_POST['message']);
    addMessage('user', $userMessage);
    
    // Procesar la respuesta del bot
    $botResponse = processBotResponse($userMessage);
    addMessage('bot', $botResponse);
    
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'response' => $botResponse]);
    exit;
}

function processBotResponse($message) {
    // 1. Saludos
    if (preg_match('/hola|buenos|días|tardes|noches/i', $message)) {
        return "¡Hola! Pídeme canciones con: 'rock', 'pop' o 'electrónica'";
    }

    // 2. Buscar música
    if (preg_match('/rock|pop|electrónica|música|canción/i', $message)) {
        $genre = preg_match('/rock/i', $message) ? 'rock' : 
                (preg_match('/pop/i', $message) ? 'pop' : 'electrónica');
        
        $youtubeData = json_decode(file_get_contents("api/youtube.php?query=".urlencode($genre)), true);
        
        if (!empty($youtubeData['song'])) {
            $song = htmlspecialchars($youtubeData['song']);
            $url = filter_var($youtubeData['url'], FILTER_SANITIZE_URL);
            // Devuelve texto plano con el formato: CANCIÓN | URL
            return "🎵 $song | $url";
        }
    }

    // 3. Respuesta por defecto
    return "Di: 'rock', 'pop' o 'electronica' para recomendaciones";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicBot - Tu asistente musical</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .video-link {
            color: #6c5ce7;
            text-decoration: none;
            word-break: break-all;
            font-size: 0.9em;
        }
        .video-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <div class="bot-info">
                <img src="assets/bot-icon.png" alt="MusicBot" class="bot-avatar">
                <div>
                    <h1>MusicBot</h1>
                    <p class="status">En línea</p>
                </div>
            </div>
            <div class="chat-actions">
                <button class="btn-icon"><i class="fas fa-ellipsis-v"></i></button>
            </div>
        </div>
        
        <div class="chat-messages" id="chat-messages">
            <?php foreach ($_SESSION['chat_history'] as $message): ?>
                <div class="message <?php echo $message['sender']; ?>">
                    <div class="message-content">
                        <?php if ($message['sender'] === 'bot'): ?>
                            <?php
                                // Separar canción y URL si existe
                                $parts = explode('|', $message['message']);
                                $output = $parts[0]; // Parte de la canción
                                
                                if (isset($parts[1])) {
                                    $url = trim($parts[1]);
                                    $url = filter_var($url, FILTER_SANITIZE_URL);
                                    $output .= " <a href='$url' target='_blank' class='video-link'>$url</a>";
                                }
                                
                                echo $output;
                            ?>
                        <?php else: ?>
                            <?php echo htmlspecialchars($message['message']); ?>
                        <?php endif; ?>
                        <span class="message-time"><?php echo $message['timestamp']; ?></span>
                    </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="chat-input">
            <form id="message-form">
                <div class="input-group">
                    <button type="button" class="btn-icon" id="attach-btn"><i class="fas fa-paperclip"></i></button>
                    <input type="text" id="user-message" placeholder="Escribe tu mensaje..." autocomplete="off">
                    <button type="button" class="btn-icon" id="voice-btn"><i class="fas fa-microphone"></i></button>
                    <button type="submit" class="btn-icon send-btn"><i class="fas fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>