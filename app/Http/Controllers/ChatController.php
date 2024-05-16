<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message; // Import model Message

class ChatController extends Controller
{
    // Phương thức để hiển thị trang chat
    public function showChat()
    {
        // Hiển thị view chat.blade.php
        return view('chat.indexchat');
    }

    // Phương thức để lấy danh sách tin nhắn
    public function getMessages()
    {
        // Lấy danh sách tin nhắn từ cơ sở dữ liệu
        $messages = Message::all();

        // Trả về danh sách tin nhắn dưới dạng JSON
        return response()->json($messages);
    }

    // Phương thức để gửi tin nhắn mới
    public function sendMessage(Request $request)
    {
        // Validate dữ liệu tin nhắn
        $validatedData = $request->validate([
            'content' => 'required|string|max:255', // Content của tin nhắn không được trống, là chuỗi và không quá 255 ký tự
        ]);

        // Tạo một tin nhắn mới
        $message = new Message();
        $message->content = $request->content; // Lấy nội dung tin nhắn từ request
        $message->save(); // Lưu tin nhắn vào cơ sở dữ liệu

        // Trả về phản hồi cho client
        return response()->json(['message' => 'Tin nhắn đã được gửi thành công!']);
    }
}
