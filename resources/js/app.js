import './bootstrap';


// window.Vue = require('vue').default();


window.edit = function () {
    // Select all tags
    var input = document.querySelectorAll('input.control');
    var select = document.querySelectorAll('select.control');
    var p = document.querySelectorAll('p');
    var textarea = document.querySelectorAll('textarea');
    var button = document.querySelectorAll('div button'); // In task edit page
    var camera_icon = document.querySelectorAll('.fa-camera'); // In profiles pages
    var div = document.querySelectorAll('#multi-select'); // In profiles pages


    // Convert NodeList to Array

    input = Array.from(input)
    select = Array.from(select)
    p = Array.from(p);
    textarea = Array.from(textarea)
    button = Array.from(button)
    camera_icon = Array.from(camera_icon)
    div = Array.from(div)

    // Concat all elements
    var elements = input.concat(select, p, textarea, button, camera_icon, div);


    for (const elem of elements) {
        // Remove hidden if it exists, else add hidden
        elem.classList.toggle('hidden');
    }
}


window.submitForm = function () {
    document.getElementById('secondForm').submit();
}

