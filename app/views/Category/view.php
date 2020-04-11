<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <?= $breadcrumbs; ?>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--prdt-starts-->
<div class="prdt">
    <div class="container">
        <div class="prdt-top">
            <div class="col-md-9">
                <?php if (!empty($products)): ?>
                <?php $currency = \ishop\App::$app->getProperty('currency'); ?>
                <div class="product-one">
                    <div class="products">
                        <?php foreach ($products as $product): ?>
                            <div class="col-md-4 product-item">
                                <div class="product-main simpleCart_shelfItem">
                                    <a href="/product/<?= $product->alias; ?>" class="mask">
                                        <img class="img-responsive zoom-img" src="/images/<?= $product->img ?>"
                                             alt="<?= $product->title ?>"/></a>
                                    <div class="product-bottom">
                                        <h3><a href="/product/<?= $product->alias; ?>"><?= $product->title ?></a>
                                        </h3>
                                        <p>Explore Now</p>
                                        <h4><a data-id="<?= $product->id; ?>" class="add-to-cart-link"
                                               href="/cart/add?id=<?= $product->id; ?>"><i></i></a>
                                            <span class=" item_price"
                                                  data-base="<?= $product->price * $currency['value']; ?>">
                                                <?= $currency['symbol_left']; ?>
                                                <?= $product->price * $currency['value']; ?>
                                                <?= $currency['symbol_right']; ?>
                                            </span>
                                            <?php if ($product->old_price): ?>
                                                <small>
                                                    <del><?= $currency['symbol_left']; ?><?= $product->old_price * $currency['value']; ?><?= $currency['symbol_right']; ?></del>
                                                </small>
                                            <?php endif; ?>
                                        </h4>
                                    </div>
                                    <div class="srch srch1">
                                        <span>
                                            <?php if ($product->old_price && $product->old_price > $product->price): ?>
                                                <span>-<?= ceil((1 - $product->price / $product->old_price) * 100); ?>%</span>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="text-center">
                        <p><?= count($products); ?> товара(ов) из <?= $total; ?></p>
                        <?php if ($pagination->countPages > 1): ?>
                            <?= $pagination; ?>
                        <? endif; ?>
                    </div>
                    <?php else: ?>
                        <h3>В этой категории товар временно отсутствует</h3>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-3 prdt-right">
                <div class="w_sidebar">
                    <?php new \app\widgets\filter\Filter(); ?>
                </div>
            </div>

        </div>
    </div>
</div>
<!--product-end-->
