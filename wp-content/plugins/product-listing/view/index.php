<div class="row" data-ng-app="product" data-ng-controller="productListController">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                    <th>Név</th>
                    <th>Ár</th>
                    <th>Hozzáadva</th>
                    <th>Műveletek</th>
                </tr> 
        </thead>
        <tbody>
            <tr data-ng-repeat="product in products track by $index">
                <th scope="row">{{ product.id }}</th>
                <td><input data-ng-model="product.name"></td>
                <td><input data-ng-model="product.price"></td>
                <td><input data-ng-model="product.created_at"></td>
                <td>
                    <button class="btn btn-primary btn-small" data-ng-click="updateProduct(product)">
                        Frissités 
                    </button> 
                </td>
            </tr>
        </tbody>
    </table>
</div>