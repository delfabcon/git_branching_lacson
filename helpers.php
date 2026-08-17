<?php

define('MAX_QUESTION_NUMBER', 5);

function retrieve_questions() {
    $file_path = __DIR__ . "/questions/triviaquiz.json";
    if (!file_exists($file_path)) {
        return ['questions' => [], 'answers' => []];
    }
    $json_string = file_get_contents($file_path);
    $json_data = json_decode($json_string, true);
    return $json_data ?? ['questions' => [], 'answers' => []];
}

function get_all_questions() {
    $data = retrieve_questions();
    return $data['questions'] ?? [];
}

function get_answers() {
    $data = retrieve_questions();
    return $data['answers'] ?? [];
}

function get_current_question($answers = '') {
    $number_of_answers = strlen($answers);
    $questions = retrieve_questions();
    return $questions['questions'][$number_of_answers] ?? null;
}

function get_current_question_number($answers = '') {
    return strlen($answers) + 1;
}

function get_options_for_question_number($number = 0) {
    $questions = retrieve_questions();
    return $questions['questions'][$number - 1]['options'] ?? [];
}

function compute_score($user_answers = []) {
    $correct_answers = get_answers();
    $total_questions = count($correct_answers);
    
    $score = 0;
    for ($i = 0; $i < $total_questions; $i++) {
        $user_ans = $user_answers[$i] ?? null;
        $correct_ans = $correct_answers[$i] ?? null;
        if (!is_null($user_ans) && $user_ans === $correct_ans) {
            $score++;
        }
    }
    return $score;
}

function format_birthdate($date_str) {
    if (empty($date_str)) {
        return 'N/A';
    }
    $timestamp = strtotime($date_str);
    if ($timestamp === false) {
        return $date_str;
    }
    return date('F j, Y', $timestamp);
}

function get_first_name($complete_name) {
    $trimmed = trim($complete_name ?? '');
    if (empty($trimmed)) {
        return 'Examinee';
    }
    $parts = preg_split('/\s+/', $trimmed);
    return $parts[0] ?? 'Examinee';
}
