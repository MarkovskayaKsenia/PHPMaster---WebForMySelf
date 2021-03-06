<!--banner-starts-->
<div class="bnr" id="home">
    <div  id="top" class="callbacks_container">
        <ul class="rslides" id="slider4">
            <li>
                <img src="images/bnr-1.jpg" alt=""/>
            </li>
            <li>
                <img src="images/bnr-2.jpg" alt=""/>
            </li>
            <li>
                <img src="images/bnr-3.jpg" alt=""/>
            </li>
        </ul>
    </div>
    <div class="clearfix"> </div>
</div>
<!--banner-ends-->
<!--about-starts-->
<?php if ($brands): ?>
<div class="about">
    <div class="container">
        <div class="about-top grid-1">
            <?php foreach ($brands as $brand): ?>
            <div class="col-md-4 about-left">
                <figure class="effect-bubba">
                    <img class="img-responsive" src="/images/<?= $brand->img; ?>" alt=""/>
                    <figcaption>
                        <h2><?= $brand->title; ?></h2>
                        <p><?= $brand->description; ?></p>
                    </figcaption>
                </figure>
            </div>
            <?php endforeach; ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php endif; ?>
<!--about-end-->
<!--product-starts-->
<?php if($hits): ?>
<?php $currency = \ishop\App::$app->getProperty('currency'); ?>
<div class="product">
    <div class="container">
        <div class="product-top">
            <div class="product-one products">
                <?php foreach($hits as $hit): ?>
                <div class="col-md-3 product-left product-item">
                    <div class="product-main simpleCart_shelfItem">
                        <a href="/product/<?= $hit->alias; ?>" class="mask"><img class="img-responsive zoom-img" src="/images/<?= $hit->img; ?>" alt="" /></a>
                        <div class="product-bottom">
                            <h3><a href="/product/<?= $hit->alias; ?>"><?= $hit->title; ?></a></h3>
                            <p>Explore Now</p>
                            <h4><a data-id="<?= $hit->id; ?>" class="add-to-cart-link" href="/cart/add?id=<?= $hit->id; ?>"><i></i></a>
                                <span class=" item_price">
                                    <?= $currency['symbol_left']; ?>
                                    <?= $hit->price * $currency['value']; ?>
                                    <?= $currency['symbol_right']; ?>
                                </span>
                                <?php if($hit->old_price): ?>
                                <small>
                                    <del>
                                        <?= $currency['symbol_left']; ?>
                                        <?= $hit->old_price * $currency['value']; ?>
                                        <?= $currency['symbol_right']; ?>
                                    </del>
                                </small>
                                <?php endif; ?>
                            </h4>
                        </div>
                        <?php if($hit->old_price && $hit->old_price > $hit->price): ?>
                            <div class="srch">
                                <span>-<?= ceil((1 - $hit->price / $hit->old_price) * 100) ; ?>%</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<!--product-end-->
<!--Slider-Starts-Here-->

<!--End-slider-script-->