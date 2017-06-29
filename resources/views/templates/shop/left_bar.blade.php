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
            @foreach($objSuperCat as $superCat)
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
                        <a @if($current_cat == $superCat->id) style="color: #FE980F;" @endif href="{{ route('shop.product.cat', ['slug' => str_slug($superCat->name), 'id' => $superCat->id]) }}">
                            {{ $superCat->name }}
                        </a>
                        @if(isset($objSubCat1[$superCat->id]))
                        <a data-toggle="collapse" class="toggle-panel-title" href="#{{ str_slug($superCat->name) }}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        </a>
                        @endif
                    </h4>
                </div>
                @if(isset($objSubCat1[$superCat->id]))
                    <div id="{{ str_slug($superCat->name) }}" class="panel-collapse  {{ $collapse }}">
                        <div class="panel-body">
                            <ul>
                                @foreach($objSubCat1[$superCat->id] as $subCat1)
                                <li>
                                    <a @if($current_cat == $subCat1->id) style="color: #FE980F;" @endif href="{{ route('shop.product.cat', ['slug' => str_slug($subCat1->name), 'id' => $subCat1->id]) }}">
                                        {{ $subCat1->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
            @endforeach
        </div><!--/category-products-->

        <div class="shipping text-center"><!--shipping-->
            @if(!sizeof($objRightAdv) == 0)
                <img src="{{ Storage::url('app/files/') }}{{ $objRightAdv[0]->image }}" alt="">
            @else
                <img src="{{ $publicUrl }}images/home/qc.jpeg" alt="">
            @endif
        </div><!--/shipping-->

    </div>
</div>