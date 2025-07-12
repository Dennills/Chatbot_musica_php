document.addEventListener('DOMContentLoaded', function() {
    const messageForm = document.getElementById('message-form');
    const userMessageInput = document.getElementById('user-message');
    const chatMessages = document.getElementById('chat-messages');
    const voiceBtn = document.getElementById('voice-btn');

    // Scroll al final del chat
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Añadir mensaje al chat con seguridad XSS
    function addMessage(sender, message, type = 'text') {
        const messageElement = document.createElement('div');
        messageElement.className = `message ${sender}`;
        
        const timestamp = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        
        messageElement.innerHTML = `
            <div class="message-content">
                ${type === 'text' ? escapeHtml(message) : message}
                <span class="message-time">${timestamp}</span>
            </div>
        `;

        // Animación de entrada
        messageElement.style.opacity = '0';
        chatMessages.appendChild(messageElement);
        setTimeout(() => {
            messageElement.style.transition = 'opacity 0.3s ease';
            messageElement.style.opacity = '1';
        }, 10);

        scrollToBottom();
    }

    // Prevención XSS
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Indicador de "escribiendo"
    function showTypingIndicator() {
        const typingElement = document.createElement('div');
        typingElement.className = 'typing-indicator';
        typingElement.id = 'typing-indicator';
        typingElement.innerHTML = `
            <span></span>
            <span></span>
            <span></span>
        `;
        chatMessages.appendChild(typingElement);
        scrollToBottom();
    }

    function hideTypingIndicator() {
        const typingElement = document.getElementById('typing-indicator');
        if (typingElement) typingElement.remove();
    }

    // Enviar mensaje a DeepSeek
async function sendToDeepSeek(message) {
    try {
        const response = await fetch(`api/deepseek.php?message=${encodeURIComponent(message)}`);
        if (!response.ok) throw new Error('API error');
        
        let data = await response.text();
        
        // Convertir enlaces en clickables
        data = data.replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank">Ver video</a>');
        
        // Detectar si es respuesta musical
        if (data.includes('(') && data.includes(')')) {
            data = `🎶 ${data}`;
        }
        
        return data;
    } catch (error) {
        console.error('Error:', error);
        return "🎵 No pude conectar con el servicio. Intenta decir: 'recomienda pop' o 'quiero rock'";
    }
}

    // Manejar envío de formulario
    messageForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const message = userMessageInput.value.trim();
        
        if (message) {
            addMessage('user', message);
            userMessageInput.value = '';
            showTypingIndicator();
            
            try {
                const botResponse = await sendToDeepSeek(message);
                hideTypingIndicator();
                
                // Detectar si es un enlace de YouTube
                if (botResponse.includes('youtube.com') || botResponse.includes('youtu.be')) {
                    const videoId = extractYouTubeId(botResponse);
                    if (videoId) {
                        addMessage('bot', `
                            <iframe width="100%" height="200" 
                                src="https://www.youtube.com/embed/${videoId}" 
                                frameborder="0" allowfullscreen>
                            </iframe>
                        `, 'html');
                        return;
                    }
                }
                
                addMessage('bot', botResponse, 'html');
            } catch (error) {
                hideTypingIndicator();
                addMessage('bot', 'Error al conectar con el servidor');
            }
        }
    });

    // Extraer ID de YouTube
    function extractYouTubeId(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? match[2] : null;
    }

    // Reconocimiento de voz
    if ('webkitSpeechRecognition' in window) {
        const recognition = new webkitSpeechRecognition();
        recognition.continuous = false;
        recognition.interimResults = false;
        recognition.lang = 'es-ES';
        
        voiceBtn.addEventListener('click', function() {
            if (voiceBtn.classList.contains('recording')) {
                recognition.stop();
                voiceBtn.classList.remove('recording');
                voiceBtn.innerHTML = '<i class="fas fa-microphone"></i>';
            } else {
                recognition.start();
                voiceBtn.classList.add('recording');
                voiceBtn.innerHTML = '<i class="fas fa-stop"></i>';
            }
        });
        
        recognition.onresult = function(event) {
            userMessageInput.value = event.results[0][0].transcript;
            voiceBtn.classList.remove('recording');
            voiceBtn.innerHTML = '<i class="fas fa-microphone"></i>';
        };
        
        recognition.onerror = function(event) {
            console.error('Error de voz:', event.error);
            voiceBtn.classList.remove('recording');
            voiceBtn.innerHTML = '<i class="fas fa-microphone"></i>';
        };
    } else {
        voiceBtn.style.display = 'none';
    }

    // Saludo inicial
    if (!document.querySelector('.message.bot')) {
        setTimeout(() => {
            addMessage('bot', '🎵 ¡Hola! Soy MusicBot tu asistente personal de musica. Puedo recomendarte canciones de acuerdo a tus gustos 😊. ¿Empezamos? 🚀');
        }, 800);
    }

    // Auto-enfoque
    userMessageInput.focus();
});