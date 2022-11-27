<?php

if (! function_exists('selected')) {
    function selected($value, $targetValue) {
        return $value === $targetValue ? 'selected' : '';
    }
}

if (! function_exists('is_filled')) {
    function is_filled($errors, $data = '') {
        return !empty($errors) || !empty($data) ? 'is-filled' : '';
    }
}
