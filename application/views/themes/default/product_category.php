<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include('header.php');?>

<div class="row">
<?php foreach($data as $row):?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="product-box">
            <div class="image-thumb">
              <?php if($row['image'] !=''):?>
                <a href="<?=product_link($row['id'])?>"><img src="<?=base_url()?>assets/uploads/thumb/<?=$row['image']?>" alt="<?=$row['name']?>" /></a>
              <?php else:?>
                <a href="<?=product_link($row['id'])?>"><img src="<?=base_url()?>assets/images/no-image.png" alt="<?=$row['name']?>" /></a>
              <?php endif;?>
            </div>
            <div class="caption">
                <h4><a href="<?=product_link($row['id'])?>"><?=$row['name']?></a></h4>
                <p><?=mb_substr(strip_tags(stripslashes($row['description'])), 0, 100); ?></p>
                <p class="price">
                  <span class="price-new">$<?=$row['price']?></span>
                  <span class="price-old"><strike>$<?=$row['list_price']?></strike></span>
                </p>
            </div>
            <div class="btns">
                <button class="btn btn-add-cart add-cart" data-id="<?=$row['id']?>"><i class="fa fa-shopping-cart"></i> <?=lang('add_to_cart')?> <span class="load"></span></button>
            </div>
        </div>
    </div>
<?php endforeach;?>
</div>
<div><ul class="pagination"> <?=$pagination->create_links();?></ul></div>
<?php include('footer.php');?>