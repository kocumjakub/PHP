import SlimSelect from "slim-select";
import i18next from "i18next";

class Product {
    constructor(selectProduct,quantityInput,priceInput,imgTable,formIndex)
    {
        this.productSlimSelect = selectProduct.selectEl;
        this.productQuantity = quantityInput;
        this.productUnitPrice = priceInput;
        this.img = imgTable;
        this.formIndex = formIndex;
        this.productSlimSelect.dataset.formIndex = formIndex;
    }

    getFormIndex()
    {
        return this.formIndex
    }

    setProductPictureUrl(id)
    {
        let locale = this.productSlimSelect.dataset.locale;
        let endpoint = this.productSlimSelect.dataset.endpoint;
        fetch(`/admin/${locale}/store-reservation/search/${endpoint}?` + new URLSearchParams({pictureItemId: id}), {
            method: 'GET',
        })
            .then((response) => response.json())
            .then((data) => {
                this.img.src = data.url
            });
    }

    setProductSelectDatasetWarehouseId(id)
    {
        this.productSlimSelect.dataset.warehouseId = id;
    }

    getSelectedItem()
    {
        return this.productSlimSelect.slim.getSelected()[0];
    }

    resetProduct()
    {
        this.productSlimSelect.slim.setData([]);
        this.productQuantity.value = '';
        this.productUnitPrice.value = '';
        this.img.src = '';
    }

    getProductUnitPrice(id,countryName)
    {
        let locale = this.productSlimSelect.dataset.locale;
        let endpoint = this.productSlimSelect.dataset.endpoint;
        fetch(`/admin/${locale}/store-reservation/search/${endpoint}?` + new URLSearchParams({itemId: id, countryName: countryName}), {
            method: 'GET',
        })
            .then((response) => response.json())
            .then((data) => {
                this.setUnitPrice(data.price)
            });
    }

    setUnitPrice(value)
    {
        this.productUnitPrice.value = value;
    }
}

class Client {
    constructor(selectClient,firstNameInput,lastNameInput,emailInput,phoneInput) {
        this.clientSelectSlim = selectClient.selectEl;
        this.firstNameIn = firstNameInput;
        this.lastNameIn = lastNameInput;
        this.emailIn = emailInput;
        this.phoneIn = phoneInput;
    }

    setClientSelectDatasetCountryName(value)
    {
        this.clientSelectSlim.dataset.countryName = value;
    }

    enableClientSelect()
    {
        this.clientSelectSlim.removeAttribute('disabled');
    }

    getClientSelectDatasetCountryName()
    {
        return this.clientSelectSlim.dataset.countryName;
    }

    setClientInputs(id)
    {
        let locale = this.clientSelectSlim.dataset.locale;
        let endpoint = this.clientSelectSlim.dataset.endpoint;
        fetch(`/admin/${locale}/store-reservation/search/${endpoint}?` + new URLSearchParams({clientId: id}), {
            method: 'GET',
        })
            .then((response) => response.json())
            .then((data) => {
                this.setFirstNameInputsByString(data.name);
                this.setLastNameInputsByString(data.surname);
                this.setEmailInputsByString(data.email);
                this.setPhoneInputsByString(data.phone);
            });
    }

    resetClient()
    {
        this.setFirstNameInputsByString('');
        this.setLastNameInputsByString('');
        this.setEmailInputsByString('');
        this.setPhoneInputsByString('');
        this.resetClientSelectSlim();
    }

    resetClientSelectSlim()
    {
        this.clientSelectSlim.slim.setSelected('');
    }

    setFirstNameInputsByString(value)
    {
        this.firstNameIn.value = value;
    }

    setLastNameInputsByString(value)
    {
        this.lastNameIn.value = value;
    }

    setEmailInputsByString(value)
    {
        this.emailIn.value = value;
    }

    setPhoneInputsByString(value)
    {
        this.phoneIn.value = value;
    }
}

