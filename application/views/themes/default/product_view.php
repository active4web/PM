<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include('header.php');?>

<ol class="breadcrumb">
  <li><a href="<?=base_url()?>"><i class="fa fa-tachometer-alt"></i> <?=lang('dashboard')?></a></li>
  <li><a href="<?=base_url()?>/product/<?=$category['id']?>"><?=$category['name']?></a></li>
  <li class="active"><?=$product['name']?></li>
</ol>

<div class="content-view">
    <div class="row">
        <div class="col-md-4 col-xs-5">
           <div class="images">
             <img src="<?=base_url()?>assets/uploads/<?=$product['image']?>" alt="<?=$product['name']?>" />
           </div>
        </div>
        <div class="col-md-8 col-xs-7">
            <h1><?=$product['name']?></h1>
            <div>
              <ul>
                <li><?=lang('brand')?>: SAMSUNG </li>
                <li><?=lang('list_price')?>: <strike>$<?=$product['list_price']?></strike> </li>
                <li><?=lang('price')?>: $<?=$product['price']?></li>
                <li><?=lang('code')?>: <?=$product['code']?></li>
                <li><?=lang('qty')?>: <input type="number" name="qty" value="1" min="1" max="<?=$product['stock_amount']?>" /></li>
              </ul>
            </div>

        </div>
    </div>
</div>

<?php include('footer.php');?>