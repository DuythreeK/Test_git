<div id="chatbot">

    {{-- ============================= --}}
    {{-- CHAT WINDOW --}}
    {{-- ============================= --}}

    <div id="chatWindow" class="card shadow-lg border-0 d-none"
        style="
            position: fixed;
            right: 25px;
            bottom: 95px;
            width: 360px;
            height: 500px;
            z-index: 1050;
        ">

        {{-- HEADER --}}
        <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">

            <div class="d-flex align-items-center">

                {{-- Avatar nhỏ --}}
                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-2"
                    style="width: 40px; height: 40px;">
                    🤖
                </div>

                <div>
                    <div class="fw-bold">
                        AI Assistant
                    </div>

                    <small>
                        <span class="text-success">●</span>
                        Online
                    </small>
                </div>

            </div>

            {{-- Close button --}}
            <button type="button" id="closeChat" class="btn btn-sm text-white fs-4">
                &times;
            </button>

        </div>


        {{-- BODY --}}
        <div id="chatMessages" class="card-body overflow-auto bg-light">

            {{-- Bot message --}}
            <div class="d-flex mb-3">

                <div class="bg-white border rounded-3 p-2 shadow-sm" style="max-width: 80%;">
                    <small class="text-muted d-block mb-1">
                        AI Assistant
                    </small>
                    Xin chào! 👋

                    <br>

                    Tôi có thể giúp gì cho bạn?
                </div>

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="card-footer bg-white">

            <div class="input-group">

                <input type="text" id="chatInput" class="form-control" placeholder="Nhập tin nhắn..."
                    autocomplete="off">

                <button type="button" id="sendMessage" class="btn btn-primary">
                    <i class="bi bi-send"></i>
                    ➤
                </button>

            </div>

        </div>

    </div>


    {{-- ============================= --}}
    {{-- FLOATING CHATBOT BUTTON --}}
    {{-- ============================= --}}

    <button type="button" id="openChat"
        class="btn btn-primary rounded-circle shadow-lg d-flex align-items-center justify-content-center"
        style="
            position: fixed;
            right: 25px;
            bottom: 25px;
            width: 60px;
            height: 60px;
            z-index: 1049;
            font-size: 26px;
        ">
        🤖
    </button>

</div>


{{-- ============================= --}}
{{-- JAVASCRIPT --}}
{{-- ============================= --}}

<script>
    const openChat = document.getElementById('openChat');

    const closeChat = document.getElementById('closeChat');

    const chatWindow = document.getElementById('chatWindow');

    const chatInput = document.getElementById('chatInput');

    const sendMessage = document.getElementById('sendMessage');

    const chatMessages = document.getElementById('chatMessages');


    // =========================
    // OPEN CHAT
    // =========================

    openChat.addEventListener('click', function() {

        chatWindow.classList.remove('d-none');

        openChat.classList.add('d-none');

        chatInput.focus();

    });


    // =========================
    // CLOSE CHAT
    // =========================

    closeChat.addEventListener('click', function() {

        chatWindow.classList.add('d-none');

        openChat.classList.remove('d-none');

    });


    // =========================
    // SEND MESSAGE
    // =========================

    function sendChatMessage() {

        const message = chatInput.value.trim();

        if (message === '') {
            return;
        }


        // -------------------------
        // USER MESSAGE
        // -------------------------

        const userMessage = document.createElement('div');

        userMessage.className =
            'd-flex justify-content-end mb-3';


        userMessage.innerHTML = `

            <div
                class="bg-primary text-white rounded-3 p-2"
                style="max-width: 80%;"
            >

                ${message}

            </div>

        `;


        chatMessages.appendChild(userMessage);


        // Clear input

        chatInput.value = '';


        // Scroll xuống cuối

        chatMessages.scrollTop =
            chatMessages.scrollHeight;


        // -------------------------
        // BOT RESPONSE
        // -------------------------

        setTimeout(function() {

            const botMessage =
                document.createElement('div');


            botMessage.className =
                'd-flex mb-3';


            botMessage.innerHTML = `

                <div
                    class="bg-white border rounded-3 p-2 shadow-sm"
                    style="max-width: 80%;"
                >

                    <small class="text-muted d-block mb-1">
                        AI Assistant
                    </small>

                    Tôi đã nhận được:

                    <strong>
                        ${message}
                    </strong>

                    🤖

                </div>

            `;


            chatMessages.appendChild(botMessage);


            // Scroll xuống cuối

            chatMessages.scrollTop =
                chatMessages.scrollHeight;

        }, 700);

    }


    // =========================
    // CLICK SEND
    // =========================

    sendMessage.addEventListener(
        'click',
        sendChatMessage
    );


    // =========================
    // PRESS ENTER
    // =========================

    chatInput.addEventListener(
        'keydown',
        function(event) {

            if (event.key === 'Enter') {

                event.preventDefault();

                sendChatMessage();

            }

        }
    );
</script>
