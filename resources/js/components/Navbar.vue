<template>
    <nav id="navbar_element" class="navbar navbar-expand-lg navbar-light fixed-top orange-stress-transparent">
        <a class="navbar-brand larafont-nav ml-2" href="/">Generator</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav fb-around-align-center w-100">
                <li class="nav-item dropdown li-stretch">
                    <a class="nav-link dropdown-toggle larafont-navlink" href="#" id="generateDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Генерировать
                    </a>
                    <div class="dropdown-menu" aria-labelledby="generateDropdown">
                        <a class="dropdown-item larafont-navlink-dropdown" href="/generate/zajavaIspit">Заява - іспит</a>
                    </div>
                </li>
                <li class="nav-item li-stretch">
                    <a class="nav-link larafont-navlink" href="/manage">База данных</a>
                </li>
                <li class="nav-item li-stretch">
                    <a class="nav-link larafont-navlink" href="#">Профиль</a>
                </li>
                <li class="nav-item dropdown li-stretch">
                    <a class="nav-link dropdown-toggle larafont-navlink" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Настройки
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item larafont-navlink-dropdown" href="#">Action</a>
                        <a class="dropdown-item larafont-navlink-dropdown" href="#">Another action</a>
                        <a class="dropdown-item larafont-navlink-dropdown" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>

</script>
