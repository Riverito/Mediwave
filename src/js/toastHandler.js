import { Toastify } from "../../node_modules/toastify-js/src/toastify.js";

function flashToast(message, type='primary'){
    if( type='error' ){
        Toastify({
            text: message,
            duration: 4000,
            newWindow: true,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #B05151, #BA0000)",
            },
            onClick: function () {}, // Callback after click
        }).showToast();
    }else if(type='warning'){
        Toastify({
            text: message,
            duration: 4000,
            newWindow: true,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #ffc107, #ebd07e)",
            },
            onClick: function () {}, // Callback after click
        }).showToast();
    }else{
        Toastify({
            text: message,
            duration: 4000,
            newWindow: true,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #7f38b7, #b892d7)",
            },
            onClick: function () {}, // Callback after click
        }).showToast();
    }
    
}