class Warehouse{
    constructor(selectWarehouse,pickupLimitAt) {
        this.warehouseSelectSlim = selectWarehouse.selectEl;
        this.pickupLimitAt = pickupLimitAt;
    }

    getWarehouseSelectSelected()
    {
        return this.warehouseSelectSlim.slim.getSelected()[0];
    }

    getCountryNameFromSelectedOption()
    {
        let data = this.warehouseSelectSlim.slim.getData();
        let countryName = undefined;
        data.forEach(item => {
            if (item.selected === true) {
                countryName = item.text.substring(item.text.length - 3,item.text.length - 1);
            }
        });

        return countryName;
    }

    setDatePickupLimitAt(countryName)
    {
        let locale = this.warehouseSelectSlim.dataset.locale;
        let endpoint = this.warehouseSelectSlim.dataset.endpoint;
        fetch(`/admin/${locale}/store-reservation/search/${endpoint}?` + new URLSearchParams({countryName: countryName}), {
            method: 'GET',
        })
            .then((response) => response.json())
            .then((data) => {
                this.pickupLimitAt.value = data.date;
            });
    }
}

const ajaxSelect = (element) => new SlimSelect({
    select: '#' + element.id,
    settings: {
        searchText: i18next.t('reservation:storeReservation.create.items.form.noResults'),
        searchingText: i18next.t('reservation:storeReservation.create.items.form.searching'),
        searchPlaceholder: i18next.t('reservation:storeReservation.create.items.form.startTyping'),
        searchHighlight: true,
        placeholderText: i18next.t('reservation:storeReservation.create.items.form.placeholder'),
        allowDeselect: true
    },
    events: {
        search: (search, currentData) => {
            return new Promise((resolve, reject) => {
                if (search.length < 3) {
                    return reject(i18next.t('reservation:storeReservation.create.items.form.minChars'));
                }
                let urlParams = new URLSearchParams({searchString: search, countryName: element.dataset.countryName, warehouseId: element.dataset.warehouseId});
                fetch(`/admin/${element.dataset.locale}/store-reservation/search/${element.dataset.endpoint}?` + urlParams, {
                    method: 'GET',
                })
                    .then((response) => response.json())
                    .then((data) => {
                        const options = data.map((entity) => {
                            switch (element.dataset.endpoint) {
                                case 'warehouse':
                                    return {
                                        text: `${entity.name} (${entity.countryname})`,
                                        value: `${entity.id}`,
                                    };
                                case 'client':
                                    return {
                                        text: `${entity.name} ${entity.surname} (${entity.email}, ${entity.phone})`,
                                        value: `${entity.id}`,
                                    };
                                case 'item':
                                   return {
                                       text: `${entity.name} (${entity.code})`,
                                       value: `${entity.id}`,
                                   };
                            }
                        });
                        resolve(options);
                    });
            });
        },
        afterChange: (newVal) => {
            if (element.dataset.endpoint === 'warehouse'){
                 if (newVal[0].text.length > 0){
                     client.setClientSelectDatasetCountryName(newVal[0].text.substring(newVal[0].text.length - 3,newVal[0].text.length - 1));
                 }
                 client.resetClientSelectSlim();
                 client.enableClientSelect();

                 warehouse.setDatePickupLimitAt(client.getClientSelectDatasetCountryName());

                 document.getElementById('product-add-btn').removeAttribute('disabled');
                 addedProducts.forEach(product => {
                     product.resetProduct();
                     if (newVal[0].value.length > 0){
                         product.setProductSelectDatasetWarehouseId(newVal[0].value);
                     }
                 });
            }

            if (element.dataset.endpoint === 'client' && newVal[0].value.length > 0){
                client.setClientInputs(newVal[0].value);
            }

            if (element.dataset.endpoint === 'item' && newVal[0].value.length > 0) {
                let countryName = client.getClientSelectDatasetCountryName();
                let index = element.dataset.formIndex;
                addedProducts.forEach(product => {
                    if(product.getFormIndex() === index) {
                        product.getProductUnitPrice(newVal[0].value,countryName);
                        product.setProductPictureUrl(newVal[0].value);
                    }
                })
            }
        }
    }
});

