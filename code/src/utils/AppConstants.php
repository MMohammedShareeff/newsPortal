<?php
namespace App\Utils;

class AppConstants
{
    public const ROLE_ADMIN = 'ADMIN';
    public const ROLE_AUTHOR = 'AUTHOR';
    public const ROLE_EDITOR = 'EDITOR';

    public const STATUS_PENDING = 'جاري المراجعة';
    public const STATUS_PUBLISHED = 'موافق عليه';
    public const STATUS_REJECTED = 'مرفوض';
    public const STATUS_ACTIVE = 'مفعل';

}