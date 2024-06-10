<?php
use App\Models\Post;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('sinhvien', function ($trail) {
    $trail->parent('Home',route('home'));
    $trail->push('Quản lý sinh viên',route('sinhvien'));
});

?>