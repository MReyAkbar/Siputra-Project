// Kita tidak perlu "DOMContentLoaded" karena Vite akan menanganinya.
function initializeChatbot() {
    
    // --- TAHAP 1: MENCARI ELEMEN ---
    const chatWindow = document.getElementById('chat-window');
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-button');
    const csrfMetaTag = document.querySelector('meta[name="csrf-token"]');

    // --- TAHAP 2: VALIDASI ELEMEN ---
    
    // Jika elemen tidak ada di halaman ini, jangan jalankan sisa skrip
    if (!chatWindow || !chatInput || !sendButton) {
        // Ini normal jika kita tidak di halaman chatbot
        return; 
    }

    if (!csrfMetaTag) {
        console.error("DEBUG ERROR: <meta name='csrf-token'> tidak ditemukan. Tambahkan '<meta name=\"csrf-token\" content=\"{{ csrf_token() }}\">' ke <head> di file layout utama Anda.");
        return; // Hentikan eksekusi
    }
    
    const csrfToken = csrfMetaTag.getAttribute('content');
    console.log("DEBUG INFO: Elemen chat dan CSRF token berhasil ditemukan. Event listener dipasang.");

    // --- TAHAP 3: FUNGSI ---
    function sendMessage() {
        const message = chatInput.value.trim();
        if (message === "") return;

        addMessageToChat(message, true);
        chatInput.value = "";
        
        chatInput.disabled = true;
        chatInput.placeholder = "Thinking...";

        fetch('/api/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(errorData => {
                    let errorMessage = errorData.reply || errorData.message || 'An unknown server error occurred.';
                    throw new Error(errorMessage);
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.reply) {
                addMessageToChat(data.reply, false);
            } else {
                addMessageToChat("I received a response, but it was empty.", false);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            addMessageToChat(error.message, false);
        })
        .finally(() => {
            chatInput.disabled = false;
            chatInput.placeholder = "Type your message...";
            chatInput.focus();
        });
    }

    function addMessageToChat(message, isUser = false) {
        const messageElement = document.createElement('div');
        
        if (isUser) {
            messageElement.className = 'bg-blue-600 text-white p-3 rounded-lg w-3/4 ml-auto';
        } else {
            messageElement.className = 'bg-gray-100 text-gray-800 p-3 rounded-lg w-3/4 mr-auto';
        }
        
        messageElement.innerText = message;
        chatWindow.appendChild(messageElement);
        chatWindow.scrollTop = chatWindow.scrollHeight;
    }

    // --- TAHAP 4: MEMASANG EVENT LISTENER ---
    sendButton.addEventListener('click', sendMessage);
    
    chatInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            sendMessage();
        }
    });
}

// Jalankan fungsi kita
initializeChatbot();