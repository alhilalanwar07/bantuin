<x-admin-layout>
    @section('title', 'Report & Statistics')
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="/">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Report & Statistics</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <livewire:admin.report-statistics />
        </div>
    </div>
</x-admin-layout>