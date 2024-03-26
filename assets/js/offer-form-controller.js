const standard_creation = document.querySelector('.offer-wrapper > form:nth-child(1)');
const list = standard_creation.querySelector('.product-list');
const product = list.querySelector('.product').innerHTML;
const add_prod_btn = list.lastElementChild.onclick = () => {
    const new_product = document.createElement('div');
    new_product.innerHTML = product;
    new_product.className = "product";
    const delete_entry_btn = document.createElement('button');
    delete_entry_btn.type = "button";
    delete_entry_btn.innerText = "remove";
    delete_entry_btn.className = "remove-entry";
    delete_entry_btn.onclick = (e) => {
        e.target.parentElement.remove();
    };
    
    // Yeah, it does work but if we were to use JSON to transfer data we'd have to manualy create inputs with unique names
    // or to be specific, iterators, something like: entry 1: name_0, selection_0; entry 2: name_1, selection_1 etc etc.
    // product wrapper = entry wrapper
    // a product in an offer is an entry
    
    new_product.insertAdjacentElement("beforeend", delete_entry_btn);
    list.insertBefore(new_product, list.lastElementChild);
}


// note to myself: that interesting, and other familar ones idk -> FileList
