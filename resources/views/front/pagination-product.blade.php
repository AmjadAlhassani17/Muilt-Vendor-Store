<div class="tab-pane fade show active" id="nav-grid" role="tabpanel" aria-labelledby="nav-grid-tab">
    <div class="row">
        @foreach ($productsGrid as $product)
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Product -->
                <x-product335 :product="$product" />
                <!-- End Single Product -->
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Pagination -->
            <div class="pagination">
                <ul class="pagination-list">
                    {{ $productsGrid->links() }}
                </ul>
            </div>
            <!--/ End Pagination -->
        </div>
    </div>
</div>
<div class="tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
    <div class="row">
        @foreach ($productsList as $product)
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Start Single Product -->
                <x-product-card-list :product="$product" />
                <!-- End Single Product -->
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Pagination -->
            <div class="pagination">
                <ul class="pagination-list">
                    {{ $productsList->links() }}
                </ul>
            </div>
            <!--/ End Pagination -->
        </div>
    </div>
</div>
