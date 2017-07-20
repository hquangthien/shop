<div class="col-md-12">
        <ul class="wrap-suggestion">
            <?php if(sizeof($objProductSearch) == 0): ?>
                <p class="text-center"> Không có kết quả tìm kiếm nào cho từ khóa <strong>" <?php echo e($key_search); ?> "</strong> </p>
            <?php else: ?>
            <?php $__currentLoopData = $objProductSearch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e(route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id])); ?>">
                    <img src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($product->picture); ?>" width="100px">
                    <h3><?php echo e($product->name); ?></h3>
                    <h4>Giá: <span class="price"><?php echo e(number_format($product->price - (1 - $product->promotion_price/100))); ?> VNĐ</span></h4>
                </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <li style="margin:auto"><p><a href="<?php echo e(route('shop.search', ['key_search' => $key_search])); ?>"><strong> Xem tất cả </strong></a></p></li>
        </ul>
</div>