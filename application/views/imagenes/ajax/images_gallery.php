<?if($imgs)foreach($imgs as $img){?>
    <div class="col-sm-2">
        <a href="<?=$img->url?>" data-toggle="lightbox" data-title="<?=$img->titulo?>"
            data-gallery="gallery">
            <img src="<?=$img->url?>" class="img-fluid mb-2" alt="Imagen" />
        </a>
    </div>
<?}?>