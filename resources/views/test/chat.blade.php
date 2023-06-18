




<div class="fixed bottom-4 right-4 z-50 flex items-center">
    {{-- <p class="text-white text-sm bg-blue-500 px-4 py-2 rounded-l-full">Chat dengan admin</p> --}}
    <button
      id="chat-toggle"
      class="flex items-center justify-center w-12 h-12 bg-blue-500 rounded-full text-white shadow-lg">
      <svg
        class="w-6 h-6"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M19 14l-4 2v5l-3-3H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v6a2 2 0 01-1 1"
        />
      </svg>
    </button>
  
    <div id="chat-wrapper" class="hidden">
      <div class="fixed bottom-4 right-4 w-100 bg-white rounded-lg shadow-lg">
        <div class="p-4">
          <div class="flex items-center mb-4">
            <img src="../img/avataritem.png" alt="Avatar" class="w-8 h-8 rounded-full mr-2">
            <h4 class="text-lg font-semibold">Customer Support</h4>
          </div>
          
        </div>
      </div>
    </div>
  
  </div>
  <style>
  
    #chat-toggle:focus {
      outline: none;
    }
  
    #chat-wrapper {
      transition: transform 0.3s ease-in-out;
    }
  
    #chat-toggle.active ~ #chat-wrapper {
      transform: translateX(-100%);
    }
  </style>
  <script>
    document.getElementById('chat-toggle').addEventListener('click', function() {
      this.classList.toggle('active');
      document.getElementById('chat-wrapper').classList.toggle('hidden');
    });
  </script>