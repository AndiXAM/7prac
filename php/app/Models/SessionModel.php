<?php


class SessionModel {
    public function startSession() {
        session_start(); 
    }

    public function getUsername() {
        return $_SESSION['username'] ?? 'user123';
    }

    public function getTheme() {
        return $_SESSION['theme'] ?? 'dark';
    }

    public function getLanguage() {
        return $_SESSION['language'] ?? 'ru';
    }

    public function setCookies() {
        if (!isset($_COOKIE['username2'])) {
            setcookie('username2', 'user123', time() + (86400), "/");
        }
        if (!isset($_COOKIE['theme2'])) {
            setcookie('theme2', 'dark', time() + (86400), "/"); 
        }
        if (!isset($_COOKIE['language2'])) {
            setcookie('language2', 'ru', time() + (86400), "/"); 
        }
    }

    public function getCookieData() {
        return [
            'username' => $_COOKIE['username2'] ?? '',
            'theme' => $_COOKIE['theme2'] ?? '',
            'language' => $_COOKIE['language2'] ?? ''
        ];
    }
}