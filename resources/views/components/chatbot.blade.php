<div id="chatbot">
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
                    Xin chào! 👋 Mình là trợ lý của Simple Shop.<br>
                    Shop chuyên về <strong>Giày thể thao & Sneaker</strong> chính hãng. Bạn cần tìm mẫu giày (Sneaker,
                    Running, Basketball...) hay cần tư vấn đo size giày (36-45) cứ nhắn cho mình nhé! 👟
                </div>

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="card-footer bg-white">

            <div class="input-group">

                <input type="text" id="chatInput" class="form-control"
                    placeholder="Hỏi về mẫu giày, tư vấn size chân..." autocomplete="off">

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
        if (chatWindow.classList.contains('d-none')) {
            chatWindow.classList.remove('d-none');
        } else
            chatWindow.classList.add('d-none');
        chatInput.focus();

    });


    // =========================
    // CLOSE CHAT
    // =========================

    closeChat.addEventListener('click', function() {

        chatWindow.classList.add('d-none');

        // openChat.classList.remove('d-none');

    });


    // =========================
    // SEND MESSAGE (CÓ LOADING & GỌI API)
    // =========================

    async function sendChatMessage() {

        const message = chatInput.value.trim();

        if (message === '') {
            return;
        }

        // -------------------------
        // 1. USER MESSAGE
        // -------------------------
        const userMessage = document.createElement('div');
        userMessage.className = 'd-flex justify-content-end mb-3';
        userMessage.innerHTML = `
            <div class="bg-primary text-white rounded-3 p-2" style="max-width: 80%;">
                ${message}
            </div>
        `;
        chatMessages.appendChild(userMessage);

        // Clear input và scroll
        chatInput.value = '';
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // -------------------------
        // 2. HIỆN BONG BÓNG LOADING & KHÓA NÚT
        // -------------------------
        chatInput.disabled = true;
        sendMessage.disabled = true;

        const loadingId = 'chat-loading-' + Date.now();
        const loadingMessage = document.createElement('div');
        loadingMessage.id = loadingId;
        loadingMessage.className = 'd-flex mb-3';
        loadingMessage.innerHTML = `
            <div class="bg-white border rounded-3 p-2 shadow-sm text-muted" style="max-width: 80%;">
                <small class="text-muted d-block mb-1">AI Assistant</small>
                <div class="d-flex align-items-center gap-2">
                    <span class="spinner-border spinner-border-sm text-primary" role="status"></span>
                    <small>Đang tìm giày phù hợp...</small>
                </div>
            </div>
        `;
        chatMessages.appendChild(loadingMessage);
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // -------------------------
        // 3. GỌI API BACKEND LARAVEL
        // -------------------------
        try {
            const response = await fetch('{{ route('chatbot.send') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    message: message
                })
            });

            const data = await response.json();

            // Xóa bong bóng loading
            const loadingEl = document.getElementById(loadingId);
            if (loadingEl) loadingEl.remove();

            // -------------------------
            // 4. HIỂN THỊ CÂU TRẢ LỜI AI
            // -------------------------
            const botMessage = document.createElement('div');
            botMessage.className = 'd-flex mb-3';
            botMessage.innerHTML = `
                <div class="bg-white border rounded-3 p-2 shadow-sm" style="max-width: 80%;">
                    <small class="text-muted d-block mb-1">
                        AI Assistant
                    </small>
                    <div style="white-space: pre-line;">${data.reply || 'Xin lỗi, mình chưa tìm thấy thông tin phù hợp.'}</div>
                </div>
            `;
            chatMessages.appendChild(botMessage);
            chatMessages.scrollTop = chatMessages.scrollHeight;

        } catch (error) {
            console.error('Lỗi kết nối chatbot:', error);
            const loadingEl = document.getElementById(loadingId);
            if (loadingEl) loadingEl.remove();

            const botMessage = document.createElement('div');
            botMessage.className = 'd-flex mb-3';
            botMessage.innerHTML = `
                <div class="bg-white border border-danger text-danger rounded-3 p-2 shadow-sm" style="max-width: 80%;">
                    <small class="d-block mb-1">Hệ thống</small>
                    Có lỗi kết nối tạm thời. Bạn vui lòng thử lại nhé!
                </div>
            `;
            chatMessages.appendChild(botMessage);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        } finally {
            // Mở khóa input và nút gửi
            chatInput.disabled = false;
            sendMessage.disabled = false;
            chatInput.focus();
        }

    }


    // =========================
    // CLICK SEND
    // =========================

    sendMessage.addEventListener('click', sendChatMessage);


    // =========================
    // PRESS ENTER
    // =========================

    chatInput.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            sendChatMessage();
        }

    });
</script>
