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
                        <a class="dropdown-item larafont-navlink-dropdown" href="/generate/zvedenaVidomist">Зведена вiдомiсть</a>
                        <a class="dropdown-item larafont-navlink-dropdown" href="/generate/vpiskaOzinok">Вписка оцiнок</a>
                        <a class="dropdown-item larafont-navlink-dropdown" href="/generate/vidomistMod1">Вiдомiсть (модуль 1)</a>
                        <a class="dropdown-item larafont-navlink-dropdown" href="/generate/vidomistMod2">Вiдомiсть (модуль 2)</a>
                        <a class="dropdown-item larafont-navlink-dropdown" href="/generate/vidomistKr">Вiдомiсть КР</a>
                    </div>

                </li>
                <li class="nav-item li-stretch">
                    <a class="nav-link larafont-navlink" href="/manage">База данных</a>
                </li>
                <li class="nav-item li-stretch">
                    <a class="nav-link larafont-navlink" href="#">Профиль</a>
                </li>
                <li class="nav-item dropdown li-stretch">
                    <a class="nav-link dropdown-toggle larafont-navlink" href="#" id="settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Настройки
                    </a>
                    <div class="dropdown-menu" aria-labelledby="settings">
                        <a class="dropdown-item larafont-navlink-dropdown" href="/settings">Основные</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>

</script>
