<?php

/** @var yii\web\View $this */

$this->title = 'Home';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
    <br>
    <br>
        <h1 style= "font-family:bookman;" class="display-4">SOUTHERN ADVENTIST UNIVERSITY</h1>


       <br>
       <br>

        <p class="lead">You may select a department below:</p>
        <br>
        <br>
    </div>

    <!-- <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
           
                <h2>Computer Science</h2>

                <i class="fa fa-anchor" aria-hidden="true"></i>

                

                <p><a class="btn btn-outline-secondary" href="http://localhost/seniorproject/web/project/index">Project List &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Psychology</h2>

                
                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/forum/">Project List&raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Biology</h2>

                

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/extensions/">Project List&raquo;</a></p>
            </div>
        </div> -->

    <!-- </div> -->

    <div class="row row-cols-1 row-cols-md-2 g-24">
    
    <?php foreach ($departments as $dept) : ?>
        <div class="col">
            <div class="card text-center">
                <i class='fa <?= $dept->icon ?> fa-5x' aria-hidden="true" 
                class="center"></i>
                <div class="card-body">
                    <h5 class="card-title"> 
                        <a class="btn btn-outline-secondary" 
                        href="<?= \yii\helpers\Url::to(['/project/index', 
                        'department_id' => $dept->id]) ?>"><?= $dept->name ?></a>
                    </h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
        <!-- <a href="<?= \yii\helpers\Url::to(['/project/index', 
        'dept_id' => $dept->id]) ?>"><?= $dept->name ?></a><br/> -->
    <?php endforeach; ?>
   
    </div>

    <br/>
    <br/>


</div>
