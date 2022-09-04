<?php
    $facilities = [
        [
            'title' => 'Facility 1',
            "image" => 'images/facilities/1.svg',
            'description' => " Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Sed, quae. Rem ab sed quidem aperiam tenetur, veritatis libero suscipit sequi optio, 
            exercitationem doloremque soluta. Unde, sunt. Corrupti necessitatibus laudantium nulla?"
        ],
        [
            'title' => 'Facility 2',
            "image" => 'images/facilities/2.svg',
            'description' => " Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Sed, quae. Rem ab sed quidem aperiam tenetur, veritatis libero suscipit sequi optio, 
            exercitationem doloremque soluta. Unde, sunt. Corrupti necessitatibus laudantium nulla?"
        ],
        [
            'title' => 'Facility 2',
            "image" => 'images/facilities/3.svg',
            'description' => " Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Sed, quae. Rem ab sed quidem aperiam tenetur, veritatis libero suscipit sequi optio, 
            exercitationem doloremque soluta. Unde, sunt. Corrupti necessitatibus laudantium nulla?"
        ],
        [
            'title' => 'Facility 2',
            "image" => 'images/facilities/4.svg',
            'description' => " Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Sed, quae. Rem ab sed quidem aperiam tenetur, veritatis libero suscipit sequi optio, 
            exercitationem doloremque soluta. Unde, sunt. Corrupti necessitatibus laudantium nulla?"
        ],
        [
            'title' => 'Facility 2',
            "image" => 'images/facilities/5.svg',
            'description' => " Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Sed, quae. Rem ab sed quidem aperiam tenetur, veritatis libero suscipit sequi optio, 
            exercitationem doloremque soluta. Unde, sunt. Corrupti necessitatibus laudantium nulla?"
        ],
        [
            'title' => 'Facility 2',
            "image" => 'images/facilities/6.svg',
            'description' => " Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Sed, quae. Rem ab sed quidem aperiam tenetur, veritatis libero suscipit sequi optio, 
            exercitationem doloremque soluta. Unde, sunt. Corrupti necessitatibus laudantium nulla?"
        ],
    ];
?>

<div class="container">
    <div class="row">
        <?php foreach($facilities as $key => $facility): ?>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2 gap-2">
                        <img src="<?=$facility['image']?>" width="40px">
                        <h5 class="m-0"><?=$facility['title']?></h5>
                    </div>
                    <p><?=$facility['description']?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>