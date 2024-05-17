<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
</head>
<body>
    <div>
        <h1>Chat</h1>
        <div id="messages">
            <!-- Danh sách tin nhắn sẽ được hiển thị ở đây -->
        </div>
        <form id="messageForm">
            <input type="text" id="content" placeholder="Nhập tin nhắn...">
            <button type="submit">Gửi</button>
        </form>
    </div>

    <!-- Sử dụng Axios để tương tác với API -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        // Gửi yêu cầu lấy danh sách tin nhắn khi trang được tải
        window.onload = function() {
            axios.get('/messages')
                .then(function(response) {
                    const messages = response.data;
                    const messagesDiv = document.getElementById('messages');
                    messages.forEach(function(message) {
                        const messageElement = document.createElement('p');
                        messageElement.textContent = message.content;
                        messagesDiv.appendChild(messageElement);
                    });
                })
                .catch(function(error) {
                    console.error('Có lỗi khi lấy danh sách tin nhắn:', error);
                });
        };

        // Xử lý sự kiện gửi tin nhắn
        document.getElementById('messageForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const content = document.getElementById('content').value;
            axios.post('/messages', { content: content })
                .then(function(response) {
                    alert(response.data.message);
                    // Sau khi gửi tin nhắn thành công, làm mới danh sách tin nhắn
                    document.getElementById('messages').innerHTML = '';
                    window.onload(); // Gửi yêu cầu lấy danh sách tin nhắn mới
                })
                .catch(function(error) {
                    console.error('Có lỗi khi gửi tin nhắn:', error);
                });
        });
    </script>
</body>
</html>
