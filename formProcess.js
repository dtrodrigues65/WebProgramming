window.addEventListener('load', function() {
    'use strict';
    
    const l_form = document.getElementById('orderForm');
    l_form.termsChkbx.addEventListener ("click", terms);
    l_form.submit.addEventListener("click", checkForm);
    this.document.getElementById("orderToys").addEventListener ("click", calculateCost);
    this.document.getElementById("collection").addEventListener ("click", calculateCost);

    let ntl_total = 0;

    function terms() {
        if (l_form.termsChkbx.checked) {
            document.getElementById("termsText").style.fontWeight = 'normal';
            document.getElementById("termsText").style.color = 'black';
            l_form.submit.disabled = false;
        } else {
            document.getElementById("termsText").style.fontWeight = 'bold';
            document.getElementById("termsText").style.color = 'red';
            l_form.submit.disabled = true;
        }
    }

    function calculateCost () {
        const l_toys = l_form.querySelectorAll('div.item');
        const l_toysCount = l_toys.length;

        ntl_total = 0;
        
        for (let i = 0; i < l_toysCount ; i++) {
            const t_toy = l_toys[i];
            const t_checkbox = t_toy.querySelector('input[data-price][type=checkbox]');
            if (t_checkbox.checked) {
                ntl_total += parseFloat(t_checkbox.dataset.price);
            }
        }

        if (ntl_total == 0) {
            l_form.total.value = 0;
        } else {
            let ntl_ship = 0;
            const l_shippings = l_form.querySelectorAll('input[name=deliveryType]');
            for (let i = 0; i < l_shippings.length; i++) {
                const shipping = l_shippings[i];
                if (shipping.checked) {
                    ntl_ship = parseFloat(shipping.dataset.price);
                }
            }

            const totalCost = ntl_ship + ntl_total;
            l_form.total.value = totalCost.toFixed(2);
        }
        
    }

    function checkForm (_evt) {
        let ev = false;
        if (l_form.forename.value.length == 0) {
            alert ("Please fill your forename");
            ev = true;
        } else if (l_form.surname.value.length == 0) {
            alert("Please fill your surname");
            ev = true;
        } else if (ntl_total == 0) {
            alert ("Please select a product");
            ev = true;
        }
        if (ev) {
            _evt.preventDefault(); 
        }
    }






});