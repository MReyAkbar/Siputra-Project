@extends('layouts.app') {{-- Pastikan ini adalah file layout Tailwind Anda --}}

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-center">
        <div class="w-full md:w-2/3">
            {{-- Ini adalah pengganti "card" di Tailwind --}}
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                
                {{-- Pengganti "card-header" --}}
                <div class="p-4 border-b border-gray-200">
                    <h1 class="text-xl font-semibold text-gray-800">Chatbot</h1>
                </div>

                {{-- Pengganti "card-body" --}}
                <div class="p-4 flex flex-col space-y-4" id="chat-window" style="height: 60vh; overflow-y: auto;">
                    {{-- Pengganti "alert alert-secondary" --}}
                    <div class="bg-gray-100 text-gray-800 p-3 rounded-lg w-3/4 mr-auto">
                        Welcome to the chat! Type a message below.
                    </div>
                </div>

                {{-- Pengganti "card-footer" dan "input-group" --}}
                <div class="p-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex space-x-3">
                        {{-- Pengganti "form-control" --}}
                        <input type="text" id="chat-input" 
                               class="flex-1 border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" 
                               placeholder="Type your message...">
                        
                        {{-- Pengganti "btn btn-primary" --}}
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors" id="send-button">
                            Send
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

