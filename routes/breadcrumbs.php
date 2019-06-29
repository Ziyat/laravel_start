<?php

use App\Domain\User\Entities\User;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;

Breadcrumbs::register('home', function (Crumbs $crumbs) {
    $crumbs->push('Home', route('home'));
});

Breadcrumbs::register('login', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Login', route('login'));
});

Breadcrumbs::register('password.request', function (Crumbs $crumbs) {
    $crumbs->parent('login');
    $crumbs->push('Reset Password', route('password.request'));
});

Breadcrumbs::register('password.reset', function (Crumbs $crumbs) {
    $crumbs->parent('password.request');
    $crumbs->push('Change', route('password.reset'));
});

Breadcrumbs::register('register', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Register', route('register'));
});

Breadcrumbs::register('cabinet.home', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Cabinet', route('cabinet.home'));
});

Breadcrumbs::register('admin.home', function (Crumbs $crumbs) {
    $crumbs->push('Dashboard', route('admin.home'));
});

Breadcrumbs::register('admin.user.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Users', route('admin.user.index'));
});

Breadcrumbs::register('admin.user.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.user.index');
    $crumbs->push('Create', route('admin.user.create'));
});

Breadcrumbs::register('admin.user.show', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.user.index');
    $crumbs->push($user->name, route('admin.user.show', $user));
});

Breadcrumbs::register('admin.user.edit', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.user.show', $user);
    $crumbs->push('Edit', route('admin.user.edit', $user));
});

