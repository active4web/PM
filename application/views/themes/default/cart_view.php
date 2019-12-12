<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include('header.php');?>

<form action="<?=base_url()?>cart/update" method="post">
  <div  class="row">
    <div class="col-md-9 col-sm-9">

<?php
  $totalAmount = 0;
  foreach($data as $row):

  $price = $row['price'];
?>
        <div class="cart-box">
           <div class="row">
             <div class="col-md-2 col-sm-3 col-xs-4">
              <div class="image-thumb">
                <?php if($row['image'] !=''):?>
                  <a href="<?=product_link($row['id'])?>"><img src="<?=base_url()?>assets/uploads/thumb/<?=$row['image']?>" alt="<?=$row['name']?>" /></a>
                <?php else:?>
                  <a href="<?=product_link($row['id'])?>"><img src="<?=base_url()?>assets/images/no-image.png" alt="<?=$row['name']?>" /></a>
                <?php endif;?>
              </div>
             </div>
             <div class="col-md-10 col-sm-9 col-xs-8">
                 <h3><?=$row['name']?></h3>

                  <div><span class="price"><?=$price?> $</span>  <small>(<?=$row['name']?>)</small></div>

                  <?php
                    foreach($contents as $key => $val):
                    if($key ==$row['id']):
                  ?>
                      <div class="qty">
                        <label><?=lang('qty')?> </label> <input type="number" min="1" name="qty<?=$row['id']?>" value="<?=$val?>" />
                        * <span class="price"><?=$price?> <span class="cur"><?=lang('dinar')?></span></span> =
                        <span class="price"><?=($price*$val)?> <span class="cur"><?=lang('dinar')?></span></span>
                      </div>

                      <?
                        $totalAmount = $totalAmount+$price*$val;
                      ?>
                    <?endif;?>
                  <?endforeach;?>
             </div>
           </div>
            <hr />
            <div><center><a class="btn btn-default" href="<?=base_url()?>cart/delete/<?=$row['id']?>"><i class="glyphicon glyphicon-remove"></i> <?=lang('delete')?></a></center></div>
            </div>
          <?endforeach;?>


    </div>
    <div class="col-md-3 col-sm-3">
       <div class="total-amount"><?=lang('total')?>: <span class="price"><?=$totalAmount?></span> $</div>
       <div style="text-align: center;margin: 6px;">+ 0.500 <?=lang('dinar')?> رسوم توصيل</div>
       <br>
       <input type="submit" class="btn btn-primary btn-block" value="تحديث السلة" />
       <br>
       <a class="btn btn-success btn-block" href="<?=base_url()?>order">Checkout</a>
    </div>
  </div>

</form>

<?php include('footer.php');?>