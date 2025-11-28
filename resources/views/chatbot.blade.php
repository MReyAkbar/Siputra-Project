@extends('layouts.app')

@section('title', 'AI Chatbot - SIPUTRA')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="flex justify-center">
        <div class="w-full lg:w-3/4 xl:w-2/3">
            <div class="bg-white shadow-2xl rounded-2xl overflow-hidden flex flex-col h-[80vh]">
                
                {{-- Header --}}
                <div class="p-5 bg-gradient-to-r from-[#0E3E6D] to-[#0F4175]">
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
                <div class="flex-1 p-6 overflow-y-auto bg-slate-50 bg-fish-pattern relative scroll-smooth" id="chat-window">
                    {{-- Welcome Message --}}
                    <div class="flex items-end space-x-2 max-w-[80%]">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden shadow-lg border-2 border-[#0F4175]">
                            <img src="{{ asset('images/chatbot-avatar.png') }}" alt="Chatbot" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col">
                            <div class="bg-white text-gray-800 p-4 rounded-2xl rounded-bl-sm shadow-md border border-gray-100">
                                <p class="font-semibold text-blue-600 mb-2 text-sm">Selamat datang di SIPUTRA AI Assistant! 👋</p>
                                <p class="text-sm text-gray-700 leading-relaxed">Saya siap membantu Anda dengan informasi tentang perusahaan dan layanan kami. Silakan tanyakan apa saja yang ingin Anda ketahui.</p>
                            </div>
                            <span class="text-xs text-gray-400 mt-1 ml-3">Just now</span>
                        </div>
                    </div>

                    {{-- Typing Indicator (Moved INSIDE chat window) --}}
                    <div id="typing-indicator" class="hidden animate-fade-in mt-4 mb-2">
                        <div class="flex items-end space-x-2">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden shadow-lg border-2 border-[#0F4175]">
                                <img src="{{ asset('images/chatbot-avatar.png') }}" alt="Bot" class="w-full h-full object-cover">
                            </div>
                            {{-- Removed bg-gray-200 to make it transparent --}}
                            <div class="px-4 py-3 rounded-2xl rounded-bl-none">
                                <div class="flex space-x-1">
                                    <div class="w-2 h-2 bg-[#0F4175] rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                                    <div class="w-2 h-2 bg-[#0F4175] rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                                    <div class="w-2 h-2 bg-[#0F4175] rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Input Area --}}
                <div class="p-5 bg-gradient-to-r from-[#0E3E6D] to-[#0F4175] border-t border-gray-100">
                    <form id="chat-form" class="relative flex items-center">
                        <textarea 
                            id="chat-input" 
                            rows="1"
                            class="w-full bg-gray-100 border-0 rounded-full pl-6 pr-14 py-4 focus:ring-2 focus:ring-[#FDE047] focus:bg-white transition-all resize-none shadow-inner" 
                            placeholder="Ketik pertanyaan Anda..."
                            style="max-height: 120px;"
                            required></textarea>
                        
                        <button type="submit"
                                id="send-button"
                                class="absolute right-2 bg-[#FDE047] text-[#0F4175] w-10 h-10 rounded-full hover:bg-yellow-600 transition-all shadow-md flex items-center justify-center">
                            <i class="bi bi-send-fill text-sm"></i>
                        </button>
                    </form>

                    {{-- Footer: Quick Buttons & Helper Text Aligned --}}
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mt-4 ml-2 md:ml-6 gap-3 animate-fade-in">
                        {{-- Quick Buttons --}}
                        <div class="flex flex-wrap gap-2">
                            <button onclick="sendQuickMessage('Apa saja layanan yang ditawarkan PT Putra Samudera Nusantara?')" class="bg-white border border-blue-200 text-blue-700 text-xs px-3 py-1.5 rounded-full hover:bg-blue-50 transition-colors shadow-sm">
                                📦 Layanan Kami
                            </button>
                            <button onclick="sendQuickMessage('Apa saja fitur SIPUTRA?')" class="bg-white border border-blue-200 text-blue-700 text-xs px-3 py-1.5 rounded-full hover:bg-blue-50 transition-colors shadow-sm">
                                🤖 Fitur SIPUTRA
                            </button>
                            <button onclick="sendQuickMessage('Dimana lokasi PT Putra Samudera Nusantara?')" class="bg-white border border-blue-200 text-blue-700 text-xs px-3 py-1.5 rounded-full hover:bg-blue-50 transition-colors shadow-sm">
                                📍 Lokasi Kantor
                            </button>
                        </div>

                        {{-- Helper Text --}}
                        <div class="text-[10px] text-[#FDE047] whitespace-nowrap opacity-80">
                            Tekan Enter untuk kirim
                        </div>
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

/* Custom Fish Pattern Class */
.bg-fish-pattern {
    background-image: url('/images/fish-pattern.png'); 
    background-repeat: repeat;
    background-size: 150px auto; 
    background-color: #f8fafc;
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

    // Send on Enter (without Shift)
    chatInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            handleSubmit();
        }
    });

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const apiEndpoint = '/api/chat';

    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        handleSubmit();
    });

    async function handleSubmit() {
        const message = chatInput.value.trim();
        if (!message) return;

        chatInput.disabled = true;
        sendButton.disabled = true;

        appendMessage(message, 'user');
        
        chatInput.value = '';
        chatInput.style.height = 'auto';

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
            chatInput.disabled = false;
            sendButton.disabled = false;
            chatInput.focus();
        }
    }

    // Function to append message
    function appendMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'animate-fade-in w-full';
        
        const time = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        
        if (sender === 'user') {
            // USER MESSAGE
            messageDiv.innerHTML = `
                <div class="flex items-end justify-end mb-4 pl-4">
                    <div class="flex flex-col items-end max-w-[85%]">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-3.5 rounded-2xl rounded-br-none shadow-lg text-left w-fit break-words">
                            <p class="text-sm leading-relaxed whitespace-pre-wrap">${escapeHtml(text)}</p>
                        </div>
                        <span class="text-xs text-gray-400 mt-1 mr-1">${time}</span>
                    </div>
                    <div class="flex-shrink-0 w-10 h-10 ml-2 bg-[#FACC15] rounded-full flex items-center justify-center shadow-lg">
                        <i class="bi bi-person-fill text-[#0F4175] text-base"></i>
                    </div>
                </div>
            `;
        } else {
            // BOT MESSAGE
            messageDiv.innerHTML = `
                <div class="flex items-end mb-4 pr-4">
                    <div class="flex-shrink-0 w-10 h-10 mr-2 rounded-full overflow-hidden shadow-lg border-2 border-blue-600">
                        <img src="{{ asset('images/chatbot-avatar.png') }}" alt="Chatbot" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col items-start max-w-[85%]">
                        <div class="bg-white text-gray-800 p-4 rounded-2xl rounded-bl-none shadow-md border border-gray-100 w-fit break-words">
                            <div class="text-sm leading-relaxed whitespace-pre-wrap">${formatBotMessage(text)}</div>
                        </div>
                        <span class="text-xs text-gray-400 mt-1 ml-1">${time}</span>
                    </div>
                </div>
            `;
        }

        // Insert message BEFORE the typing indicator (if it exists)
        // This keeps the HTML structure clean, but we will force the indicator to bottom when shown
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
        // Move indicator to the very bottom of the chat window before showing
        chatWindow.appendChild(typingIndicator);
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

// Helper function for Quick Buttons
function sendQuickMessage(text) {
    const chatInput = document.getElementById('chat-input');
    chatInput.value = text;
    const event = new Event('submit', { cancelable: true });
    document.getElementById('chat-form').dispatchEvent(event);
}
</script>
@endsection