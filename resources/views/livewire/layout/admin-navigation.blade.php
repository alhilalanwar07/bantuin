<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <div class="sidebar" data-background-color="white">
        <div class="sidebar-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
                <a href="#" class="logo">
                    <img src="{{ url('/') }}/assets/img/logo/logo_bantuindong_12.webp" alt="bantuindong" height="30" />
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
            <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <li class="nav-item {{ Route::is('home') ? 'active text-info' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}" >
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Masters</h4>
                    </li>
                    <!-- specialization -->
                    <li class="nav-item {{ Route::is('admin.specialization')? 'active text-info' : '' }}">
                        <a class="nav-link" href="{{ route('admin.specialization') }}" wire:navigate>
                            <i class="fas fa-certificate"></i>
                            <p>
                                Specialization
                            </p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Advertisement</h4>
                    </li>
                    <li class="nav-item {{ Route::is('admin.customer') ? 'active text-info' : '' }}">
                        <a class="nav-link" href="{{ route('admin.customer') }}" wire:navigate>
                            <i class="fas fa-users"></i>
                            <p>Customers</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('admin.advertisement')? 'active text-info' : '' }}">
                        <a class="nav-link" href="{{ route('admin.advertisement') }}" wire:navigate>
                        <i class="fa fa-address-book" aria-hidden="true"></i>
                            <p>Advertisement</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Services</h4>
                    </li>
                    <li class="nav-item {{ Route::is('admin.provider') ? 'active text-info' : '' }}">
                        <a class="nav-link" href="{{ route('admin.provider') }}" wire:navigate>
                            <i class="fas fa-user-tie"></i>
                            <p>Providers</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('admin.rating') ? 'active text-info' : '' }}">
                        <a class="nav-link" href="{{ route('admin.rating') }}" wire:navigate>
                            <i class="fas fa-star"></i>
                            <p>Rating</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('admin.service-request')? 'active text-info' : '' }}">
                        <a class="nav-link" href="{{ route('admin.service-request') }}" wire:navigate>
                            <i class="fas fa-envelope"></i>
                            <p>Service Request</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Output</h4>
                    </li>
                    <li class="nav-item {{ Route::is('admin.report-statistics')? 'active text-info' : '' }}">
                        <a class="nav-link" href="{{ route('admin.report-statistics') }}" wire:navigate>
                            <i class="fas fa-chart-bar"></i>
                            <p>Report & Statistics</p>
                        </a>
                    </li>

                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Settings</h4>
                    </li>
                    @if(auth()->user()->role == 'admin')
                    <li class="nav-item {{ Route::is('admin.manajemen-user') ? 'active text-info' : '' }}">
                        <a class="nav-link" href="{{ route('admin.manajemen-user') }}" wire:navigate>
                            <i class="fas fa-users"></i>
                            <p>Manajemen User</p>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item {{ Route::is('profil') ? 'active text-info' : '' }}">
                        <a class="nav-link" href="{{ route('profil') }}" wire:navigate>
                            <i class="fas fa-user"></i>
                            <p>Profil</p>
                        </a>
                    </li>


                    <br>
                    <div class="px-4">
                        <li class="nav-item" style="padding: 0px !important;">
                            <a href="#" wire:click="logout" class=" text-center btn btn-sm btn-danger w-100 btn-block d-flex justify-content-center align-items-center" style="padding: 0px !important;">
                                <i class="fas fa-sign-out-alt fa-lg m-2 p-1"></i> &nbsp;
                                <p style="padding: 0px !important; margin: 5px !important">Keluar</p>
                            </a>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
