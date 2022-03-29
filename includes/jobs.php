<?php $jobs = getPublishedPostBy("Empleos") ?>


<div class="d-flex filtered">
    <?php foreach ($jobs as $job) : ?>
        <div class="jobs filtered__item ">
            <div class="job">
                <p class="job__ubication"><i class="fas fa-map-marker-alt"></i><?php echo $job['subtitle'] ?></p>
                <h2 class="job__title navbar__container-link">Búsqueda Laboral</h2>
                <h3 class="job__place"><?php echo $job['title'] ?></h3>
                <div class="job__image">
                    <img loading="lazy" class="job__image-img" width="100" height="100" src="<?php echo BASE_URL . 'static/img/uploads/' . $job['image']  ?>" alt="<?php echo $job['title'] ?>">
                </div>
                <div class="job__body">
                    <p class="job__body-title">Tareas a desarrollar:</p>
                    <div class="job__body-text">
                        <?php echo html_entity_decode($job['body']) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>