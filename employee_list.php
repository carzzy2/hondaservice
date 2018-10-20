<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<div class="container-fluid">
    <div class="product-status-wrap table table-responsive">
        <h4>Products List</h4>
        <table>
            <tbody><tr>
                <th>Image</th>
                <th>Product Title</th>
                <th>Status</th>
                <th>Purchases</th>
                <th>Product sales</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Setting</th>
            </tr>
            <tr>
                <td><img src="img/new-product/5-small.jpg" alt=""></td>
                <td>Jewelery Title 1</td>
                <td>
                    <button class="pd-setting">Active</button>
                </td>
                <td>50</td>
                <td>$750</td>
                <td>Out Of Stock</td>
                <td>$15</td>
                <td>
                    <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Trash"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </td>
            </tr>
            <tr>
                <td><img src="img/new-product/6-small.jpg" alt=""></td>
                <td>Jewelery Title 2</td>
                <td>
                    <button class="ps-setting">Paused</button>
                </td>
                <td>60</td>
                <td>$1020</td>
                <td>In Stock</td>
                <td>$17</td>
                <td>
                    <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Trash"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </td>
            </tr>
            <tr>
                <td><img src="img/new-product/7-small.jpg" alt=""></td>
                <td>Jewelery Title 3</td>
                <td>
                    <button class="ds-setting">Disabled</button>
                </td>
                <td>70</td>
                <td>$1050</td>
                <td>Low Stock</td>
                <td>$15</td>
                <td>
                    <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Trash"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </td>
            </tr>
            <tr>
                <td><img src="img/new-product/5-small.jpg" alt=""></td>
                <td>Jewelery Title 4</td>
                <td>
                    <button class="pd-setting">Active</button>
                </td>
                <td>120</td>
                <td>$1440</td>
                <td>In Stock</td>
                <td>$12</td>
                <td>
                    <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Trash"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </td>
            </tr>
            <tr>
                <td><img src="img/new-product/6-small.jpg" alt=""></td>
                <td>Jewelery Title 5</td>
                <td>
                    <button class="pd-setting">Active</button>
                </td>
                <td>30</td>
                <td>$540</td>
                <td>Out Of Stock</td>
                <td>$18</td>
                <td>
                    <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Trash"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </td>
            </tr>
            <tr>
                <td><img src="img/new-product/7-small.jpg" alt=""></td>
                <td>Jewelery Title 6</td>
                <td>
                    <button class="ps-setting">Paused</button>
                </td>
                <td>400</td>
                <td>$4000</td>
                <td>In Stock</td>
                <td>$10</td>
                <td>
                    <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Trash"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </td>
            </tr>
            </tbody></table>
        <div class="custom-pagination">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
