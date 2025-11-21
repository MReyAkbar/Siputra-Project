@extends('layouts.app')

@section('title', 'AI Chatbot - SIPUTRA')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="flex justify-center">
        <div class="w-full lg:w-3/4 xl:w-2/3">
            <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
                
                {{-- Header --}}
                <div class="p-5 bg-gradient-to-r from-blue-600 to-blue-700">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white bg-opacity-20 p-1 rounded-lg backdrop-blur-sm">
                                <img src="{{ asset('images/chatbot-avatar.png') }}" alt="Chatbot" class="w-10 h-10 rounded-lg object-cover">
                            </div>
                            <div>
                                <h1 class="text-xl font-bold text-white">AI Chatbot Assistant</h1>
                                <p class="text-blue-100 text-xs">SIPUTRA Virtual Assistant</p>
                            </div>
                        </div>
                        <span class="bg-green-400 text-green-900 text-xs px-3 py-1.5 rounded-full font-semibold flex items-center space-x-1">
                            <span class="w-2 h-2 bg-green-900 rounded-full animate-pulse"></span>
                            <span>Online</span>
                        </span>
                    </div>
                </div>

                {{-- Chat Messages Area --}}
                <div class="p-6 flex flex-col space-y-4 bg-gradient-to-b from-gray-50 to-white" id="chat-window" style="height: 65vh; overflow-y: auto;">
                    {{-- Welcome Message - AI di KIRI --}}
                    <div class="flex items-end space-x-2 max-w-[80%]">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden shadow-lg border-2 border-blue-600">
                            <img src="{{ asset('images/chatbot-avatar.png') }}" alt="Chatbot" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col">
                            <div class="bg-white text-gray-800 p-4 rounded-2xl rounded-bl-sm shadow-md border border-gray-100">
                                <p class="font-semibold text-blue-600 mb-2 text-sm">Selamat datang di SIPUTRA AI Assistant! 👋</p>
                                <p class="text-sm text-gray-700 leading-relaxed">Saya siap membantu Anda dengan informasi tentang produk dan layanan kami. Silakan tanyakan apa saja yang ingin Anda ketahui.</p>
                            </div>
                            <span class="text-xs text-gray-400 mt-1 ml-3">Just now</span>
                        </div>
                    </div>
                </div>

                {{-- Typing Indicator --}}
                <div id="typing-indicator" class="px-6 pb-4 hidden">
                    <div class="flex items-end space-x-2 max-w-[80%]">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden shadow-lg border-2 border-blue-600">
                            <img src="{{ asset('images/chatbot-avatar.png') }}" alt="Chatbot" class="w-full h-full object-cover">
                        </div>
                        <div class="bg-white px-5 py-3 rounded-2xl rounded-bl-sm shadow-md border border-gray-100">
                            <div class="flex space-x-1.5">
                                <div class="w-2.5 h-2.5 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                                <div class="w-2.5 h-2.5 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                                <div class="w-2.5 h-2.5 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Input Area --}}
                <div class="p-5 border-t border-gray-200 bg-white">
                    <form id="chat-form" class="flex items-end space-x-3">
                        <div class="flex-1">
                            <textarea 
                                id="chat-input" 
                                rows="1"
                                class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none" 
                                placeholder="Ketik pesan Anda..."
                                style="max-height: 120px;"
                                required></textarea>
                        </div>
                        
                        <button type="submit"
                                id="send-button"
                                class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-3.5 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all transform hover:scale-105 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none shadow-lg">
                            <i class="bi bi-send-fill text-lg"></i>
                        </button>
                    </form>
                    
                    {{-- Input Area --}}
                    <div class="mt-3 text-xs text-gray-400 text-right">
                        Tekan Enter untuk kirim
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

#chat-window::-webkit-scrollbar {
    width: 6px;
}

#chat-window::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

#chat-window::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

#chat-window::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatWindow = document.getElementById('chat-window');
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-button');
    const chatForm = document.getElementById('chat-form');
    const typingIndicator = document.getElementById('typing-indicator');

    // Auto-resize textarea
    chatInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });

    // Send on Enter (without Shift) - PERBAIKAN
    chatInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            // Trigger submit secara manual
            handleSubmit();
        }
    });

    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // API endpoints
    const apiEndpoint = '/api/chat';

    // Handle form submission - PERBAIKAN UTAMA
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault(); // PENTING: Prevent default form submission
        handleSubmit();
    });

    // Function to handle submit - FUNGSI BARU
    async function handleSubmit() {
        const message = chatInput.value.trim();
        if (!message) return;

        // Disable input
        chatInput.disabled = true;
        sendButton.disabled = true;

        // Display user message
        appendMessage(message, 'user');
        
        // Clear and reset textarea
        chatInput.value = '';
        chatInput.style.height = 'auto';

        // Show typing indicator
        showTypingIndicator();

        try {
            const response = await fetch(apiEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();
            hideTypingIndicator();

            if (response.ok) {
                appendMessage(data.reply, 'bot');
            } else {
                appendMessage('Maaf, terjadi kesalahan. Silakan coba lagi.', 'bot');
            }
        } catch (error) {
            console.error('Error:', error);
            hideTypingIndicator();
            appendMessage('Maaf, tidak dapat terhubung ke server.', 'bot');
        } finally {
            // Re-enable input
            chatInput.disabled = false;
            sendButton.disabled = false;
            chatInput.focus();
        }
    }

    // Function to append message
    function appendMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'animate-fade-in';
        
        const time = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        
        if (sender === 'user') {
            // USER MESSAGE - MEPET KANAN
            messageDiv.innerHTML = `
                <div class="flex items-end justify-end space-x-2 mb-4">
                    <div class="flex flex-col items-end max-w-[80%]">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-4 rounded-2xl rounded-br-sm shadow-lg">
                            <p class="text-sm leading-relaxed break-words">${escapeHtml(text)}</p>
                        </div>
                        <span class="text-xs text-gray-400 mt-1 mr-3">${time}</span>
                    </div>
                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full flex items-center justify-center shadow-lg">
                        <i class="bi bi-person-fill text-gray-700 text-base"></i>
                    </div>
                </div>
            `;
        } else {
            // BOT MESSAGE - KIRI
            messageDiv.innerHTML = `
                <div class="flex items-end space-x-2 mb-4 max-w-[80%]">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden shadow-lg border-2 border-blue-600">
                        <img src="{{ asset('images/chatbot-avatar.png') }}" alt="Chatbot" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col">
                        <div class="bg-white text-gray-800 p-4 rounded-2xl rounded-bl-sm shadow-md border border-gray-100">
                            <div class="text-sm leading-relaxed break-words">${formatBotMessage(text)}</div>
                        </div>
                        <span class="text-xs text-gray-400 mt-1 ml-3">${time}</span>
                    </div>
                </div>
            `;
        }

        chatWindow.appendChild(messageDiv);
        scrollToBottom();
    }

    function formatBotMessage(text) {
        return escapeHtml(text)
            .replace(/\n\n/g, '</p><p class="mt-2">')
            .replace(/\n/g, '<br>')
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.*?)\*/g, '<em>$1</em>');
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function showTypingIndicator() {
        typingIndicator.classList.remove('hidden');
        scrollToBottom();
    }

    function hideTypingIndicator() {
        typingIndicator.classList.add('hidden');
    }

    function scrollToBottom() {
        setTimeout(() => {
            chatWindow.scrollTo({
                top: chatWindow.scrollHeight,
                behavior: 'smooth'
            });
        }, 100);
    }

    // Focus on input when page loads
    chatInput.focus();
});
</script>
@endsection