let addedProducts = [];

const warehouse = new Warehouse(
    ajaxSelect(document.getElementById('store_reservation_create_catalogWarehouse')),
    document.getElementById('store_reservation_create_pickupLimitDate')
);

const client = new Client(
    ajaxSelect(document.getElementById('store_reservation_create_client')),
    document.getElementById('store_reservation_create_firstName'),
    document.getElementById('store_reservation_create_lastName'),
    document.getElementById('store_reservation_create_email'),
    document.getElementById('store_reservation_create_phone')
)

if (warehouse.getWarehouseSelectSelected() !== undefined){
    client.enableClientSelect();
    client.setClientSelectDatasetCountryName(warehouse.getCountryNameFromSelectedOption());
}

document
    .querySelectorAll('.add_item_link')
    .forEach(btn => {
        btn.addEventListener("click", addFormToCollection);
        btn.classList.add("btn");
        btn.classList.add("btn-default");
        btn.classList.add("btn-sm");
        if (warehouse.getWarehouseSelectSelected() !== undefined){
            btn.removeAttribute('disabled');
        }
    });

function addProductIntoProducts(indexOfAddedElements,item)
{
    const product = new Product(
        ajaxSelect(document.getElementById('store_reservation_create_items_'+indexOfAddedElements+'_item')),
        document.getElementById('store_reservation_create_items_'+indexOfAddedElements+'_quantity'),
        document.getElementById('store_reservation_create_items_'+indexOfAddedElements+'_unitPrice'),
        document.getElementById('store_reservation_create_items_'+indexOfAddedElements+'_img'),
        indexOfAddedElements
    );
    product.setProductSelectDatasetWarehouseId(warehouse.getWarehouseSelectSelected());

    addTagFormDeleteLink(item,indexOfAddedElements);

    addedProducts.push(product);

    document.getElementById('product-add-btn').setAttribute('disabled', 'disabled');
    document.getElementById('product-add-btn').style.visibility = 'hidden';
}

document
    .querySelectorAll('table.reservationItems tbody tr')
    .forEach((item) => {
        let idSplit = item.children[1].firstChild.id.split('_');
        let indexOfAddedElements = idSplit[(idSplit.length - 2)];
        addProductIntoProducts(indexOfAddedElements,item);
        let countryName = client.getClientSelectDatasetCountryName();
        let product = addedProducts.filter(product => {
            return product.getFormIndex() === indexOfAddedElements
        })[0];
        if (product.getSelectedItem() !== undefined && countryName !== undefined){
            product.setProductPictureUrl(product.getSelectedItem());
            product.getProductUnitPrice(product.getSelectedItem(),countryName);
        }
    });

function addFormToCollection(e) {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

    const item = document.createElement('tr');

    item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
            /__name__/g,
            collectionHolder.dataset.index
        );

    collectionHolder.appendChild(item);

    let indexOfAddedElements = collectionHolder.dataset.index;

    collectionHolder.dataset.index++;

    addProductIntoProducts(indexOfAddedElements,item);
}

function addTagFormDeleteLink(item,index) {
    /*
    const removeFormButtonDiv = document.createElement('div');
    removeFormButtonDiv.classList.add("form-row");
    removeFormButtonDiv.classList.add("mt-3");
    removeFormButtonDiv.classList.add("mb-3");

    const removeFormButton = document.createElement('button');
    removeFormButton.innerHTML = '<span nowrap="nowrap">' + i18next.t('reservation:storeReservation.create.items.form.delete') + '</span>';
    removeFormButton.classList.add("btn");
    removeFormButton.classList.add("btn-danger");
    removeFormButton.classList.add("btn-sm");

    removeFormButtonDiv.appendChild(removeFormButton);

    item.append(removeFormButtonDiv);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        item.remove();
        addedProducts = addedProducts.filter(product => {
            return product.getFormIndex() !== index
        });
    });
    */
}

