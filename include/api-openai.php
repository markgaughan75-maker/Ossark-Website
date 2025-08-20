<?php
/**
 * Lumely – OpenAI helpers
 * Expect OPENAI_API_KEY to be defined in wp-config.php or available via environment var.
 */

if (!defined('ABSPATH')) { exit; }

function lumely_openai_key() {
    // Prefer constant in wp-config; otherwise environment.
    if (defined('OPENAI_API_KEY') && OPENAI_API_KEY) return OPENAI_API_KEY;
    $env = getenv('OPENAI_API_KEY');
    return $env ? $env : '';
}

function lumely_openai_request($url, $payload, $headers = []) {
    $apiKey = lumely_openai_key();
    if (!$apiKey) {
        return new WP_Error('openai_no_key', 'OpenAI API key missing');
    }

    $default_headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
    ];
    $headers = array_merge($default_headers, $headers);

    $args = [
        'method'      => 'POST',
        'headers'     => $headers,
        'body'        => wp_json_encode($payload),
        'timeout'     => 60,
        'data_format' => 'body',
    ];

    $response = wp_remote_post($url, $args);
    if (is_wp_error($response)) return $response;

    $code = wp_remote_retrieve_response_code($response);
    $body = json_decode(wp_remote_retrieve_body($response), true);

    if ($code < 200 || $code >= 300) {
        return new WP_Error('openai_http_error', 'OpenAI HTTP error', [
            'status' => $code,
            'body'   => $body
        ]);
    }

    return $body;
}

/**
 * Chat completion (GPT)
 * $messages = [['role'=>'system','content'=>'...'], ['role'=>'user','content'=>'...']]
 */
function lumely_openai_chat($messages, $model = 'gpt-4o-mini', $opts = []) {
    $url = 'https://api.openai.com/v1/chat/completions';
    $payload = array_merge([
        'model'    => $model,
        'messages' => $messages,
        'temperature' => isset($opts['temperature']) ? $opts['temperature'] : 0.2,
        'max_tokens'  => isset($opts['max_tokens']) ? $opts['max_tokens'] : 1000,
    ], $opts);

    $res = lumely_openai_request($url, $payload);
    if (is_wp_error($res)) return $res;

    return $res['choices'][0]['message']['content'] ?? '';
}

/**
 * Image generation (GPT-Image-1)
 */
function lumely_openai_image($prompt, $size = '1024x1024', $opts = []) {
    $url = 'https://api.openai.com/v1/images/generations';
    $payload = array_merge([
        'model'  => 'gpt-image-1',
        'prompt' => $prompt,
        'size'   => $size,
        'n'      => 1,
        // set 'response_format' => 'b64_json' if you want base64
    ], $opts);

    $res = lumely_openai_request($url, $payload);
    if (is_wp_error($res)) return $res;

    return $res['data'][0] ?? null; // returns ['url'=>...] or ['b64_json'=>...]
}

/**
 * Example AJAX endpoint: generate design options text
 */
add_action('wp_ajax_lumely_generate_design', 'lumely_generate_design');
add_action('wp_ajax_nopriv_lumely_generate_design', 'lumely_generate_design');
function lumely_generate_design() {
    $brief = isset($_POST['brief']) ? wp_strip_all_tags($_POST['brief']) : '';
    if (!$brief) wp_send_json_error(['message'=>'Missing brief'], 400);

    $messages = [
        ['role'=>'system','content'=>'You are an interior/visual design assistant for real estate media. Respond concisely.'],
        ['role'=>'user','content'=>"Create 3 design options based on this brief:\n\n".$brief],
    ];

    $reply = lumely_openai_chat($messages, 'gpt-4o-mini', ['max_tokens'=>800]);
    if (is_wp_error($reply)) wp_send_json_error(['message'=>$reply->get_error_message()], 500);

    wp_send_json_success(['text'=>$reply]);
}

/**
 * Example AJAX endpoint: generate a staging image URL
 * (Front-end: upload image to your server/CDN first; then craft a prompt describing edits.)
 */
add_action('wp_ajax_lumely_virtual_staging', 'lumely_virtual_staging');
add_action('wp_ajax_nopriv_lumely_virtual_staging', 'lumely_virtual_staging');
function lumely_virtual_staging() {
    $prompt = isset($_POST['prompt']) ? sanitize_text_field($_POST['prompt']) : '';
    if (!$prompt) wp_send_json_error(['message'=>'Missing prompt'], 400);

    $image = lumely_openai_image($prompt, '1024x1024');
    if (is_wp_error($image)) wp_send_json_error(['message'=>$image->get_error_message()], 500);

    wp_send_json_success($image);
}
