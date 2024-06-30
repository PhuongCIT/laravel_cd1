<div class="lg-3 sm-3 alert alert-primary">
    <nav class=" navbar navbar-light  navbar-expand-sm">
        <div class=" collapse navbar-collapse " id="navbarCollapse">
            <div class="d-flex navbar-nav mx-auto">
                @foreach ($list_menu as $rowmenu)
                    <x-main-menu-item :$rowmenu />
                @endforeach
    </nav>
</div>
