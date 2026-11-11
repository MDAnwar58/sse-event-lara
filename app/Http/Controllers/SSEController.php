<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class SSEController extends Controller
{
    public function sendSSE()
    {
        // Set headers for SSE
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');
        header('Access-Control-Allow-Origin: *');
        header('X-Accel-Buffering: no'); // Disable buffering for Nginx

        // Prevent the script from timing out
        set_time_limit(0);

        // Disable output buffering
        while (ob_get_level()) {
            ob_end_flush();
        }
        ob_implicit_flush(true);

        // Loop to keep the connection open
        while (true) {
            // Check for new messages
            $message = Message::where('is_read', 0)->first();

            if ($message) {
                $eventData = [
                    'message' => $message->message,
                ];

                // Format the data as SSE
                echo "data: " . json_encode($eventData) . "\n\n";

                // Mark the message as read
                $message->is_read = 1;
                $message->save(); // Using save() instead of update()

            } else {
                // If no message, send a comment to keep the connection alive
                echo ": keep-alive\n\n";
            }

            // Flush the output to the client
            ob_flush();
            flush();

            // Check if the client has disconnected
            if (connection_aborted()) {
                break;
            }

            // Wait for 2 seconds before checking again
            sleep(2);
        }
    }
}
