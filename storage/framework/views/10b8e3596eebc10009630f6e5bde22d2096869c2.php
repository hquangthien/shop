<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Danh mục</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <?php
                $current_cat = "";
                if (isset($objCat))
                    {
                        $current_cat = $objCat->id;
                    }
            ?>
            <?php $__currentLoopData = $objSuperCat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $superCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $collapse = "collapse";
                if (isset($objCat)){
                    if ($objCat->id == $superCat->id || $objCat->parrent_cat == $superCat->id){
                        $collapse = "in";
                    }
                }
                ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a <?php if($current_cat == $superCat->id): ?> style="color: #FE980F;" <?php endif; ?> href="<?php echo e(route('shop.product.cat', ['slug' => str_slug($superCat->name), 'id' => $superCat->id])); ?>">
                            <?php echo e($superCat->name); ?>

                        </a>
                        <?php if(isset($objSubCat1[$superCat->id])): ?>
                        <a data-toggle="collapse" class="toggle-panel-title" href="#<?php echo e(str_slug($superCat->name)); ?>">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        </a>
                        <?php endif; ?>
                    </h4>
                </div>
                <?php if(isset($objSubCat1[$superCat->id])): ?>
                    <div id="<?php echo e(str_slug($superCat->name)); ?>" class="panel-collapse  <?php echo e($collapse); ?>">
                        <div class="panel-body">
                            <ul>
                                <?php $__currentLoopData = $objSubCat1[$superCat->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a <?php if($current_cat == $subCat1->id): ?> style="color: #FE980F;" <?php endif; ?> href="<?php echo e(route('shop.product.cat', ['slug' => str_slug($subCat1->name), 'id' => $subCat1->id])); ?>">
                                        <?php echo e($subCat1->name); ?>

                                    </a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div><!--/category-products-->

        <div class="shipping text-center"><!--shipping-->
            <?php if(!sizeof($objRightAdv) == 0): ?>
                <img src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($objRightAdv[0]->image); ?>" alt="">
            <?php else: ?>
                <img src="<?php echo e($publicUrl); ?>images/home/qc.jpeg" alt="">
            <?php endif; ?>
        </div><!--/shipping-->

    </div>
</div>