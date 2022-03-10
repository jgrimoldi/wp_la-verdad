<main id="timer">
    <section class="timer d-flex">
        <div class="timer__info">
            <h1>La Verdad</h1>
            <h2>Página en construcción</h2>
            <p>Muy pronto la actualidad de Río Negro en un solo sitio!</p>
        </div>
        <div class="timer__countdown d-flex">
            <div class="timer__countdown-d">
                <p class="big-number" id="days">0</p>
                <span class="title">Días</span>
            </div>
            <div class="timer__countdown-h">
                <p class="big-number" id="hours">0</p>
                <span class="title">Horas</span>
            </div>
            <div class="timer__countdown-min">
                <p class="big-number" id="mins">0</p>
                <span class="title">Minutos</span>
            </div>
            <div class="timer__countdown-sec">
                <p class="big-number" id="secs">0</p>
                <span class="title">Segundos</span>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo BASE_URL . 'static/js/countdown.js' ?>"></script>