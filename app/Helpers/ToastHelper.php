<?php


namespace App\Helpers;


class ToastHelper
{
    public static function backgroundHeader($status)
    {
        switch ($status) {
            case 'success':
                return 'bg-success';
                break;
            case 'error':
                return 'bg-danger';
                break;

            case 'warning':
                return 'bg-warning';
                break;

            case 'info':
                return 'bg-primary';
                break;

            default:
                return 'bg-secondary';
                break;
        }
    }

    public static function backgroundBody($status)
    {
        switch ($status) {
            case 'success':
                return 'bg-light-success';
                break;
            case 'error':
                return 'bg-light-danger';
                break;

            case 'warning':
                return 'bg-light-warning';
                break;

            case 'info':
                return 'bg-light-primary';
                break;

            default:
                return 'bg-light-secondary';
                break;
        }
    }

    public static function svgicon($status)
    {
        switch ($status) {
            case 'success':
                return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black"/>
            </svg>';
                break;
            case 'error':
                return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"/>
                <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"/>
                <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"/>
            </svg>';
                break;

            case 'warning':
                return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black"/>
                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"/>
            </svg>';
                break;

            case 'info':
                return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                <rect x="11" y="17" width="7" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"/>
                <rect x="11" y="9" width="2" height="2" rx="1" transform="rotate(-90 11 9)" fill="black"/>
            </svg>';
                break;

            default:
                return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                <rect x="11" y="17" width="7" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"/>
                <rect x="11" y="9" width="2" height="2" rx="1" transform="rotate(-90 11 9)" fill="black"/>
            </svg>';
                break;
        }
    }

    public static function textColor($status)
    {
        switch ($status) {
            case 'success':
                return 'success';
                break;
            case 'error':
                return 'danger';
                break;

            case 'warning':
                return 'warning';
                break;

            case 'info':
                return 'primary';
                break;

            default:
                return 'secondary';
                break;
        }
    }
}
