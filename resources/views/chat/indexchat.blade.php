@extends('header.dashboard')
<style>
        #chat-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 300px;
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            padding: 15px;
            z-index: 1000;
        }
    </style>
@section('content') 
<!-- Phần chat -->
<div id="chat-container" style="display: none;">
    <h5>Chat</h5>
    <div id="message-container">
        <!-- Danh sách tin nhắn sẽ được hiển thị ở đây -->
    </div>
    <form id="message-form">
        <div class="form-group">
            <textarea id="message" class="form-control" rows="3" placeholder="Nhập tin nhắn của bạn"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script>
    $(document).ready(function(){
        // Hiển thị hoặc ẩn phần chat khi nhấn nút mở chat
        $('#open-chat').click(function(){
            $('#chat-container').toggle();
        });

        // Xử lý sự kiện khi gửi tin nhắn
        $('#message-form').submit(function(e){
            e.preventDefault(); // Ngăn chặn việc gửi form một cách mặc định

            // Lấy nội dung tin nhắn từ textarea
            var message = $('#message').val();

            // Gửi tin nhắn đến server (bạn cần phải xử lý phần này bằng Ajax)

            // Xóa nội dung tin nhắn sau khi gửi
            $('#message').val('');
        });
    });
</script> -->
@endsection